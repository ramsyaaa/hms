<?php

namespace App\Http\Livewire;

use App\Models\Charge;
use App\Models\ChargeCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ChargeTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'charges.templates.button.add-button';

    public $FilterComponent = ['charges.templates.button.filter-button', ChargeCategory::FILTER_CHARGE_TYPES];

    protected $model = Charge::class;

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
            ->setDefaultSort('charges.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('code') || $column->isField('name') || $column->isField('standard_charge')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('standard_charge')) {
                return [
                    'class' => 'd-flex justify-content-end',
                    'style' => 'padding-right: 7rem !important',
                ];
            }

            return [];
        });
    }

    /**
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.charge.code'), 'code')
                ->sortable()->searchable(),
            Column::make(__('messages.charge.charge_category'), 'chargeCategory.name')
                ->view('charges.templates.column.charge_category')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.charge_category.charge_type'), 'charge_type')
                ->view('charges.templates.column.charge_type')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.charge.standard_charge'), 'standard_charge')
                ->view('charges.templates.column.standard_charge')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('charges.action'),
        ];
    }

    /**
     * @return Builder|Charge|\Illuminate\Database\Query\Builder
     */
    public function builder(): Builder
    {
        $query = Charge::whereHas('chargeCategory')->with('chargeCategory')->select('charges.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('charges.charge_type', 1);
            }
            if ($this->statusFilter == 2) {
                $q->where('charges.charge_type', 2);
            }
            if ($this->statusFilter == 3) {
                $q->where('charges.charge_type', 3);
            }
            if ($this->statusFilter == 4) {
                $q->where('charges.charge_type', 4);
            }
            if ($this->statusFilter == 5) {
                $q->where('charges.charge_type', 5);
            }
        });

        return $query;
    }
}
