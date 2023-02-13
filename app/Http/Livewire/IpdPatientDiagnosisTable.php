<?php

namespace App\Http\Livewire;

use App\Models\IpdDiagnosis;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IpdPatientDiagnosisTable extends LivewireTableComponent
{
    public $ipdPatientDepartment;

    protected $model = IpdDiagnosis::class;

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
            ->setDefaultSort('ipd_diagnoses.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function mount(int $ipdPatientDepartment): void
    {
        $this->ipdPatientDepartment = $ipdPatientDepartment;
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.ipd_patient_diagnosis.report_type'), 'report_type')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_patient_diagnosis.report_date'), 'report_date')
                ->view('ipd_patient_list.columns.ipd_patient_diagnosys_columns.report_date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_patient_diagnosis.document'), 'id')
                ->view('ipd_patient_list.columns.ipd_patient_diagnosys_columns.document')
                ->sortable(),
            Column::make(__('messages.ipd_patient_diagnosis.description'), 'description')
                ->sortable()
                ->searchable(),
        ];
    }

    public function builder(): Builder
    {
        return IpdDiagnosis::whereIpdPatientDepartmentId($this->ipdPatientDepartment)->select('ipd_diagnoses.*');
    }
}
