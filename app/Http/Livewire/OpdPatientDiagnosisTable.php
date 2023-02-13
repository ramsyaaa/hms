<?php

namespace App\Http\Livewire;

use App\Models\OpdDiagnosis;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OpdPatientDiagnosisTable extends LivewireTableComponent
{
    protected $model = OpdDiagnosis::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public $patientDiagnosis;

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(string $patientDiagnosis): void
    {
        $this->patientDiagnosis = $patientDiagnosis;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('opd_diagnoses.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.ipd_patient_diagnosis.report_type'), 'report_type')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient_diagnosis.report_date'), 'report_date')
                ->sortable(),
            Column::make(__('messages.ipd_patient_diagnosis.document'), 'created_at')
                ->view('opd_patient_list.templates.DiagnosisColumn.document')
                ->sortable(),
            Column::make(__('messages.ipd_patient_diagnosis.description'), 'description')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var OpdDiagnosis $query */
        $query = OpdDiagnosis::whereOpdPatientDepartmentId($this->patientDiagnosis)->select('opd_diagnoses.*');

        return $query;
    }
}
