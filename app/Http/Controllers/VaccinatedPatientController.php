<?php

namespace App\Http\Controllers;

use App\Exports\VaccinatedPatientExport;
use App\Http\Requests\CreateVaccinatedPatientRequest;
use App\Http\Requests\UpdateVaccinatedPatientRequest;
use App\Models\VaccinatedPatients;
use App\Repositories\VaccinatedPatientRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class VaccinatedPatientController extends AppBaseController
{
    /**
     * @var VaccinatedPatientRepository
     */
    private $vaccinatedPatientRepository;

    public function __construct(VaccinatedPatientRepository $vaccinatedPatientRepository)
    {
        $this->vaccinatedPatientRepository = $vaccinatedPatientRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Application|Factory|Response|View
     *
     * @throws Exception
     */
    public function index()
    {
        $data = $this->vaccinatedPatientRepository->getVaccinatedPatientData();

        return view('vaccinated_patients.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateVaccinatedPatientRequest  $request
     * @return JsonResponse
     */
    public function store(CreateVaccinatedPatientRequest $request)
    {
        try {
            $input = $request->all();
            $checkValidation = checkVaccinatePatientValidation($input, null, null);
            if ($checkValidation) {
                return $this->sendError('The patient is already registered with same vaccine and dose no.');
            }
            $this->vaccinatedPatientRepository->create($input);

            return $this->sendSuccess(__('messages.vaccinated_patient.vaccinate_patient').' '.__('messages.common.saved_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  VaccinatedPatients  $vaccinatedPatient
     * @return JsonResponse
     */
    public function edit(VaccinatedPatients $vaccinatedPatient)
    {
        return $this->sendResponse($vaccinatedPatient, 'Vaccinated Patients retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateVaccinatedPatientRequest  $request
     * @param  VaccinatedPatients  $vaccinatedPatient
     * @return JsonResponse
     */
    public function update(UpdateVaccinatedPatientRequest $request, VaccinatedPatients $vaccinatedPatient)
    {
        try {
            $input = $request->all();
            if ($input['patient_id'] == $vaccinatedPatient->patient_id &&
                $input['vaccination_id'] == $vaccinatedPatient->vaccination_id &&
                $input['dose_number'] == $vaccinatedPatient->dose_number) {
            } else {
                $checkValidation = checkVaccinatePatientValidation($input, $vaccinatedPatient, $isCreate = true);
                if ($checkValidation) {
                    return $this->sendError('The patient is already registered with same vaccine and dose no.');
                }
            }
            $this->vaccinatedPatientRepository->update($input, $vaccinatedPatient->id);

            return $this->sendSuccess(__('messages.vaccinated_patient.vaccinate_patient').' '.__('messages.common.updated_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  VaccinatedPatients  $vaccinatedPatient
     * @return JsonResponse
     */
    public function destroy(VaccinatedPatients $vaccinatedPatient)
    {
        try {
            $vaccinatedPatient->delete();

            return $this->sendSuccess(__('messages.vaccinated_patient.vaccinate_patient').' '.__('messages.common.deleted_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @return BinaryFileResponse
     *
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function vaccinatedPatientExport()
    {
        return Excel::download(new VaccinatedPatientExport, 'vaccinated_patient-'.time().'.xlsx');
    }
}
