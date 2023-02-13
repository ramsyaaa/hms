<?php

namespace App\Http\Livewire;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MedicineTable extends LivewireTableComponent
{
    protected $model = Medicine::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'medicines.add-button';

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
            ->setDefaultSort('medicines.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('selling_price') || $column->isField('buying_price')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('selling_price') || $column->isField('buying_price')) {
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
            Column::make(__('messages.medicine.medicine'), 'name')
                ->view('medicines.templates.columns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.brand'), 'brand.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.selling_price'), 'selling_price')
                ->view('medicines.templates.columns.selling_price')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.buying_price'), 'buying_price')
                ->view('medicines.templates.columns.buying_price')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('medicines.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var Medicine $query */
        return Medicine::with('category', 'brand')->select('medicines.*');
    }
}
