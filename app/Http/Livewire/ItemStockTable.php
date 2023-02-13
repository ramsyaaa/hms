<?php

namespace App\Http\Livewire;

use App\Models\ItemStock;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ItemStockTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $buttonComponent = 'item_stocks.add-button';

    protected $model = ItemStock::class;

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
            ->setDefaultSort('item_stocks.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('quantity') || $column->isField('purchase_price') || $column->isField('created_at')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('purchase_price')) {
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
            Column::make(__('messages.item_stock.item'), 'item.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.item_stock.item_category'), 'item.itemcategory.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.item_stock.quantity'), 'quantity')
                ->view('item_stocks.templates.columns.available_quantity')
                ->sortable(),
            Column::make(__('messages.item_stock.purchase_price'), 'purchase_price')
                ->view('item_stocks.templates.columns.purchase_price')
                ->sortable(),
            Column::make(__('messages.common.created_at'), 'created_at')
                ->view('item_stocks.templates.columns.created_at')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('item_stocks.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var ItemStock $query */
        return ItemStock::with('item')->select('item_stocks.*');
    }
}
