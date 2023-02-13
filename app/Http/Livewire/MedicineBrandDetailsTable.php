<?php

namespace App\Http\Livewire;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MedicineBrandDetailsTable extends LivewireTableComponent
{
    protected $model = Medicine::class;

    public $brandDetails;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(string $brandDetails): void
    {
        $this->brandDetails = $brandDetails;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('selling_price')) {
                return [
                    'class' => 'text-end',
                    'style' => 'padding-right: 4rem !important',
                ];
            }
            if ($column->isField('buying_price')) {
                return [
                    'class' => 'd-flex justify-content-end',
                    'style' => 'padding-right: 4rem !important',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.medicine.category'), 'category.name')
                ->view('brands.templates.columnsDetails.category')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.medicine'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.brand'), 'category_id')
                ->hideIf('category_id'),

            Column::make(__('messages.medicine.selling_price'), 'selling_price')
                ->view('brands.templates.columnsDetails.selling')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.buying_price'), 'buying_price')
                ->view('brands.templates.columnsDetails.buying')
                ->searchable()
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var Medicine $query */
        $query = Medicine::with('category', 'brand')->where('brand_id', $this->brandDetails);

        return $query;
    }
}
