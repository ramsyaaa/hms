<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PaymentController extends AppBaseController
{
    /** @var PaymentRepository */
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepository = $paymentRepo;
    }

    /**
     * Display a listing of the Payment.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('payments.index');
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Factory|View
     */
    public function create()
    {
        $accounts = $this->paymentRepository->getAccounts();

        return view('payments.create', compact('accounts'));
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param  CreatePaymentRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();
        $input['amount'] = removeCommaFromNumbers($input['amount']);
        $payment = $this->paymentRepository->create($input);

        Flash::success(__('messages.payment.payment').' '.__('messages.common.saved_successfully'));

        return redirect(route('payments.index'));
    }

    /**
     * Display the specified Payment.
     *
     * @param  Payment  $payment
     * @return Factory|View
     */
    public function show(Payment $payment)
    {
        return view('payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param  Payment  $payment
     * @return Factory|View
     */
    public function edit(Payment $payment)
    {
        $accounts = $this->paymentRepository->getAccounts();

        return view('payments.edit', compact('accounts', 'payment'));
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param  Payment  $payment
     * @param  UpdatePaymentRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(Payment $payment, UpdatePaymentRequest $request)
    {
        $input = $request->all();
        $input['amount'] = removeCommaFromNumbers($input['amount']);
        $payment = $this->paymentRepository->update($input, $payment->id);

        Flash::success(__('messages.payment.payment').' '.__('messages.common.updated_successfully'));

        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param  Payment  $payment
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Payment $payment)
    {
        $this->paymentRepository->delete($payment->id);

        return $this->sendSuccess(__('messages.payment.payment').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function paymentExport()
    {
        return Excel::download(new PaymentExport, 'payments-'.time().'.xlsx');
    }

    /**
     * @param  Payment  $payment
     * @return JsonResponse
     *
     * @throws \Gerardojbaez\Money\Exceptions\CurrencyException
     */
    public function showModal(Payment $payment)
    {
        $payment->load('account');
//        $payment['amount'] = getCurrencySymbol().' '.number_format($payment->amount,2);
        $currency = $payment->currency_symbol ? strtoupper($payment->currency_symbol) : strtoupper(getCurrentCurrency());
//        $payment['amount'] = checkValidCurrency($payment->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($payment->amount, $currency) : number_format($payment->amount).''.getCurrencySymbol();
        $payment['amount'] = checkNumberFormat($payment->amount, $currency);

        return $this->sendResponse($payment, 'Payment Retrieved Successfully.');
    }
}
