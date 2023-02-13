<?php

namespace App\Http\Livewire;

use App\Models\PatientAdmission;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientAdmissionTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'patient_admissions.add-button';

    public $FilterComponent = ['patient_admissions.filter-button', PatientAdmission::FILTER_STATUS_ARR];

    protected $model = PatientAdmission::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPage', 'changeFilter'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('patient_admissions.created_at', 'desc')
            ->setQueryStringStatus(false);
//        $this->setThAttributes(function (Column $column) {
//            return [
//                'class' => 'w-100 text-nowrap',
//            ];
//        });
//        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
//            if ($columnIndex == '9') {
//                return [
//                    'class' => 'w-100 text-nowrap',
//                ];
//            }
//
//            return [];
//        });
    }

    public function columns(): array
    {
        if (! getLoggedinPatient()) {
            $this->showButtonOnHeader = true;
            $actionButton = Column::make(__('messages.patient_diagnosis_test.action'),
                'id')->view('patient_admissions.action');
        } else {
            $this->showButtonOnHeader = false;
            $actionButton = Column::make(__('messages.patient_diagnosis_test.action'),
                'id')->view('patient_diagnosis_test.templates.action-button')->hideIf(1);
        }

        return [
            Column::make(__('messages.bill.admission_id'),
                'patient_admission_id')->view('patient_admissions.columns.patient_admission_id')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_admission.patient'),
                'patient.patientUser.first_name')->view('patient_admissions.columns.patient')
                ->sortable()->searchable(),
            Column::make('', 'patient_id')->hideIf(1),
            Column::make(__('messages.patient_admission.doctor'),
                'doctor.doctorUser.first_name')->view('patient_admissions.columns.doctor')
                ->sortable()->searchable(),
            Column::make('', 'doctor_id')->hideIf(1),
            Column::make(__('messages.patient_admission.admission_date'),
                'admission_date')->view('patient_admissions.columns.admission_date')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_admission.discharge_date'),
                'discharge_date')->view('patient_admissions.columns.discharge_date')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_admission.package'), 'package.name')
                ->view('patient_admissions.columns.package')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_admission.insurance'), 'insurance.name')
                ->view('patient_admissions.columns.insurance')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_admission.policy_no'), 'policy_no')
                ->view('patient_admissions.columns.policy_no')
                ->sortable()->searchable(),
            Column::make(__('messages.common.status'), 'status')->view('patient_admissions.columns.status'),
            $actionButton,
        ];
    }

    public function builder(): Builder
    {
        $query = PatientAdmission::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->with('patient.patientUser',
            'doctor.doctorUser', 'package', 'insurance')
            ->select('patient_admissions.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('patient_admissions.status', PatientAdmission::ACTIVE);
            }
            if ($this->statusFilter == 2) {
                $q->where('patient_admissions.status', PatientAdmission::INACTIVE);
            }
        });

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        } elseif ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
