<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\PatientAdmission;

class PatientAdmissionAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $admissions = PatientAdmission::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->with('patient.patientUser',
            'doctor.doctorUser', 'package', 'insurance')->where('patient_id', getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();
        $data = [];
        foreach ($admissions as $admission) {
            $data[] = $admission->prepareAdmission();
        }

        return $this->sendResponse($data, 'Admissions Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $admission = PatientAdmission::with('patient.patientUser', 'doctor.doctorUser', 'package',
            'insurance')->where('id', $id)->where('patient_id', getLoggedInUser()->owner_id)->first();

        if (! $admission) {
            return $this->sendError('Admission not found');
        }

        return $this->sendResponse($admission->prepareAdmission(), 'Admissions Retrieved Successfully');
    }
}
