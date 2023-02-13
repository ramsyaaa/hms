<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\LiveMeetingRequest;
use App\Models\LiveMeeting;
use App\Repositories\LiveMeetingRepository;
use App\Repositories\ZoomRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LiveMeetingController extends AppBaseController
{
    /** @var LiveMeetingRepository */
    private $liveMeetingRepository;

    /**
     * LiveMeetingController constructor.
     *
     * @param  LiveMeetingRepository  $liveMeetingRepository
     */
    public function __construct(LiveMeetingRepository $liveMeetingRepository)
    {
        $this->liveMeetingRepository = $liveMeetingRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $users = $this->liveMeetingRepository->getUsers();
        $status = LiveMeeting::status;

        return view('live_consultations.member_index', compact('users', 'status'));
    }

    /**
     * @param  LiveMeetingRequest  $request
     * @return JsonResponse
     */
    public function liveMeetingStore(LiveMeetingRequest $request)
    {
        try {
            $this->liveMeetingRepository->store($request->all());
            $this->liveMeetingRepository->createNotification($request->all());

            return $this->sendSuccess(__('messages.live_meetings').' '.__('messages.common.saved_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getChangeStatus(Request $request)
    {
        $liveMeeting = LiveMeeting::findOrFail($request->get('id'));
        $status = null;

        if ($request->get('statusId') == LiveMeeting::STATUS_AWAITED) {
            $status = LiveMeeting::STATUS_AWAITED;
        } elseif ($request->get('statusId') == LiveMeeting::STATUS_CANCELLED) {
            $status = LiveMeeting::STATUS_CANCELLED;
        } else {
            $status = LiveMeeting::STATUS_FINISHED;
        }

        $liveMeeting->update([
            'status' => $status,
        ]);

        return $this->sendsuccess(__('messages.common.status_updated_successfully'));
    }

    /**
     * @param  LiveMeeting  $liveMeeting
     * @return JsonResponse
     */
    public function getLiveStatus(LiveMeeting $liveMeeting)
    {
        if (getLoggedInUser()->hasRole('Admin') || collect($liveMeeting->members)->contains('id', getLoggedInUser()->id)) {
            $data['liveMeeting'] = LiveMeeting::with('user')->find($liveMeeting->id);

            /** @var ZoomRepository $zoomRepo */
            $zoomRepo = App::make(ZoomRepository::class, ['createdBy' => $liveMeeting->created_by]);
            $data['zoomLiveData'] = $zoomRepo->get($liveMeeting->meta['id'], ['meeting_owner' => $liveMeeting->created_by]);

            return $this->sendResponse($data, 'Live Status retrieved successfully.');
        } else {
            return $this->sendError(__('messages.live_meetings').' '.__('messages.common.not_found'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LiveMeeting  $liveMeeting
     * @return JsonResponse
     */
    public function edit(LiveMeeting $liveMeeting)
    {
        if (getLoggedInUser()->hasRole('Admin') || collect($liveMeeting->members)->contains('id', getLoggedInUser()->id)) {
            $liveMeeting->load('members');
            $meetingUsers = $liveMeeting->members->pluck('id')->toArray();
            $liveMeeting->setAttribute('meetingUsers', $meetingUsers);

            return $this->sendResponse($liveMeeting, 'Live Meeting retrieved successfully.');
        } else {
            return $this->sendError(__('messages.live_meetings').' '.__('messages.common.not_found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LiveMeetingRequest  $request
     * @param  LiveMeeting  $liveMeeting
     * @return JsonResponse
     */
    public function update(LiveMeetingRequest $request, LiveMeeting $liveMeeting)
    {
        try {
            $this->liveMeetingRepository->edit($request->all(), $liveMeeting);

            return $this->sendSuccess(__('messages.live_meetings').' '.__('messages.common.updated_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param  LiveMeeting  $liveMeeting
     * @return JsonResponse
     */
    public function show(LiveMeeting $liveMeeting)
    {
        if (getLoggedInUser()->hasRole('Admin') || collect($liveMeeting->members)->contains('id', getLoggedInUser()->id)) {
            $liveMeeting = LiveMeeting::with(['user'])->find($liveMeeting->id);

            return $this->sendResponse($liveMeeting, 'Live Meeting retrieved successfully.');
        } else {
            return $this->sendError(__('messages.live_meetings').' '.__('messages.common.not_found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LiveMeeting  $liveMeeting
     * @return JsonResponse
     */
    public function destroy(LiveMeeting $liveMeeting)
    {
        try {
            if (getLoggedInUser()->hasRole('Admin') || collect($liveMeeting->members)->contains('id', getLoggedInUser()->id)) {
                $liveMeeting->delete();

                return $this->sendSuccess(__('messages.live_meetings').' '.__('messages.common.deleted_successfully'));
            } else {
                return $this->sendError(__('messages.live_meetings').' '.__('messages.common.not_found'));
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
