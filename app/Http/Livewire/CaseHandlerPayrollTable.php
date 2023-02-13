<?php

namespace App\Http\Livewire;

use App\Models\CaseHandler;
use App\Models\EmployeePayroll;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CaseHandlerPayrollTable extends LivewireTableComponent
{
    public $caseHandlerId = null;

    protected $model = EmployeePayroll::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(string $caseHandlerId): void
    {
        $this->caseHandlerId = $caseHandlerId;
        $this->setDefaultSort('employee_payrolls.created_at', 'desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('basic_salary') || $column->isField('allowance') || $column->isField('deductions') || $column->isField('net_salary')) {
                return [
                    'class' => 'text-end',
                    'style' => 'padding-right: 2rem !important',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'id')
                ->hideIf('id'),
            Column::make(__('messages.employee_payroll.payroll_id'), 'payroll_id')
                ->searchable()
                ->view('case_handlers.templates.case_handler_payroll.payroll_id')
                ->sortable(),
            Column::make(__('messages.employee_payroll.month'), 'month')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.year'), 'year')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.basic_salary'), 'basic_salary')
                ->searchable()
                ->view('case_handlers.templates.case_handler_payroll.basic_salary')
                ->sortable(),
            Column::make(__('messages.employee_payroll.allowance'), 'allowance')
                ->view('case_handlers.templates.case_handler_payroll.allowance')
                ->sortable(),
            Column::make(__('messages.employee_payroll.deductions'), 'deductions')
                ->view('case_handlers.templates.case_handler_payroll.deductions')
                ->sortable(),
            Column::make(__('messages.employee_payroll.net_salary'), 'net_salary')
                ->view('case_handlers.templates.case_handler_payroll.net_salary')
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('case_handlers.templates.case_handler_payroll.status')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        /** @var EmployeePayroll $query */
//        $query = EmployeePayroll::where('owner_id', $this->caseHandlerId)
//            ->where('owner_type', 'App\Models\CaseHandler');

        $query = EmployeePayroll::whereHasMorph(
            'owner', [
                CaseHandler::class,
            ], function ($q, $type) {
            if (in_array($type, EmployeePayroll::PYAYROLLUSERS)) {
                $q->whereHas('user', function (Builder $qr) {
                    return $qr;
                });
            }
        })->where('owner_id', $this->caseHandlerId)->with('owner.user')->select('employee_payrolls.*');

        return $query;
    }
}
