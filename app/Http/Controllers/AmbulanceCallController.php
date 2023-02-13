<?php

namespace App\Http\Controllers;

use App\Exports\AmbulanceCallExport;
use App\Http\Requests\CreateAmbulanceCallRequest;
use App\Http\Requests\UpdateAmbulanceCallRequest;
use App\Models\Ambulance;
use App\Models\AmbulanceCall;
use App\Repositories\AmbulanceCallRepository;
use App\Repositories\AmbulanceRepository;
use App\Repositories\PatientRepository;
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

class AmbulanceCallController extends AppBaseController
{
    /** @var AmbulanceCallRepository */
    private $ambulanceCallRepository;

    /** @var AmbulanceRepository */
    private $ambulanceRepository;

    /** @var PatientRepository */
    private $patientRepository;

    public function __construct(
        AmbulanceCallRepository $ambulanceCallRepo,
        AmbulanceRepository $ambulanceRepo,
        PatientRepository $patientRepo
    ) {
        $this->ambulanceCallRepository = $ambulanceCallRepo;
        $this->ambulanceRepository = $ambulanceRepo;
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Payment.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('ambulance_calls.index');
    }

    /**
     * Show the form for creating a new AmbulanceCall.
     *
     * @return Factory|View
     */
    public function create()
    {
        $ambulances = $this->ambulanceRepository->getAmbulances();
        $patients = $this->patientRepository->getPatients();

        return view('ambulance_calls.create', compact('ambulances', 'patients'));
    }

    /**
     * Store a newly created AmbulanceCall in storage.
     *
     * @param  CreateAmbulanceCallRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateAmbulanceCallRequest $request)
    {
        $input = $request->all();
        if ($request->has('amount')) {
            $input['amount'] = removeCommaFromNumbers($input['amount']);
        }

        $ambulanceCall = $this->ambulanceCallRepository->create($input);
        Ambulance::where('id', $input['ambulance_id'])->update(['is_available' => false]);

        Flash::success(__('messages.ambulance_call.ambulance_call').' '.__('messages.common.saved_successfully'));

        return redirect(route('ambulance-calls.index'));
    }

    /**
     * Display the specified AmbulanceCall.
     *
     * @param  AmbulanceCall  $ambulanceCall
     * @return Factory|View
     */
    public function show(AmbulanceCall $ambulanceCall)
    {
        return view('ambulance_calls.show')->with('ambulanceCall', $ambulanceCall);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param  AmbulanceCall  $ambulanceCall
     * @return Factory|View
     */
    public function edit(AmbulanceCall $ambulanceCall)
    {
        $ambulances = $this->ambulanceRepository->getAmbulances();
        $patients = $this->patientRepository->getPatients();
        $ambulance = Ambulance::whereId($ambulanceCall->ambulance_id)->first()->vehicle_model;
        $ambulances->put($ambulanceCall->ambulance_id, $ambulance);

        return view('ambulance_calls.edit', compact('ambulances', 'patients', 'ambulanceCall'));
    }

    /**
     * Update the specified AmbulanceCall in storage.
     *
     * @param  AmbulanceCall  $ambulanceCall
     * @param  UpdateAmbulanceCallRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(AmbulanceCall $ambulanceCall, UpdateAmbulanceCallRequest $request)
    {
        $input = $request->all();
        $input['amount'] = removeCommaFromNumbers($input['amount']);
        $ambulanceCall = $this->ambulanceCallRepository->update($input, $ambulanceCall);

        Flash::success(__('messages.ambulance_call.ambulance_call').' '.__('messages.common.updated_successfully'));

        return redirect(route('ambulance-calls.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param  AmbulanceCall  $ambulanceCall
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(AmbulanceCall $ambulanceCall)
    {
        $this->ambulanceCallRepository->delete($ambulanceCall->id);

        return $this->sendSuccess(__('messages.ambulance_call.ambulance_call').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function getDriverName(Request $request)
    {
        if (empty($request->get('id'))) {
            return $this->sendError(__('messages.ambulance.driver_name').' '.__('messages.common.not_found'));
        }

        $driverName = Ambulance::whereId($request->id)->get()->pluck('driver_name');

        return $this->sendResponse($driverName, 'Driver name retrieved successful');
    }

    /**
     * @return BinaryFileResponse
     */
    public function ambulanceCallExport()
    {
        return Excel::download(new AmbulanceCallExport, 'ambulance-calls-'.time().'.xlsx');
    }
}
