<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DepartmentDoctorTable extends LivewireTableComponent
{
    protected $model = Doctor::class;

    public $doctorDepartmentId;

    public function configure(): void
    {
        $this->setQueryStringStatus(false);
        $this->setPrimaryKey('id');
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('specialist') || $column->isField('phone') || $column->isField('qualification') || $column->isField('status')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function mount(string $doctorDepartmentId): void
    {
        $this->doctorDepartmentId = $doctorDepartmentId;
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.case.doctor'), 'user_id')
                ->hideIf('id'),
            Column::make(__('messages.case.doctor'), 'id')
                ->view('doctors.templates.columns.name')
                ->sortable()->searchable(),
            Column::make(__('messages.doctor.specialist'), 'specialist')
                ->sortable()->searchable(),
            Column::make(__('messages.case.phone'), 'doctorUser.phone')
                ->view('doctor_departments.templates.columns.phone')
                ->sortable()->searchable(),
            Column::make(__('messages.user.qualification'), 'doctorUser.qualification')
                ->view('doctors.templates.columns.qualification')
                ->sortable()->searchable(),
            Column::make(__('messages.user.status'), 'doctorUser.status')
                ->view('doctor_departments.templates.columns.status')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var Doctor $query */
        $query = Doctor::with('doctorUser')->where('doctor_department_id', $this->doctorDepartmentId);

        return $query;
    }
}
