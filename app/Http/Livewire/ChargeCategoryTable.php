<?php

namespace App\Http\Livewire;

use App\Models\ChargeCategory;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ChargeCategoryTable extends LivewireTableComponent
{
    public $buttonComponent = 'charge_categories.templates.button.add-button';

    public $showButtonOnHeader = true;

    protected $model = ChargeCategory::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

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
            ->setDefaultSort('charge_categories.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('description') || $column->isField('charge_type')) {
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
            Column::make('Id', 'id')
                ->sortable()
                ->hideIf('id'),
            Column::make(__('messages.charge.charge_category'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.description'), 'description')
                ->view('charge_categories.templates.column.description')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.charge_category.charge_type'), 'charge_type')
                ->view('charge_categories.templates.column.charge_type')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('charge_categories.action'),

        ];
    }
}
