<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\AppBaseController;
use App\Models\OperationReport;
use App\Models\PatientCase;

class DoctorOperationAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $operation_reports = OperationReport::with('patient', 'doctor', 'caseFromOperationReport')->where('doctor_id',
            getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($operation_reports as $operation_report) {
            $data[] = $operation_report->prepareData();
        }

        return $this->sendResponse($data, 'Operation report retrieved successfully');
    }

    /**
     * @param $caseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($caseId): \Illuminate\Http\JsonResponse
    {
        $case_detail = PatientCase::where('case_id', $caseId)->where('doctor_id', getLoggedInUser()->owner_id)->first();

        if (! $case_detail) {
            return $this->sendError('Patient case not found');
        }

        return $this->sendResponse($case_detail->preparePatientCaseDetailData(), 'Patient case retrieve successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $operation_report = OperationReport::with('patient', 'doctor', 'caseFromOperationReport')->where('id', $id)->where('doctor_id', getLoggedInUser()->owner_id)->first();

        if (! $operation_report) {
            return $this->sendError('Operation report not found');
        }

        $operation_report->delete();

        return $this->sendSuccess('Operation report deleted successfully');
    }
}
