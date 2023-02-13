<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\AppBaseController;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorAppointmentAPIController extends AppBaseController
{
    /** @var AppointmentRepository */
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepo)
    {
        $this->appointmentRepository = $appointmentRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $appointments = Appointment::with('doctor.doctorUser')->where('doctor_id', getLoggedInUser()->owner_id)->orderBy('id', 'desc')->get();
        $data = [];
        foreach ($appointments as $appointment) {
            $data[] = $appointment->prepareAppointmentForDoctor();
        }

        return $this->sendResponse($data, 'Appointments Retrieved Successfully');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request): \Illuminate\Http\JsonResponse
    {
        $status = $request->get('status');

//        $appointments = Appointment::where('is_completed', $status)->where('doctor_id',
//            getLoggedInUser()->owner_id)->with('patient', 'doctor', 'department')->get();
        if ($status == 'all') {
            $appointments = Appointment::with('patient', 'doctor', 'department')->orderBy('id', 'desc')->where('doctor_id',
                getLoggedInUser()->owner_id)->get();
            $data = [];
            foreach ($appointments as $appointment) {
                $data[] = $appointment->prepareAppointmentForDoctor();
            }

            return $this->sendResponse($data, 'Appointments Retrieved Successfully');
        } elseif ($status == 'pending') {
            $appointments = Appointment::where('is_completed', Appointment::STATUS_PENDING)->orderBy('id', 'desc')->where('doctor_id',
                getLoggedInUser()->owner_id)->with('patient', 'doctor', 'department')->get();
            $data = [];
            foreach ($appointments as $appointment) {
                $data[] = $appointment->prepareAppointmentForDoctor();
            }

            return $this->sendResponse($data, 'Appointments Retrieved Successfully');
        } elseif ($status == 'completed') {
            $appointments = Appointment::where('is_completed', Appointment::STATUS_COMPLETED)->orderBy('id', 'desc')->where('doctor_id',
                getLoggedInUser()->owner_id)->with('patient', 'doctor', 'department')->get();
            $data = [];
            foreach ($appointments as $appointment) {
                $data[] = $appointment->prepareAppointmentForDoctor();
            }

            return $this->sendResponse($data, 'Appointments Retrieved Successfully');
        } elseif ($status == 'cancelled') {
            $appointments = Appointment::where('is_completed', Appointment::STATUS_CANCELLED)->orderBy('id', 'desc')->where('doctor_id',
                getLoggedInUser()->owner_id)->with('patient', 'doctor', 'department')->get();
            $data = [];
            foreach ($appointments as $appointment) {
                $data[] = $appointment->prepareAppointmentForDoctor();
            }

            return $this->sendResponse($data, 'Appointments Retrieved Successfully');
        } elseif ($status == 'past') {
            $appointments = Appointment::whereDate('opd_date', '<', Carbon::today())->orderBy('id', 'desc')->where('doctor_id',
                getLoggedInUser()->owner_id)->with('patient', 'doctor', 'department')->get();
            $data = [];
            foreach ($appointments as $appointment) {
                $data[] = $appointment->prepareAppointmentForDoctor();
            }

            return $this->sendResponse($data, 'Appointments Retrieved Successfully');
        } else {
            return $this->sendError('Appointments Not Found');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmAppointment($id): \Illuminate\Http\JsonResponse
    {
        $appointment = Appointment::where('id', $id)->where('is_completed', '!=', Appointment::STATUS_CANCELLED)->where('doctor_id', getLoggedInUser()->owner_id)->first();
        if (! $appointment) {
            return $this->sendError('Appointment not found');
        }

        $appointment->update(['is_completed' => Appointment::STATUS_COMPLETED]);

        return $this->sendSuccess('Appointment confirmed successfully');
    }
}
