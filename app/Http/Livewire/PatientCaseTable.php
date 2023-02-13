<?php

namespace App\Http\Livewire;

use App\Models\PatientCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientCaseTable extends LivewireTableComponent
{
    public $showButtonOnHeader = false;

    public $showFilterOnHeader = false;

    protected $model = PatientCase::class;

    public $patientId;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

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
            ->setDefaultSort('patient_cases.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '5') {
                return [
                    'class' => 'justify-content-center',
                ];
            }
            if ($column->isField('case_id') || $column->isField('fee')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('fee')) {
                return [
                    'class' => 'text-end',
                    'style' => 'padding-right: 7rem !important',
                ];
            }

            return [];
        });
    }

    public function mount(int $patientId): void
    {
        $this->patientId = $patientId;
    }

    public function columns(): array
    {
        if (! Auth::user()->hasRole('Patient|Doctor|Accountant|Nurse')) {
            $data = Column::make(__('messages.common.action'), 'id')->view('patients.patient-case-show-column.action');
        } else {
            $data = Column::make(__('messages.common.action'), 'id')->view('patients.patient-case-show-column.action')
                ->hideIf(1);
        }

        return [
            Column::make(__('messages.case.case_id'), 'case_id')->view('patients.patient-case-show-column.case-id')
                ->sortable()->searchable(),
            Column::make(__('messages.case.doctor'),
                'doctor.doctorUser.first_name')->view('patients.patient-case-show-column.doctor')
                ->sortable()->searchable(),
            Column::make(__('messages.case.doctor'), 'doctor_id')->hideIf(1),
            Column::make(__('messages.case.case_date'), 'date')->view('patients.patient-case-show-column.case_date')
                ->sortable()->searchable(),
            Column::make(__('messages.case.fee'), 'fee')->view('patients.patient-case-show-column.fee')
                ->sortable()->searchable(),
            Column::make(__('messages.common.status'), 'status')->view('patients.patient-case-show-column.status')
                ->sortable(),
            $data,
        ];
    }

    public function builder(): Builder
    {
        $patientCase = PatientCase::with('doctor')
         ->where('patient_id', $this->patientId)->select('patient_cases.*');

        return $patientCase;
    }
}
