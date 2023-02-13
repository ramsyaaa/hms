<?php

namespace App\Http\Livewire;

use App\Models\Sms;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SmsTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $buttonComponent = 'sms.add-button';

    protected $model = Sms::class;

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
        $this->setPrimaryKey('id')
            ->setDefaultSort('sms.created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.sms.send_to'), 'user.first_name')->view('sms.templates.column.send_to')
                ->sortable()->searchable(),
            Column::make(__('messages.user.phone'), 'phone_number')->view('sms.templates.column.phone_no')
                ->sortable()->searchable(),
            Column::make(__('messages.user.region_code'), 'region_code')->hideIf(1),
            Column::make(__('messages.sms.send_by'), 'sendBy.first_name')->view('sms.templates.column.send_by')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('sms.templates.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var Builder $query */
        $query = Sms::whereHas('sendBy')->with('user', 'sendBy')->select('sms*');

        /** @var User $user */
        $user = Auth::user();
        if (! $user->hasRole('Admin')) {
            $query->where('send_to', $user->id)->orwhere('send_by', $user->id);
        }

        return $query->select('sms.*');
    }
}
