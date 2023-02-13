<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Accountant;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AccountTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'accounts.add-button';

    public $FilterComponent = ['accounts.filter-button', Accountant::FILTER_STATUS_ARR, Account::ACCOUNT_TYPES];

    protected $model = Account::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'changeTypeFilter', 'resetPage'];

    public function changeTypeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->typeFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

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
            ->setDefaultSort('accounts.created_at', 'desc')
            ->setQueryStringStatus(false)
            ->setFiltersEnabled();
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '3') {
                return [
                    'width' => '8%',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.account.account'), 'name')
                ->view('accounts.columns.name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.account.type'), 'type')
                ->view('accounts.columns.type')
                ->searchable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('accounts.columns.status')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('accounts.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Account::select('accounts.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('status', $this->statusFilter);
            }
            if ($this->statusFilter == 2) {
                $q->where('status', Account::INACTIVE);
            }
        });

        $query->when(isset($this->typeFilter), function (Builder $q) {
            if ($this->typeFilter == 0) {
            } else {
                $q->where('type', $this->typeFilter);
            }
        });

        return $query;
    }
}
