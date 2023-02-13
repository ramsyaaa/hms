<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\NoticeBoard;

class NoticeboardAPIController extends AppBaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $noticeboards = NoticeBoard::orderBy('id', 'desc')->get();

        $data = [];
        foreach ($noticeboards as $noticeboard) {
            $data[] = $noticeboard->prepareNoticeboardData();
        }

        return $this->sendResponse($data, 'Noticeboard Retrieved Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $noticeboard = NoticeBoard::where('id', $id)->select(['title', 'description'])->first();

        return $this->sendResponse($noticeboard, 'Noticeboard Retrieved Successfully');
    }
}
