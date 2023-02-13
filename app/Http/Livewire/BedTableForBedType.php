<?php

namespace App\Http\Livewire;

use App\Models\Bed;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BedTableForBedType extends LivewireTableComponent
{
    public $bedTypeId;

    use WithPagination;

    public $showButtonOnHeader = false;

    public $showFilterOnHeader = false;

    public $paginationIsEnabled = true;

    protected $model = Bed::class;

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
        $this->setQueryStringStatus(false);
        $this->setDefaultSort('beds.created_at', 'desc');
        $this->setPrimaryKey('id');
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => '',
            ];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '4') {
                return [
                    'width' => '8%',
                ];
            }
            if ($column->isField('name') || $column->isField('description')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('charge')) {
                return [
                    'class' => 'd-flex justify-content-center',
                    'style' => 'padding-right: 5rem !important',
                ];
            }

            return [];
        });
    }

    public function mount(int $bedTypeId)
    {
        $this->bedTypeId = $bedTypeId;
    }

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.bed.bed_id'), 'bed_id')->hideIf(1)
                ->searchable(),
            Column::make(__('messages.bed_assign.bed'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.bed.description'), 'description')
                ->view('beds.component.description')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.bed.charge'), 'charge')
                ->view('bed_types.detail_columns.charge')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.bed.available'), 'is_available')
                ->view('beds.component.is_available')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        $query = Bed::with('bedType')->select('beds.*')->where('bed_type', $this->bedTypeId);

        return $query;
    }
}
