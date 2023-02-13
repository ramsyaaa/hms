<?php

namespace App\Http\Livewire;

use App\Models\CaseHandler;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CaseHandlerTable extends LivewireTableComponent
{
    protected $model = CaseHandler::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'case_handlers.add-button';

    public $FilterComponent = ['case_handlers.filter-button', CaseHandler::STATUS_ARR];

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
            ->setDefaultSort('case_handlers.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('phone') || $column->isField('qualification') || $column->isField('dob') || $column->isField('status')) {
                return [
                    'class' => 'pt-5',
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
            Column::make(__('messages.users'), 'user.first_name')
                ->view('case_handlers.templates.columns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.phone'), 'user_id')
                ->hideIf('user_id')
                ->sortable(),
            Column::make(__('messages.user.phone'), 'user.phone')
                ->view('case_handlers.templates.columns.phone')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.qualification'), 'user.qualification')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.nurse.birth_date'), 'user.dob')
                ->view('case_handlers.templates.columns.dob')
                ->sortable(),
            Column::make(__('messages.common.status'), 'user.status')
                ->view('case_handlers.templates.columns.status')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('case_handlers.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var CaseHandler $query */
        $query = CaseHandler::query()->select('users.*')->with('user');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 2) {
            } else {
                $q->where('status', $this->statusFilter);
            }
        });

        return $query;
    }
}
