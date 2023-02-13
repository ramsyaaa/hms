<?php

namespace App\Http\Livewire;

use App\Models\ItemCategory;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ItemCategoryTable extends LivewireTableComponent
{
    protected $model = ItemCategory::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'item_categories.add-button';

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
            ->setDefaultSort('item_categories.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-100',
            ];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.user.name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('item_categories.action'),
        ];
    }
}
