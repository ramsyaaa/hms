<?php

namespace App\Http\Controllers;

use App\Exports\BloodBankExport;
use App\Http\Requests\CreateBloodBankRequest;
use App\Http\Requests\UpdateBloodBankRequest;
use App\Models\BloodBank;
use App\Models\BloodDonor;
use App\Models\User;
use App\Repositories\BloodBankRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BloodBankController extends AppBaseController
{
    /** @var BloodBankRepository */
    private $bloodBankRepository;

    public function __construct(BloodBankRepository $bloodBankRepo)
    {
        $this->bloodBankRepository = $bloodBankRepo;
    }

    /**
     * Display a listing of the BloodBank.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('blood_banks.index');
    }

    /**
     * Store a newly created BloodBank in storage.
     *
     * @param  CreateBloodBankRequest  $request
     * @return JsonResponse
     */
    public function store(CreateBloodBankRequest $request)
    {
        $input = $request->all();
        $this->bloodBankRepository->create($input);

        return $this->sendSuccess(__('messages.hospital_blood_bank.blood_group').' '.__('messages.common.saved_successfully'));
    }

    /**
     * Show the form for editing the specified BloodBank.
     *
     * @param  BloodBank  $bloodBank
     * @return JsonResponse
     */
    public function edit(BloodBank $bloodBank)
    {
        return $this->sendResponse($bloodBank, 'BloodBank retrieved successfully.');
    }

    /**
     * Update the specified BloodBank in storage.
     *
     * @param  BloodBank  $bloodBank
     * @param  UpdateBloodBankRequest  $request
     * @return JsonResponse
     */
    public function update(BloodBank $bloodBank, UpdateBloodBankRequest $request)
    {
        $input = $request->all();
        $this->bloodBankRepository->update($input, $bloodBank->id);

        return $this->sendSuccess(__('messages.hospital_blood_bank.blood_group').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified BloodBank from storage.
     *
     * @param  BloodBank  $bloodBank
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(BloodBank $bloodBank)
    {
        $bloodBankModel = [
            BloodDonor::class, User::class,
        ];
        $result = canDelete($bloodBankModel, 'blood_group', $bloodBank->blood_group);
        if ($result) {
            return $this->sendError(__('messages.hospital_blood_bank.blood_group').' '.__('messages.common.cant_be_deleted'));
        }
        $bloodBank->delete($bloodBank->id);

        return $this->sendSuccess(__('messages.hospital_blood_bank.blood_group').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function bloodBankExport()
    {
        return Excel::download(new BloodBankExport, 'blood-banks-'.time().'.xlsx');
    }
}
