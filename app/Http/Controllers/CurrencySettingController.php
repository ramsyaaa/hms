<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createcurrency_settingRequest;
use App\Http\Requests\UpdateCurrencySettingRequest;
use App\Models\CurrencySetting;
use App\Repositories\currency_settingRepository;
use Flash;
use Illuminate\Http\Request;

class CurrencySettingController extends AppBaseController
{
    /** @var currency_settingRepository */
    private $currencySettingRepository;

    public function __construct(currency_settingRepository $currencySettingRepo)
    {
        $this->currencySettingRepository = $currencySettingRepo;
    }

    /**
     * Display a listing of the currency_setting.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $currencySettings = $this->currencySettingRepository->all();

        return view('currency_settings.index')
            ->with('currencySettings', $currencySettings);
    }

    /**
     * Show the form for creating a new currency_setting.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('currency_settings.create');
    }

    /**
     * Store a newly created currency_setting in storage.
     *
     * @param  Createcurrency_settingRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Createcurrency_settingRequest $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();

        $this->currencySettingRepository->create($input);

        return $this->sendSuccess('Currency saved successfully');
    }

    /**
     * Display the specified currency_setting.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        $currencySetting = $this->currencySettingRepository->find($id);

        if (empty($currencySetting)) {
            Flash::error('Currency Setting not found');

            return redirect(route('currencySettings.index'));
        }

        return view('currency_settings.show')->with('currencySetting', $currencySetting);
    }

    /**
     * Show the form for editing the specified currency_setting.
     *
     * @param  \App\Models\CurrencySetting  $currencySetting
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(CurrencySetting $currencySetting)
    {
        return $this->sendResponse($currencySetting, 'Currency retrieved successfully.');
    }

    /**
     * Update the specified currency_setting in storage.
     *
     * @param  \App\Models\CurrencySetting  $currencySetting
     * @param  \App\Http\Requests\UpdateCurrencySettingRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CurrencySetting $currencySetting, UpdateCurrencySettingRequest $request)
    {
        $input = $request->all();

        $this->currencySettingRepository->update($input, $currencySetting->id);

        return $this->sendSuccess('Currency updated successfully');
    }

    /**
     * Remove the specified currency_setting from storage.
     *
     * @param  \App\Models\CurrencySetting  $currencySetting
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy(CurrencySetting $currencySetting)
    {
        $this->currencySettingRepository->delete($currencySetting->id);

        return $this->sendSuccess('Currency deleted');
    }
}
