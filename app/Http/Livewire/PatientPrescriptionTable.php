<?php

namespace App\Http\Livewire;

use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientPrescriptionTable extends LivewireTableComponent
{
    public $showFilterOnHeader = true;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'patients_prescription_list.add-button';

    public $FilterComponent = ['patients_prescription_list.filter-button', Prescription::STATUS_ARR];

    protected $model = Prescription::class;

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
            ->setDefaultSort('prescriptions.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.prescription.patient'), 'patient.patientUser.first_name')
                ->sortable()->searchable()
                ->view('patients_prescription_list.templates.column.patient'),
            Column::make(__('messages.patient_admission.doctor'), 'doctor.doctorUser.first_name')
                ->sortable()->searchable()
                ->view('patients_prescription_list.templates.column.doctor'),
            Column::make(__('messages.prescription.medical_history'), 'medical_history')
                ->view('patients_prescription_list.templates.column.medical_history')
                ->sortable()->searchable(),
            Column::make(__('messages.prescription.current_medication'), 'current_medication')
                ->view('patients_prescription_list.templates.column.current_medication')
                ->sortable()->searchable(),
            Column::make(__('messages.prescription.health_insurance'), 'health_insurance')
                ->view('patients_prescription_list.templates.column.health_insurance')
                ->sortable()->searchable(),
            Column::make(__('messages.prescription.low_income'), 'low_income')
                ->view('patients_prescription_list.templates.column.low_income')
                ->sortable()->searchable(),
            Column::make(__('messages.prescription.reference'), 'reference')
                ->view('patients_prescription_list.templates.column.reference')
                ->sortable()->searchable(),
            Column::make(__('messages.common.status'), 'status')
                ->sortable()->searchable()
                ->view('patients_prescription_list.templates.column.status'),
            Column::make(__('messages.common.action'), 'created_at')
                ->view('patients_prescription_list.templates.column.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Prescription $query */
        $query = Prescription::with('patient.patientUser', 'doctor.doctorUser')->select('prescriptions.*');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 2) {
            } else {
                $q->where('prescriptions.status', $this->statusFilter);
            }
        });
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }

        return $query;
    }
}
