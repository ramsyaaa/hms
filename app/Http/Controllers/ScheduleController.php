<?php

namespace App\Http\Controllers;

use App\Exports\ScheduleExport;
use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\HospitalSchedule;
use App\Models\Schedule;
use App\Models\ScheduleDay;
use App\Repositories\ScheduleRepository;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ScheduleController extends AppBaseController
{
    /** @var ScheduleRepository */
    private $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepository = $scheduleRepo;
    }

    /**
     * Display a listing of the Schedule.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        if (getLoggedInUser()->hasRole('Doctor')) {
            $checkDoctorId = Doctor::where('user_id', getLoggedInUserId())->first();
            $checkDoctorSchedule = Schedule::where('doctor_id', $checkDoctorId->id)->get();

            return view('schedules.index', compact('checkDoctorSchedule'));
        }

        return view('schedules.index');
    }

    /**
     * Show the form for creating a new Schedule.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->scheduleRepository->getData();

        $hospitalSchedules = HospitalSchedule::all();
        if (count($hospitalSchedules) == 0) {
            Flash::success('Currently user not able to create a hospital schedule if hospital schedule is not available');
        }

        return view('schedules.create', compact('data'));
    }

    /**
     * Store a newly created Schedule in storage.
     *
     * @param  CreateScheduleRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateScheduleRequest $request)
    {
        $input = $request->all();

        $schedule = $this->scheduleRepository->store($input);

        Flash::success(__('messages.schedules').' '.__('messages.common.saved_successfully'));

        return redirect(route('schedules.index'));
    }

    /**
     * Display the specified Schedule.
     *
     * @param  Schedule  $schedule
     * @return View
     */
    public function show(Schedule $schedule)
    {
        if (checkRecordAccess($schedule->doctor_id) && getLoggedInUser()->hasRole('Doctor')) {
            return view('errors.404');
        } else {
            $scheduleDays = ScheduleDay::whereScheduleId($schedule->id)->get();

            return view('schedules.show', compact('scheduleDays', 'schedule'));
        }
    }

    /**
     * Show the form for editing the specified Schedule.
     *
     * @param  Schedule  $schedule
     * @return Factory|View
     */
    public function edit(Schedule $schedule)
    {
        $data = $this->scheduleRepository->getData();
        $scheduleDays = ScheduleDay::whereScheduleId($schedule->id)->get();

        return view('schedules.edit', compact('schedule', 'data', 'scheduleDays'));
    }

    /**
     * Update the specified Schedule in storage.
     *
     * @param  Schedule  $schedule
     * @param  UpdateScheduleRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(Schedule $schedule, UpdateScheduleRequest $request)
    {
        $schedule = $this->scheduleRepository->update($request->all(), $schedule->id);
        Flash::success(__('messages.schedules').' '.__('messages.common.updated_successfully'));

        return redirect(route('schedules.index'));
    }

    /**
     * Remove the specified Schedule from storage.
     *
     * @param  Schedule  $schedule
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Schedule $schedule)
    {
        $doctorModule = [Appointment::class];
        $result = canDelete($doctorModule, 'doctor_id', $schedule->doctor_id);
        if ($result) {
            return $this->sendError(__('messages.schedules').' '.__('messages.common.cant_be_deleted'));
        }

        $this->scheduleRepository->delete($schedule->id);
        ScheduleDay::whereScheduleId($schedule->id)->delete();

        return $this->sendSuccess(__('messages.schedules').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function doctorScheduleList(Request $request)
    {
        $input = $request->all();
        $dayName = '';

        foreach (HospitalSchedule::WEEKDAY_FULL_NAME as $key => $value) {
            if ($value == $input['day_name']) {
                $dayName = $key;
            }
        }

        $check = HospitalSchedule::where('day_of_week', $dayName)->exists();
        if (! $check) {
            return $this->sendError('This Day Hospital is Closed.');
        }

        $doctorSchedule = $this->scheduleRepository->getDoctorSchedule($input);

        return $this->sendResponse($doctorSchedule, 'successfully');
    }

    /**
     * @return BinaryFileResponse
     */
    public function schedulesExport()
    {
        return Excel::download(new ScheduleExport, getLoggedInUser()->full_name.'-schedules-'.time().'.xlsx');
    }
}
