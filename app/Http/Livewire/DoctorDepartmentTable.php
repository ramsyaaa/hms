<?php

namespace App\Http\Livewire;

use App\Models\DoctorDepartment;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorDepartmentTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $buttonComponent = 'doctor_departments.add-button';

    protected $model = DoctorDepartment::class;

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
            ->setDefaultSort('doctor_departments.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-100',
            ];
        });
    }

    public function columns(): array
    {
        return [

            Column::make(__('messages.appointment.doctor_department'), 'title')
                ->view('doctor_departments.templates.columns.title')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('doctor_departments.action'),

        ];
    }
}
