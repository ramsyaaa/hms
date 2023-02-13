<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBedTypeRequest;
use App\Http\Requests\UpdateBedTypeRequest;
use App\Models\Bed;
use App\Models\BedType;
use App\Models\IpdPatientDepartment;
use App\Repositories\BedTypeRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class BedTypeController
 */
class BedTypeController extends AppBaseController
{
    /** @var BedTypeRepository */
    private $bedTypeRepository;

    public function __construct(BedTypeRepository $bedTypeRepo)
    {
        $this->bedTypeRepository = $bedTypeRepo;
    }

    /**
     * Display a listing of the Bed_Type.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('bed_types.index');
    }

    /**
     * Store a newly created Bed_Type in storage.
     *
     * @param  CreateBedTypeRequest  $request
     * @return JsonResponse
     */
    public function store(CreateBedTypeRequest $request)
    {
        $input = $request->all();

        $bedType = $this->bedTypeRepository->create($input);

        return $this->sendSuccess(__('messages.bed.bed_type').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Display the specified Bed_Type.
     *
     * @param  BedType  $bedType
     * @return Factory|View
     */
    public function show(BedType $bedType)
    {
        $beds = $bedType->beds;

        return view('bed_types.show', compact('bedType', 'beds'));
    }

    /**
     * Show the form for editing the specified Bed_Type.
     *
     * @param  BedType  $bedType
     * @return JsonResponse
     */
    public function edit(BedType $bedType)
    {
        return $this->sendResponse($bedType, 'Bed Type retrieved successfully.');
    }

    /**
     * Update the specified Bed_Type in storage.
     *
     * @param  BedType  $bedType
     * @param  UpdateBedTypeRequest  $request
     * @return JsonResponse
     */
    public function update(BedType $bedType, UpdateBedTypeRequest $request)
    {
        $input = $request->all();
        $bedType = $this->bedTypeRepository->update($input, $bedType->id);

        return $this->sendSuccess(__('messages.bed.bed_type').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified Bed_Type from storage.
     *
     * @param  BedType  $bedType
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(BedType $bedType)
    {
        $bed = Bed::whereBedType($bedType->id)->exists();
        $ipdPatientDepartment = IpdPatientDepartment::whereBedTypeId($bedType->id)->exists();

        if ($bed || $ipdPatientDepartment) {
            return $this->sendError(__('messages.bed.bed_type').' '.__('messages.common.cant_be_deleted'));
        }

        $this->bedTypeRepository->delete($bedType->id);

        return $this->sendSuccess(__('messages.bed.bed_type').' '.__('messages.common.deleted_successfully'));
    }
}
