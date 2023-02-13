<?php

namespace App\Http\Controllers;

use App\Exports\DoctorOPDChargeExport;
use App\Http\Requests\CreateDoctorOPDChargeRequest;
use App\Http\Requests\UpdateDoctorOPDChargeRequest;
use App\Models\DoctorOPDCharge;
use App\Repositories\DoctorOPDChargeRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DoctorOPDChargeController extends AppBaseController
{
    /**
     * @var DoctorOPDChargeRepository
     */
    private $doctorOPDChargeRepository;

    public function __construct(DoctorOPDChargeRepository $doctorOPDChargeRepository)
    {
        $this->doctorOPDChargeRepository = $doctorOPDChargeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $doctors = $this->doctorOPDChargeRepository->getDoctors();

        return view('doctor_opd_charges.index', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDoctorOPDChargeRequest  $request
     * @return JsonResponse
     */
    public function store(CreateDoctorOPDChargeRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $this->doctorOPDChargeRepository->create($input);

        return $this->sendSuccess(__('messages.doctor_opd_charges').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DoctorOPDCharge  $doctorOPDCharge
     * @return JsonResponse
     */
    public function edit(DoctorOPDCharge $doctorOPDCharge)
    {
        return $this->sendResponse($doctorOPDCharge, 'Doctor OPD Charge retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDoctorOPDChargeRequest  $request
     * @param  DoctorOPDCharge  $doctorOPDCharge
     * @return JsonResponse
     */
    public function update(UpdateDoctorOPDChargeRequest $request, DoctorOPDCharge $doctorOPDCharge)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $this->doctorOPDChargeRepository->update($input, $doctorOPDCharge->id);

        return $this->sendSuccess(__('messages.doctor_opd_charges').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DoctorOPDCharge  $doctorOPDCharge
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function destroy(DoctorOPDCharge $doctorOPDCharge)
    {
        $doctorOPDCharge->delete();

        return $this->sendSuccess(__('messages.doctor_opd_charges').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function doctorOPDChargeExport()
    {
        return Excel::download(new DoctorOPDChargeExport, 'doctor-opd-charges-'.time().'.xlsx');
    }
}
