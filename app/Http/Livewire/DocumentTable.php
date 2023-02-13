<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DocumentTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $showFilterOnHeader = false;

    public $buttonComponent = 'documents.templates.add-button';

    protected $model = Document::class;

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

        $this->setDefaultSort('documents.created_at', 'desc');
        $this->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-50',
            ];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('id') || $column->isField('name')) {
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
            Column::make(__('messages.file_name'), 'id')
                ->view('documents.templates.columns.file_name'),
            Column::make(__('messages.document.document_type'), 'documentType.name')
                ->view('documents.templates.columns.document_type')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.document.patient'), 'patient.patientUser.first_name')
                ->view('documents.templates.columns.patient')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), 'created_at')
                ->view('documents.templates.action-button'),
        ];
    }

    public function builder(): Builder
    {
//        return  Document::whereHas('patient.user')->with(['documentType', 'patient.user', 'media'])->select('documents.*');
        if (! getLoggedinPatient()) {
            $query = Document::whereHas('patient.patientUser')->with('documentType', 'patient.patientUser',
                'media')->select('documents.*');
        } else {
            $patientId = Patient::where('user_id', getLoggedInUserId())->first();
            $query = Document::whereHas('patient.patientUser')->with('documentType', 'patient.patientUser',
                'media')->select('documents.*')->where('patient_id', $patientId->id);
        }

        return $query;
    }
}
