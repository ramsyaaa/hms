<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\LiveConsultation;
use App\Repositories\LiveConsultationRepository;
use App\Repositories\PatientCaseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LiveConsultationAPIController extends AppBaseController
{
    /** @var LiveConsultationRepository */
    private $liveConsultationRepository;

    /** @var PatientCaseRepository */
    private $patientCaseRepository;

    /**
     * LiveConsultationController constructor.
     *
     * @param  LiveConsultationRepository  $liveConsultationRepository
     * @param  PatientCaseRepository  $patientCaseRepository
     */
    public function __construct(
        LiveConsultationRepository $liveConsultationRepository,
        PatientCaseRepository $patientCaseRepository
    ) {
        $this->liveConsultationRepository = $liveConsultationRepository;
        $this->patientCaseRepository = $patientCaseRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $liveConsultations = LiveConsultation::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->whereHas('user')->with([
            'patient.patientUser', 'doctor.doctorUser', 'user',
        ])->filter()->where('patient_id', getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($liveConsultations as $liveConsultation) {
            $data[] = $liveConsultation->prepareLiveConsultation();
        }

        return $this->sendResponse($data, 'Live Consultation Retrieved successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $liveConsultation = LiveConsultation::with([
            'user', 'patient.patientUser', 'doctor.doctorUser', 'opdPatient', 'ipdPatient',
        ])->where('id', $id)->where('patient_id', getLoggedInUser()->owner_id)->first();

        if (! $liveConsultation) {
            return $this->sendError('Live Consultation Not Found.');
        }

        return $this->sendResponse($liveConsultation->prepareLiveConsultationDetail(),
            'Live Consultation Retrieved successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function meeting($id): JsonResponse
    {
        $live_consultation = LiveConsultation::where('id', $id)->first();

        if (! $live_consultation) {
            return $this->sendError('Live consultation not found');
        }

        if ($live_consultation->status == 1 || $live_consultation->status == 2) {
            return $this->sendError('This meeting is finished or cancelled');
        }

        return $this->sendResponse($live_consultation->prepareDataForMeeting(),
            'Live Consultancy Retrieved Successfully');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request): JsonResponse
    {
        $status = $request->get('status');

        $live_consultancy = $this->liveConsultationRepository->filter($status);

        $data = [];
        foreach ($live_consultancy as $liveConsultation) {
            $data[] = $liveConsultation->prepareLiveConsultation();
        }

        return $this->sendResponse($data, 'Live Consultancy Retrieved Successfully');
    }
}
