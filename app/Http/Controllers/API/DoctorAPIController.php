<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\ScheduleDay;
use App\Models\User;
use App\Repositories\ScheduleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DoctorAPIController extends AppBaseController
{
    /** @var ScheduleRepository */
    private $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepository = $scheduleRepo;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $doctors = Doctor::query()->with('doctorUser')->orderBy('id', 'desc')->get();
        $data = [];
        foreach ($doctors as $doctor) {
            $data[] = $doctor->prepareDoctor();
        }

        return $this->sendResponse($data, 'Doctors Retrieved Successfully');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function users(): JsonResponse
    {
        $users = User::where('owner_type', \App\Models\Doctor::class)->orWhere('owner_type', '=', null)->get();

        $data = [];
        foreach ($users as $user) {
            $data[] = $user->prepareUserForDoctor();
        }

        return $this->sendResponse($data, 'Users Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $doctor = Doctor::with('doctorUser')->find($id);

        /** @var Doctor $doctor */

        return $this->sendResponse($doctor->prepareDoctorDetail(), 'Doctor Retrieved Successfully');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function doctorScheduleList(): JsonResponse
    {
        $id = getLoggedInUser()->owner_id;
        $schedules = Schedule::with('scheduleDays')->where('doctor_id', $id)->first();
        if (empty($schedules)) {
            return $this->sendError('Doctor schedule not found');
        }
        $scheduleDays = ScheduleDay::with('schedule')->where('doctor_id', $id)->where('schedule_id', $schedules->id)->get();
        $per_patient_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedules->per_patient_time)->format('H:i:s');
//        if ($time > '00:59:00') {
//            $per_patient_time = $time." hours";
//        } else {
//            $per_patient_time = \Carbon\Carbon::createFromFormat('H:i:s',
//                    $schedules->per_patient_time)->format('i').' minutes';
//        }

        $data = [];
        foreach ($scheduleDays as $key => $schedule) {
            $data[] = $schedule->prepareScheduleDay();
        }

        $response = [
            'id' => $schedules->id,
            'per_patient_time' => $per_patient_time,
            'schedule' => $data,
        ];

        return $this->sendResponse($response, 'Doctor Scheduled Retrieved Successfully');
    }

    /**
     * @param $id
     * @param  \App\Http\Requests\UpdateScheduleRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctorScheduleUpdate($id, Request $request): JsonResponse
    {
        $input = $request->all();

        $input['doctor_id'] = getLoggedInUser()->owner_id;

        $schedule = $this->scheduleRepository->update($input, $id);

        if ($schedule) {
            return $this->sendSuccess('Doctor Scheduled Updated Successfully');
        } else {
            return $this->sendError('Doctor Scheduled Not Updated');
        }
    }
}
