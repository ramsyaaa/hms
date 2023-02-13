<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientAppoinmentDetailTable extends LivewireTableComponent
{
    protected $model = Appointment::class;

    public $patientId;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(int $patientId)
    {
        $this->patientId = $patientId;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('appointments.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        if (! Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager')) {
            $data = Column::make(__('messages.common.action'), 'id')
               ->view('patients.patient_appointment_detail_column.action');
        } else {
            $data = Column::make(__('messages.common.action'), 'id')->hideIf(1)
                ->view('patients.patient_appointment_detail_column.action');
        }

        return [
            Column::make(__('messages.appointment.doctor'), 'doctor.doctorUser.first_name')->view('patients.patient_appointment_detail_column.doctor')
                ->sortable()->searchable(),
            Column::make('', 'doctor_id')->hideIf(1),
            Column::make(__('messages.appointment.doctor_department'), 'doctor.department.title')->view('patients.patient_appointment_detail_column.department')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.date'), 'opd_date')->view('patients.patient_appointment_detail_column.date')
                ->sortable()->searchable(),
            $data,
        ];
    }

    public function builder(): Builder
    {
        $query = Appointment::with('department')->select('appointments.*')->where('patient_id', $this->patientId);

        return $query;
    }
}
