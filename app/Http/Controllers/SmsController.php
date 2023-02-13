<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSmsRequest;
use App\Models\Sms;
use App\Repositories\SmsRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SmsController extends AppBaseController
{
    /**
     * @var SmsRepository
     */
    private $smsRepository;

    public function __construct(SmsRepository $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $roles = Sms::ROLE_TYPES;

        return view('sms.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSmsRequest  $request
     * @return JsonResponse
     *
     * @throws \Twilio\Exceptions\ConfigurationException
     */
    public function store(CreateSmsRequest $request)
    {
        $input = $request->all();
        $this->smsRepository->store($input);

        return $this->sendSuccess(__('messages.sms.sms').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Sms  $sms
     * @return Application|Factory|View
     */
    public function show(Sms $sms)
    {
        if (getLoggedInUser()->hasRole('Admin')) {
            $sms = Sms::with('user.roles')->find($sms->id);

            return view('sms.show', compact('sms'));
        } else {
            if ($sms->send_by == getLoggedInUser()->id) {
                $sms = Sms::with('user.roles')->find($sms->id);

                return view('sms.show', compact('sms'));
            } else {
                return view('errors.404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Sms  $sms
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Sms $sms): JsonResponse
    {
        if (getLoggedInUser()->hasRole('Admin')) {
            $this->smsRepository->delete($sms->id);

            return $this->sendSuccess(__('messages.sms.sms').' '.__('messages.common.deleted_successfully'));
        } else {
            if ($sms->send_by == getLoggedInUser()->id) {
                $this->smsRepository->delete($sms->id);

                return $this->sendSuccess(__('messages.sms.sms').' '.__('messages.common.deleted_successfully'));
            } else {
                return $this->sendError(__('messages.sms.sms').' '.__('messages.common.not_found'));
            }
        }
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getUsersList(Request $request)
    {
        if (empty($request->get('id'))) {
            return $this->sendError('User List not found');
        }

        $usersData = Sms::CLASS_TYPES[$request->id]::with('user')
        ->whereHas('user', function (Builder $query) {
            $query->whereNotNull('phone');
        })
        ->get()->where('user.status', '=', 1)
        ->pluck('user.full_name', 'user.id');

        return $this->sendResponse($usersData, 'Retrieved successfully');
    }

    /**
     * @param  Sms  $sms
     * @return JsonResponse
     */
    public function showModal(Sms $sms): JsonResponse
    {
        if (getLoggedInUser()->hasRole('Admin')) {
            $sms = Sms::with(['user.roles', 'sendBy'])->find($sms->id);

            return $this->sendResponse($sms, 'SMS Retrieved Successfully.');
        } else {
            if ($sms->send_by == getLoggedInUser()->id) {
                $sms = Sms::with(['user.roles', 'sendBy'])->find($sms->id);

                return $this->sendResponse($sms, 'SMS Retrieved Successfully.');
            } else {
                return $this->sendError(__('messages.sms.sms').' '.__('messages.common.not_found'));
            }
        }
    }
}
