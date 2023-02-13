<?php

namespace App\Http\Livewire;

use App\Models\OpdPatientDepartment;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OpdPatientTable extends LivewireTableComponent
{
    protected $model = Patient::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'opd_patient_departments.add-button';

    public $showFilterOnHeader = false;

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
            ->setDefaultSort('opd_patient_departments.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('standard_charge')) {
                return [
                    'class' => 'd-flex justify-content-end',
                    'style' => 'padding-right: 3rem !important',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.opd_patient.opd_number'), 'opd_number')
                ->view('opd_patient_departments.columns.opd_no')
                ->sortable()
                ->searchable(),
            //                ->searchable(fn(Builder $query, $searchTerm) =>
            //                $query->with('opd')->whereHas('opd', function (Builder $q) use ($searchTerm){
            //
            //                    $q->where('opd_number', $searchTerm)
            //                        ->orWhere('opd_number', 'like', '%'. $searchTerm .'%');
            //                })),
            //            Column::make(__('messages.ipd_patient.patient_id'),"opd.opd_patient_id")
            //                ->hideIf('patient_id'),
            Column::make(__('messages.ipd_patient.patient_id'), 'patient.patientUser.first_name')
                ->view('opd_patient_departments.columns.patient')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient.doctor_id'), 'doctor.doctorUser.first_name')
                ->view('opd_patient_departments.columns.doctor')
                ->sortable(),
            Column::make(__('messages.opd_patient.appointment_date'), 'appointment_date')
                ->view('opd_patient_departments.columns.appointment_date')
                ->searchable()
//                ->searchable(fn(Builder $query, $searchTerm) =>
//                $query->with('opd')->whereHas('opd', function (Builder $q) use ($searchTerm){
//                    $q->where('appointment_date', $searchTerm)
//                        ->orWhere('appointment_date', 'like', '%'. $searchTerm .'%');
//                }))
                ->sortable(),
            Column::make(__('messages.doctor_opd_charge.standard_charge'), 'standard_charge')
                ->view('opd_patient_departments.columns.standard_charge')
                ->searchable()
//                ->searchable(fn(Builder $query, $searchTerm) =>
//                $query->with('opd')->whereHas('opd', function (Builder $q) use ($searchTerm){
//                    $q->where('standard_charge', $searchTerm)
//                        ->orWhere('standard_charge', 'like', '%'. $searchTerm .'%');
//                }))
                ->sortable(),
            Column::make(__('messages.ipd_payments.payment_mode'), 'payment_mode')
                ->view('opd_patient_departments.columns.payment_mode')
                ->searchable()
//                ->searchable(fn(Builder $query, $searchTerm) =>
//                $query->with('opd')->whereHas('opd', function (Builder $q) use ($searchTerm){
//                    $q->where('payment_mode', $searchTerm);
//                }))
                ->sortable(),
            Column::make(__('messages.opd_patient.total_visits'), 'id')
                ->view('opd_patient_departments.columns.total_visits'),
            Column::make(__('messages.common.action'), 'id')
                ->view('opd_patient_departments.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = OpdPatientDepartment::whereHas('patient')->whereHas('doctor')
            ->with(['patient.patientUser', 'doctor.doctorUser', 'patient.opd'])->select('opd_patient_departments.*');

        return $query;

//        return Patient::whereHas('opd')->with(['opd','opd.doctor.user'])->withCount('opd');
    }
}
