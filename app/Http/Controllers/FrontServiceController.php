<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrontServiceRequest;
use App\Http\Requests\UpdateFrontServiceRequest;
use App\Models\FrontService;
use App\Repositories\FrontServiceRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontServiceController extends AppBaseController
{
    /** @var FrontServiceRepository */
    private $frontServiceRepository;

    public function __construct(FrontServiceRepository $frontServiceRepository)
    {
        $this->frontServiceRepository = $frontServiceRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index()
    {
        return view('front_settings.front_services.index');
    }

    /**
     * Store a newly created FrontService in storage.
     *
     * @param  FrontServiceRequest  $request
     * @return JsonResponse
     */
    public function store(FrontServiceRequest $request)
    {
        try {
            $input = $request->all();
            $this->frontServiceRepository->store($input);

            return $this->sendSuccess(__('messages.front_service').' '.__('messages.common.saved_successfully'));
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified FrontService.
     *
     * @param    $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $frontService = FrontService::find($id);

        return $this->sendResponse($frontService, 'FrontService retrieved successfully.');
    }

    /**
     * @param    $id
     * @param \App\Http\Requests\UpdateFrontServiceRequest $request
     * @return JsonResponse
     */
    public function update($id, UpdateFrontServiceRequest $request)
    {
        try {
            $this->frontServiceRepository->updateFrontService($request->all(), $id);

            return $this->sendSuccess(__('messages.front_service').' '.__('messages.common.updated_successfully'));
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified FrontService from storage.
     *
     * @param    $id
     * @return JsonResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            $frontService = FrontService::find($id);
            $frontService->clearMediaCollection(FrontService::PATH);
            $frontService->delete();

            return $this->sendSuccess(__('messages.front_service').' '.__('messages.common.deleted_successfully'));
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
