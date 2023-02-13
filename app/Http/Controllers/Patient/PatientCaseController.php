<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\PatientCase;
use App\Queries\PatientCaseDataTable;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PatientCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PatientCaseDataTable())->get())
                ->addColumn('patientImageUrl', function (PatientCase $patientCase) {
                    return $patientCase->patient->patientUser->image_url;
                })->addColumn('doctorImageUrl', function (PatientCase $patientCase) {
                    return $patientCase->doctor->doctorUser->image_url;
                })->make(true);
        }

        return view('patients_cases_list.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function show($id)
    {
        $user = Auth::user();
        $patientCase = PatientCase::where('id', $id)->where('patient_id', $user->owner_id)->first();
        if (empty($patientCase)) {
            return view('errors.404');
        } else {
            return view('patients_cases_list.show')->with('patientCase', $patientCase);
        }
    }
}
