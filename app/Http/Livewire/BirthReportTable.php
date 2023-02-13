<?php

namespace App\Http\Livewire;

use App\Models\BirthReport;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BirthReportTable extends LivewireTableComponent
{
    protected $model = BirthReport::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'birth_reports.add-button';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('birth_reports.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.birth_report.case_id'), 'patient_id')
                ->hideIf('patient.patientUser.email')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.birth_report.case_id'), 'doctor_id')
                ->hideIf('doctor.doctorUser.email')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.birth_report.case_id'), 'patient.patientUser.email')
                ->hideIf('patient.patientUser.email')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.birth_report.case_id'), 'doctor.doctorUser.email')
                ->hideIf('doctor.doctorUser.email')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.birth_report.case_id'), 'case_id')
                ->view('birth_reports.templates.columns.case_id')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.case.patient'), 'patient.patientUser.first_name')
                ->view('birth_reports.templates.columns.patient_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.case.doctor'), 'doctor.doctorUser.first_name')
                ->view('birth_reports.templates.columns.doctor_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.birth_report.date'), 'date')
                ->view('birth_reports.templates.columns.date')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('birth_reports.action'),
        ];
    }

    public function builder(): Builder
    {
        if (! getLoggedinDoctor()) {
            $query = BirthReport::with('patient', 'doctor', 'caseFromBirthReport');
        } else {
            $doctorId = Doctor::where('user_id', getLoggedInUserId())->first();
            $query = BirthReport::with('patient', 'doctor', 'caseFromBirthReport')->where('doctor_id', $doctorId->id);
        }

        return $query;
    }
}
