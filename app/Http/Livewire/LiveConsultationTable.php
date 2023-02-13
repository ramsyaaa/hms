<?php

namespace App\Http\Livewire;

use App\Models\IpdPatientDepartment;
use App\Models\LiveConsultation;
use App\Models\OpdPatientDepartment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LiveConsultationTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'live_consultations.add-button';

    public $FilterComponent = ['live_consultations.filter-button', LiveConsultation::FILTER_STATUS];

    protected $model = LiveConsultation::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function resetPage($pageName = 'page')
    {
        $rowsPropertyData = $this->getRows()->toArray();
        $prevPageNum = $rowsPropertyData['current_page'] - 1;
        $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
        $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

        $this->setPage($pageNum, $pageName);
    }

    public function changeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('live_consultations.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.live_consultation.consultation_title'), 'consultation_title')
                ->view('live_consultations.columns.title')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.investigation_report.date'), 'consultation_date')
                ->view('live_consultations.columns.date')
                ->sortable(),
            Column::make(__('messages.live_consultation.created_by'), 'user.first_name')
                ->view('live_consultations.columns.created_by')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.live_consultation.created_for'), 'doctor.doctorUser.first_name')
                ->view('live_consultations.columns.created_for')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.investigation_report.patient'), 'patient.patientUser.first_name')
                ->view('live_consultations.columns.patient')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('live_consultations.columns.status')
                ->sortable(),
            Column::make(__('messages.user.password'), 'password')
                ->view('live_consultations.columns.password')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('live_consultations.action'),
        ];
    }

    public function builder(): Builder
    {
        static $ipdIds, $opdIds;
        /** @var LiveConsultation $query */
        $query = LiveConsultation::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->whereHas('user')->with([
            'patient.patientUser', 'doctor.doctorUser', 'user',
        ]);
        
        if (empty($opdIds)) {
            $opdIds = OpdPatientDepartment::pluck('id')->toArray();
        }
        if (empty($ipdIds)) {
            $ipdIds = IpdPatientDepartment::pluck('id')->toArray();
        }


        $query->where(function (Builder $q) use ($ipdIds, $opdIds) {
            $q->whereIn('type_number', $ipdIds)->where('type', 1)
                ->orWhereIn('type_number', $opdIds)->where('type', 0);
        });

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('live_consultations.status', LiveConsultation::STATUS_AWAITED);
            }
            if ($this->statusFilter == 2) {
                $q->where('live_consultations.status', LiveConsultation::STATUS_CANCELLED);
            }
            if ($this->statusFilter == 3) {
                $q->where('live_consultations.status', LiveConsultation::STATUS_FINISHED);
            }
        });

        if (getLoggedInUser()->hasRole('Patient')) {
            $query->where('patient_id', getLoggedInUser()->owner_id)->select('live_consultations.*');
        }
        if (getLoggedInUser()->hasRole('Doctor')) {
            $query->where('doctor_id', getLoggedInUser()->owner_id)->select('live_consultations.*');
        }
        $query->select('live_consultations.*');

        return $query;
    }
}
