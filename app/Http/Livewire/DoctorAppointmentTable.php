<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorAppointmentTable extends LivewireTableComponent
{
    public $docId;

    protected $model = Appointment::class;

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
            ->setDefaultSort('appointments.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('title')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function mount(string $docId): void
    {
        $this->docId = $docId;
    }

    public function columns(): array
    {
        return [

            Column::make(__('messages.appointment.patient_name'), 'patient.patientUser.first_name')
                ->view('doctors.templates.doctorAppointmentColumns.patient_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.appointment.doctor_name'), 'doctor.doctorUser.first_name')
                ->view('doctors.templates.doctorAppointmentColumns.doctor_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.appointment.department_name'), 'doctor.department.title')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.appointment.opd_date'), 'opd_date')
                ->view('doctors.templates.doctorAppointmentColumns.opd_date')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.prescription.problem'), 'doctor_id')
                ->hideIf('doctor_id')
                ->sortable(),
            Column::make('Is completed', 'patient_id')
                ->hideIf('patient_id')
                ->sortable(),
            Column::make('Id', 'id')
                ->hideIf('id')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var Appointment $query */
        $query = Appointment::where('doctor_id', $this->docId)->with('patient', 'doctor', 'department');

        return $query;
    }
}
