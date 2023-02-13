<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\OpdPatientDepartment;
use App\Repositories\OpdPatientDepartmentRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OpdPatientDepartmentController extends Controller
{
    /** @var OpdPatientDepartmentRepository */
    private $opdPatientDepartmentRepository;

    public function __construct(OpdPatientDepartmentRepository $opdPatientDepartmentRepo)
    {
        $this->opdPatientDepartmentRepository = $opdPatientDepartmentRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('opd_patient_list.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  OpdPatientDepartment  $opdPatientDepartment
     * @return Factory|View
     */
    public function show(OpdPatientDepartment $opdPatientDepartment)
    {
        if (checkRecordAccess($opdPatientDepartment->patient_id)) {
            return view('errors.404');
        } else {
            return view('opd_patient_list.show', compact('opdPatientDepartment'));
        }
    }
}
