<?php

namespace App\Http\Livewire;

use App\Models\IpdConsultantRegister;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IpdConsultantRegisterPatientTable extends LivewireTableComponent
{
    public $ipdPatientDepartment;

    protected $model = IpdConsultantRegister::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(int $ipdPatientDepartment)
    {
        $this->ipdPatientDepartment = $ipdPatientDepartment;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('ipd_consultant_registers.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.ipd_patient_consultant_register.applied_date'), 'applied_date')
                ->view('ipd_patient_list.columns.ipd_patient_counsultant_columns.applied_date')
                ->sortable(),
            Column::make(__('messages.ipd_patient_consultant_register.doctor_id'), 'doctor.doctorUser.first_name')
                ->view('ipd_patient_list.columns.ipd_patient_counsultant_columns.doctor')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.ipd_patient_consultant_register.instruction_date'), 'instruction_date')
                ->view('ipd_patient_list.columns.ipd_patient_counsultant_columns.instruction_date')
                ->sortable(),
            Column::make(__('messages.ipd_patient_consultant_register.instruction'), 'instruction')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        return IpdConsultantRegister::whereHas('doctor.doctorUser')->with('doctor.doctorUser')->where('ipd_patient_department_id',
            $this->ipdPatientDepartment)
            ->select('ipd_consultant_registers.*');
    }
}
