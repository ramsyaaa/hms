<?php

namespace App\Http\Controllers;

use App\Exports\CaseHandlerExport;
use App\Http\Requests\CreateCaseHandlerRequest;
use App\Http\Requests\UpdateCaseHandlerRequest;
use App\Models\CaseHandler;
use App\Models\EmployeePayroll;
use App\Repositories\CaseHandlerRepository;
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

class CaseHandlerController extends AppBaseController
{
    /** @var CaseHandlerRepository */
    private $caseHandlerRepository;

    public function __construct(CaseHandlerRepository $caseHandlerRepo)
    {
        $this->caseHandlerRepository = $caseHandlerRepo;
    }

    /**
     * Display a listing of the CaseHandler.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $data['statusArr'] = CaseHandler::STATUS_ARR;

        return view('case_handlers.index', $data);
    }

    /**
     * Show the form for creating a new CaseHandler.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('case_handlers.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created CaseHandler in storage.
     *
     * @param  CreateCaseHandlerRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateCaseHandlerRequest $request)
    {
        $input = $request->all();
        $input['status'] = ! isset($input['status']) ? 0 : 1;
        $this->caseHandlerRepository->store($input);
        Flash::success(__('messages.case_handlers').' '.__('messages.common.saved_successfully'));

        return redirect(route('case-handlers.index'));
    }

    /**
     * Display the specified CaseHandler.
     *
     * @param  CaseHandler  $caseHandler
     * @return Factory|View
     */
    public function show(CaseHandler $caseHandler)
    {
        $payrolls = $caseHandler->payrolls;

        return view('case_handlers.show', compact('caseHandler', 'payrolls'));
    }

    /**
     * Show the form for editing the specified CaseHandler.
     *
     * @param  CaseHandler  $caseHandler
     * @return Factory|View
     */
    public function edit(CaseHandler $caseHandler)
    {
        $user = $caseHandler->user;
        $bloodGroup = getBloodGroups();

        return view('case_handlers.edit', compact('user', 'caseHandler', 'bloodGroup'));
    }

    /**
     * Update the specified CaseHandler in storage.
     *
     * @param  CaseHandler  $caseHandler
     * @param  UpdateCaseHandlerRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(CaseHandler $caseHandler, UpdateCaseHandlerRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $this->caseHandlerRepository->update($caseHandler, $input);
        Flash::success(__('messages.case_handlers').' '.__('messages.common.updated_successfully'));

        return redirect(route('case-handlers.index'));
    }

    /**
     * Remove the specified CaseHandler from storage.
     *
     * @param  CaseHandler  $caseHandler
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(CaseHandler $caseHandler)
    {
        $caseHandlersModels = [
            EmployeePayroll::class,
        ];
        $result = canDelete($caseHandlersModels, 'owner_id', $caseHandler->id);
        if ($result) {
            return $this->sendError(__('messages.case_handlers').' '.__('messages.common.cant_be_deleted'));
        }

        $caseHandler->user()->delete();
        $caseHandler->address()->delete();
        $caseHandler->delete();

        return $this->sendSuccess(__('messages.case_handlers').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $caseHandler = CaseHandler::findOrFail($id);
        $status = ! $caseHandler->user->status;
        $caseHandler->user()->update(['status' => $status]);

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function caseHandlerExport()
    {
        return Excel::download(new CaseHandlerExport, 'case-handlers-'.time().'.xlsx');
    }
}
