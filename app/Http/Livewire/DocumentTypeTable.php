<?php

namespace App\Http\Livewire;

use App\Models\DocumentType;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DocumentTypeTable extends LivewireTableComponent
{
    protected $model = DocumentType::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'document_types.add-button';

    public $showFilterOnHeader = false;

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
        $this->setPrimaryKey('id');
        $this->setDefaultSort('document_types.created_at', 'desc');
        $this->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-100',
            ];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.document.document_type'), 'name')
                ->view('document_types.show_route')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('document_types.action'),
        ];
    }
}
