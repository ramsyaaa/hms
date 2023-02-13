<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use App\Models\Payment;
use App\Repositories\AccountRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends AppBaseController
{
    /** @var AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $data['statusArr'] = Account::STATUS_ARR;
        $data['typeArr'] = Account::TYPE_ARR;

        return view('accounts.index')->with($data);
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param  CreateAccountRequest  $request
     * @return JsonResponse
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $this->accountRepository->create($input);

        return $this->sendSuccess(__('messages.account.account').' '.__('messages.common.saved_successfully'));
    }

    /**
     * @param  Account  $account
     * @return Factory|View
     */
    public function show(Account $account)
    {
        $payments = $account->payments;

        return view('accounts.show', compact('payments', 'account'));
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param  Account  $account
     * @return JsonResponse
     */
    public function edit(Account $account)
    {
        return $this->sendResponse($account, 'Account retrived successfully.');
    }

    /**
     * Update the specified Account in storage.
     *
     * @param  Account  $account
     * @param  UpdateAccountRequest  $request
     * @return JsonResponse
     */
    public function update(Account $account, UpdateAccountRequest $request)
    {
        $this->accountRepository->update($request->all(), $account->id);

        return $this->sendSuccess(__('messages.account.account').' '.__('messages.common.updated_successfully'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param  Account  $account
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Account $account)
    {
        $accountModel = [
            Payment::class,
        ];
        $result = canDelete($accountModel, 'account_id', $account->id);
        if ($result) {
            return $this->sendError(__('messages.account.account').' '.__('messages.common.cant_be_deleted'));
        }
        $this->accountRepository->delete($account->id);

        return $this->sendSuccess(__('messages.account.account').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  Account  $account
     * @return JsonResponse
     */
    public function activeDeactiveAccount(Account $account)
    {
        $account->status = ! $account->status;
        $account->save();

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }
}
