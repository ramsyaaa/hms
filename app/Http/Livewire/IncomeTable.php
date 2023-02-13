<?php

namespace App\Http\Livewire;

use App\Models\Income;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IncomeTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'incomes.add-button';

    public $FilterComponent = ['incomes.filter-button', Income::FILTER_INCOME_HEAD];

    protected $model = Income::class;

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
            ->setDefaultSort('incomes.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('amount')) {
                return [
                    'class' => 'd-flex justify-content-end',
                    'style' => 'padding-right: 7rem !important',
                ];
            }

            return [];
        });
    }

    public $columnSearch = [
        'invoice_number' => null,
        'name' => null,
    ];

    public $date = [
        'date' => null,
    ];

    public function columns(): array
    {
        return [
            Column::make(__('messages.incomes.invoice_number'), 'invoice_number')
                ->sortable()
                ->searchable()
                ->view('incomes.templates.columns.invoice_number'),
            Column::make(__('messages.incomes.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.incomes.income_head'), 'income_head')
                ->sortable()
                ->view('incomes.templates.columns.income_head'),
            Column::make(__('messages.incomes.date'), 'date')
                ->view('incomes.templates.columns.income_date')
                ->sortable(),
            Column::make(__('messages.incomes.amount'), 'amount')
                ->view('incomes.templates.columns.amount')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.incomes.attachment'), 'id')
                ->view('incomes.templates.columns.attachment'),
            Column::make(__('messages.common.action'), 'created_at')->view('incomes.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var Income $query */
        $query = Income::query()->select('incomes.*')->with('media');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 0) {
            } else {
                $q->where('income_head', $this->statusFilter);
            }
        });

        return $query;
    }
}
