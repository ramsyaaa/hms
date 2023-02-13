<?php

namespace App\Http\Livewire;

use App\Models\PatientDiagnosisTest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientDiagnosisTestTable extends LivewireTableComponent
{
    public $showFilterOnHeader = false;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'patient_diagnosis_test.add-button';

    protected $model = PatientDiagnosisTest::class;

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
            ->setDefaultSort('patient_diagnosis_tests.created_at', 'desc')
            ->setQueryStringStatus(false)
            ->setThAttributes(function (Column $column) {
                return [
                    'class' => 'text-nowrap',
                ];
            });
    }

    public function columns(): array
    {
        if (! getLoggedinPatient()) {
            $this->showButtonOnHeader = true;
            $actionButton = Column::make(__('messages.patient_diagnosis_test.action'),
                'id')->view('patient_diagnosis_test.templates.action-button');
        } else {
            $this->showButtonOnHeader = false;
            $actionButton = Column::make(__('messages.patient_diagnosis_test.action'),
                'id')->view('patient_diagnosis_test.templates.action-button')->hideIf(1);
        }

        return [
            Column::make(__('messages.patient_diagnosis_test.report_number'),
                'report_number')->view('patient_diagnosis_test.templates.columns.report')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_diagnosis_test.patient'),
                'patient.patientUser.first_name')->view('patient_diagnosis_test.templates.columns.patient')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_diagnosis_test.doctor'),
                'doctor.doctorUser.first_name')->view('patient_diagnosis_test.templates.columns.doctor')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_diagnosis_test.doctor'),
                'doctor_id')->hideIf(1),
            Column::make(__('messages.patient_diagnosis_test.diagnosis_category'),
                'category.name')->view('patient_diagnosis_test.templates.columns.diagnosys_category')
                ->sortable(),
            Column::make(__('messages.common.created_at'),
                'created_at')->view('patient_diagnosis_test.templates.columns.created_at')->sortable(),
            $actionButton,
        ];
    }

    public function builder(): Builder
    {
        $query = PatientDiagnosisTest::with('patient.patientUser',
            'doctor.doctorUser',
            'category')->select('patient_diagnosis_tests.*');

        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
