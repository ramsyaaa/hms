<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\InvestigationReport;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class InvestigationReportTable extends LivewireTableComponent
{
    protected $model = InvestigationReport::class;

    public $showFilterOnHeader = true;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'investigation_reports.add-button';

    public $FilterComponent = ['investigation_reports.filter-button', InvestigationReport::STATUS_ARR];

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
            ->setDefaultSort('investigation_reports.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('title') || $column->isField('short_name') || $column->isField('status') || $column->isField('created_at')) {
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
            Column::make(__('messages.common.user_details'), 'patient.patientUser.first_name')
                ->hideIf('patient.patientUser.first_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.users'), 'patient.patientUser.first_name')
                ->view('investigation_reports.templates.columns.patient_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.investigation_report.date'), 'date')
                ->view('investigation_reports.templates.columns.date')
                ->sortable(),
            Column::make(__('messages.investigation_report.title'), 'title')
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('investigation_reports.templates.columns.status'),
            Column::make(__('messages.incomes.attachment'), 'created_at')
                ->view('investigation_reports.templates.columns.attachment'),
            Column::make(__('messages.common.action'), 'id')->view('investigation_reports.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var InvestigationReport $media */
        if (! getLoggedinDoctor()) {
            $query = InvestigationReport::query()->select('investigation_reports.*')->with('media', 'patient',
                'doctor');
        } else {
            $doctorId = Doctor::where('user_id', getLoggedInUserId())->first();
            $query = InvestigationReport::query()->select('investigation_reports.*')->with('media', 'patient',
                'doctor')->where('doctor_id', $doctorId->id);
        }
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 0) {
            } else {
                $q->where('investigation_reports.status', $this->statusFilter);
            }
        });

        return $query;
    }
}
