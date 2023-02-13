<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\VaccinatedPatients;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VaccinatedPatientsTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    protected $model = VaccinatedPatients::class;

    public $buttonComponent = 'vaccinated_patients.add-button';

    public $showFilterOnHeader = false;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

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
            ->setDefaultSort('vaccinated_patients.created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('vaccination_serial_number') || $column->isField('dose_number')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        if (! getLoggedinPatient()) {
            $this->showButtonOnHeader = true;
            $actionButton = Column::make(__('messages.patient_diagnosis_test.action'),
                'id')->view('vaccinated_patients.action');
        } else {
            $this->showButtonOnHeader = false;
            $actionButton = Column::make(__('messages.patient_diagnosis_test.action'),
                'id')->view('patient_diagnosis_test.vaccinated_patients.action')->hideIf(1);
        }

        return [
            Column::make(__('messages.vaccinated_patient.patient'),
                'patient.patientUser.first_name')->view('vaccinated_patients.column.patient')
                ->sortable()->searchable(),
            Column::make('', 'patient_id')->hideIf(1),
            Column::make(__('messages.vaccinated_patient.vaccination'),
                'vaccination.name')->view('vaccinated_patients.column.vaccination')
                ->sortable()->searchable(),
            Column::make(__('messages.vaccinated_patient.serial_no'),
                'vaccination_serial_number')->view('vaccinated_patients.column.serial_no')->sortable()->searchable(),
            Column::make('', 'vaccination_serial_number')->hideIf(1),
            Column::make(__('messages.vaccinated_patient.does_no'), 'dose_number')
                ->view('vaccinated_patients.column.dose')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.vaccinated_patient.dose_given_date'),
                'dose_given_date')->view('vaccinated_patients.column.dose_given_date')->sortable(),
            $actionButton,
        ];
    }

    public function builder(): Builder
    {
        $query = VaccinatedPatients::whereHas('patient.patientUser')->with(['patient.patientUser.media', 'vaccination']);

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }

        return $query->select('vaccinated_patients.*');
    }
}
