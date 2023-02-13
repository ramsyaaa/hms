<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIpdConsultantRegisterRequest;
use App\Http\Requests\UpdateIpdConsultantRegisterRequest;
use App\Models\IpdConsultantRegister;
use App\Queries\IpdConsultantRegisterDataTable;
use App\Repositories\IpdConsultantRegisterRepository;
use DataTables;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class IpdConsultantRegisterController extends AppBaseController
{
    /** @var IpdConsultantRegisterRepository */
    private $ipdConsultantRegisterRepository;

    public function __construct(IpdConsultantRegisterRepository $ipdConsultantRegisterRepo)
    {
        $this->ipdConsultantRegisterRepository = $ipdConsultantRegisterRepo;
    }

    /**
     * Display a listing of the IpdConsultantRegister.
     *
     * @param  Request  $request
     * @return Response
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new IpdConsultantRegisterDataTable())->get($request->get('id')))
                ->addColumn('doctorImageUrl', function (IpdConsultantRegister $ipdConsultantRegister) {
                    return $ipdConsultantRegister->doctor->doctorUser->image_url;
                })->make(true);
        }
    }

    /**
     * Store a newly created IpdConsultantRegister in storage.
     *
     * @param  CreateIpdConsultantRegisterRequest  $request
     * @return JsonResponse
     */
    public function store(CreateIpdConsultantRegisterRequest $request)
    {
        $input = $request->all();
        
        for ($i = 0; $i < count($input['doctor_id']); $i++) {
            if($input['doctor_id'][$i] == 0) {
                return $this->sendError('Please select doctor');
            }
        }
        
        $result = $this->ipdConsultantRegisterRepository->store($input);

        if($result) {
            return $this->sendSuccess(__('messages.ipd_patient_consultant_register.instruction').' '.__('messages.common.saved_successfully'));   
        }
        else {
            return $this->sendError('Applied date or Instruction date can not be null');
        }
    }

    /**
     * Show the form for editing the specified IpdPrescription.
     *
     * @param  IpdConsultantRegister  $ipdConsultantRegister
     * @return JsonResponse
     */
    public function edit(IpdConsultantRegister $ipdConsultantRegister)
    {
        return $this->sendResponse($ipdConsultantRegister, 'Consultant Instruction retrieved successfully.');
    }

    /**
     * Update the specified IpdPrescriptionItem in storage.
     *
     * @param  IpdConsultantRegister  $ipdConsultantRegister
     * @param  UpdateIpdConsultantRegisterRequest  $request
     * @return JsonResponse
     */
    public function update(IpdConsultantRegister $ipdConsultantRegister, UpdateIpdConsultantRegisterRequest $request)
    {
        $input = $request->all();
        $this->ipdConsultantRegisterRepository->update($input, $ipdConsultantRegister->id);

        return $this->sendSuccess(__('messages.ipd_patient_consultant_register.instruction').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified IpdConsultantRegister from storage.
     *
     * @param  IpdConsultantRegister  $ipdConsultantRegister
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(IpdConsultantRegister $ipdConsultantRegister)
    {
        $ipdConsultantRegister->delete();

        return $this->sendSuccess(__('messages.ipd_patient_consultant_register.instruction').' '.__('messages.common.deleted_successfully'));
    }
}
