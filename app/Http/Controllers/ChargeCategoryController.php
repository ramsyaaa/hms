<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChargeCategoryRequest;
use App\Http\Requests\UpdateChargeCategoryRequest;
use App\Models\ChargeCategory;
use App\Models\RadiologyTest;
use App\Repositories\ChargeCategoryRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChargeCategoryController extends AppBaseController
{
    /** @var ChargeCategoryRepository */
    private $chargeCategoryRepository;

    public function __construct(ChargeCategoryRepository $chargeCategoryRepo)
    {
        $this->chargeCategoryRepository = $chargeCategoryRepo;
    }

    /**
     * Display a listing of the ChargeCategory.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $chargeTypes = ChargeCategory::CHARGE_TYPES;
        asort($chargeTypes);

        return view('charge_categories.index', compact('chargeTypes'));
    }

    /**
     * Store a newly created ChargeCategory in storage.
     *
     * @param  CreateChargeCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(CreateChargeCategoryRequest $request)
    {
        $input = $request->all();

        $chargeCategory = $this->chargeCategoryRepository->create($input);

        return $this->sendSuccess(__('messages.charge.charge_category').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Display the specified ChargeCategory.
     *
     * @param  ChargeCategory  $chargeCategory
     * @return Factory|View
     */
    public function show(ChargeCategory $chargeCategory)
    {
        $chargeTypes = ChargeCategory::CHARGE_TYPES;

        return view('charge_categories.show', compact('chargeCategory', 'chargeTypes'));
    }

    /**
     * Show the form for editing the specified ChargeCategory.
     *
     * @param  ChargeCategory  $chargeCategory
     * @return JsonResponse
     */
    public function edit(ChargeCategory $chargeCategory)
    {
        return $this->sendResponse($chargeCategory, 'Charge Category Retrieved Successfully.');
    }

    /**
     * Update the specified ChargeCategory in storage.
     *
     * @param  ChargeCategory  $chargeCategory
     * @param  UpdateChargeCategoryRequest  $request
     * @return JsonResponse
     */
    public function update(ChargeCategory $chargeCategory, UpdateChargeCategoryRequest $request)
    {
        $chargeCategory = $this->chargeCategoryRepository->update($request->all(), $chargeCategory->id);

        return $this->sendSuccess(__('messages.charge.charge_category').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified ChargeCategory from storage.
     *
     * @param  ChargeCategory  $chargeCategory
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(ChargeCategory $chargeCategory)
    {
        $chargeCategoryModels = [
            RadiologyTest::class,
        ];
        $result = canDelete($chargeCategoryModels, 'charge_category_id', $chargeCategory->id);
        if ($result) {
            return $this->sendError(__('messages.charge.charge_category').' '.__('messages.common.cant_be_deleted'));
        }
        $this->chargeCategoryRepository->delete($chargeCategory->id);

        return $this->sendSuccess(__('messages.charge.charge_category').' '.__('messages.common.deleted_successfully'));
    }
}
