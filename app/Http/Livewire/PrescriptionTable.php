<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PrescriptionTable extends LivewireTableComponent
{
    protected $model = Prescription::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'prescriptions.add-button';

    public $FilterComponent = ['prescriptions.filter-button', Prescription::STATUS_ARR];

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
        $this->setPrimaryKey('id');
        $this->setDefaultSort('prescriptions.created_at', 'desc');
        $this->setQueryStringStatus(false);

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('status')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
    }

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.patients'), 'patient.patientUser.first_name')
                ->view('prescriptions.templates.columns.patient_name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.patients'), 'patient_id')->hideIf(1),
            Column::make(__('messages.doctors'), 'doctor.doctorUser.first_name')
                ->view('prescriptions.templates.columns.doctor_name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.doctors'), 'doctor_id')->hideIf(1),
            Column::make(__('messages.prescription.medical_history'), 'medical_history')
                ->view('prescriptions.templates.columns.medical_history')
                ->sortable(),
            Column::make(__('messages.user.status'), 'status')
                ->view('prescriptions.templates.columns.status'),
            Column::make(__('messages.common.action'), 'id')->view('prescriptions.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var Prescription $query */
        if (! getLoggedinDoctor()) {
            $query = Prescription::query()->select('prescriptions.*')->with('patient', 'doctor');
        } else {
            $doctorId = Doctor::where('user_id', getLoggedInUserId())->first();
            $query = Prescription::query()->select('prescriptions.*')->with('patient', 'doctor')->where('doctor_id',
                $doctorId->id);
        }
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 2) {
            } else {
                $q->where('prescriptions.status', $this->statusFilter);
            }
        });

        return $query;
    }
}
