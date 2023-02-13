<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\BirthReport;
use App\Models\Doctor;

class BirthReportAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $doctorId = Doctor::where('user_id', getLoggedInUserId())->first();
        $birthReports = BirthReport::with('patient', 'doctor', 'caseFromBirthReport')->where('doctor_id',
            $doctorId->id)->orderBy('id', 'desc')->get();
        $data = [];
        foreach ($birthReports as $birthReport) {
            $data[] = $birthReport->prepareBirthReport();
        }

        return $this->sendResponse($data, 'BirthReports Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $birthReport = BirthReport::with('patient', 'doctor', 'caseFromBirthReport')->where('id',
            $id)->where('doctor_id', getLoggedInUser()->id)->first();

        /** @var BirthReport $birthReport */

        return $this->sendResponse($birthReport->prepareBirthReport(), 'BirthReport Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $birthReport = BirthReport::with('patient', 'doctor', 'caseFromBirthReport')->where('id',
            $id)->where('doctor_id', getLoggedInUser()->owner_id)->first();
        if (! $birthReport || $birthReport->doctor_id != getLoggedInUser()->owner_id) {
            return $this->sendError('Birth report not found');
        } else {
            $birthReport->delete();

            return $this->sendSuccess('Birth report deleted successfully');
        }
    }
}
