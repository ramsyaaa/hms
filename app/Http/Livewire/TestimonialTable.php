<?php

namespace App\Http\Livewire;

use App\Models\Testimonial;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TestimonialTable extends LivewireTableComponent
{
    use WithPagination;

    public $showFilterOnHeader = false;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'testimonials.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    protected $model = Testimonial::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('testimonials.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '2') {
                return [
                    'width' => '70%',
                ];
            }
            if ($columnIndex == '3') {
                return [
                    'width' => '12%',
                ];
            }
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
            Column::make(__('messages.common.profile'), 'id')->view('testimonials.columns.profile'),
            Column::make(__('messages.testimonial.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.testimonial.description'),
                'description')->view('testimonials.columns.description')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('testimonials.action'),
        ];
    }
}
