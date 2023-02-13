<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBirthReportRequest;
use App\Http\Requests\UpdateBirthReportRequest;
use App\Models\BirthReport;
use App\Models\DeathReport;
use App\Models\PatientCase;
use App\Repositories\BirthReportRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class BirthReportController extends AppBaseController
{
    /** @var BirthReportRepository */
    private $birthReportRepository;

    public function __construct(BirthReportRepository $birthReportRepo)
    {
        $this->birthReportRepository = $birthReportRepo;
    }

    /**
     * Display a listing of the BirthReport.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $cases = $this->birthReportRepository->getCases();
        $doctors = $this->birthReportRepository->getDoctors();

        return view('birth_reports.index', compact('cases', 'doctors'));
    }

    /**
     * Store a newly created BirthReport in storage.
     *
     * @param  CreateBirthReportRequest  $request
     * @return JsonResponse|Redirector
     */
    public function store(CreateBirthReportRequest $request)
    {
        $input = $request->all();
        $input['date'] = Carbon::parse($input['date'])->format('Y-m-d H:i:s');
        $patientId = PatientCase::with('patient.patientUser')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->patientUser->dob;
        $selectBirthDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $selectBirthDate < $birthDate) {
            return $this->sendError(__('messages.bed_assign.assign_date_should_not_be_smaller_than_patient_birth_date'));
        }

        $isUserHasDead = DeathReport::whereCaseId($input['case_id'])->first();
        if (! empty($isUserHasDead)) {
            return $this->sendError('Can\'t create report because the patient has been dead.');
        }
        $birthReport = $this->birthReportRepository->store($input);

        return $this->sendSuccess(__('messages.birth_report.birth_report').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Display the specified BirthReport.
     *
     * @param  BirthReport  $birthReport
     * @return Factory|View
     */
    public function show(BirthReport $birthReport)
    {
        $cases = $this->birthReportRepository->getCases();
        $doctors = $this->birthReportRepository->getDoctors();

        return view('birth_reports.show')->with([
            'birthReport' => $birthReport, 'cases' => $cases, 'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for editing the specified BirthReport.
     *
     * @param  BirthReport  $birthReport
     * @return JsonResponse
     */
    public function edit(BirthReport $birthReport)
    {
        if (checkRecordAccess($birthReport->doctor_id)) {
            return $this->sendError(__('messages.birth_report.birth_report').' '.__('messages.common.not_found'));
        } else {
            return $this->sendResponse($birthReport, 'Birth Report retrieved successfully.');
        }
    }

    /**
     * Update the specified BirthReport in storage.
     *
     * @param  BirthReport  $birthReport
     * @param  UpdateBirthReportRequest  $request
     * @return JsonResponse
     */
    public function update(BirthReport $birthReport, UpdateBirthReportRequest $request)
    {
        $input = $request->all();
        $patientId = PatientCase::with('patient.patientUser')->whereCaseId($input['case_id'])->first();
        $birthDate = $patientId->patient->patientUser->dob;
        $selectBirthDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $selectBirthDate < $birthDate) {
            return $this->sendError(__('messages.bed_assign.assign_date_should_not_be_smaller_than_patient_birth_date'));
        }
        $birthReport = $this->birthReportRepository->update($request->all(), $birthReport);

        return $this->sendSuccess(__('messages.birth_report.birth_report').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified BirthReport from storage.
     *
     * @param  BirthReport  $birthReport
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(BirthReport $birthReport)
    {
        if (checkRecordAccess($birthReport->doctor_id)) {
            return $this->sendError(__('messages.birth_report.birth_report').' '.__('messages.common.not_found'));
        } else {
            $this->birthReportRepository->delete($birthReport->id);

            return $this->sendSuccess(__('messages.birth_report.birth_report').' '.__('messages.common.deleted_successfully'));
        }
    }
}
