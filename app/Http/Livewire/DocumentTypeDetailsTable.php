<?php

namespace App\Http\Livewire;

use App\Models\Document;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DocumentTypeDetailsTable extends LivewireTableComponent
{
    protected $model = Document::class;

    public $documentType;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(string $documentType): void
    {
        $this->documentType = $documentType;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.document.attachment'), 'id')
                ->view('document_types.detailsColumns.document'),
            Column::make(__('messages.document.title'), 'title')
                ->sortable(),
            Column::make(__('messages.document.patient'), 'patient.patientUser.first_name')
                ->view('document_types.detailsColumns.patient_name')
                ->sortable(),
            Column::make(__('messages.document.uploaded_by'), 'user.first_name')
                ->view('document_types.detailsColumns.uploaded_by')
                ->searchable()
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        $query = Document::whereHas('patient.patientUser')->with('documentType', 'patient', 'user')->where('document_type_id',
            $this->documentType)->select('documents.*');

        return $query;
    }
}
