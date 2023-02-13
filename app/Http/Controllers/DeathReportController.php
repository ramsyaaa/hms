<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeathReportRequest;
use App\Http\Requests\UpdateDeathReportRequest;
use App\Models\BirthReport;
use App\Models\DeathReport;
use App\Models\PatientCase;
use App\Repositories\DeathReportRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeathReportController extends AppBaseController
{
    /** @var DeathReportRepository */
    private $deathReportRepository;

    public function __construct(DeathReportRepository $deathReportRepo)
    {
        $this->deathReportRepository = $deathReportRepo;
    }

    /**
     * Display a listing of the DeathReport.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $cases = $this->deathReportRepository->getCases();
        $doctors = $this->deathReportRepository->getDoctors();

        return view('death_reports.index', compact('cases', 'doctors'));
    }

    /**
     * Store a newly created DeathReport in storage.
     *
     * @param  CreateDeathReportRequest  $request
     * @return JsonResponse
     */
    public function store(CreateDeathReportRequest $request)
    {
        $input = $request->all();
        $input['date'] = Carbon::parse($input['date'])->format('Y-m-d H:i:s');
//        $patientId = PatientCase::with('patient.user')->whereCaseId($input['case_id'])->first();
        $patientId = BirthReport::whereCaseId($input['case_id'])->first();
        if (empty($patientId)) {
            return $this->sendError(__('messages.birth_report.patient_birth_date_not_found'));
        } else {
            $birthDate = $patientId->date;
            $deathDate = Carbon::parse($input['date'])->toDateString();
            if (! empty($birthDate) && $deathDate < $birthDate) {
                return $this->sendError(__('messages.birth_report.data_should_not_be_smaller_than_patient_birth_date'));
            }
            $deathReport = $this->deathReportRepository->store($input);

            return $this->sendSuccess(__('messages.death_report.death_report').' '.__('messages.common.saved_successfully'));
        }
    }

    /**
     * Display the specified DeathReport.
     *
     * @param  DeathReport  $deathReport
     * @return Factory|View
     */
    public function show(DeathReport $deathReport)
    {
        $cases = $this->deathReportRepository->getCases();
        $doctors = $this->deathReportRepository->getDoctors();

        return view('death_reports.show')->with([
            'deathReport' => $deathReport, 'cases' => $cases, 'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for editing the specified DeathReport.
     *
     * @param  DeathReport  $deathReport
     * @return JsonResponse
     */
    public function edit(DeathReport $deathReport)
    {
        if (checkRecordAccess($deathReport->doctor_id)) {
            return $this->sendError(__('messages.death_report.death_report').' '.__('messages.common.not_found'));
        } else {
            return $this->sendResponse($deathReport, 'Death Report retrieved successfully.');
        }
    }

    /**
     * Update the specified DeathReport in storage.
     *
     * @param  DeathReport  $deathReport
     * @param  UpdateDeathReportRequest  $request
     * @return JsonResponse
     */
    public function update(DeathReport $deathReport, UpdateDeathReportRequest $request)
    {
        $input = $request->all();
        $patientId = PatientCase::with('patient.patientUser')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->patientUser->dob;
        $deathDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $deathDate < $birthDate) {
            return $this->sendError('Date should not be smaller than patient birth date.');
        }

        $deathReport = $this->deathReportRepository->update($request->all(), $deathReport);

        return $this->sendSuccess(__('messages.death_report.death_report').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified DeathReport from storage.
     *
     * @param  DeathReport  $deathReport
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(DeathReport $deathReport)
    {
        if (checkRecordAccess($deathReport->doctor_id)) {
            return $this->sendError(__('messages.death_report.death_report').' '.__('messages.common.not_found'));
        } else {
            $this->deathReportRepository->delete($deathReport->id);

            return $this->sendSuccess(__('messages.death_report.death_report').' '.__('messages.common.deleted_successfully'));
        }
    }
}
