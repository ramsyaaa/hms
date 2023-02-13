<?php

namespace App\Http\Livewire;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VisitorTable extends LivewireTableComponent
{
    protected $model = Visitor::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'visitors.add-button';

    public $FilterComponent = ['visitors.filter-button', Visitor::FILTER_PURPOSE];

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
            ->setDefaultSort('visitors.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('purpose') || $column->isField('name') || $column->isField('phone') || $column->isField('id_card') || $column->isField('no_of_person') || $column->isField('date') || $column->isField('in_time') || $column->isField('out_time') || $column->isField('id')) {
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

            Column::make(__('messages.visitor.purpose'), 'purpose')
                ->view('visitors.templates.columns.purpose')
                ->sortable()->searchable(),
            Column::make(__('messages.visitor.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.visitor.phone'), 'phone')
                ->view('visitors.templates.columns.phone')
                ->sortable()->searchable(),
            Column::make(__('messages.visitor.id_card'), 'id_card')
                ->view('visitors.templates.columns.id_card')
                ->sortable()->searchable(),
            Column::make(__('messages.visitor.number_of_person'), 'no_of_person')
                ->view('visitors.templates.columns.no_of_person')
                ->sortable()->searchable(),
            Column::make(__('messages.visitor.date'), 'date')
                ->view('visitors.templates.columns.date')
                ->sortable()->searchable(),
            Column::make(__('messages.visitor.in_time'), 'in_time')
                ->view('visitors.templates.columns.in_time')
                ->sortable(),
            Column::make(__('messages.visitor.out_time'), 'out_time')
                ->view('visitors.templates.columns.out_time')
                ->sortable(),
            Column::make(__('messages.incomes.attachment'), 'id')
                ->view('visitors.templates.columns.attachment'),
            Column::make(__('messages.common.action'), 'created_at')->view('visitors.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var Visitor $query */
        $query = Visitor::query()->with('media')->select('visitors.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 0) {
            } else {
                $q->where('purpose', $this->statusFilter);
            }
        });

        return $query;
    }
}
