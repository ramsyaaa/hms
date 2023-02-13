<?php

namespace App\Http\Livewire;

use App\Models\Accountant;
use App\Models\CaseHandler;
use App\Models\Doctor;
use App\Models\EmployeePayroll;
use App\Models\LabTechnician;
use App\Models\Nurse;
use App\Models\Pharmacist;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PayrollTable extends DataTableComponent
{
    public $showButtonOnHeader = true;

    public $showFilterOnHeader = false;

    public $buttonComponent = 'employees.payrolls.add-button';

    public $FilterComponent = ['employees.payrolls.filter-button', EmployeePayroll::FILTER_STATUS_ARR];

    protected $model = EmployeePayroll::class;

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
            if ($column->isField('basic_salary') || $column->isField('allowance') || $column->isField('deductions') || $column->isField('net_salary')) {
                return [
                    'class' => 'text-end',
                    'style' => 'padding-right: 5rem !important',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('basic_salary') || $column->isField('allowance') || $column->isField('deductions') || $column->isField('net_salary')) {
                return [
                    'class' => 'text-end',
                    'style' => 'padding-right: 5rem !important',
                ];
            }

            return [];
        });
    }

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
    }

    public function columns(): array
    {
        if (Auth::user()->hasRole('Patient|Doctor|Case Manager|Nurse|Receptionist|Lab Technician|Accountant|Pharmacist')) {
            $action = Column::make(__('messages.common.action'), 'id')->view('employees.payrolls.action')->hideIf(1);
        } else {
            $action = Column::make(__('messages.common.action'), 'id')->view('employees.payrolls.action');
        }

        return [
            Column::make(__('messages.employee_payroll.payroll_id'),
                'payroll_id')->view('employees.payrolls.columns.payroll_id')
                ->sortable()->searchable(),
            Column::make(__('messages.employee_payroll.month'), 'month')
                ->sortable()->searchable(),
            Column::make(__('messages.employee_payroll.year'), 'year')
                ->sortable()->searchable(),
            Column::make(__('messages.employee_payroll.basic_salary'), 'basic_salary')
                ->view('employees.payrolls.columns.basic_salary')
                ->sortable()->searchable(),
            Column::make(__('messages.employee_payroll.allowance'), 'allowance')
                ->view('employees.payrolls.columns.allowance')
                ->sortable()->searchable(),
            Column::make(__('messages.employee_payroll.deductions'), 'deductions')
                ->view('employees.payrolls.columns.deduction')
                ->sortable()->searchable(),
            Column::make(__('messages.employee_payroll.net_salary'), 'net_salary')
                ->view('employees.payrolls.columns.net_salary')
                ->sortable()->searchable(),
            Column::make(__('messages.common.status'), 'status')->view('employees.payrolls.columns.status'),

            $action,
        ];
    }

    public function builder(): Builder
    {
        $query = EmployeePayroll::whereHasMorph(
            'owner', [
                Nurse::class,
                Doctor::class,
                LabTechnician::class,
                Receptionist::class,
                Pharmacist::class,
                Accountant::class,
                CaseHandler::class,
            ], function ($q, $type) {
                if (in_array($type, EmployeePayroll::PYAYROLLUSERS)) {
                    if ($type == \App\Models\Doctor::class) {
                        $q->whereHas('doctorUser', function (Builder $qr) {
                            return $qr;
                        });
                    } else {
                        $q->whereHas('user', function (Builder $qr) {
                            return $qr;
                        });
                    }
                }
            })->with('owner')->select('employee_payrolls.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('status', $this->statusFilter);
            }
            if ($this->statusFilter == 2) {
                $q->where('status', EmployeePayroll::NOT_PAID);
            }
        });

        /** @var User $user */
        $user = Auth::user();
        $route = Route::current()->getName();
        if (! ($route == 'payroll' && ! $user->hasRole(['Admin']))) {
            $query->where('owner_id', $user->owner_id);
            $query->where('owner_type', $user->owner_type);

            return $query;
        }
        $query->where('owner_id', $user->owner_id);
        $query->where('owner_type', $user->owner_type);

        return $query;
    }
}
