<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ServiceTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'services.add-button';

    public $FilterComponent = ['services.filter-button', Service::FILTER_STATUS_ARRAY];

    protected $model = Service::class;

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
            ->setDefaultSort('services.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => '',
            ];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '4') {
                return [
                    'class' => 'w-100px',
                ];
            }

            if ($column->isField('quantity') || $column->isField('name') || $column->isField('rate') || $column->isField('status')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('rate')) {
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
            Column::make(__('messages.package.service'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.service.quantity'), 'quantity')->view('services.templates.columns.quantity')
                ->sortable()->searchable(),
            Column::make(__('messages.service.rate'), 'rate')->view('services.templates.columns.rate')
                ->sortable()->searchable(),
            Column::make(__('messages.common.status'), 'status')->view('services.templates.columns.status')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('services.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var Service $query */
        $query = Service::select('services.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == Service::ACTIVE) {
                $q->where('status', $this->statusFilter);
            }
            if ($this->statusFilter == 2) {
                $q->where('status', Service::INACTIVE);
            }
        });

        return $query;
    }
}
