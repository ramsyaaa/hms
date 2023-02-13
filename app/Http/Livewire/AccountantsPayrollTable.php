<?php

namespace App\Http\Livewire;

use App\Models\Accountant;
use App\Models\EmployeePayroll;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AccountantsPayrollTable extends LivewireTableComponent
{
    protected $model = EmployeePayroll::class;

    public $accountantId;

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
            ->setDefaultSort('employee_payrolls.created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('payroll_id') || $column->isField('month') || $column->isField('year') || $column->isField('basic_salary') || $column->isField('allowance') || $column->isField('deductions') || $column->isField('net_salary') || $column->isField('status')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('basic_salary') || $column->isField('allowance') || $column->isField('deductions') || $column->isField('net_salary')) {
                return [
                    'class' => 'text-end',
                ];
            }

            return [];
        });
    }

    public function mount(string $accountantId): void
    {
        $this->accountantId = $accountantId;
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'id')
                ->hideIf('id')
                ->sortable(),
            Column::make(__('messages.employee_payroll.payroll_id'), 'payroll_id')
                ->view('accountants.payrollColumns.payroll_id')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.month'), 'month')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.year'), 'year')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.basic_salary'), 'basic_salary')
                ->view('accountants.payrollColumns.basic_salary')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.allowance'), 'allowance')
                ->view('accountants.payrollColumns.allowance')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.deductions'), 'deductions')
                ->view('accountants.payrollColumns.deductions')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.net_salary'), 'net_salary')
                ->view('accountants.payrollColumns.net_salary')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('accountants.payrollColumns.status')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var EmployeePayroll $query */
//        $query = EmployeePayroll::where('type', '=', 6)
//            ->where('owner_id', $this->accountantId);
        $query = EmployeePayroll::whereHasMorph(
            'owner', [
                Accountant::class,
            ], function ($q, $type) {
            if (in_array($type, EmployeePayroll::PYAYROLLUSERS)) {
                $q->whereHas('user', function (Builder $qr) {
                    return $qr;
                });
            }
        })->where('owner_id', $this->accountantId)->with('owner.user')->select('employee_payrolls.*');

        return $query;
    }
}
