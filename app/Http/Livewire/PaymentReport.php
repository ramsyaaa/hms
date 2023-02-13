<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PaymentReport extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'payment_reports.add-button';

    public $FilterComponent = ['payment_reports.filter-button', Account::ACCOUNT_TYPES];

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

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('payments.created_at', 'desc')
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

    public function columns(): array
    {
        return [
            Column::make(__('messages.payment.payment_date'), 'payment_date')->view('payment_reports.columns.payment_date')
                ->sortable()->searchable(),
            Column::make(__('messages.payment.account'), 'account.name')->view('payment_reports.columns.account')
                ->sortable()->searchable(),
            Column::make(__('messages.account.account'), 'account_id')->hideIf(1),
            Column::make(__('messages.payment.pay_to'), 'pay_to')->view('payment_reports.columns.pay_to')
                ->sortable()->searchable(),
            Column::make(__('messages.account.type'), 'account.type')->view('payment_reports.columns.type')
                ->sortable(),
            Column::make(__('messages.payment.amount'), 'amount')->view('payment_reports.columns.amount')
                ->sortable()->searchable(),
        ];
    }

    public function builder(): Builder
    {
        $query = Payment::with('accounts')->select('payments.*', 'accounts.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            $q->whereHas('accounts', function (Builder $query) {
                if ($this->statusFilter == 1) {
                    $query->where('type', Account::DEBIT);
                }
                if ($this->statusFilter == 2) {
                    $query->where('type', Account::CREDIT);
                }
                if ($this->statusFilter == 0) {
                }
            });
        });

        return $query;
    }
}
