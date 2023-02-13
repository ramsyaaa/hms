<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\CreateZoomCredentialRequest;
use App\Http\Requests\LiveConsultationRequest;
use App\Models\LiveConsultation;
use App\Models\UserZoomCredential;
use App\Repositories\LiveConsultationRepository;
use App\Repositories\PatientCaseRepository;
use App\Repositories\ZoomRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class LiveConsultationController
 */
class LiveConsultationController extends AppBaseController
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
     * Display a listing of the LabTechnician.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $doctors = $this->patientCaseRepository->getDoctors();
        $patients = $this->patientCaseRepository->getPatients();
        $type = LiveConsultation::STATUS_TYPE;
        $status = LiveConsultation::status;

        return view('live_consultations.index', compact('doctors', 'patients', 'type', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LiveConsultationRequest  $request
     * @return JsonResponse
     */
    public function store(LiveConsultationRequest $request): JsonResponse
    {
        try {
            $this->liveConsultationRepository->store($request->all());
            $this->liveConsultationRepository->createNotification($request->all());

            return $this->sendSuccess(__('messages.live_consultations').' '.__('messages.common.saved_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LiveConsultation  $liveConsultation
     * @return JsonResponse
     */
    public function edit(LiveConsultation $liveConsultation): JsonResponse
    {
        if (checkRecordAccess($liveConsultation->doctor_id)) {
            return $this->sendError(__('messages.live_consultations').' '.__('messages.common.not_found'));
        } else {
            return $this->sendResponse($liveConsultation, 'Live Consultation retrieved successfully.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LiveConsultationRequest  $request
     * @param  LiveConsultation  $liveConsultation
     * @return JsonResponse
     */
    public function update(LiveConsultationRequest $request, LiveConsultation $liveConsultation): JsonResponse
    {
        try {
            $this->liveConsultationRepository->edit($request->all(), $liveConsultation);

            return $this->sendSuccess(__('messages.live_consultations').' '.__('messages.common.updated_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LiveConsultation  $liveConsultation
     * @return JsonResponse
     */
    public function destroy(LiveConsultation $liveConsultation): JsonResponse
    {
        try {
            if (checkRecordAccess($liveConsultation->doctor_id)) {
                return $this->sendError(__('messages.live_consultations').' '.__('messages.common.not_found'));
            } else {
                $liveConsultation->delete();

                return $this->sendSuccess(__('messages.live_consultations').' '.__('messages.common.deleted_successfully'));
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getTypeNumber(Request $request): JsonResponse
    {
        try {
            $typeNumber = $this->liveConsultationRepository->getTypeNumber($request->all());

            return $this->sendResponse($typeNumber, 'Type Number Retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getChangeStatus(Request $request): JsonResponse
    {
        $liveConsultation = LiveConsultation::findOrFail($request->get('id'));

        if (checkRecordAccess($liveConsultation->patient_id)) {
            return $this->sendError(__('messages.live_consultations').' '.__('messages.common.not_found'));
        } else {
            $status = null;

            if ($request->get('statusId') == LiveConsultation::STATUS_AWAITED) {
                $status = LiveConsultation::STATUS_AWAITED;
            } elseif ($request->get('statusId') == LiveConsultation::STATUS_CANCELLED) {
                $status = LiveConsultation::STATUS_CANCELLED;
            } else {
                $status = LiveConsultation::STATUS_FINISHED;
            }

            $liveConsultation->update([
                'status' => $status,
            ]);

            return $this->sendsuccess(__('messages.common.status_updated_successfully'));
        }
    }

    /**
     * @param  LiveConsultation  $liveConsultation
     * @return JsonResponse
     */
    public function getLiveStatus(LiveConsultation $liveConsultation): JsonResponse
    {
        if (getLoggedinDoctor() ? checkRecordAccess($liveConsultation->doctor_id) : checkRecordAccess($liveConsultation->patient_id)) {
            return $this->sendError(__('messages.live_consultations').' '.__('messages.common.not_found'));
        } else {
            $data['liveConsultation'] = LiveConsultation::with('user')->find($liveConsultation->id);
            /** @var ZoomRepository $zoomRepo */
            $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveConsultation->created_by]);

            $data['zoomLiveData'] = $zoomRepo->get($liveConsultation->meeting_id,
                ['meeting_owner' => $liveConsultation->created_by]);

            return $this->sendResponse($data, 'Live Status retrieved successfully.');
        }
    }

    /**
     * @param  LiveConsultation  $liveConsultation
     * @return JsonResponse
     */
    public function show(LiveConsultation $liveConsultation): JsonResponse
    {
        if (getLoggedinDoctor() ? checkRecordAccess($liveConsultation->doctor_id) : checkRecordAccess($liveConsultation->patient_id)) {
            return $this->sendError(__('messages.live_consultations').' '.__('messages.common.not_found'));
        } else {
            $data['liveConsultation'] = LiveConsultation::with([
                'user', 'patient.patientUser', 'doctor.doctorUser', 'opdPatient', 'ipdPatient',
            ])->find($liveConsultation->id);
            $data['typeNumber'] = ($liveConsultation->type == LiveConsultation::OPD) ? $liveConsultation->opdPatient->opd_number : $liveConsultation->ipdPatient->ipd_number;

            return $this->sendResponse($data, 'Live Consultation retrieved successfully.');
        }
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function zoomCredential($id): JsonResponse
    {
        try {
            $data = UserZoomCredential::where('user_id', $id)->first();

            return $this->sendResponse($data, 'User Zoom Credential retrieved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  CreateZoomCredentialRequest  $request
     * @return JsonResponse
     */
    public function zoomCredentialCreate(CreateZoomCredentialRequest $request): JsonResponse
    {
        try {
            $this->liveConsultationRepository->createUserZoom($request->all());

            return $this->sendSuccess('User Zoom Credential saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
