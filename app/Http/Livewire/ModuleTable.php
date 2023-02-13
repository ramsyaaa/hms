<?php

namespace App\Http\Livewire;

use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ModuleTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = false;

    public $showFilterOnHeader = true;

    public $FilterComponent = ['settings.module-filter-button', Module::FILTER_STATUS_ARR];

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    protected $model = Module::class;

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('modules.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-100',
            ];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name')) {
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
            Column::make(__('messages.user.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make('', 'id')->view('')
                ->hideIf(1),
            Column::make(__('messages.common.status'), 'is_active')->view('settings.module-template.status')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        $query = Module::Query();
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('is_active', Module::ACTIVE);
            }
            if ($this->statusFilter == 2) {
                $q->where('is_active', Module::INACTIVE);
            }
        });

        return $query;
    }
}
