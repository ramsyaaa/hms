<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PaymentTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $showFilterOnHeader = false;

    public $buttonComponent = 'payments.add-button';

    protected $model = Payment::class;

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
            ->setQueryStringStatus(false)
            ->setDefaultSort('payments.created_at', 'desc');

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '3') {
                return [
                    'width' => '20%',
                ];
            }
            if ($columnIndex == '4') {
                return [
                    'width' => '14%',
                ];
            }
            if ($columnIndex == '5') {
                return [
                    'width' => '12%',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('amount')) {
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
            Column::make(__('messages.account.account'), 'account.name')->view('payments.columns.accounts')
                ->sortable()->searchable(),
            Column::make(__('messages.account.account'), 'account_id')->hideIf(1),
            Column::make(__('messages.payment.payment_date'), 'payment_date')->view('payments.columns.payment_date')
                ->sortable()->searchable(),
            Column::make(__('messages.payment.pay_to'), 'pay_to')->view('payments.columns.pay_to')
                ->sortable()->searchable(),
            Column::make(__('messages.payment.amount'), 'amount')->view('payments.columns.amount')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('payments.action'),
        ];
    }

    public function builder(): Builder
    {
        return Payment::with('accounts', 'account')->select('payments.*');
    }
}
