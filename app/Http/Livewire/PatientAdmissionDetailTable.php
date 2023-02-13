<?php

namespace App\Http\Livewire;

use App\Models\PatientAdmission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientAdmissionDetailTable extends LivewireTableComponent
{
    protected $model = PatientAdmission::class;

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

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('patient_admissions.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function mount(int $patientId)
    {
        $this->patientId = $patientId;
    }

    public function columns(): array
    {
        if (! Auth::user()->hasRole('Patient|Accountant|Nurse')) {
            $data = Column::make(__('messages.common.action'),
                'id')->view('patients.patient_admission_detail_columns.action');
        } else {
            $data = Column::make(__('messages.common.action'),
                'id')->view('patients.patient_admission_detail_columns.action');
        }

        return [
            Column::make(__('messages.bill.admission_id'),
                'patient_admission_id')->view('patients.patient_admission_detail_columns.admission_i_d')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_admission.doctor'),
                'doctor.doctorUser.first_name')->view('patients.patient_admission_detail_columns.doctor')
                ->sortable()->searchable(),
            Column::make('', 'doctor_id')->hideIf(1),
            Column::make(__('messages.patient_admission.admission_date'),
                'admission_date')->view('patients.patient_admission_detail_columns.admission_date')
                ->sortable(),
            Column::make(__('messages.patient_admission.discharge_date'),
                'discharge_date')->view('patients.patient_admission_detail_columns.discharge_date')
                ->sortable(),
            Column::make(__('messages.common.status'),
                'status')->view('patients.patient_admission_detail_columns.status'),
            $data,
        ];
    }

    public function builder(): Builder
    {
        $query = PatientAdmission::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->with('patient.patientUser',
            'doctor.doctorUser', 'package', 'insurance')
            ->select('patient_admissions.*')->where('patient_id', $this->patientId);

        return $query;
    }
}
