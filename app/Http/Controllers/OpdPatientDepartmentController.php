<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpdPatientDepartmentRequest;
use App\Http\Requests\UpdateOpdPatientDepartmentRequest;
use App\Models\DoctorOPDCharge;
use App\Models\OpdPatientDepartment;
use App\Repositories\OpdPatientDepartmentRepository;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class OpdPatientDepartmentController
 */
class OpdPatientDepartmentController extends AppBaseController
{
    /** @var OpdPatientDepartmentRepository */
    private $opdPatientDepartmentRepository;

    public function __construct(OpdPatientDepartmentRepository $opdPatientDepartmentRepo)
    {
        $this->opdPatientDepartmentRepository = $opdPatientDepartmentRepo;
    }

    /**
     * Display a listing of the OpdPatientDepartment.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('opd_patient_departments.index');
    }

    /**
     * Show the form for creating a new OpdPatientDepartment.
     *
     * @return Factory|View
     */
    public function create(Request $request)
    {
        $data = $this->opdPatientDepartmentRepository->getAssociatedData();
        $data['revisit'] = ($request->get('revisit')) ? $request->get('revisit') : 0;
        if ($data['revisit']) {
            $id = $data['revisit'];
            $data['last_visit'] = OpdPatientDepartment::findOrFail($id);
        }

        return view('opd_patient_departments.create', compact('data'));
    }

    /**
     * Store a newly created OpdPatientDepartment in storage.
     *
     * @param  CreateOpdPatientDepartmentRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateOpdPatientDepartmentRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $this->opdPatientDepartmentRepository->store($input);
        $this->opdPatientDepartmentRepository->createNotification($input);
        Flash::success(__('messages.opd_patient.opd_patient').' '.__('messages.common.saved_successfully'));

        return redirect(route('opd.patient.index'));
    }

    /**
     * Display the specified OpdPatientDepartment.
     *
     * @param  OpdPatientDepartment  $opdPatientDepartment
     * @return Factory|View
     */
    public function show(OpdPatientDepartment $opdPatientDepartment)
    {
        $doctors = $this->opdPatientDepartmentRepository->getDoctorsData();

//        $doctorsList = $this->opdPatientDepartmentRepository->getDoctorsList();
        return view('opd_patient_departments.show', compact('opdPatientDepartment', 'doctors'));
    }

    /**
     * Show the form for editing the specified Ipd Diagnosis.
     *
     * @param  OpdPatientDepartment  $opdPatientDepartment
     * @return Factory|View
     */
    public function edit(OpdPatientDepartment $opdPatientDepartment)
    {
        $data = $this->opdPatientDepartmentRepository->getAssociatedData();

        return view('opd_patient_departments.edit', compact('data', 'opdPatientDepartment'));
    }

    /**
     * Update the specified Ipd Diagnosis in storage.
     *
     * @param  OpdPatientDepartment  $opdPatientDepartment
     * @param  UpdateOpdPatientDepartmentRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(OpdPatientDepartment $opdPatientDepartment, UpdateOpdPatientDepartmentRequest $request)
    {
        $input = $request->all();
        $this->opdPatientDepartmentRepository->updateOpdPatientDepartment($input, $opdPatientDepartment);
        Flash::success(__('messages.opd_patient.opd_patient').' '.__('messages.common.updated_successfully'));

        return redirect(route('opd.patient.index'));
    }

    /**
     * Remove the specified OpdPatientDepartment from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $opdPatientDepartment = OpdPatientDepartment::findOrFail($id);
        $opdPatientDepartment->delete();

        return $this->sendSuccess(__('messages.opd_patient.opd_patient').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getPatientCasesList(Request $request)
    {
        $patientCases = $this->opdPatientDepartmentRepository->getPatientCases($request->get('id'));

        return $this->sendResponse($patientCases, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getDoctorOPDCharge(Request $request)
    {
        $doctorOPDCharge = DoctorOPDCharge::whereDoctorId($request->get('id'))->get();

        return $this->sendResponse($doctorOPDCharge, 'Doctor OPD Charge retrieved successfully.');
    }
}
