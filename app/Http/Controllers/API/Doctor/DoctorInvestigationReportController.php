<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\AppBaseController;
use App\Models\InvestigationReport;

class DoctorInvestigationReportController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $investigation_reports = InvestigationReport::with('media', 'patient', 'doctor')->where('doctor_id',
            getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($investigation_reports as $investigation_report) {
            $data[] = $investigation_report->prepareData();
        }

        return $this->sendResponse($data, 'investigation report retrieved successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $investigation_reports = InvestigationReport::with('media', 'patient', 'doctor')->where('id', $id)->first();

        if (! $investigation_reports || $investigation_reports->doctor_id != getLoggedInUser()->owner_id) {
            return $this->sendError('investigation report not found');
        } else {
            $investigation_reports->delete();

            return $this->sendSuccess('investigation report deleted successfully');
        }
    }
}
