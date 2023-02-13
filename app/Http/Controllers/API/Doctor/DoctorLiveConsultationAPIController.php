<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\IpdPatientDepartment;
use App\Models\LiveConsultation;
use App\Models\OpdPatientDepartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DoctorLiveConsultationAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $live_consultations = $this->getLiveConsultancy()->get();

        $data = [];
        foreach ($live_consultations as $live_consultation) {
            $data[] = $live_consultation->prepareData();
        }

        return $this->sendResponse($data, 'Live Consultancy Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function liveConsultancyMeeting($id): \Illuminate\Http\JsonResponse
    {
        $live_consultation = LiveConsultation::where('id', $id)->where('doctor_id',
            getLoggedInUser()->owner_id)->first();

        if (!$live_consultation) {
            return $this->sendError('Live consultation not found');
        }

        return $this->sendResponse($live_consultation->prepareDataForMeeting(),
            'Live Consultancy Retrieved Successfully');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request): \Illuminate\Http\JsonResponse
    {
        $status = $request->get('status');

        if ($status == 'all') {

            $live_consultations = $this->getLiveConsultancy()->orderBy('id', 'desc')->get();

            $data = [];
            foreach ($live_consultations as $live_consultation) {
                $data[] = $live_consultation->prepareData();
            }

            return $this->sendResponse($data, 'Live Consultancy Retrieved Successfully');
        } elseif ($status == 'awaited') {

            $live_consultations = $this->getLiveConsultancy();

            $live_consultations = $live_consultations->where('status',
                LiveConsultation::STATUS_AWAITED)->where('doctor_id',
                getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();

            $data = [];
            foreach ($live_consultations as $live_consultation) {
                $data[] = $live_consultation->prepareData();
            }

            return $this->sendResponse($data, 'Live Consultancy Retrieved Successfully');
        } elseif ($status == 'cancelled') {
            $live_consultations = $this->getLiveConsultancy();

            $live_consultations = $live_consultations->where('status',
                LiveConsultation::STATUS_CANCELLED)->where('doctor_id',
                getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();

            $data = [];
            foreach ($live_consultations as $live_consultation) {
                $data[] = $live_consultation->prepareData();
            }

            return $this->sendResponse($data, 'Live Consultancy Retrieved Successfully');
        } elseif ($status == 'finished') {
            $live_consultations = $this->getLiveConsultancy();

            $live_consultations = $live_consultations->where('status',
                LiveConsultation::STATUS_FINISHED)->where('doctor_id',
                getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();

            $data = [];
            foreach ($live_consultations as $live_consultation) {
                $data[] = $live_consultation->prepareData();
            }

            return $this->sendResponse($data, 'Live Consultancy Retrieved Successfully');
        } else {
            return $this->sendError('Live Consultation not found');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $live_consultation = LiveConsultation::where('id', $id)->where('doctor_id',
            getLoggedInUser()->owner_id)->first();

        if (!$live_consultation) {
            return $this->sendError('Live consultancy not found');
        }

        return $this->sendResponse($live_consultation->prepareDataForDetail(),
            'Live Consultancy Retrieved Successfully');
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getLiveConsultancy(): Builder
    {
        $ipdIds = IpdPatientDepartment::pluck('id')->toArray();
        $opdIds = OpdPatientDepartment::pluck('id')->toArray();
        $live_consultations = LiveConsultation::with([
            'patient.patientUser', 'doctor.doctorUser', 'user', 'ipdPatient', 'opdPatient',
        ])->where('doctor_id', getLoggedInUser()->owner_id);

        $live_consultations->where(function (Builder $q) use ($ipdIds, $opdIds) {
            $q->whereIn('type_number', $ipdIds)->where('type', 1)
                ->orWhereIn('type_number', $opdIds)->where('type', 0);
        });

        return $live_consultations;
    }
}
