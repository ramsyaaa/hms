<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Repositories\ItemCategoryRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemCategoryController extends AppBaseController
{
    /** @var ItemCategoryRepository */
    private $itemCategoryRepository;

    public function __construct(ItemCategoryRepository $itemCategoryRepo)
    {
        $this->itemCategoryRepository = $itemCategoryRepo;
    }

    /**
     * Display a listing of the ItemCategory.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('item_categories.index');
    }

    /**
     * Store a newly created ItemCategory in storage.
     *
     * @param  CreateItemCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(CreateItemCategoryRequest $request)
    {
        $input = $request->all();
        $this->itemCategoryRepository->create($input);

        return $this->sendSuccess(__('messages.item_category.item_category').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Show the form for editing the specified ItemCategory.
     *
     * @param  ItemCategory  $itemCategory
     * @return JsonResponse
     */
    public function edit(ItemCategory $itemCategory)
    {
        return $this->sendResponse($itemCategory, 'Item Category retrieved successfully.');
    }

    /**
     * Update the specified ItemCategory in storage.
     *
     * @param  ItemCategory  $itemCategory
     * @param  UpdateItemCategoryRequest  $request
     * @return JsonResponse
     */
    public function update(ItemCategory $itemCategory, UpdateItemCategoryRequest $request)
    {
        $input = $request->all();
        $this->itemCategoryRepository->update($input, $itemCategory->id);

        return $this->sendSuccess(__('messages.item_category.item_category').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified ItemCategory from storage.
     *
     * @param  ItemCategory  $itemCategory
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategoryModel = [Item::class];
        $result = canDelete($itemCategoryModel, 'item_category_id', $itemCategory->id);
        if ($result) {
            return $this->sendError(__('messages.item_category.item_category').' '.__('messages.common.cant_be_deleted'));
        }
        $this->itemCategoryRepository->delete($itemCategory->id);

        return $this->sendSuccess(__('messages.item_category.item_category').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getItemsList(Request $request)
    {
        if (empty($request->get('id'))) {
            return $this->sendError('Items not found');
        }

        $itemsData = Item::get()->where('item_category_id', $request->get('id'))->pluck('name', 'id');

        return $this->sendResponse($itemsData, 'Retrieved successfully');
    }
}
