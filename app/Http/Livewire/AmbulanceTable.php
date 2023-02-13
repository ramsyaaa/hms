<?php

namespace App\Http\Livewire;

use App\Models\Ambulance;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AmbulanceTable extends LivewireTableComponent
{
    use WithPagination;

    protected $model = Ambulance::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'ambulances.add-button';

    public $FilterComponent = ['ambulances.filter-button', Ambulance::FILTER_STATUS_ARR];

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
            ->setDefaultSort('ambulances.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('vehicle_number') || $column->isField('vehicle_model') || $column->isField('year_made') || $column->isField('driver_name') || $column->isField('driver_license') || $column->isField('driver_contact') || $column->isField('vehicle_type') || $column->isField('is_available')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.ambulance.vehicle_number'), 'vehicle_number')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ambulance.vehicle_model'), 'vehicle_model')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ambulance.year_made'), 'year_made')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ambulance.driver_name'), 'driver_name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ambulance.driver_license'), 'driver_license')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ambulance.driver_contact'), 'driver_contact')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ambulance.vehicle_type'), 'vehicle_type')
                ->view('ambulances.templates.columns.vehicle_type')
                ->sortable(),
            Column::make(__('messages.ambulance.is_available'), 'is_available')
                ->view('ambulances.templates.columns.is_available'),
            Column::make(__('messages.common.action'), 'id')
                ->view('ambulances.action-button'),
        ];
    }

    public function builder(): BUIlder
    {
        $query = Ambulance::select('ambulances.*');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('is_available', Ambulance::TRUE);
            }
            if ($this->statusFilter == 2) {
                $q->where('is_available', Ambulance::FALSE);
            }
        });

        return $query;
    }
}
