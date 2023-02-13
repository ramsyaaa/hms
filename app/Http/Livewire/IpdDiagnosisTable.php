<?php

namespace App\Http\Livewire;

use App\Models\IpdDiagnosis;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IpdDiagnosisTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $buttonComponent = 'ipd_diagnoses.add-button';

    protected $model = IpdDiagnosis::class;

    public $ipdDiagnosisId;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(int $ipdDiagnosisId)
    {
        $this->ipdDiagnosisId = $ipdDiagnosisId;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('ipd_diagnoses.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('report_type') || $column->isField('id') || $column->isField('description')) {
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
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_patient_diagnosis.report_date'), 'report_date')
                ->view('ipd_diagnoses.columns.report_date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_patient_diagnosis.document'), 'id')
                ->view('ipd_diagnoses.columns.document')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_patient_diagnosis.description'), 'description')
                ->view('ipd_diagnoses.columns.description')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'created_at')
                ->view('ipd_diagnoses.columns.action'),
        ];
    }

    public function builder(): Builder
    {
        return IpdDiagnosis::whereIpdPatientDepartmentId($this->ipdDiagnosisId)->select('ipd_diagnoses.*');
    }
}
