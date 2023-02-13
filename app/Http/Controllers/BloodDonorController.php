<?php

namespace App\Http\Controllers;

use App\Exports\BloodDonorExport;
use App\Http\Requests\CreateBloodDonorRequest;
use App\Http\Requests\UpdateBloodDonorRequest;
use App\Models\BloodDonation;
use App\Models\BloodDonor;
use App\Repositories\BloodDonorRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BloodDonorController extends AppBaseController
{
    /** @var BloodDonorRepository */
    private $bloodDonorRepository;

    public function __construct(BloodDonorRepository $bloodDonorRepo)
    {
        $this->bloodDonorRepository = $bloodDonorRepo;
    }

    /**
     * Display a listing of the BloodDonor.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $bloodGroup = getBloodGroups();

        return view('blood_donors.index', compact('bloodGroup'));
    }

    /**
     * Store a newly created BloodDonor in storage.
     *
     * @param  CreateBloodDonorRequest  $request
     * @return JsonResponse
     */
    public function store(CreateBloodDonorRequest $request)
    {
        $input = $request->all();
        $this->bloodDonorRepository->create($input);

        return $this->sendSuccess(__('messages.blood_donor.blood_donor').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Show the form for editing the specified BloodDonor.
     *
     * @param  BloodDonor  $bloodDonor
     * @return JsonResponse
     */
    public function edit(BloodDonor $bloodDonor)
    {
        return $this->sendResponse($bloodDonor, 'Blood Donor retrieved successfully.');
    }

    /**
     * Update the specified BloodDonor in storage.
     *
     * @param  BloodDonor  $bloodDonor
     * @param  UpdateBloodDonorRequest  $request
     * @return JsonResponse
     */
    public function update(BloodDonor $bloodDonor, UpdateBloodDonorRequest $request)
    {
        $input = $request->all();
        $this->bloodDonorRepository->update($input, $bloodDonor->id);

        return $this->sendSuccess(__('messages.blood_donor.blood_donor').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified BloodDonor from storage.
     *
     * @param  BloodDonor  $bloodDonor
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(BloodDonor $bloodDonor)
    {
        $bloodDonorModel = [BloodDonation::class];
        $result = canDelete($bloodDonorModel, 'blood_donor_id', $bloodDonor->id);
        if ($result) {
            return $this->sendError(__('messages.blood_donor.blood_donor').' '.__('messages.common.cant_be_deleted'));
        }
        $bloodDonor->delete($bloodDonor->id);

        return $this->sendSuccess(__('messages.blood_donor.blood_donor').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function bloodDonorExport()
    {
        return Excel::download(new BloodDonorExport, 'blood-donor-'.time().'.xlsx');
    }
}
