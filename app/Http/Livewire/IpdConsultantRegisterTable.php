<?php

namespace App\Http\Livewire;

use App\Models\IpdConsultantRegister;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IpdConsultantRegisterTable extends LivewireTableComponent
{
    public $ipdDiagnosisId;

    protected $model = IpdConsultantRegister::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'ipd_consultant_registers.add-button';

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

    public function mount(int $ipdDiagnosisId): void
    {
        $this->ipdDiagnosisId = $ipdDiagnosisId;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('ipd_consultant_registers.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('instruction_date')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.ipd_patient_consultant_register.doctor_id'), 'doctor.doctorUser.first_name')
                ->view('ipd_consultant_registers.columns.doctor')
                ->sortable()
                ->searchable(),
            Column::make('', 'doctor_id')->view('ipd_consultant_registers.columns.doctor')
                ->hideIf(1),
            Column::make(__('messages.ipd_patient_consultant_register.applied_date'), 'applied_date')
                ->view('ipd_consultant_registers.columns.applied_date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_patient_consultant_register.instruction_date'), 'instruction_date')
                ->view('ipd_consultant_registers.columns.instruction_date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('ipd_consultant_registers.columns.action'),
        ];
    }

    public function builder(): Builder
    {
        return IpdConsultantRegister::whereHas('doctor.doctorUser')->with('doctor.doctorUser')->where('ipd_patient_department_id',
            $this->ipdDiagnosisId)
            ->select('ipd_consultant_registers.*');
    }
}
