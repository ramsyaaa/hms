<?php

namespace App\Http\Livewire;

use App\Models\BedType;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BedTypeTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'bed_types.add-button';

    protected $model = BedType::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('bed_types.created_at', 'desc');
        $this->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-100',
            ];
        });

//        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
//            if ($columnIndex == '5') {
//                return [
//                    'class' => 'justify-content-center',
//                ];
//            }
//
//            return [];
//        });
    }

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.bed.bed_type'), 'title')
                ->view('bed_types.show_route')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('bed_types.action'),
        ];
    }
}
