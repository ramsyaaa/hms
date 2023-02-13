<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePathologyCategoryRequest;
use App\Http\Requests\UpdatePathologyCategoryRequest;
use App\Models\PathologyCategory;
use App\Models\PathologyTest;
use App\Repositories\PathologyCategoryRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PathologyCategoryController extends AppBaseController
{
    /** @var PathologyCategoryRepository */
    private $pathologyCategoryRepository;

    public function __construct(PathologyCategoryRepository $pathologyCategoryRepo)
    {
        $this->pathologyCategoryRepository = $pathologyCategoryRepo;
    }

    /**
     * Display a listing of the PathologyCategory.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('pathology_categories.index');
    }

    /**
     * Store a newly created PathologyCategory in storage.
     *
     * @param  CreatePathologyCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(CreatePathologyCategoryRequest $request)
    {
        $input = $request->all();
        $this->pathologyCategoryRepository->create($input);

        return $this->sendSuccess(__('messages.pathology_categories').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Show the form for editing the specified PathologyCategory.
     *
     * @param  PathologyCategory  $pathologyCategory
     * @return JsonResponse
     */
    public function edit(PathologyCategory $pathologyCategory)
    {
        return $this->sendResponse($pathologyCategory, 'Pathology Category retrieved successfully.');
    }

    /**
     * Update the specified PathologyCategory in storage.
     *
     * @param  PathologyCategory  $pathologyCategory
     * @param  UpdatePathologyCategoryRequest  $request
     * @return JsonResponse
     */
    public function update(PathologyCategory $pathologyCategory, UpdatePathologyCategoryRequest $request)
    {
        $input = $request->all();
        $this->pathologyCategoryRepository->update($input, $pathologyCategory->id);

        return $this->sendSuccess(__('messages.pathology_categories').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified PathologyCategory from storage.
     *
     * @param  PathologyCategory  $pathologyCategory
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(PathologyCategory $pathologyCategory)
    {
        $pathologyCategoryModels = [
            PathologyTest::class,
        ];
        $result = canDelete($pathologyCategoryModels, 'category_id', $pathologyCategory->id);
        if ($result) {
            return $this->sendError(__('messages.pathology_categories').' '.__('messages.common.cant_be_deleted'));
        }

        $pathologyCategory->delete();

        return $this->sendSuccess(__('messages.pathology_categories').' '.__('messages.common.deleted_successfully'));
    }
}
