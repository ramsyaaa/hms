<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiagnosisCategoryRequest;
use App\Http\Requests\UpdateDiagnosisCategoryRequest;
use App\Models\DiagnosisCategory;
use App\Models\PatientDiagnosisTest;
use App\Repositories\DiagnosisCategoryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiagnosisCategoryController extends AppBaseController
{
    /**
     * @var DiagnosisCategoryRepository
     */
    private $categoryRepository;

    public function __construct(DiagnosisCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('diagnosis_categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateDiagnosisCategoryRequest  $request
     * @return JsonResponse
     */
    public function store(CreateDiagnosisCategoryRequest $request)
    {
        $input = $request->all();
        $this->categoryRepository->create($input);

        return $this->sendSuccess(__('messages.diagnosis_category.diagnosis_category').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  DiagnosisCategory  $diagnosisCategory
     * @return Application|Factory|View
     */
    public function show(DiagnosisCategory $diagnosisCategory)
    {
        return view('diagnosis_categories.show', compact('diagnosisCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DiagnosisCategory  $diagnosisCategory
     * @return JsonResponse
     */
    public function edit(DiagnosisCategory $diagnosisCategory)
    {
        return $this->sendResponse($diagnosisCategory, 'Diagnosis Category retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDiagnosisCategoryRequest  $request
     * @param  DiagnosisCategory  $diagnosisCategory
     * @return JsonResponse
     */
    public function update(UpdateDiagnosisCategoryRequest $request, DiagnosisCategory $diagnosisCategory)
    {
        $input = $request->all();
        $this->categoryRepository->update($input, $diagnosisCategory->id);

        return $this->sendSuccess(__('messages.diagnosis_category.diagnosis_category').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DiagnosisCategory  $diagnosisCategory
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(DiagnosisCategory $diagnosisCategory)
    {
        $diagnosisCategoryModal = [
            PatientDiagnosisTest::class,
        ];
        $result = canDelete($diagnosisCategoryModal, 'category_id', $diagnosisCategory->id);
        if ($result) {
            return $this->sendError(__('messages.diagnosis_category.diagnosis_category').' '.__('messages.common.cant_be_deleted'));
        }

        $diagnosisCategory->delete();

        return $this->sendSuccess(__('messages.diagnosis_category.diagnosis_category').' '.__('messages.common.deleted_successfully'));
    }
}
