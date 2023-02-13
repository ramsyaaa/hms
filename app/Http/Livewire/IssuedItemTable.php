<?php

namespace App\Http\Livewire;

use App\Models\IssuedItem;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IssuedItemTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'issued_items.add-button';

    public $FilterComponent = ['issued_items.filter-button', IssuedItem::STATUS_ARR];

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
            ->setDefaultSort('issued_items.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('issued_date') || $column->isField('return_date') || $column->isField('quantity') || $column->isField('status')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
    }

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.issued_item.item'), 'item.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.issued_item.item_category'), 'item.itemcategory.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.issued_item.issued_date'), 'issued_date')
                ->view('issued_items.templates.columns.issued_date')
                ->sortable(),
            Column::make(__('messages.issued_item.return_date'), 'return_date')
                ->view('issued_items.templates.columns.return_date')
                ->sortable(),
            Column::make(__('messages.issued_item.quantity'), 'quantity')
                ->view('issued_items.templates.columns.quantity')
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('issued_items.templates.columns.status')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('issued_items.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = IssuedItem::with('department', 'user', 'item');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 2) {
            } else {
                $q->where('status', $this->statusFilter);
            }
        });

        return $query->select('issued_items.*');
    }
}
