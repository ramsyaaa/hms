<?php

namespace App\Http\Livewire;

use App\Models\BedAssign;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AssignBedTable extends LivewireTableComponent
{
    protected $model = BedAssign::class;

    public $bedId;

    public function configure(): void
    {
        $this->setQueryStringStatus(false);
        $this->setPrimaryKey('id');
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('case_id') || $column->isField('discharge_date') || $column->isField('status')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function mount(string $bedId): void
    {
        $this->bedId = $bedId;
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.bed_assign.case_id'), 'case_id')
                ->view('beds.assignBed.case_id')
                ->sortable()->searchable(),
            Column::make(__('messages.case.patient'), 'patient_id')
                ->hideIf('patient_id'),
            Column::make(__('messages.case.patient'), 'patient.user_id')
                ->view('beds.assignBed.patient_name')
                ->searchable()
                ->sortable(),

            Column::make(__('messages.bed_assign.assign_date'), 'assign_date')
                ->view('beds.assignBed.assign_date')
                ->sortable()->searchable(),
            Column::make(__('messages.bed_assign.discharge_date'), 'discharge_date')
                ->view('beds.assignBed.discharge_date')
                ->sortable()->searchable(),

            Column::make(__('messages.common.status'), 'status')
                ->view('beds.assignBed.status')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        /** @var BedAssign $query */
        return BedAssign::where('bed_id', $this->bedId)->with('patient');
    }
}
