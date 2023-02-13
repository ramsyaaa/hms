<?php

namespace App\Http\Livewire;

use App\Models\IpdPrescription;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IpdPrescriptionTable extends LivewireTableComponent
{
    public $ipdPrescriptionId;

    protected $model = IpdPrescription::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(int $ipdPrescriptionId)
    {
        $this->ipdPrescriptionId = $ipdPrescriptionId;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('ipd_prescriptions.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '2') {
                return [
                    'width' => '12%',
                ];
            }
            if ($column->isField('ipd_patient_department_id') || $column->isField('created_at')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        if (! getLoggedinPatient()) {
            $actionButton = Column::make(__('messages.common.action'), 'id')->view('ipd_prescriptions.columns.action');
        } else {
            $actionButton = Column::make(__('messages.common.action'), 'id')->view('ipd_prescriptions.columns.action')->hideIf(1);
        }

        return [
            Column::make(__('messages.ipd_patient_prescription.ipd_no'), 'ipd_patient_department_id')
                ->view('ipd_prescriptions.columns.ipd_no')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.created_on'), 'created_at')
                ->view('ipd_prescriptions.columns.created_at')
                ->sortable()
                ->searchable(),
            $actionButton,
        ];
    }

    public function builder(): Builder
    {
        return IpdPrescription::with('patient')->where('ipd_patient_department_id', $this->ipdPrescriptionId)
            ->select('ipd_prescriptions.*');
    }
}
