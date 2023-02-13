<?php

namespace App\Http\Livewire;

use App\Models\Insurance;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class InsuranceTable extends LivewireTableComponent
{
//    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'insurances.add-button';

    protected $model = Insurance::class;

    public $FilterComponent = ['insurances.filter-button', Insurance::FILTER_STATUS_ARRAY];

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
            ->setDefaultSort('insurances.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('service_tax') || $column->isField('hospital_rate') || $column->isField('total')) {
                return [
                    'class' => 'text-end',
                    'style' => 'padding-right: 7rem !important',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.insurance.insurance'), 'name')
                ->view('insurances.templates.columns.name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.insurance.service_tax'), 'service_tax')
                ->view('insurances.templates.columns.serveice_tax')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.insurance.insurance_no'), 'insurance_no')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.insurance.insurance_code'), 'insurance_code')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.insurance.hospital_rate'), 'hospital_rate')
                ->view('insurances.templates.columns.hospital_rate')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.total'), 'total')
                ->view('insurances.templates.columns.total')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('insurances.templates.columns.status'),
            Column::make(__('messages.common.action'), 'id')
                ->view('insurances.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Insurance::query()->select('insurances.*');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('status', Insurance::ACTIVE);
            }
            if ($this->statusFilter == 2) {
                $q->where('status', Insurance::INACTIVE);
            }
        });

        return $query;
    }
}
