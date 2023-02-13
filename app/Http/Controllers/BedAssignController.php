<?php

namespace App\Http\Controllers;

use App\Exports\BedAssignExport;
use App\Http\Requests\CreateBedAssignRequest;
use App\Http\Requests\UpdateBedAssignRequest;
use App\Models\BedAssign;
use App\Models\BedType;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Repositories\BedAssignRepository;
use Carbon\Carbon;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BedAssignController extends AppBaseController
{
    /** @var BedAssignRepository */
    private $bedAssignRepository;

    public function __construct(BedAssignRepository $bedAssignRepo)
    {
        $this->bedAssignRepository = $bedAssignRepo;
    }

    /**
     * Display a listing of the BedAssign.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $data['statusArr'] = BedAssign::STATUS_ARR;

        return view('bed_assigns.index', $data);
    }

    /**
     * Show the form for creating a new BedAssign.
     *
     * @param  Request  $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        $bedId = $request->get('bed_id', null);
        $beds = $this->bedAssignRepository->getBeds();
        $cases = $this->bedAssignRepository->getCases();

        return view('bed_assigns.create', compact('cases', 'beds', 'bedId'));
    }

    /**
     * Store a newly created BedAssign in storage.
     *
     * @param  CreateBedAssignRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateBedAssignRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $patientId = PatientCase::with('patient.patientUser')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->patientUser->dob;
        $assign_date = Carbon::parse($input['assign_date'])->toDateString();
        if (! empty($birthDate) && $assign_date < $birthDate) {
            Flash::error(__('messages.bed_assign.assign_date_should_not_be_smaller_than_patient_birth_date'));

            return redirect()->back()->withInput($input);
        }
        $this->bedAssignRepository->store($input);
        $this->bedAssignRepository->createNotification($input);
        Flash::success(__('messages.bed_assign.bed_assign').' '.__('messages.common.saved_successfully'));

        return redirect(route('bed-assigns.index'));
    }

    /**
     * Display the specified BedAssign.
     *
     * @param  BedAssign  $bedAssign
     * @return Factory|View
     */
    public function show(BedAssign $bedAssign)
    {
        return view('bed_assigns.show')->with('bedAssign', $bedAssign);
    }

    /**
     * Show the form for editing the specified BedAssign.
     *
     * @param  BedAssign  $bedAssign
     * @return Factory|View
     */
    public function edit(BedAssign $bedAssign)
    {
        $beds = $this->bedAssignRepository->getPatientBeds($bedAssign);
        $cases = $this->bedAssignRepository->getPatientCases($bedAssign);
        $ipd_patient = $bedAssign->ipdPatient ? $bedAssign->ipdPatient->ipd_number : null;

        return view('bed_assigns.edit', compact('cases', 'beds', 'bedAssign', 'ipd_patient'));
    }

    /**
     * Update the specified BedAssign in storage.
     *
     * @param  BedAssign  $bedAssign
     * @param  UpdateBedAssignRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(BedAssign $bedAssign, UpdateBedAssignRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $patientId = PatientCase::with('patient.patientUser')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->patientUser->dob;
        $assign_date = Carbon::parse($input['assign_date'])->toDateString();
        if (! empty($birthDate) && $assign_date < $birthDate) {
            Flash::error(__('messages.bed_assign.assign_date_should_not_be_smaller_than_patient_birth_date'));

            return redirect()->back()->withInput($input);
        }
        $bedAssign = $this->bedAssignRepository->update($input, $bedAssign);
        Flash::success(__('messages.bed_assign.bed_assign').' '.__('messages.common.updated_successfully'));

        return redirect(route('bed-assigns.index'));
    }

    /**
     * Remove the specified BedAssign from storage.
     *
     * @param  BedAssign  $bedAssign
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(BedAssign $bedAssign)
    {
        $bedAssign->bed->update(['is_available' => 1]);
        $this->bedAssignRepository->delete($bedAssign->id);

        return $this->sendSuccess(__('messages.bed_assign.bed_assign').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $bedAssign = BedAssign::findOrFail($id);
        $status = ! $bedAssign->status;
        $bedAssign->update(['status' => $status]);

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }

    /**
     * @return Application|Factory|View
     */
    public function bedStatus()
    {
        $bedTypes = BedType::with(['beds.bedAssigns.patient.patientUser'])->get();
        $patientAdmissions = PatientAdmission::whereHas('bed')->with('bed.bedType')->get();

        return view('bed_status.index', compact('bedTypes', 'patientAdmissions'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function bedAssignExport()
    {
        return Excel::download(new BedAssignExport, 'bed-assigns-'.time().'.xlsx');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getIpdPatientsList(Request $request)
    {
        $ipdPatients = $this->bedAssignRepository->getIpdPatients($request->get('id'));

        return $this->sendResponse($ipdPatients, 'Retrieved successfully');
    }
}
