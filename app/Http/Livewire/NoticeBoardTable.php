<?php

namespace App\Http\Livewire;

use App\Models\NoticeBoard;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class NoticeBoardTable extends LivewireTableComponent
{
    public $buttonComponent = 'notice_boards.add-button';

    public $showFilterOnHeader = false;

    public $showButtonOnHeader = true;

    protected $model = NoticeBoard::class;

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
            ->setDefaultSort('notice_boards.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '2') {
                return [
                    'width' => '12%',
                ];
            }
            if ($columnIndex == '1') {
                return [
                    'width' => '35%',
                ];
            }
            if ($column->isField('title')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        if (Auth::user()->hasRole('Admin')) {
            $this->showButtonOnHeader = true;
        } else {
            $this->showButtonOnHeader = false;
        }

        return [
            Column::make(__('messages.notice_board.title'), 'title')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.created_at'), 'created_at')
                ->view('notice_boards.columns.created_on')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('notice_boards.action'),
        ];
    }
}
