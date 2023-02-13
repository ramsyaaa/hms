<?php

namespace App\Http\Controllers;

use App\Exports\RadiologyTestExport;
use App\Http\Requests\CreateRadiologyTestRequest;
use App\Http\Requests\UpdateRadiologyTestRequest;
use App\Models\Charge;
use App\Models\RadiologyTest;
use App\Repositories\RadiologyTestRepository;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RadiologyTestController extends AppBaseController
{
    /** @var RadiologyTestRepository */
    private $radiologyTestRepository;

    public function __construct(RadiologyTestRepository $radiologyTestRepo)
    {
        $this->radiologyTestRepository = $radiologyTestRepo;
    }

    /**
     * Display a listing of the RadiologyTest.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('radiology_tests.index');
    }

    /**
     * Show the form for creating a new RadiologyTest.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->radiologyTestRepository->getRadiologyAssociatedData();

        return view('radiology_tests.create', compact('data'));
    }

    /**
     * Store a newly created RadiologyTest in storage.
     *
     * @param  CreateRadiologyTestRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateRadiologyTestRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $input['report_days'] = ! empty($input['report_days']) ? $input['report_days'] : null;
        $input['subcategory'] = ! empty($input['subcategory']) ? $input['subcategory'] : null;
        $this->radiologyTestRepository->create($input);
        Flash::success(__('messages.radiology_test.radiology_tests').' '.__('messages.common.saved_successfully'));

        return redirect(route('radiology.test.index'));
    }

    /**
     * Display the specified RadiologyTest.
     *
     * @param  RadiologyTest  $radiologyTest
     * @return Factory|View
     */
    public function show(RadiologyTest $radiologyTest)
    {
        return view('radiology_tests.show', compact('radiologyTest'));
    }

    /**
     * Show the form for editing the specified RadiologyTest.
     *
     * @param  RadiologyTest  $radiologyTest
     * @return Factory|View
     */
    public function edit(RadiologyTest $radiologyTest)
    {
        $data = $this->radiologyTestRepository->getRadiologyAssociatedData();

        return view('radiology_tests.edit', compact('radiologyTest', 'data'));
    }

    /**
     * Update the specified RadiologyTest in storage.
     *
     * @param  RadiologyTest  $radiologyTest
     * @param  UpdateRadiologyTestRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(RadiologyTest $radiologyTest, UpdateRadiologyTestRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $input['report_days'] = ! empty($input['report_days']) ? $input['report_days'] : null;
        $input['subcategory'] = ! empty($input['subcategory']) ? $input['subcategory'] : null;
        $this->radiologyTestRepository->update($input, $radiologyTest->id);
        Flash::success(__('messages.radiology_test.radiology_tests').' '.__('messages.common.updated_successfully'));

        return redirect(route('radiology.test.index'));
    }

    /**
     * Remove the specified RadiologyTest from storage.
     *
     * @param  RadiologyTest  $radiologyTest
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(RadiologyTest $radiologyTest)
    {
        $radiologyTest->delete();

        return $this->sendSuccess(__('messages.radiology_test.radiology_tests').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getStandardCharge($id)
    {
        $standardCharges = Charge::where('charge_category_id', $id)->value('standard_charge');

        return $this->sendResponse($standardCharges, 'StandardCharge retrieved successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function radiologyTestExport()
    {
        return Excel::download(new RadiologyTestExport, 'radiology-tests-'.time().'.xlsx');
    }

    /**
     * @param  RadiologyTest  $radiologyTest
     * @return JsonResponse
     *
     * @throws \Gerardojbaez\Money\Exceptions\CurrencyException
     */
    public function showModal(RadiologyTest $radiologyTest): JsonResponse
    {
        $radiologyTest->load(['radiologycategory', 'chargecategory']);

        $currency = $radiologyTest->currency_symbol ? strtoupper($radiologyTest->currency_symbols) : strtoupper(getCurrentCurrency());
        $radiologyTest = [
            'test_name' => $radiologyTest->test_name,
            'short_name' => $radiologyTest->short_name,
            'test_type' => $radiologyTest->test_type,
            'radiology_category_name' => $radiologyTest->radiologycategory->name,
            'subcategory' => $radiologyTest->subcategory,
            'standard_charge' => checkNumberFormat($radiologyTest->standard_charge, $currency),
            'report_days' => $radiologyTest->report_days,
            'charge_category_name' => $radiologyTest->chargecategory->name,
            'created_at' => $radiologyTest->created_at,
            'updated_at' => $radiologyTest->updated_at,
        ];

        return $this->sendResponse($radiologyTest, 'Radiology Test Retrieved Successfully.');
    }
}
