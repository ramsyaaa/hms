<?php

namespace App\Http\Livewire;

use App\Models\EmployeePayroll;
use App\Models\Receptionist;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ReceptionistPayrollTable extends LivewireTableComponent
{
    public $receptionistId = null;

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

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('employee_payrolls.created_at', 'desc')
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

    public function mount(string $receptionistId): void
    {
        $this->receptionistId = $receptionistId;
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'id')
                ->hideIf('id'),
            Column::make(__('messages.employee_payroll.payroll_id'), 'payroll_id')
                ->searchable()
                ->view('receptionists.templates.receptionistsPayroll.payroll_id')
                ->sortable(),
            Column::make(__('messages.employee_payroll.month'), 'month')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.year'), 'year')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.basic_salary'), 'basic_salary')
                ->searchable()
                ->view('receptionists.templates.receptionistsPayroll.basic_salary')
                ->sortable(),
            Column::make(__('messages.employee_payroll.allowance'), 'allowance')
                ->view('receptionists.templates.receptionistsPayroll.allowance')
                ->sortable(),
            Column::make(__('messages.employee_payroll.deductions'), 'deductions')
                ->view('receptionists.templates.receptionistsPayroll.deductions')
                ->sortable(),
            Column::make(__('messages.employee_payroll.net_salary'), 'net_salary')
                ->view('receptionists.templates.receptionistsPayroll.net_salary')
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('receptionists.templates.receptionistsPayroll.status')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var EmployeePayroll $query */
//        $query = EmployeePayroll::where('owner_id', $this->receptionistId)
//            ->where('owner_type', 'App\Models\Receptionist');
        $query = EmployeePayroll::whereHasMorph(
            'owner', [
                Receptionist::class,
            ], function ($q, $type) {
            if (in_array($type, EmployeePayroll::PYAYROLLUSERS)) {
                $q->whereHas('user', function (Builder $qr) {
                    return $qr;
                });
            }
        })->where('owner_id', $this->receptionistId)->with('owner.user')->select('employee_payrolls.*');

        return $query;
    }
}
