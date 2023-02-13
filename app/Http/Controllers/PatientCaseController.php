<?php

namespace App\Http\Controllers;

use App\Exports\PatientCaseExport;
use App\Http\Requests\CreatePatientCaseRequest;
use App\Http\Requests\UpdatePatientCaseRequest;
use App\Models\BedAssign;
use App\Models\BirthReport;
use App\Models\DeathReport;
use App\Models\IpdPatientDepartment;
use App\Models\OperationReport;
use App\Models\Patient;
use App\Models\PatientCase;
use App\Repositories\PatientCaseRepository;
use Carbon\Carbon;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PatientCaseController extends AppBaseController
{
    /** @var PatientCaseRepository */
    private $patientCaseRepository;

    public function __construct(PatientCaseRepository $patientCaseManagerRepo)
    {
        $this->patientCaseRepository = $patientCaseManagerRepo;
    }

    /**
     * Display a listing of the PatientCase.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $data['statusArr'] = PatientCase::STATUS_ARR;

        return view('patient_cases.index', $data);
    }

    /**
     * Show the form for creating a new PatientCase.
     *
     * @return Factory|View
     */
    public function create()
    {
        $patients = $this->patientCaseRepository->getPatients();
        $doctors = $this->patientCaseRepository->getDoctors();

        return view('patient_cases.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created PatientCase in storage.
     *
     * @param  CreatePatientCaseRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePatientCaseRequest $request)
    {
        $input = $request->all();
        $patientId = Patient::with('patientUser')->whereId($input['patient_id'])->first();
        $birthDate = $patientId->patientUser->dob;
        $caseDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $caseDate < $birthDate) {
            Flash::error('Case date should not be smaller than patient birth date.');

            return redirect()->back()->withInput($input);
        }

        $input['fee'] = removeCommaFromNumbers($input['fee']);
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['phone'] = preparePhoneNumber($input, 'phone');

        $this->patientCaseRepository->store($input);
        $this->patientCaseRepository->createNotification($input);

        Flash::success(__('messages.case.case').' '.__('messages.common.saved_successfully'));

        return redirect(route('patient-cases.index'));
    }

    /**
     * Display the specified PatientCase.
     *
     * @param  PatientCase  $patientCase
     * @return Factory|View
     */
    public function show(PatientCase $patientCase)
    {
        return view('patient_cases.show')->with('patientCase', $patientCase);
    }

    /**
     * Show the form for editing the specified PatientCase.
     *
     * @param  PatientCase  $patientCase
     * @return Factory|View
     */
    public function edit(PatientCase $patientCase)
    {
        $patients = $this->patientCaseRepository->getPatients();
        $doctors = $this->patientCaseRepository->getDoctors();

        return view('patient_cases.edit', compact('patientCase', 'patients', 'doctors'));
    }

    /**
     * Update the specified PatientCase in storage.
     *
     * @param  PatientCase  $patientCase
     * @param  UpdatePatientCaseRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(PatientCase $patientCase, UpdatePatientCaseRequest $request)
    {
        $input = $request->all();
        $patientId = Patient::with('patientUser')->whereId($input['patient_id'])->first();
        $birthDate = $patientId->patientUser->dob;
        $caseDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $caseDate < $birthDate) {
            Flash::error('Case date should not be smaller than patient birth date.');

            return redirect()->back()->withInput($input);
        }
        $input['fee'] = removeCommaFromNumbers($input['fee']);
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['phone'] = preparePhoneNumber($input, 'phone');

        $patientCase = $this->patientCaseRepository->update($input, $patientCase->id);

        Flash::success(__('messages.case.case').' '.__('messages.common.updated_successfully'));

        return redirect(route('patient-cases.index'));
    }

    /**
     * Remove the specified PatientCase from storage.
     *
     * @param  PatientCase  $patientCase
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(PatientCase $patientCase)
    {
        $patientCaseModel = [
            BedAssign::class, BirthReport::class, DeathReport::class, OperationReport::class,
            IpdPatientDepartment::class,
        ];
        $result = canDelete($patientCaseModel, 'case_id', $patientCase->case_id);
        if ($result) {
            return $this->sendError(__('messages.case.case').' '.__('messages.common.cant_be_deleted'));
        }
        $this->patientCaseRepository->delete($patientCase->id);

        return $this->sendSuccess(__('messages.case.case').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function activeDeActiveStatus($id)
    {
        $patientCase = PatientCase::findOrFail($id);
        $patientCase->status = ! $patientCase->status;
        $patientCase->update(['status' => $patientCase->status]);

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function patientCaseExport()
    {
        return Excel::download(new PatientCaseExport, 'patient-cases-'.time().'.xlsx');
    }

    /**
     * @param  PatientCase  $patientCase
     * @return JsonResponse
     *
     * @throws \Gerardojbaez\Money\Exceptions\CurrencyException
     */
    public function showModal(PatientCase $patientCase)
    {
        $patientCase->load(['patient.patientUser', 'doctor.doctorUser']);

        $currency = $patientCase->currency_symbol ? strtoupper($patientCase->currency_symbol) : strtoupper(getCurrentCurrency());
        $patientCase = [
            'case_id' => $patientCase->case_id,
            'patient_name' => $patientCase->patient->patientUser->full_name,
            'doctor_name' => $patientCase->doctor->doctorUser->full_name,
            'phone' => $patientCase->phone,
            'date' => $patientCase->date,
            'fee' => checkNumberFormat($patientCase->fee, $currency),
            'status' => $patientCase->status,
            'created_at' => $patientCase->created_at,
            'updated_at' => $patientCase->updated_at,
            'description' => $patientCase->description,
        ];

        return $this->sendResponse($patientCase, 'Patient Case Retrieved Successfully.');
    }
}
