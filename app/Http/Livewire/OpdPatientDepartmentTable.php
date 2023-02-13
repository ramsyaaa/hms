<?php

namespace App\Http\Livewire;

use App\Models\OpdPatientDepartment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OpdPatientDepartmentTable extends LivewireTableComponent
{
    public $showButtonOnHeader = false;

    public $showFilterOnHeader = false;

    public $paginationIsEnabled = true;

    protected $model = OpdPatientDepartment::class;

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
                    'class' => 'text-end',
                    'style' => 'padding-right: 7rem !important',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.opd_patient.opd_number'), 'id')
                ->hideIf('id')
                ->sortable(),
            Column::make(__('messages.opd_patient.opd_number'), 'opd_number')
                ->view('opd_patient_list.templates.column.opd_no')
                ->sortable()->searchable(),
            Column::make(__('messages.ipd_patient.doctor_id'), 'doctor.doctorUser.first_name')
                ->view('opd_patient_list.templates.column.doctor')
                ->sortable()->searchable(),
            //            Column::make(__('messages.ipd_patient.doctor_id')
            //                ,"doctor_id")->hideIf(1),
            Column::make(__('messages.opd_patient.appointment_date'), 'appointment_date')
                ->view('opd_patient_list.templates.column.appointment_date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.doctor_opd_charge.standard_charge'), 'standard_charge')
                ->view('opd_patient_list.templates.column.standard_charge')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_payments.payment_mode'), 'payment_mode')
                ->view('opd_patient_list.templates.column.payment_mode')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.user.phone'), 'patient.patientUser.phone')
                ->view('opd_patient_list.templates.column.phone')
                ->sortable()->searchable(),
            Column::make(__('messages.opd_patient.total_visits'), 'created_at')
                ->view('opd_patient_list.templates.column.total_visits')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var OpdPatientDepartment $query */
        $query = OpdPatientDepartment::with([
            'patient.patientUser', 'doctor.doctorUser',
        ])->where('patient_id', getLoggedInUser()->owner_id)->select('opd_patient_departments.*');

        return $query;
    }
}
