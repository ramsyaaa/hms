<?php

namespace App\Http\Livewire;

use App\Models\RadiologyTest;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RadiologyTestTable extends LivewireTableComponent
{
    protected $model = RadiologyTest::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = false;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'radiology_tests.add-button';

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
            ->setDefaultSort('radiology_tests.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('test_name') || $column->isField('short_name') || $column->isField('test_type') || $column->isField('category_id') || $column->isField('charge_category_id')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.radiology_test.test_name'), 'test_name')
                ->view('radiology_tests.templates.columns.test_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.radiology_test.short_name'), 'short_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.radiology_test.test_type'), 'test_type')
                ->sortable(),
            Column::make(__('messages.radiology_test.category_name'), 'radiologycategory.name')
                ->sortable()
                ->view('radiology_tests.templates.columns.Category'),
            Column::make(__('messages.radiology_test.charge_category'), 'chargecategory.name')
                ->view('radiology_tests.templates.columns.Charge_category')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('radiology_tests.action'),

        ];
    }

    public function builder(): Builder
    {
        return RadiologyTest::with('chargecategory', 'radiologycategory')->select('radiology_tests.*');
    }
}
