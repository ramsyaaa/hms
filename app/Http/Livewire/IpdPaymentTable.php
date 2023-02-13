<?php

namespace App\Http\Livewire;

use App\Models\IpdPayment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IpdPaymentTable extends LivewireTableComponent
{
    public $ipdPatientDepartmentId;

    protected $model = IpdPayment::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

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
            ->setDefaultSort('ipd_payments.created_at', 'desc')
            ->setQueryStringStatus(false);

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

    public function mount(int $ipdPatientDepartmentId)
    {
        $this->ipdPatientDepartmentId = $ipdPatientDepartmentId;
    }

    public function columns(): array
    {
        if (! getLoggedinPatient()) {
            $actionButton = Column::make(__('messages.common.action'), 'id')->view('ipd_payments.columns.action');
        } else {
            $actionButton = Column::make(__('messages.common.action'), 'id')->view('ipd_payments.columns.action')->hideIf(1);
        }

        return [
            Column::make(__('messages.ipd_patient_charges.date'), 'date')
                ->view('ipd_payments.columns.date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ambulance_call.amount'), 'amount')
                ->view('ipd_payments.columns.amount')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_payments.payment_mode'), 'payment_mode')
                ->view('ipd_payments.columns.payment_mode')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.ipd_patient_diagnosis.document'), 'id')
                ->view('ipd_payments.columns.document')
                ->sortable(),
            Column::make(__('messages.ambulance.note'), 'notes')
                ->view('ipd_payments.columns.note')
                ->sortable()
                ->searchable(),
            $actionButton,
        ];
    }

    public function builder(): Builder
    {
        return IpdPayment::whereIpdPatientDepartmentId($this->ipdPatientDepartmentId)->select('ipd_payments.*');
    }
}
