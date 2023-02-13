<?php

namespace App\Http\Controllers;

use App;
use App\Exports\PatientExport;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\AdvancedPayment;
use App\Models\Appointment;
use App\Models\BedAssign;
use App\Models\Bill;
use App\Models\BirthReport;
use App\Models\DeathReport;
use App\Models\InvestigationReport;
use App\Models\Invoice;
use App\Models\IpdPatientDepartment;
use App\Models\OperationReport;
use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Models\Prescription;
use App\Models\Vaccination;
use App\Repositories\AdvancedPaymentRepository;
use App\Repositories\PatientRepository;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PatientController extends AppBaseController
{
    /** @var PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Patient.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $data['statusArr'] = Patient::STATUS_ARR;

        return view('patients.index', $data);
    }

    /**
     * Show the form for creating a new Patient.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('patients.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param  CreatePatientRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePatientRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $this->patientRepository->store($input);
        $this->patientRepository->createNotification($input);
        Flash::success(__('messages.advanced_payment.patient').' '.__('messages.common.saved_successfully'));

        return redirect(route('patients.index'));
    }

    /**
     * @param  int  $patientId
     * @return Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View
     */
    public function show($patientId)
    {
        $data = $this->patientRepository->getPatientAssociatedData($patientId);
        if (! $data) {
            return view('errors.404');
        }
        if (getLoggedinPatient() && checkRecordAccess($data->id)) {
            return view('errors.404');
        } else {
            $advancedPaymentRepo = App::make(AdvancedPaymentRepository::class);
            $patients = $advancedPaymentRepo->getPatients();
            $user = Auth::user();
            if ($user->hasRole('Doctor')) {
                $vaccinationPatients = getPatientsList($user->owner_id);
            } else {
                $vaccinationPatients = Patient::getActivePatientNames();
            }
            $vaccinations = Vaccination::toBase()->pluck('name', 'id')->toArray();
            natcasesort($vaccinations);

            return view('patients.show', compact('data', 'patients', 'vaccinations', 'vaccinationPatients'));
        }
    }

    /**
     * Show the form for editing the specified Patient.
     *
     * @param  Patient  $patient
     * @return Factory|View
     */
    public function edit(Patient $patient)
    {
//        $user = $patient->patientUser;
        $bloodGroup = getBloodGroups();

        return view('patients.edit', compact('patient', 'bloodGroup'));
    }

    /**
     * @param  Patient  $patient
     * @param  UpdatePatientRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(Patient $patient, UpdatePatientRequest $request)
    {
        if ($patient->is_default == 1) {
            Flash::error('This action is not allowed for default record.');

            return redirect(route('patients.index'));
        }

        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $this->patientRepository->update($input, $patient);

        Flash::success(__('messages.advanced_payment.patient').' '.__('messages.common.updated_successfully'));

        return redirect(route('patients.index'));
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param  Patient  $patient
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Patient $patient)
    {
        if ($patient->is_default == 1) {
            return $this->sendError('This action is not allowed for default record.');
        }

        $patientModels = [
            BirthReport::class, DeathReport::class, InvestigationReport::class, OperationReport::class,
            Appointment::class, BedAssign::class, PatientAdmission::class, PatientCase::class, Bill::class,
            Invoice::class, AdvancedPayment::class, Prescription::class, IpdPatientDepartment::class,
        ];
        $result = canDelete($patientModels, 'patient_id', $patient->id);
        if ($result) {
            return $this->sendError(__('messages.advanced_payment.patient').' '.__('messages.common.cant_be_deleted'));
        }
        $patient->patientUser()->delete();
        $patient->address()->delete();
        $patient->delete();

        return $this->sendSuccess(__('messages.advanced_payment.patient').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $patient = Patient::findOrFail($id);
        $status = ! $patient->patientUser->status;
        $patient->patientUser()->update(['status' => $status]);

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function patientExport()
    {
        return Excel::download(new PatientExport, 'patients-'.time().'.xlsx');
    }

    /**
     * @param $id
     * @return Patient|Builder|Model|object|null
     */
    public function getBirthDate($id)
    {
        return Patient::whereId($id)->with('user')->first();
    }
}
