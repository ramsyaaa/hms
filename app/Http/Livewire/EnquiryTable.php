<?php

namespace App\Http\Livewire;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EnquiryTable extends LivewireTableComponent
{
    protected $model = Enquiry::class;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $FilterComponent = ['enquiries.filter-button', Enquiry::STATUS_ARR];

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
            ->setDefaultSort('enquiries.created_at', 'desc')
            ->setQueryStringStatus(false);
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
            Column::make('id', 'id')
               ->hideIf('id'),
            Column::make(__('messages.user.name'), 'full_name')
                ->view('enquiries.templates.columns.full_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.email'), 'email')
                ->searchable()
                ->hideIf('email')
                ->sortable(),
            Column::make(__('messages.enquiry.type'), 'type')
                ->view('enquiries.templates.columns.type')
                ->sortable(),
            Column::make(__('messages.common.created_at'), 'created_at')
                ->view('enquiries.templates.columns.date')
                ->sortable(),
            Column::make(__('messages.enquiry.viewed_by'), 'user.first_name')
                ->view('enquiries.templates.columns.viewed_by')
                ->sortable(),
            Column::make(__('messages.user.status'), 'status')
                ->view('enquiries.templates.columns.status')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('enquiries.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var Enquiry $query */
        $query = Enquiry::query()->select('enquiries.*')->with('user');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 2) {
            } else {
                $q->where('enquiries.status', $this->statusFilter);
            }
        });

        return $query;
    }
}
