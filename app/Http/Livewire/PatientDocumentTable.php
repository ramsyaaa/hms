<?php

namespace App\Http\Livewire;

use App\Models\Document;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientDocumentTable extends LivewireTableComponent
{
    protected $model = Document::class;

    public $patientId;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function mount(int $patientId)
    {
        $this->patientId = $patientId;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('documents.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '3') {
                return [
                    'width' => '8%',
                ];
            }
            if ($columnIndex == '2') {
                return [
                    'width' => '45%',
                ];
            }
            if ($column->isField('name') || $column->isField('title')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        if (! Auth::user()->hasRole('Patient|Doctor|Accountant|Case Manager|Nurse|Receptionist')) {
            $data = Column::make(__('messages.common.action'), 'id')->view('patients.patient_document_columns.action');
        } else {
            $data = Column::make(__('messages.common.action'), 'id')->hideIf(1);
        }

        return [
            Column::make(__('messages.document.document_type'), 'documentType.name')
                ->sortable()->searchable(),
            Column::make('', 'document_type_id')->hideIf(1),
            Column::make(__('messages.document.title'), 'title')
                ->sortable()->searchable(),
            $data,
        ];
    }

    public function builder(): Builder
    {
        $query = Document::whereHas('patient.patientUser')->with(['documentType', 'patient.patientUser', 'media'])
            ->where('patient_id', $this->patientId);

        return $query;
    }
}
