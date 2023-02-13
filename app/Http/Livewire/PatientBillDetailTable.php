<?php

namespace App\Http\Livewire;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientBillDetailTable extends LivewireTableComponent
{
    protected $model = Bill::class;

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
            ->setDefaultSort('bills.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '3') {
                return [
                    'width' => '8%',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('amount')) {
                return [
                    'class' => 'd-flex justify-content-end',
                    'style' => 'padding-right: 7rem !important',
                ];
            }

            return [];
        });
    }

    public function mount(int $patientId)
    {
        $this->patientId = $patientId;
    }

    public function columns(): array
    {
        if (! Auth::user()->hasRole('Patient|Doctor|Case Manager|Nurse|Receptionist')) {
            $data = Column::make(__('messages.common.action'), 'id')->view('patients.patient_bill_column.action');
        } else {
            $data = Column::make(__('messages.common.action'), 'id')->hideIf(1);
        }

        return [
            Column::make(__('messages.bill.bill_id'), 'patient_admission_id')->view('patients.patient_bill_column.bill_id')
                ->sortable()->searchable(),
            Column::make(__('messages.bill.bill_date'), 'bill_date')->view('patients.patient_bill_column.bill_date')
                ->sortable()->searchable(),
            Column::make(__('messages.bill.amount'), 'amount')->view('patients.patient_bill_column.amount')
                ->sortable()->searchable(),
            $data,

        ];
    }

    public function builder(): Builder
    {
        return Bill::where('patient_id', $this->patientId)->select('bills.*');
    }
}
