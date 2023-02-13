<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicineRequest;
use App\Http\Requests\CreatePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Models\Prescription;
use App\Models\User;
use App\Repositories\DoctorRepository;
use App\Repositories\MedicineRepository;
use App\Repositories\PrescriptionRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class PrescriptionController extends AppBaseController
{
    /** @var  PrescriptionRepository
     * @var DoctorRepository
     */
    private $prescriptionRepository;

    private $doctorRepository;

    private $medicineRepository;

    public function __construct(
        PrescriptionRepository $prescriptionRepo,
        DoctorRepository $doctorRepository,
        MedicineRepository $medicineRepository

    ) {
        $this->prescriptionRepository = $prescriptionRepo;
        $this->doctorRepository = $doctorRepository;
        $this->medicineRepository = $medicineRepository;
    }

    /**
     * Display a listing of the Prescription.
     *
     * @param  Request  $request
     * @return Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $data['statusArr'] = Prescription::STATUS_ARR;

        return view('prescriptions.index', $data);
    }

    /**
     * Show the form for creating a new Prescription.
     *
     * @return Factory|View
     */
    public function create()
    {
        $patients = $this->prescriptionRepository->getPatients();
        $medicines = $this->prescriptionRepository->getMedicines();
        $doctors = $this->doctorRepository->getDoctors();
        $data = $this->medicineRepository->getSyncList();
        $medicineList = $this->medicineRepository->getMedicineList($medicines['medicines']);
        $mealList = $this->medicineRepository->getMealList();

        return view('prescriptions.create',
            compact('patients', 'doctors', 'medicines', 'medicineList', 'mealList'))->with($data);
    }

    /**
     * Store a newly created Prescription in storage.
     *
     * @param  CreatePrescriptionRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePrescriptionRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $prescription = $this->prescriptionRepository->create($input);
        $this->prescriptionRepository->createPrescription($input, $prescription);
        $this->prescriptionRepository->createNotification($input);
        Flash::success(__('messages.prescription.prescription').' '.__('messages.common.saved_successfully'));

        return redirect(route('prescriptions.index'));
    }

    /**
     * @param  Prescription  $prescription
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(Prescription $prescription)
    {
        $prescription = $this->prescriptionRepository->find($prescription->id);
        if (empty($prescription)) {
            Flash::error('Prescription not found');

            return redirect(route('prescriptions.index'));
        }

        return view('prescriptions.show')->with('prescription', $prescription);
    }

    /**
     * @param  Prescription  $prescription
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function edit(Prescription $prescription)
    {
        if (checkRecordAccess($prescription->doctor_id)) {
            return view('errors.404');
        } else {
            $prescription->getMedicine;
            $patients = $this->prescriptionRepository->getPatients();
            $doctors = $this->doctorRepository->getDoctors();
            $medicines = $this->prescriptionRepository->getMedicines();
            $data = $this->medicineRepository->getSyncList();
            $medicineList = $this->medicineRepository->getMedicineList($medicines['medicines']);
            $mealList = $this->medicineRepository->getMealList();

            return view('prescriptions.edit',
                compact('patients', 'prescription', 'doctors', 'medicines', 'medicineList', 'mealList'))->with($data);
        }
    }

    /**
     * @param  Prescription  $prescription
     * @param  UpdatePrescriptionRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function update(Prescription $prescription, UpdatePrescriptionRequest $request)
    {
        $prescription = $this->prescriptionRepository->find($prescription->id);
        if (empty($prescription)) {
            Flash::error('Prescription not found');

            return redirect(route('prescriptions.index'));
        }
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $this->prescriptionRepository->updatePrescription($prescription, $request->all());

        Flash::success(__('messages.prescription.prescription').' '.__('messages.common.updated_successfully'));

        return redirect(route('prescriptions.index'));
    }

    /**
     * @param  Prescription  $prescription
     * @return JsonResponse|RedirectResponse|Redirector
     *
     * @throws Exception
     */
    public function destroy(Prescription $prescription)
    {
        if (checkRecordAccess($prescription->doctor_id)) {
            $this->sendError(__('messages.prescription.prescription').' '.__('messages.common.not_found'));
        } else {
            $prescription = $this->prescriptionRepository->find($prescription->id);
            if (empty($prescription)) {
                Flash::error('Prescription not found');

                return redirect(route('prescriptions.index'));
            }
            $prescription->delete();

            return $this->sendSuccess(__('messages.prescription.prescription').' '.__('messages.common.deleted_successfully'));
        }
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $prescription = Prescription::findOrFail($id);
        if (checkRecordAccess($prescription->doctor_id)) {
            return $this->sendError(__('messages.prescription.prescription').' '.__('messages.common.not_found'));
        } else {
            $status = ! $prescription->status;
            $prescription->update(['status' => $status]);

            return $this->sendSuccess(__('messages.common.status_updated_successfully'));
        }
    }
//
//    /**
//     * @param $id
//     *
//     * @return JsonResponse
//     */
//    public function showModal($id)
//    {
//        $prescription = $this->prescriptionRepository->find($id);
//        $prescription->load(['patient.user', 'doctor.user']);
//        if (empty($prescription)) {
//            return $this->sendError('Prescription Not Found');
//        }
//
//        return $this->sendResponse($prescription, 'Prescription Retrieved Successfully');
//    }

    /**
     * @param $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function prescriptionsView($id)
    {
        $data = $this->prescriptionRepository->getSettingList();

        $prescription = $this->prescriptionRepository->getData($id);
        if (checkRecordAccess($prescription['prescription']->doctor_id)) {
            return view('errors.404');
        } else {
            $medicines = $this->prescriptionRepository->getMedicineData($id);

            return view('prescriptions.view', compact('prescription', 'medicines', 'data'));
        }
    }

    /**
     * @param  \App\Http\Requests\CreateMedicineRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function prescreptionMedicineStore(CreateMedicineRequest $request)
    {
        $input = $request->all();

        $this->medicineRepository->create($input);

        return $this->sendSuccess('Medicine saved successfully.');
    }

    /**
     * @param $id
     * @return Response
     */
    public function convertToPDF($id): Response
    {
        $data = $this->prescriptionRepository->getSettingList();

        $prescription = $this->prescriptionRepository->getData($id);

        $medicines = $this->prescriptionRepository->getMedicineData($id);

//        App::setLocale(getCurrentLoginUserLanguageName());

        $pdf = PDF::loadView('prescriptions.prescription_pdf', compact('prescription', 'medicines', 'data'));

        return $pdf->stream($prescription['prescription']->patient->patientUser->full_name.'-'.$prescription['prescription']->id);
    }
}
