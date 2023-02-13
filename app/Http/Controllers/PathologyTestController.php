<?php

namespace App\Http\Controllers;

use App\Exports\PathologyTestExport;
use App\Http\Requests\CreatePathologyTestRequest;
use App\Http\Requests\UpdatePathologyTestRequest;
use App\Models\Charge;
use App\Models\PathologyTest;
use App\Repositories\PathologyTestRepository;
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

class PathologyTestController extends AppBaseController
{
    /** @var PathologyTestRepository */
    private $pathologyTestRepository;

    public function __construct(PathologyTestRepository $pathologyTestRepo)
    {
        $this->pathologyTestRepository = $pathologyTestRepo;
    }

    /**
     * Display a listing of the PathologyTest.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('pathology_tests.index');
    }

    /**
     * Show the form for creating a new PathologyTest.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->pathologyTestRepository->getPathologyAssociatedData();

        return view('pathology_tests.create', compact('data'));
    }

    /**
     * Store a newly created PathologyTest in storage.
     *
     * @param  CreatePathologyTestRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePathologyTestRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $input['unit'] = ! empty($input['unit']) ? $input['unit'] : null;
        $input['subcategory'] = ! empty($input['subcategory']) ? $input['subcategory'] : null;
        $input['method'] = ! empty($input['method']) ? $input['method'] : null;
        $input['report_days'] = ! empty($input['report_days']) ? $input['report_days'] : null;
        $this->pathologyTestRepository->create($input);
        Flash::success(__('messages.pathology_tests').' '.__('messages.common.saved_successfully'));

        return redirect(route('pathology.test.index'));
    }

    /**
     * Display the specified PathologyTest.
     *
     * @param  PathologyTest  $pathologyTest
     * @return Factory|View
     */
    public function show(PathologyTest $pathologyTest)
    {
        return view('pathology_tests.show', compact('pathologyTest'));
    }

    /**
     * Show the form for editing the specified PathologyTest.
     *
     * @param  PathologyTest  $pathologyTest
     * @return Factory|View
     */
    public function edit(PathologyTest $pathologyTest)
    {
        $data = $this->pathologyTestRepository->getPathologyAssociatedData();

        return view('pathology_tests.edit', compact('pathologyTest', 'data'));
    }

    /**
     * Update the specified PathologyTest in storage.
     *
     * @param  PathologyTest  $pathologyTest
     * @param  UpdatePathologyTestRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(PathologyTest $pathologyTest, UpdatePathologyTestRequest $request)
    {
        $input = $request->all();
        $input['standard_charge'] = removeCommaFromNumbers($input['standard_charge']);
        $input['unit'] = ! empty($input['unit']) ? $input['unit'] : null;
        $input['subcategory'] = ! empty($input['subcategory']) ? $input['subcategory'] : null;
        $input['method'] = ! empty($input['method']) ? $input['method'] : null;
        $input['report_days'] = ! empty($input['report_days']) ? $input['report_days'] : null;
        $this->pathologyTestRepository->update($input, $pathologyTest->id);
        Flash::success(__('messages.pathology_tests').' '.__('messages.common.updated_successfully'));

        return redirect(route('pathology.test.index'));
    }

    /**
     * Remove the specified PathologyTest from storage.
     *
     * @param  PathologyTest  $pathologyTest
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(PathologyTest $pathologyTest)
    {
        $pathologyTest->delete();

        return $this->sendSuccess(__('messages.pathology_tests').' '.__('messages.common.deleted_successfully'));
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
    public function pathologyTestExport()
    {
        return Excel::download(new PathologyTestExport, 'pathology-tests-'.time().'.xlsx');
    }

    /**
     * @throws \Gerardojbaez\Money\Exceptions\CurrencyException
     */
    public function showModal(PathologyTest $pathologyTest)
    {
        $pathologyTest->load(['pathologycategory', 'chargecategory']);

        $currency = $pathologyTest->currency_symbol ? strtoupper($pathologyTest->currency_symbol) : strtoupper(getCurrentCurrency());
        $pathologyTest = [
            'test_name' => $pathologyTest->test_name,
            'short_name' => $pathologyTest->short_name,
            'test_type' => $pathologyTest->test_type,
            'pathology_category_name' => $pathologyTest->pathologycategory->name,
            'unit' => $pathologyTest->unit,
            'report_days' => $pathologyTest->report_days,
            'standard_charge' => checkValidCurrency($pathologyTest->currency_symbol ?? getCurrentCurrency()) ? moneyFormat($pathologyTest->standard_charge, $currency) : number_format($pathologyTest->standard_charge).''.($pathologyTest->currency_symbol ? getSymbols($pathologyTest->currency_symbol) : getCurrencySymbol()),
            'subcategory' => $pathologyTest->subcategory,
            'method' => $pathologyTest->method,
            'charge_category_name' => $pathologyTest->chargecategory->name,
            'created_at' => $pathologyTest->created_at,
            'updated_at' => $pathologyTest->updated_at,
        ];

        return $this->sendResponse($pathologyTest, 'Pathology Test Retrieved Successfully.');
    }
}
