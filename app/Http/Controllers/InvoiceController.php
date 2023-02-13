<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\Setting;
use App\Repositories\InvoiceRepository;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class InvoiceController extends AppBaseController
{
    /** @var InvoiceRepository */
    private $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepo)
    {
        $this->invoiceRepository = $invoiceRepo;
    }

    /**
     * Display a listing of the Invoice.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $statusArr = Invoice::STATUS_ARR;

        return view('invoices.index')->with('statusArr', $statusArr);
    }

    /**
     * Show the form for creating a new Invoice.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->invoiceRepository->getSyncList();

        return view('invoices.create')->with($data);
    }

    /**
     * Store a newly created Invoice in storage.
     *
     * @param  CreateInvoiceRequest  $request
     * @return JsonResponse
     *
     * @throws Exception|Throwable
     */
    public function store(CreateInvoiceRequest $request)
    {
        try {
            DB::beginTransaction();
            $bill = $this->invoiceRepository->saveInvoice($request->all());
            $this->invoiceRepository->saveNotification($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($bill, __('messages.invoice.invoice').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Display the specified Invoice.
     *
     * @param  Invoice  $invoice
     * @return Factory|View
     */
    public function show(Invoice $invoice)
    {
        $data['hospitalAddress'] = Setting::where('key', '=', 'hospital_address')->first()->value;
        $data['invoice'] = Invoice::with(['invoiceItems.account', 'patient.address'])->find($invoice->id);

        return view('invoices.show')->with($data);
    }

    /**
     * Show the form for editing the specified Invoice.
     *
     * @param  Invoice  $invoice
     * @return Factory|View
     */
    public function edit(Invoice $invoice)
    {
        $invoice->invoiceItems;
        $data = $this->invoiceRepository->getSyncList();
        $data['invoice'] = $invoice;

        return view('invoices.edit')->with($data);
    }

    /**
     * Update the specified Invoice in storage.
     *
     * @param  Invoice  $invoice
     * @param  UpdateInvoiceRequest  $request
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function update(Invoice $invoice, UpdateInvoiceRequest $request)
    {
        try {
            DB::beginTransaction();
            $bill = $this->invoiceRepository->updateInvoice($invoice->id, $request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($bill, __('messages.invoice.invoice').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified Invoice from storage.
     *
     * @param  Invoice  $invoice
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Invoice $invoice)
    {
        $this->invoiceRepository->delete($invoice->id);

        return $this->sendSuccess(__('messages.invoice.invoice').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function convertToPdf(Invoice $invoice)
    {
        $invoice->invoiceItems;
        $data = $this->invoiceRepository->getSyncListForCreate($invoice->id);
        $data['invoice'] = $invoice;
        $data['currencySymbol'] = getCurrencySymbol();
        $pdf = PDF::loadView('invoices.invoice_pdf', $data);

        return $pdf->stream('invoice.pdf');
    }
}
