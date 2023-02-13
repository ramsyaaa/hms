<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorDepartmentRequest;
use App\Http\Requests\UpdateDoctorDepartmentRequest;
use App\Models\Doctor;
use App\Models\DoctorDepartment;
use App\Repositories\DoctorDepartmentRepository;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class DoctorDepartmentController extends AppBaseController
{
    /** @var DoctorDepartmentRepository */
    private $doctorDepartmentRepository;

    public function __construct(DoctorDepartmentRepository $doctorDepartmentRepo)
    {
        $this->doctorDepartmentRepository = $doctorDepartmentRepo;
    }

    /**
     * Display a listing of the DoctorDepartment.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('doctor_departments.index');
    }

    /**
     * Store a newly created DoctorDepartment in storage.
     *
     * @param  CreateDoctorDepartmentRequest  $request
     * @return JsonResponse
     */
    public function store(CreateDoctorDepartmentRequest $request)
    {
        $input = $request->all();
        $this->doctorDepartmentRepository->create($input);

        return $this->sendSuccess(__('messages.doctor_department.doctor_department').' '.__('messages.common.saved_successfully'));
    }

    /**
     * @param  DoctorDepartment  $doctorDepartment
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(DoctorDepartment $doctorDepartment)
    {
        $doctors = $doctorDepartment->doctors;

        $doctorDepartment = $this->doctorDepartmentRepository->find($doctorDepartment->id);

        if (empty($doctorDepartment)) {
            Flash::error(__('messages.doctor_department.doctor_department').' '.__('messages.common.not_found'));

            return redirect(route('doctorDepartments.index'));
        }

        return view('doctor_departments.show', compact('doctors', 'doctorDepartment'));
    }

    /**
     * Show the form for editing the specified DoctorDepartment.
     *
     * @param  DoctorDepartment  $doctorDepartment
     * @return JsonResponse
     */
    public function edit(DoctorDepartment $doctorDepartment)
    {
        return $this->sendResponse($doctorDepartment, 'Doctor Department retrieved successfully.');
    }

    /**
     * Update the specified DoctorDepartment in storage.
     *
     * @param  DoctorDepartment  $doctorDepartment
     * @param  UpdateDoctorDepartmentRequest  $request
     * @return JsonResponse
     */
    public function update(DoctorDepartment $doctorDepartment, UpdateDoctorDepartmentRequest $request)
    {
        $input = $request->all();
        $this->doctorDepartmentRepository->update($input, $doctorDepartment->id);

        return $this->sendSuccess(__('messages.doctor_department.doctor_department').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified DoctorDepartment from storage.
     *
     * @param  DoctorDepartment  $doctorDepartment
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(DoctorDepartment $doctorDepartment)
    {
        $doctorDepartmentModels = [
            Doctor::class,
        ];
        $result = canDelete($doctorDepartmentModels, 'doctor_department_id', $doctorDepartment->id);
        if ($result) {
            return $this->sendError(__('messages.doctor_department.doctor_department').' '.__('messages.common.cant_be_deleted'));
        }
        $doctorDepartment->delete();

        return $this->sendSuccess(__('messages.doctor_department.doctor_department').' '.__('messages.common.deleted_successfully'));
    }
}
