<?php

namespace App\Http\Livewire;

use App\Models\Vaccination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VaccinationTable extends LivewireTableComponent
{
    protected $model = Vaccination::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'vaccinations.add-button';

    public $showFilterOnHeader = false;

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
            ->setDefaultSort('vaccinations.created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('manufactured_by') || $column->isField('brand')) {
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
            Column::make(__('messages.vaccination.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.vaccination.manufactured_by'), 'manufactured_by')
                ->sortable()->searchable(),
            Column::make(__('messages.vaccination.brand'), 'brand')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('vaccinations.action'),
        ];
    }
}
