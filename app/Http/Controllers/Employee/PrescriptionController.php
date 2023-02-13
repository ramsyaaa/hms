<?php

namespace App\Http\Controllers\Employee;

use App\Exports\PrescriptionExport;
use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('employee_prescription_list.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $prescription = Prescription::findOrFail($id);

        return view('employee_prescription_list.show')->with('prescription', $prescription);
    }

    /**
     * @return BinaryFileResponse
     */
    public function prescriptionExport()
    {
        return Excel::download(new PrescriptionExport, 'prescriptions-'.time().'.xlsx');
    }
}
