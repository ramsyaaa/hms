<?php

namespace App\Http\Livewire;

use App\Models\ScheduleDay;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorScheduleTable extends LivewireTableComponent
{
    protected $model = ScheduleDay::class;

    public $docId;

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
            ->setDefaultSort('schedule_days.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function mount(string $docId): void
    {
        $this->docId = $docId;
    }

    public function columns(): array
    {
        return [

            Column::make('Doctor id', 'doctor_id')
                ->hideIf('doctor_id')
                ->sortable(),
            Column::make(__('messages.schedule.available_on'), 'available_on')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.schedule.available_from'), 'available_from')
                ->view('doctors.templates.doctorSchedule.available_from')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.schedule.available_to'), 'available_to')
                ->view('doctors.templates.doctorSchedule.available_to')
                ->searchable()
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        /** @var ScheduleDay $query */
        $query = ScheduleDay::where('doctor_id', $this->docId);

        return $query;
    }
}
