<?php

namespace App\Http\Livewire;

use App\Models\CurrencySetting;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CurrencyTable extends LivewireTableComponent
{
    protected $model = CurrencySetting::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'currency_settings.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('currency_settings.created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'd-flex justify-content-center',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.currency.currency_name'), 'currency_name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.currency.currency_icon'), 'currency_icon')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.currency.currency_code'), 'currency_code')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('currency_settings.action'),
        ];
    }
}
