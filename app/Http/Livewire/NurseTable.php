<?php

namespace App\Http\Livewire;

use App\Models\Nurse;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class NurseTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'nurses.add-button';

    public $FilterComponent = ['nurses.filter-button', Nurse::FILTER_STATUS_ARR];

    protected $model = Nurse::class;

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
            ->setDefaultSort('nurses.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '5') {
                return [
                    'width' => '8%',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.nurses'), 'user.first_name')
                ->view('nurses.columns.nurses')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.phone'), 'user.phone')
                ->view('nurses.columns.phone')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.qualification'), 'user.qualification')
                ->view('nurses.columns.qualification')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.nurse.birth_date'), 'user.dob')
                ->view('nurses.columns.birth_date')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.status'), 'created_at')
                ->view('nurses.columns.status'),
            Column::make(__('messages.common.action'), 'updated_at')
                ->view('nurses.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Nurse::whereHas('user')->with('user.media')->select('nurses.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('status', 1);
            }
            if ($this->statusFilter == 2) {
                $q->where('status', 0);
            }
        });

        return $query;
    }
}
