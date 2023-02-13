<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ExpenseTable extends LivewireTableComponent
{
    protected $model = Expense::class;

    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'expenses.add-button';

    public $FilterComponent = ['expenses.filter-button', Expense::FILTER_EXPENSE_HEAD];

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
            ->setDefaultSort('expenses.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('invoice_number') || $column->isField('name') || $column->isField('expense_head') || $column->isField('date') || $column->isField('amount') || $column->isField('id')) {
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

    public function columns(): array
    {
        return [
            Column::make(__('messages.expense.invoice_number'), 'invoice_number')
                ->view('expenses.templates.columns.invoice_number')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.expense.name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.expense.expense_head'), 'expense_head')
                ->view('expenses.templates.columns.expense_head')
                ->sortable(),
            Column::make(__('messages.expense.date'), 'date')
                ->view('expenses.templates.columns.date')
                ->sortable(),
            Column::make(__('messages.expense.amount'), 'amount')
                ->view('expenses.templates.columns.amount')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.expense.attachment'), 'id')
                ->view('expenses.templates.columns.attachment'),
            Column::make(__('messages.common.action'), 'created_at')->view('expenses.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var Expense $media */
        $query = Expense::query()->select('expenses.*')->with('media');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 0) {
            } else {
                $q->where('expense_head', $this->statusFilter);
            }
        });

        return $query;
    }
}
