<?php

namespace App\Http\Livewire;

use App\Models\DiagnosisCategory;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DiagnosisCategoryTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $buttonComponent = 'diagnosis_categories.add-button';

    protected $model = DiagnosisCategory::class;

    public $showFilterOnHeader = false;

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
            ->setDefaultSort('diagnosis_categories.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-100',
            ];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.diagnosis_category.diagnosis_category'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('diagnosis_categories.action'),

        ];
    }
}
