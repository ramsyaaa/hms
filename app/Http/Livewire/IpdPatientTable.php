<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\IpdPatientDepartment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IpdPatientTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'ipd_patient_departments.add-button';

    public $FilterComponent = ['ipd_patient_departments.filter-button', IpdPatientDepartment::FILTER_STATUS_ARR];

    protected $model = IpdPatientDepartment::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

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
            ->setDefaultSort('ipd_patient_departments.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.ipd_patient.ipd_number'), 'ipd_number')
                ->view('ipd_patient_departments.columns.ipd_number')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_patient.patient_id'), 'patient.patientUser.first_name')
                ->hideIf('patient.patientUser.first_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient.patient_id'), 'patient_id')
                ->hideIf('patient.patientUser.email')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient.patient_id'), 'patient.patientUser.first_name')
                ->view('ipd_patient_departments.columns.patient')
                ->sortable(),
            Column::make(__('messages.ipd_patient.doctor_id'), 'bed_id')
                ->hideIf('bed_id')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient.doctor_id'), 'doctor_id')
                ->hideIf('doctor.doctorUser.first_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient.doctor_id'), 'doctor.doctorUser.first_name')
                ->view('ipd_patient_departments.columns.doctor')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient.admission_date'), 'admission_date')
                ->view('ipd_patient_departments.columns.admission_date')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient.bed_id'), 'bed.name')
                ->view('ipd_patient_departments.columns.bed')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient.bill_status'), 'bill_status')
                ->view('ipd_patient_departments.columns.bill_status'),
            Column::make(__('messages.common.action'), 'id')
                ->view('ipd_patient_departments.action'),
        ];
    }

    public function builder(): Builder
    {

//        if (!getLoggedinDoctor()) {
        $query = IpdPatientDepartment::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')
            ->with(['patient.patientUser', 'doctor.doctorUser', 'bed', 'bill']);
//        }
//        else {
        ////            $doctorId = Doctor::where('user_id', getLoggedInUserId())->first();
//            $query = IpdPatientDepartment::whereHas('patient.user')->whereHas('doctor.user')
//                ->with(['patient.user', 'doctor.user', 'bed', 'bill'])->where('doctor_id', $doctorId->id);
//        }

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('bill_status', 0);
            }
            if ($this->statusFilter == 2) {
                $q->where('bill_status', 1);
            }
        });

        return $query;
    }
}
