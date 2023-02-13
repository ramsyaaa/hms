<?php

namespace App\Http\Livewire;

use App\Models\Accountant;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AccountantTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'accountants.add-button';

    public $FilterComponent = ['accountants.filter-button', Accountant::FILTER_STATUS_ARR];

//    public $FilterComponent = ['livewire.filter-button', Accountant::FILTER_STATUS_ARR];
    protected $model = Accountant::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

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
            ->setDefaultSort('accountants.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => '',
            ];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '3') {
                return [
                    'class' => 'text-center',
                    'width' => '8%',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.accountants'), 'user.first_name')
                ->view('accountants.columns.accountant')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.phone'), 'user.phone')
                ->view('accountants.columns.phone')
                ->sortable()->searchable(),
            Column::make(__('messages.common.status'), 'user.status')
                ->view('accountants.columns.status')
                ->searchable(),
            Column::make(__('messages.common.action'), 'created_at')
                ->view('accountants.action'),
            Column::make(__('last_name'), 'user.last_name')->hideIf(1),
            Column::make(__('email'), 'user.email')->hideIf(1),
        ];
    }

    public function builder(): Builder
    {
        /** @var Accountant $query */
        $query = Accountant::whereHas('user')->with('user')->select('accountants.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            $q->whereHas('user', function (Builder $query) {
                if ($this->statusFilter == 1) {
                    $query->where('status', Accountant::ACTIVE);
                }
                if ($this->statusFilter == 2) {
                    $query->where('status', Accountant::INACTIVE);
                }
            });
        });

        return $query;
    }
}
