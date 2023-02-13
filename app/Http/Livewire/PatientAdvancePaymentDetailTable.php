<?php

namespace App\Http\Livewire;

use App\Models\AdvancedPayment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientAdvancePaymentDetailTable extends LivewireTableComponent
{
    protected $model = AdvancedPayment::class;

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
            ->setDefaultSort('advanced_payments.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '3') {
                return [
                    'width' => '8%',
                ];
            }
            if ($column->isField('receipt_no') || $column->isField('date') || $column->isField('amount')) {
                return [
                    'class' => 'pt-5',
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

    public function columns(): array
    {
        if (! Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist')) {
            $data = Column::make(__('messages.common.action'), 'id')->view('patients.patient_advance_payment_detail_column.action');
        } else {
            $data = Column::make(__('messages.common.action'), 'id')->hideIf(1);
        }

        return [
            Column::make(__('messages.advanced_payment.receipt_no'), 'receipt_no')
                ->sortable()->searchable()->view('patients.patient_advance_payment_detail_column.receipt_id'),
            Column::make(__('messages.advanced_payment.date'), 'date')
                ->sortable()->searchable()->view('patients.patient_advance_payment_detail_column.date'),
            Column::make(__('messages.advanced_payment.amount'), 'amount')
                ->sortable()->searchable()->view('patients.patient_advance_payment_detail_column.amount'),
            $data,
        ];
    }

    public function builder(): Builder
    {
        $query = AdvancedPayment::select('advanced_payments.*')->where('patient_id', $this->patientId);

        return $query;
    }
}
