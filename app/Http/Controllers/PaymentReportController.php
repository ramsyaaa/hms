<?php

namespace App\Http\Controllers;

use App\Exports\PaymentReportExport;
use App\Models\Account;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PaymentReportController extends Controller
{
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
        $accountTypes = Account::ACCOUNT_TYPES;

        return view('payment_reports.index', compact('accountTypes'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function paymentReportExport()
    {
        return Excel::download(new PaymentReportExport, 'payments-reports-'.time().'.xlsx');
    }
}
