<?php

namespace App\Http\Livewire;

use App\Models\OpdDiagnosis;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OpdDiagnosesTable extends LivewireTableComponent
{
    protected $model = OpdDiagnosis::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public $opdDiagnoses;

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(string $opdDiagnoses): void
    {
        $this->opdDiagnoses = $opdDiagnoses;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('opd_diagnoses.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('report_type') || $column->isField('opd_patient_department_id') || $column->isField('description')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.ipd_patient_diagnosis.report_type'), 'report_type')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient_diagnosis.report_date'), 'report_date')
                ->view('opd_patient_departments.columnsDiagnoses.report_date')
                ->sortable()->searchable(),
            Column::make(__('messages.ipd_patient_diagnosis.document'), 'opd_patient_department_id')
                ->view('opd_patient_departments.columnsDiagnoses.document'),

            Column::make(__('messages.ipd_patient_diagnosis.description'), 'description')
                ->view('opd_patient_departments.columnsDiagnoses.description')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('opd_diagnoses.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var OpdDiagnosis $query */
        $query = OpdDiagnosis::where('opd_patient_department_id', $this->opdDiagnoses);

        return $query;
    }
}
