<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Models\Patient;
use App\Repositories\BillRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Response;

class BillController extends AppBaseController
{
    /** @var BillRepository */
    private $billRepository;

    public function __construct(BillRepository $billRepo)
    {
        $this->billRepository = $billRepo;
    }

    /**
     * Display a listing of the Bill.
     *
     * @param Request $request
     * @throws Exception
     * @return Factory|View|Response
     *
     */
    public function index()
    {
        return view('bills.index');
    }

    /**
     * Show the form for creating a new Bill.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->billRepository->getSyncList(false);

        return view('bills.create')->with($data);
    }

    /**
     * Store a newly created Bill in storage.
     *
     * @param CreateBillRequest $request
     * @throws Exception
     * @return JsonResponse
     *
     */
    public function store(CreateBillRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $patientId = Patient::with('patientUser')->whereId($input['patient_id'])->first();
            $birthDate = $patientId->patientUser->dob;
            $billDate = Carbon::parse($input['bill_date'])->toDateString();
            if (!empty($birthDate) && $billDate < $birthDate) {
                return $this->sendError(__('messages.bed_assign.assign_date_should_not_be_smaller_than_patient_birth_date'));
            }
            $bill = $this->billRepository->saveBill($request->all());
            $this->billRepository->saveNotification($input);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($bill, __('messages.bill.bill').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Display the specified Bill.
     *
     * @param Bill $bill
     * @return Factory|View
     */
    public function show(Bill $bill)
    {
        $bill = Bill::with(['billItems.medicine', 'patient', 'patientAdmission'])->find($bill->id);
        if ($bill->patientAdmission) {
            $admissionDate = Carbon::parse($bill->patientAdmission->admission_date);
            $dischargeDate = Carbon::parse($bill->patientAdmission->discharge_date);
            $bill->totalDays = $admissionDate->diffInDays($dischargeDate) + 1;
        }

        return view('bills.show')->with('bill', $bill);
    }

    /**
     * Show the form for editing the specified Bill.
     *
     * @param Bill $bill
     * @return Factory|View
     */
    public function edit(Bill $bill)
    {
        $bill->billItems;
        $isEdit = true;
        $data = $this->billRepository->getSyncList($isEdit);
        $data['bill'] = $bill;

        return view('bills.edit')->with($data);
    }

    /**
     * Update the specified Bill in storage.
     *
     * @param Bill $bill
     * @param UpdateBillRequest $request
     * @throws Exception
     * @return JsonResponse
     *
     */
    public function update(Bill $bill, UpdateBillRequest $request)
    {
        $input = $request->all();
        $patientId = Patient::with('patientUser')->whereId($input['patient_id'])->first();
        $birthDate = $patientId->patientUser->dob;
        $billDate = Carbon::parse($input['bill_date'])->toDateString();
        if (!empty($birthDate) && $billDate < $birthDate) {
            return $this->sendError(__('messages.bed_assign.assign_date_should_not_be_smaller_than_patient_birth_date'));
        }
        $bill = $this->billRepository->updateBill($bill->id, $request->all());

        return $this->sendResponse($bill, __('messages.bill.bill').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified Bill from storage.
     *
     * @param Bill $bill
     * @throws Exception
     * @return JsonResponse
     *
     */
    public function destroy(Bill $bill)
    {
        $this->billRepository->delete($bill->id);

        return $this->sendSuccess(__('messages.bill.bill').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPatientAdmissionDetails(Request $request)
    {
        $inputs = $request->all();
        $patientAdmissionDetails = $this->billRepository->patientAdmissionDetails($inputs);

        return $this->sendResponse($patientAdmissionDetails, 'Details retrieved successfully.');
    }

    /**
     * @param Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function convertToPdf(Bill $bill)
    {
        $bill->billItems;
        $data = $this->billRepository->getSyncListForCreate($bill->id);
        $data['bill'] = $bill;
        $pdf = PDF::loadView('bills.bill_pdf', $data);

        return $pdf->stream('bill.pdf');
    }
}
