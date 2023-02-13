<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIpdDiagnosisRequest;
use App\Http\Requests\UpdateIpdDiagnosisRequest;
use App\Models\IpdDiagnosis;
use App\Queries\IpdDiagnosisDataTable;
use App\Repositories\IpdDiagnosisRepository;
use DataTables;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IpdDiagnosisController extends AppBaseController
{
    /** @var IpdDiagnosisRepository */
    private $ipdDiagnosisRepository;

    public function __construct(IpdDiagnosisRepository $ipdDiagnosisRepo)
    {
        $this->ipdDiagnosisRepository = $ipdDiagnosisRepo;
    }

    /**
     * Display a listing of the IpdDiagnosis.
     *
     * @param  Request  $request
     * @return Response
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new IpdDiagnosisDataTable())->get($request->id))->make(true);
        }
    }

    /**
     * Store a newly created IpdDiagnosis in storage.
     *
     * @param  CreateIpdDiagnosisRequest  $request
     * @return JsonResponse
     */
    public function store(CreateIpdDiagnosisRequest $request)
    {
        $input = $request->all();
        $this->ipdDiagnosisRepository->store($input);

        return $this->sendSuccess(__('messages.ipd_diagnosis').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Show the form for editing the specified Ipd Diagnosis.
     *
     * @param  IpdDiagnosis  $ipdDiagnosis
     * @return JsonResponse
     */
    public function edit(IpdDiagnosis $ipdDiagnosis)
    {
        return $this->sendResponse($ipdDiagnosis, 'IPD Diagnosis retrieved successfully.');
    }

    /**
     * Update the specified Ipd Diagnosis in storage.
     *
     * @param  IpdDiagnosis  $ipdDiagnosis
     * @param  UpdateIpdDiagnosisRequest  $request
     * @return JsonResponse
     */
    public function update(IpdDiagnosis $ipdDiagnosis, UpdateIpdDiagnosisRequest $request)
    {
        $this->ipdDiagnosisRepository->updateIpdDiagnosis($request->all(), $ipdDiagnosis->id);

        return $this->sendSuccess(__('messages.ipd_diagnosis').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified IpdDiagnosis from storage.
     *
     * @param  IpdDiagnosis  $ipdDiagnosis
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(IpdDiagnosis $ipdDiagnosis)
    {
        $this->ipdDiagnosisRepository->deleteIpdDiagnosis($ipdDiagnosis->id);

        return $this->sendSuccess(__('messages.ipd_diagnosis').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  IpdDiagnosis  $ipdDiagnosis
     * @return Media
     */
    public function downloadMedia(IpdDiagnosis $ipdDiagnosis)
    {
        $media = $ipdDiagnosis->getMedia(IpdDiagnosis::IPD_DIAGNOSIS_PATH)->first();
        if ($media != null) {
            $media = $media->id;
            $mediaItem = Media::findOrFail($media);

            return $mediaItem;
        }

        return '';
    }
}
