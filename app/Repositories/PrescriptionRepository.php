<?php

namespace App\Repositories;

use App\Models\Medicine;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\PrescriptionMedicineModal;
use App\Models\Setting;
use Auth;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class PrescriptionRepository
 *
 * @version March 31, 2020, 12:22 pm UTC
 */
class PrescriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'food_allergies',
        'tendency_bleed',
        'heart_disease',
        'high_blood_pressure',
        'diabetic',
        'surgery',
        'accident',
        'others',
        'medical_history',
        'current_medication',
        'female_pregnancy',
        'breast_feeding',
        'health_insurance',
        'low_income',
        'reference',
        'status',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Prescription::class;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getPatients()
    {
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $patients = getPatientsList($user->owner_id);
        } else {
            $patients = Patient::with('patientUser')
                ->whereHas('patientUser', function (Builder $query) {
                    $query->where('status', 1);
                })->get()->pluck('patientUser.full_name', 'id')->sort();
        }

        return $patients;
    }

    /**
     * @param  array  $prescription
     * @param  array  $input
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($prescription, $input)
    {
        try {
            /** @var Prescription $prescription */
            $prescription->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     */
    public function createNotification($input)
    {
        try {
            $patient = Patient::with('patientUser')->where('id', $input['patient_id'])->first();

            addNotification([
                Notification::NOTIFICATION_TYPE['Prescription'],
                $patient->user_id,
                Notification::NOTIFICATION_FOR[Notification::PATIENT],
                $patient->patientUser->full_name.' your prescription has been created.',
            ]);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function createPrescription($input, $prescription)
    {
        try {
            foreach ($input['medicine'] as $key => $value) {
                $PrescriptionItem = [
                    'prescription_id' => $prescription->id,
                    'medicine'        => $input['medicine'][$key],
                    'dosage'          => $input['dosage'][$key],
                    'day'             => $input['day'][$key],
                    'time'            => $input['time'][$key],
                    'comment'         => $input['comment'][$key],
                ];
                PrescriptionMedicineModal::create($PrescriptionItem);
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $prescription
     * @param $input
     * @return mixed
     */
    public function updatePrescription($prescription, $input)
    {
        try {
            $prescriptionMedicineArr = \Arr::only($input, $this->model->getFillable());
            $prescription->update($prescriptionMedicineArr);
            $prescription->getMedicine()->delete();

            if (! empty($input['medicine'])) {
                foreach ($input['medicine'] as $key => $value) {
                    $PrescriptionItem = [
                        'prescription_id' => $prescription->id,
                        'medicine'        => $input['medicine'][$key],
                        'dosage'          => $input['dosage'][$key],
                        'day'             => $input['day'][$key],
                        'time'            => $input['time'][$key],
                        'comment'         => $input['comment'][$key],
                    ];
                    PrescriptionMedicineModal::create($PrescriptionItem);
                }
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return $prescription;
    }

    public function prepareInputForServicePackageItem($prescriptionMedicineArr): array
    {
        $items = [];
        foreach ($prescriptionMedicineArr as $key => $data) {
            foreach ($data as $index => $value) {
                $items[$index][$key] = $value;
            }
        }

        return $items;
    }

    public function getData($id)
    {
        static $data;
        
        if(empty($data))
        {
            $data['prescription'] = Prescription::with('patient', 'doctor', 'getMedicine.medicines')
                ->findOrFail($id);    
        }
        
        return $data;
    }

    public function getMedicineData($id)
    {
//        $data['prescription'] = Prescription::with('patient', 'doctor', 'getMedicine')
//            ->findOrFail($id);
        $data = $this->getData($id)['prescription'];
        $medicines = [];
        foreach ($data->getMedicine as $medicine) {
            $data['medicine'] = Medicine::where('id', $medicine->medicine)->get();
            array_push($medicines, $data['medicine']);
        }

        return $medicines;
    }

    /**
     * @param  null  $prescriptionId
     * @return array
     */
    public function getSyncListForCreate($prescriptionId = null)
    {
        $setting = Setting::all()->pluck('value', 'key')->toArray();

        return $setting;
    }

    /**
     * @return array
     */
    public function getSettingList()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return $settings;
    }

    public function getMedicines()
    {
        $data['medicines'] = Medicine::all()->pluck('name', 'id')->toArray();

        return $data;
    }
}
