<?php

namespace App\Http\Controllers;

use App\Exports\AppointmentExport;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class AppointmentController
 */
class AppointmentController extends AppBaseController
{
    /** @var AppointmentRepository */
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepo)
    {
        $this->appointmentRepository = $appointmentRepo;
    }

    /**
     * Display a listing of the appointment.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $statusArr = Appointment::STATUS_ARR;

        return view('appointments.index', compact('statusArr'));
    }

    /**
     * Show the form for creating a new appointment.
     *
     * @return Factory|View
     */
    public function create()
    {
        $patients = $this->appointmentRepository->getPatients();
        $departments = $this->appointmentRepository->getDoctorDepartments();
        $statusArr = Appointment::STATUS_PENDING;

        return view('appointments.create', compact('patients', 'departments', 'statusArr'));
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  CreateAppointmentRequest  $request
     * @return JsonResponse
     */
    public function store(CreateAppointmentRequest $request)
    {
        $input = $request->all();
        $input['opd_date'] = $input['opd_date'].$input['time'];
        $input['is_completed'] = isset($input['status']) ? Appointment::STATUS_COMPLETED : Appointment::STATUS_PENDING;
        if ($request->user()->hasRole('Patient')) {
            $input['patient_id'] = $request->user()->owner_id;
        }
        $this->appointmentRepository->create($input);
        $this->appointmentRepository->createNotification($input);

        return $this->sendSuccess(__('messages.web_menu.appointment').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Display the specified appointment.
     *
     * @param  Appointment  $appointment
     * @return Factory|View|RedirectResponse
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show')->with('appointment', $appointment);
    }

    /**
     * Show the form for editing the specified appointment.
     *
     * @param  Appointment  $appointment
     * @return RedirectResponse|Redirector|View
     */
    public function edit(Appointment $appointment)
    {
        $patients = $this->appointmentRepository->getPatients();
        $doctors = $this->appointmentRepository->getDoctors($appointment->department_id);
        $departments = $this->appointmentRepository->getDoctorDepartments();
        $statusArr = $appointment->is_completed;

        return view('appointments.edit', compact('appointment', 'patients', 'doctors', 'departments', 'statusArr'));
    }

    /**
     * Update the specified appointment in storage.
     *
     * @param  Appointment  $appointment
     * @param  UpdateAppointmentRequest  $request
     * @return JsonResponse
     */
    public function update(Appointment $appointment, UpdateAppointmentRequest $request)
    {
        $input = $request->all();
        $input['opd_date'] = $input['opd_date'].$input['time'];
        $input['is_completed'] = isset($input['status']) ? Appointment::STATUS_COMPLETED : Appointment::STATUS_PENDING;
        if ($request->user()->hasRole('Patient')) {
            $input['patient_id'] = $request->user()->owner_id;
        }
        $appointment = $this->appointmentRepository->update($input, $appointment->id);

        return $this->sendSuccess(__('messages.web_menu.appointment').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified appointment from storage.
     *
     * @param  Appointment  $appointment
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Appointment $appointment): JsonResponse
    {
        if (getLoggedinPatient() && $appointment->patient_id != getLoggedInUser()->owner_id) {
            return $this->sendError(__('messages.web_menu.appointment').' '.__('messages.common.not_found'));
        } else {
            $this->appointmentRepository->delete($appointment->id);

            return $this->sendSuccess(__('messages.web_menu.appointment').' '.__('messages.common.deleted_successfully'));
        }
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getDoctors(Request $request)
    {
        $id = $request->get('id');

        $doctors = $this->appointmentRepository->getDoctors($id);

        return $this->sendResponse($doctors, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getBookingSlot(Request $request)
    {
        $inputs = $request->all();
        $data = $this->appointmentRepository->getBookingSlot($inputs);

        return $this->sendResponse($data, 'Retrieved successfully');
    }

    /**
     * @return BinaryFileResponse
     */
    public function appointmentExport()
    {
        return Excel::download(new AppointmentExport, 'appointments-'.time().'.xlsx');
    }

    /**
     * @param  Appointment  $appointment
     * @return JsonResponse
     */
    public function status(Appointment $appointment): JsonResponse
    {
        if (getLoggedinDoctor() && $appointment->doctor_id != getLoggedInUser()->owner_id) {
            return $this->sendError(__('messages.web_menu.appointment').' '.__('messages.common.not_found'));
        } else {
            $isCompleted = ! $appointment->is_completed;
            $appointment->update(['is_completed' => $isCompleted]);

            return $this->sendSuccess(__('messages.common.status_updated_successfully'));
        }
    }

    /**
     * @param  Appointment  $appointment
     * @return JsonResponse
     */
    public function cancelAppointment(Appointment $appointment): JsonResponse
    {
        if ((getLoggedinPatient() && $appointment->patient_id != getLoggedInUser()->owner_id) || (getLoggedinDoctor() && $appointment->doctor_id != getLoggedInUser()->owner_id)) {
            return $this->sendError(__('messages.web_menu.appointment').' '.__('messages.common.not_found'));
        } else {
            $appointment->update(['is_completed' => Appointment::STATUS_CANCELLED]);

            return $this->sendSuccess(__('messages.web_menu.appointment').' '.__('messages.common.canceled'));
        }
    }
}
