<?php

namespace App\Http\Livewire;

use App\Models\PatientCase;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorCasesTable extends LivewireTableComponent
{
    protected $model = PatientCase::class;

    public $docId;

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
        $this->setPrimaryKey('id');
        $this->setDefaultSort('patient_cases.created_at', 'desc');
        $this->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('case_id') || $column->isField('phone') || $column->isField('fee') || $column->isField('status')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('fee')) {
                return [
                    'class' => 'd-flex justify-content-end',
                    'style' => 'padding-right: 7rem !important',
                ];
            }

            return [];
        });
    }

    public function mount(int $docId): void
    {
        $this->docId = $docId;
    }

    public function columns(): array
    {
        return [

            Column::make(__('messages.case.case_id'), 'case_id')
                ->view('doctors.templates.caseColumns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.case.patient'), 'patient_id')
                ->view('doctors.templates.caseColumns.patient_name')
                ->sortable(),
            Column::make(__('messages.case.phone'), 'phone')
                ->view('doctors.templates.caseColumns.phone')
                ->sortable(),
            Column::make(__('messages.case.case_date'), 'date')
                ->view('doctors.templates.caseColumns.date')
                ->sortable(),
            Column::make(__('messages.case.fee'), 'fee')
                ->view('doctors.templates.caseColumns.fee')
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('doctors.templates.caseColumns.status')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var PatientCase $query */
        $query = PatientCase::where('doctor_id', $this->docId)->with('patient');

        return $query;
    }
}
