<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends LivewireTableComponent
{
    protected $model = User::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'users.add-button';

    public $showFilterOnHeader = true;

    public $FilterComponent = ['users.filter-button', User::FILTER_STATUS_ARR, Department::ROLE];

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'changeRoleFilter', 'resetPage'];

    public $roleFilter = 0;

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    /**
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    /**
     * @param $param
     * @param $value
     */
    public function changeRoleFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->roleFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('users.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.users'), 'first_name')->view('users.templates.columns.user')
                ->sortable()->searchable(),
            Column::make(__('messages.employee_payroll.role'), 'department.name')->view('users.templates.columns.role')
                ->sortable()->searchable(),
            Column::make(__('messages.user.email'), 'department_id')->view('users.templates.columns.email_verified'),
            Column::make(__('messages.common.status'), 'first_name')->view('users.templates.columns.status'),
            Column::make(__('messages.common.action'), 'id')->view('users.templates.action-button'),
        ];
    }

    public function builder(): Builder
    {
        $query = User::with(['department', 'media'])->select('users.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('users.status', 1);
            }
            if ($this->statusFilter == 2) {
                $q->where('users.status', 0);
            }
        });

        $query->when(isset($this->roleFilter), function (Builder $q) {
            $q->whereHas('department', function (Builder $query) {
                if ($this->roleFilter == 0) {
                } else {
                    $query->where('id', $this->roleFilter);
                }
            });
        });

        return $query;
    }
}
