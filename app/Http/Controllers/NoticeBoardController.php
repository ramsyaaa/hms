<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoticeBoardRequest;
use App\Http\Requests\UpdateNoticeBoardRequest;
use App\Models\NoticeBoard;
use App\Repositories\NoticeBoardRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class NoticeBoardController extends AppBaseController
{
    /** @var NoticeBoardRepository */
    private $noticeBoardRepository;

    public function __construct(NoticeBoardRepository $noticeBoardRepo)
    {
        $this->noticeBoardRepository = $noticeBoardRepo;
    }

    /**
     * Display a listing of the NoticeBoard.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('notice_boards.index');
    }

    /**
     * Store a newly created NoticeBoard in storage.
     *
     * @param  CreateNoticeBoardRequest  $request
     * @return JsonResponse
     */
    public function store(CreateNoticeBoardRequest $request)
    {
        $input = $request->all();
        $this->noticeBoardRepository->create($input);
        $this->noticeBoardRepository->createNotification();

        return $this->sendSuccess(__('messages.notice_boards').' '.__('messages.common.saved_successfully'));
    }

    /**
     * @param  NoticeBoard  $noticeBoard
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $noticeBoard = NoticeBoard::findOrFail($id);

        return $this->sendResponse($noticeBoard, 'Notice Board retrieved successfully.');
    }

    /**
     * Show the form for editing the specified NoticeBoard.
     *
     * @param  NoticeBoard  $noticeBoard
     * @return JsonResponse
     */
    public function edit(NoticeBoard $noticeBoard)
    {
        return $this->sendResponse($noticeBoard, 'Notice Board retrieved successfully.');
    }

    /**
     * @param  NoticeBoard  $noticeBoard
     * @param  UpdateNoticeBoardRequest  $request
     * @return JsonResponse
     */
    public function update(NoticeBoard $noticeBoard, UpdateNoticeBoardRequest $request)
    {
        $this->noticeBoardRepository->update($request->all(), $noticeBoard->id);

        return $this->sendSuccess(__('messages.notice_boards').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified NoticeBoard from storage.
     *
     * @param  NoticeBoard  $noticeBoard
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(NoticeBoard $noticeBoard)
    {
        $noticeBoard->delete();

        return $this->sendSuccess(__('messages.notice_boards').' '.__('messages.common.deleted_successfully'));
    }
}
