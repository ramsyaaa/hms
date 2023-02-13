<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Bill;

class BillAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        if(getLoggedinPatient())
        {
            $bills = Bill::where('patient_id', getLoggedInUser()->patient->id)->orderBy('id', 'desc')->get();
            $data = [];
            foreach ($bills as $bill) {
                $data[] = $bill->prepareBills();
            }

            return $this->sendResponse($data, 'Bills Retrieved Successfully');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $bill = Bill::with(['billItems.medicine', 'patient', 'patientAdmission'])->where('id', $id)->where('patient_id', getLoggedInUser()->patient->id)->first();

        if (! $bill) {
            return $this->sendError('Bill not found');
        }

        return $this->sendResponse($bill->prepareBillDetails(), 'Bill Retrieved Successfully');
    }
}
