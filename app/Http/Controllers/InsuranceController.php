<?php

namespace App\Http\Controllers;

use App\Exports\InsuranceExport;
use App\Http\Requests\CreateInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Models\Insurance;
use App\Models\PatientAdmission;
use App\Repositories\InsuranceRepository;
use DB;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class InsuranceController
 */
class InsuranceController extends AppBaseController
{
    /** @var InsuranceRepository */
    private $insuranceRepository;

    public function __construct(InsuranceRepository $insuranceRepo)
    {
        $this->insuranceRepository = $insuranceRepo;
    }

    /**
     * Display a listing of the Insurance.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $data['statusArr'] = Insurance::STATUS_ARR;

        return view('insurances.index', $data);
    }

    /**
     * Show the form for creating a new Insurance.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('insurances.create');
    }

    /**
     * Store a newly created Insurance in storage.
     *
     * @param  CreateInsuranceRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws Exception
     */
    public function store(CreateInsuranceRequest $request)
    {
        $input = $request->all();
        $input['service_tax'] = removeCommaFromNumbers($input['service_tax']);
        $input['hospital_rate'] = removeCommaFromNumbers($input['hospital_rate']);
        $input['status'] = isset($input['status']) ? 1 : 0;
        try {
            DB::beginTransaction();
            $insurance = $this->insuranceRepository->store($input);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            Flash::error($e->getMessage());

            return redirect(route('insurances.store'));
//            return $this->sendError();
        }

        Flash::success(__('messages.insurance.insurance').' '.__('messages.common.saved_successfully'));

        return redirect(route('insurances.index'));
//        return $this->sendSuccess('');
    }

    /**
     * Display the specified Insurance.
     *
     * @param  Insurance  $insurance
     * @return Factory|View
     */
    public function show(Insurance $insurance)
    {
        $diseases = $this->insuranceRepository->getInsuranceDisease($insurance->id);

        return view('insurances.show', compact('diseases', 'insurance'));
    }

    /**
     * Show the form for editing the specified Insurance.
     *
     * @param  Insurance  $insurance
     * @return Factory|View
     */
    public function edit(Insurance $insurance)
    {
        $diseases = $this->insuranceRepository->getInsuranceDisease($insurance->id);

        return view('insurances.edit', compact('diseases', 'insurance'));
    }

    /**
     * Update the specified Insurance in storage.
     *
     * @param  Insurance  $insurance
     * @param  UpdateInsuranceRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws Exception
     */
    public function update(Insurance $insurance, UpdateInsuranceRequest $request)
    {
        $input = $request->all();
        $input['service_tax'] = removeCommaFromNumbers($input['service_tax']);
        $input['hospital_rate'] = removeCommaFromNumbers($input['hospital_rate']);
        $input['status'] = isset($input['status']) ? 1 : 0;
        try {
            DB::beginTransaction();
            $insurance = $this->insuranceRepository->update($insurance, $input);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        Flash::success(__('messages.insurance.insurance').' '.__('messages.common.updated_successfully'));

        return redirect(route('insurances.index'));
//        return $this->sendSuccess('');
    }

    /**
     * Remove the specified Insurance from storage.
     *
     * @param  Insurance  $insurance
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Insurance $insurance)
    {
        $insuranceModel = [
            PatientAdmission::class,
        ];
        $result = canDelete($insuranceModel, 'insurance_id', $insurance->id);
        if ($result) {
            return $this->sendError(__('messages.insurance.insurance').' '.__('messages.common.cant_be_deleted'));
        }
        try {
            $this->insuranceRepository->delete($insurance->id);

            return $this->sendSuccess(__('messages.insurance.insurance').' '.__('messages.common.deleted_successfully'));
        } catch (Exception $exception) {
            return $this->sendError($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function activeDeactiveInsurance($id)
    {
        $insurance = Insurance::findOrFail($id);
        $insurance->status = ! $insurance->status;
        $insurance->update(['status' => $insurance->status]);

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function insuranceExport()
    {
        return Excel::download(new InsuranceExport, 'insurances-'.time().'.xlsx');
    }
}
