<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Doctor;
use App\Models\EmployeePayroll;
use Auth;

class PayrollAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $payrolls = EmployeePayroll::whereHasMorph('owner', [Doctor::class], function ($q, $type) {
            if ($type == \App\Models\Doctor::class) {
                $q->whereHas('doctorUser', function (\Illuminate\Database\Eloquent\Builder $qr) {
                    return $qr;
                });
            }
        })->where('owner_id', $user->owner_id)->where('owner_type', $user->owner_type)->with('owner')->orderBy('id', 'desc')->get();
        $data = [];
        foreach ($payrolls as $payroll) {
            $data[] = $payroll->preparePayroll();
        }

        return $this->sendResponse($data, 'Payrolls Retrieved successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $payroll = EmployeePayroll::where('id', $id)->where('owner_id', getLoggedInUser()->owner_id)->first();

        if (! $payroll) {
            return $this->sendError('Payroll not found');
        }

        return $this->sendResponse($payroll->prepareDoctorPayrollDetail(), 'Payrolls Retrieved successfully.');
    }
}
