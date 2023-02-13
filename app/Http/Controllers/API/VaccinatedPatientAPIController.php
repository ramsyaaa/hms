<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\VaccinatedPatients;

class VaccinatedPatientAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        if(getLoggedinPatient()) 
        {
            $vaccinatedPatientsData = VaccinatedPatients::where('patient_id', getLoggedInUser()->patient->id)->orderBy('id', 'desc')->get();
            $data = [];
            foreach ($vaccinatedPatientsData as $vaccinatedPatientData) {
                $data[] = $vaccinatedPatientData->prepareVaccinationData();
            }

            return $this->sendResponse($data, 'Vaccinations Retrieved Successfully');
        }
    }
}
