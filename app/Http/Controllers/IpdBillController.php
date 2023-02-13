<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIpdBillRequest;
use App\Models\IpdPatientDepartment;
use App\Repositories\IpdBillRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class IpdBillController extends AppBaseController
{
    /** @var IpdBillRepository */
    private $ipdBillRepository;

    public function __construct(IpdBillRepository $ipdBillRepo)
    {
        $this->ipdBillRepository = $ipdBillRepo;
    }

    /**
     * Store a newly created Bill in storage.
     *
     * @param  CreateIpdBillRequest  $request
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function store(CreateIpdBillRequest $request)
    {
        $input = $request->all();
        $bill = $this->ipdBillRepository->saveBill($input);

        return $this->sendResponse($bill, __('messages.bill.bill').' '.__('messages.common.saved_successfully'));
    }

    /**
     * @param  IpdPatientDepartment  $ipdPatientDepartment
     * @return RedirectResponse
     */
    public function ipdBillConvertToPdf(IpdPatientDepartment $ipdPatientDepartment)
    {
        $data = $this->ipdBillRepository->getSyncListForCreate();

        $data['bill'] = $this->ipdBillRepository->getBillList($ipdPatientDepartment);
        $data['currencySymbol'] = getCurrencySymbol();
        $pdf = PDF::loadView('ipd_bills.bill_pdf', $data);

        return $pdf->stream('bill.pdf');
    }
}
