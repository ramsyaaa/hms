<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIpdChargeRequest;
use App\Http\Requests\UpdateIpdChargeRequest;
use App\Models\IpdCharge;
use App\Queries\IpdChargesDataTable;
use App\Repositories\IpdChargeRepository;
use DataTables;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class IpdChargeController extends AppBaseController
{
    /** @var IpdChargeRepository */
    private $ipdChargeRepository;

    public function __construct(IpdChargeRepository $ipdChargeRepo)
    {
        $this->ipdChargeRepository = $ipdChargeRepo;
    }

    /**
     * Display a listing of the IpdCharge.
     *
     * @param  Request  $request
     * @return Response
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new IpdChargesDataTable())->get($request->get('id')))->make(true);
        }
    }

    /**
     * Store a newly created IpdCharge in storage.
     *
     * @param  CreateIpdChargeRequest  $request
     * @return JsonResponse
     */
    public function store(CreateIpdChargeRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $input['applied_charge'] = removeCommaFromNumbers($input['applied_charge']);
        $this->ipdChargeRepository->create($input);
        $this->ipdChargeRepository->createNotification($input);

        return $this->sendSuccess(__('messages.ipd_charges').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Show the form for editing the specified Ipd Diagnosis.
     *
     * @param  IpdCharge  $ipdCharge
     * @return JsonResponse
     */
    public function edit(IpdCharge $ipdCharge)
    {
        return $this->sendResponse($ipdCharge, 'Ipd Charge retrieved successfully.');
    }

    /**
     * Update the specified Ipd Diagnosis in storage.
     *
     * @param  IpdCharge  $ipdCharge
     * @param  UpdateIpdChargeRequest  $request
     * @return JsonResponse
     */
    public function update(IpdCharge $ipdCharge, UpdateIpdChargeRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $input['applied_charge'] = removeCommaFromNumbers($input['applied_charge']);
        $this->ipdChargeRepository->update($input, $ipdCharge->id);

        return $this->sendSuccess(__('messages.ipd_charges').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified IpdCharge from storage.
     *
     * @param  IpdCharge  $ipdCharge
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(IpdCharge $ipdCharge)
    {
        $ipdCharge->delete();

        return $this->sendSuccess(__('messages.ipd_charges').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getChargeCategoryList(Request $request)
    {
        $chargeCategories = $this->ipdChargeRepository->getChargeCategories($request->get('id'));

        return $this->sendResponse($chargeCategories, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getChargeList(Request $request)
    {
        $charges = $this->ipdChargeRepository->getCharges($request->get('id'));

        return $this->sendResponse($charges, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getChargeStandardRate(Request $request)
    {
        $chargeStandardRate = $this->ipdChargeRepository->getChargeStandardRate($request->get('id'),
            $request->get('isEdit'), $request->get('onceOnEditRender'), $request->get('ipdChargeId'));

        return $this->sendResponse($chargeStandardRate, 'Retrieved successfully');
    }
}
