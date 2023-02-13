<?php

namespace App\Http\Livewire;

use App\Models\LiveMeeting;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LiveMeetingTable extends LivewireTableComponent
{
    protected $model = LiveMeeting::class;

    public $showFilterOnHeader = true;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'live_consultations.live_meetings.add-button';

    public $FilterComponent = ['live_consultations.live_meetings.filter-button', LiveMeeting::FILTER_STATUS];

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
            ->setDefaultSort('live_meetings.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.live_consultation.consultation_title'),
                'consultation_title')->view('live_consultations.live_meetings.columns.title')
                ->sortable()->searchable(),
            Column::make(__('messages.investigation_report.date'),
                'consultation_date')->view('live_consultations.live_meetings.columns.date')
                ->sortable()->searchable(),
            Column::make(__('messages.live_consultation.created_by'),
                'user.first_name')->view('live_consultations.live_meetings.columns.created_by')
                ->sortable(),
            Column::make(__('messages.common.status'),
                'status')->view('live_consultations.live_meetings.columns.status')
                ->sortable(),
            Column::make(__('messages.user.password'), 'password')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('live_consultations.live_meetings.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = LiveMeeting::whereHas('user')->with(['user', 'members'])->select('live_meetings.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('live_meetings.status', LiveMeeting::STATUS_AWAITED);
            }
            if ($this->statusFilter == 2) {
                $q->where('live_meetings.status', LiveMeeting::STATUS_CANCELLED);
            }
            if ($this->statusFilter == 3) {
                $q->where('live_meetings.status', LiveMeeting::STATUS_FINISHED);
            }
        });

        if (getLoggedInUser()->hasRole('Receptionist')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Doctor')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Nurse')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Accountant')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Lab Technician')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Pharmacist')) {
            $this->query($query);
        } elseif (getLoggedInUser()->hasRole('Case Manager')) {
            $this->query($query);
        }

        return $query;
    }

    /**
     * @param  array  $query
     */
    public function query($query)
    {
        $query->whereHas('members', function (Builder $query) {
            $query->where('user_id', '=', getLoggedInUserId());
        });
    }
}
