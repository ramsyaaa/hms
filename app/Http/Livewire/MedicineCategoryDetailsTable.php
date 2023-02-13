<?php

namespace App\Http\Livewire;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MedicineCategoryDetailsTable extends LivewireTableComponent
{
    protected $model = Medicine::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public $categoryDetails;

    public function mount(string $categoryDetails): void
    {
        $this->categoryDetails = $categoryDetails;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
//            ->setDefaultSort('created_at', 'desc')
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
            Column::make(__('messages.medicine.medicine'), 'name')
                ->sortable(),

            Column::make(__('messages.medicine.brand'), 'brand_id')
                ->hideIf('brand_id'),
            Column::make(__('messages.medicine.brand'), 'brand.name')
                ->view('categories.templates.columnsDetails.brand')
                ->searchable()
                ->sortable(),

            Column::make(__('messages.medicine.description'), 'description')
                ->searchable()
                ->sortable()
                ->view('categories.templates.columnsDetails.description'),
            Column::make(__('messages.medicine.selling_price'), 'selling_price')
                ->searchable()
                ->view('categories.templates.columnsDetails.selling_price')
                ->sortable(),
            Column::make(__('messages.medicine.buying_price'), 'buying_price')
                ->searchable()
                ->view('categories.templates.columnsDetails.buying_price')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var Medicine $query */
        $query = Medicine::with('category', 'brand')->where('category_id', $this->categoryDetails);

        return $query;
    }
}
