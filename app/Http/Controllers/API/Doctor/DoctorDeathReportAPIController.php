<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\AppBaseController;
use App\Models\DeathReport;

class DoctorDeathReportAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $death_reports = DeathReport::with('patient', 'doctor', 'caseFromDeathReport')->where('doctor_id', getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($death_reports as $death_report) {
            $data[] = $death_report->prepareData();
        }

        return $this->sendResponse($data, 'Death report retrieved successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $death_reports = DeathReport::with('patient', 'doctor', 'caseFromDeathReport')->where('id', $id)->where('doctor_id', getLoggedInUser()->owner_id)->first();

        if (! $death_reports) {
            return $this->sendError('Death report not found');
        }

        $death_reports->delete();

        return $this->sendSuccess('Death report deleted successfully');
    }
}
