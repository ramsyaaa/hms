<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppointmentAPIController extends AppBaseController
{
    /** @var AppointmentRepository */
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepo)
    {
        $this->appointmentRepository = $appointmentRepo;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
       $appointments = Appointment::with('patient.patientUser', 'doctor.doctorUser', 'department')->where('patient_id', getLoggedInUser()->patient->id)->orderBy('id', 'desc')->get();

        $data = [];
        foreach ($appointments as $appointment) {
            $data[] = $appointment->prepareAppointment();
        }

        return $this->sendResponse($data, 'Appointments Retrieved Successfully');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request): JsonResponse
    {
        $status = $request->get('status');
        $appointments = $this->appointmentRepository->filter($status);

        $data = [];
        foreach ($appointments as $appointment) {
            $data[] = $appointment->prepareAppointment();
        }

        return $this->sendResponse($data, 'Appointments Retrieved Successfully');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDoctorDepartment(): JsonResponse
    {
        $doctor_departments = $this->appointmentRepository->getDoctorDepartmentForAPI();

        return $this->sendResponse($doctor_departments, 'Doctor department Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDoctors($id): JsonResponse
    {
        $doctor = $this->appointmentRepository->getDepartmentDoctorList($id);

        return $this->sendResponse($doctor, 'Doctor Retrieved Successfully');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookingSlots(Request $request): JsonResponse
    {
        $inputs = $request->all();
        $data = $this->appointmentRepository->getBookingSlotAPI($inputs);

        return $this->sendResponse($data, 'Retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateAppointmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAppointmentRequest $request): JsonResponse
    {
        $input = $request->all();
        $input['opd_date'] = $input['opd_date'].' '.$input['time'];
        if (Appointment::where('opd_date', $input['opd_date'])->first()) {
            return $this->sendError('please select appointment slot');
        }
        $input['patient_id'] = auth()->user()->owner_id;
        $input['is_completed'] = isset($input['status']) ? Appointment::STATUS_COMPLETED : Appointment::STATUS_PENDING;
        $success = $this->appointmentRepository->create($input);
        if ($success) {
            return $this->sendSuccess('Appointment created successfully');
        } else {
            return $this->sendError('Something went wrong');
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelAppointment(Request $request): JsonResponse
    {
        $appointment = Appointment::where('id', $request->id)->first();

        if (! $appointment) {
            return $this->sendError('Appointment not found');
        }

        $appointment->update(['is_completed' => Appointment::STATUS_CANCELLED]);

        return $this->sendSuccess('Appointment cancelled successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy(Request $request): JsonResponse
    {
        $appointment = Appointment::where('id', $request->id)->first();

        if (! $appointment) {
            return $this->sendError('Appointment not found');
        }

        $appointment->delete($request->id);

        return $this->sendSuccess('Appointment deleted successfully');
    }
}
