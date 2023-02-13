<?php

namespace App\Http\Livewire;

use App\Models\BloodDonation;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BloodDonationTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $showFilterOnHeader = false;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'blood_donations.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    protected $model = BloodDonation::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('blood_donations.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '2') {
                return [
                    'width' => '8%',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.blood_donation.donor_name'), 'blooddonor.name')
                ->view('blood_donations.columns.donor_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.blood_donation.bags'), 'bags')
                ->view('blood_donations.columns.bags')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('blood_donations.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = BloodDonation::with(['blooddonor'])->select('blood_donations.*');

        return $query;
    }
}
