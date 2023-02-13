<?php

namespace App\Http\Livewire;

use App\Models\Doctor;
use App\Models\EmployeePayroll;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorPayrollTable extends LivewireTableComponent
{
    protected $model = EmployeePayroll::class;

    public $docId;

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

    public function mount(string $docId): void
    {
        $this->docId = $docId;
    }

    public function columns(): array
    {
        return [

            Column::make(__('messages.employee_payroll.payroll_id'), 'id')
                ->hideIf('id'),
            Column::make(__('messages.employee_payroll.payroll_id'), 'payroll_id')
                ->view('doctors.templates.doctorPayroll.payroll_id')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.month'), 'month')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.year'), 'year')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.basic_salary'), 'basic_salary')
                ->searchable()
                ->view('doctors.templates.doctorPayroll.basic_salary')
                ->sortable(),
            Column::make(__('messages.employee_payroll.allowance'), 'allowance')
                ->view('doctors.templates.doctorPayroll.allowance')
                ->sortable(),
            Column::make(__('messages.employee_payroll.deductions'), 'deductions')
                ->view('doctors.templates.doctorPayroll.deductions')
                ->sortable(),
            Column::make(__('messages.employee_payroll.net_salary'), 'net_salary')
                ->view('doctors.templates.doctorPayroll.net_salary')
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('doctors.templates.doctorPayroll.status')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        /** @var EmployeePayroll $query */
//        $query = EmployeePayroll::where('type','=',2)
//                                ->where('owner_id',$this->docId);

        $query = EmployeePayroll::whereHasMorph(
            'owner', [
                Doctor::class,
            ], function ($q, $type) {
            if (in_array($type, EmployeePayroll::PYAYROLLUSERS)) {
                $q->whereHas('doctorUser', function (Builder $qr) {
                    return $qr;
                });
            }
        })->where('owner_id', $this->docId)->with('owner.doctorUser')->select('employee_payrolls.*');

        return $query;
    }
}
