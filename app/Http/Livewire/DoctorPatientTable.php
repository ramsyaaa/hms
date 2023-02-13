<?php

namespace App\Http\Livewire;

use App\Models\PatientCase;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DoctorPatientTable extends LivewireTableComponent
{
    protected $model = PatientCase::class;

    public $docId;

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
            ->setDefaultSort('patient_cases.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('phone') || $column->isField('blood_group') || $column->isField('status')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
    }

    public function mount(string $docId): void
    {
        $this->docId = $docId;
    }

    public function columns(): array
    {
        return [

            Column::make(__('messages.case.patient'), 'patient.patientUser.first_name')
                ->view('doctors.templates.doctorPatientColumns.patient_name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.phone'), 'phone')
                ->view('doctors.templates.doctorPatientColumns.phone')
                ->sortable(),
            Column::make(__('messages.user.blood_group'), 'patient.patientUser.blood_group')
                ->view('doctors.templates.doctorPatientColumns.blood_group')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('doctors.templates.doctorPatientColumns.status')
                ->sortable(),
            Column::make('Phone', 'patient_id')
                ->hideIf('patient_id')
                ->hideIf('id')
                ->sortable(),

        ];
    }

    public function builder(): Builder
    {
        /** @var PatientCase $query */
        $query = PatientCase::where('doctor_id', $this->docId)->with('patient');

        return $query;
    }
}
