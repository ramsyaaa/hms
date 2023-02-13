<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\AppBaseController;
use App\Models\PatientAdmission;

class DoctorPatientAdmissionAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $patient_admissions = PatientAdmission::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->with('patient.patientUser', 'doctor.doctorUser', 'package', 'insurance')->where('doctor_id', getLoggedInUser()->owner_id)->get();

        $data = [];
        foreach ($patient_admissions as $patient_admission) {
            $data[] = $patient_admission->preparePatientAdmissionData();
        }

        return $this->sendResponse($data, 'Patient Admission Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $patient_admissions = PatientAdmission::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->with('patient.patientUser', 'doctor.doctorUser', 'package', 'insurance')->where('id', $id)->where('doctor_id', getLoggedInUser()->owner_id)->first();

        if (! $patient_admissions) {
            return $this->sendError('Patient Admission Not Found');
        }

        return $this->sendResponse($patient_admissions->prepareDataForDetail(), 'Patient Admission Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $patient_admissions = PatientAdmission::where('id', $id)->first();

        if (! $patient_admissions) {
            return $this->sendError('Patient Admission Not Found');
        }

        $patient_admissions->delete();

        return $this->sendSuccess('Document deleted successfully');
    }
}
