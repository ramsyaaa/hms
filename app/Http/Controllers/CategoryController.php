<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Medicine;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $data['statusArr'] = Category::STATUS_ARR;

        return view('categories.index', $data);
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  CreateCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->create($input);

        return $this->sendSuccess(__('messages.medicine.medicine_category').' '.__('messages.common.saved_successfully'));
    }

    /**
     * @param  Category  $category
     * @return Factory|View
     */
    public function show(Category $category)
    {
        $medicines = $category->medicines;

        return view('categories.show', compact('medicines', 'category'));
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  Category  $category
     * @return JsonResponse
     */
    public function edit(Category $category)
    {
        return $this->sendResponse($category, 'Medicine category retrieved successfully.');
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  Category  $category
     * @param  UpdateCategoryRequest  $request
     * @return JsonResponse
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->update($input, $category->id);

        return $this->sendSuccess(__('messages.medicine.medicine_category').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  Category  $category
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $medicineCategoryModel = [
            Medicine::class,
        ];
        $result = canDelete($medicineCategoryModel, 'category_id', $category->id);
        if ($result) {
            return $this->sendError(__('messages.medicine.medicine_category').' '.__('messages.common.cant_be_deleted'));
        }
        $this->categoryRepository->delete($category->id);

        return $this->sendSuccess(__('messages.medicine.medicine_category').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function activeDeActiveCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->is_active = ! $category->is_active;
        $category->save();

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }
}
