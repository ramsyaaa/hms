<?php

namespace App\Http\Livewire;

use App\Models\BloodDonor;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BloodDonorTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = false;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'blood_donors.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    protected $model = BloodDonor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('blood_donors.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '5') {
                return [
                    'width' => '8%',
                ];
            }

            if ($column->isField('age') || $column->isField('name') || $column->isField('gender') || $column->isField('blood_group')) {
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
            Column::make(__('messages.blood_donor.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.blood_donor.age'), 'age')
                ->view('blood_donors.columns.age')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.blood_donor.gender'), 'gender')
                ->view('blood_donors.columns.gender')
                ->sortable(),
            Column::make(__('messages.blood_donor.blood_group'), 'blood_group')
                ->view('blood_donors.columns.blood_group')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.blood_donor.last_donation_date'), 'last_donate_date')
                ->view('blood_donors.columns.last_donate')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('blood_donors.action'),
        ];
    }
}
