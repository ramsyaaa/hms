<?php

namespace App\Http\Livewire;

use App\Models\FrontService;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FrontCmsServiceTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'front_settings.front_services.add-button';

    public $showFilterOnHeader = false;

    protected $model = FrontService::class;

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
            ->setDefaultSort('front_services.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('short_description')) {
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
            Column::make(__('messages.icon'), 'id')
                ->view('front_settings.front_services.columns.icon'),
            Column::make(__('messages.common.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.description'), 'short_description')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('front_settings.front_services.action'),
        ];
    }
}
