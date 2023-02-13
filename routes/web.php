<?php

use App\Http\Controllers\AccountantController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\AdvancedPaymentController;
use App\Http\Controllers\AmbulanceCallController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\AppointmentCalendarController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BedAssignController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BedTypeController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BirthReportController;
use App\Http\Controllers\BloodBankController;
use App\Http\Controllers\BloodDonationController;
use App\Http\Controllers\BloodDonorController;
use App\Http\Controllers\BloodIssueController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CallLogController;
use App\Http\Controllers\CaseHandlerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChargeCategoryController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CurrencySettingController;
use App\Http\Controllers\DeathReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DiagnosisCategoryController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDepartmentController;
use App\Http\Controllers\DoctorOPDChargeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\Employee;
use App\Http\Controllers\EmployeePayrollController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrontServiceController;
use App\Http\Controllers\FrontSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HospitalScheduleController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\InvestigationReportController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\IpdBillController;
use App\Http\Controllers\IpdChargeController;
use App\Http\Controllers\IpdConsultantRegisterController;
use App\Http\Controllers\IpdDiagnosisController;
use App\Http\Controllers\IpdPatientDepartmentController;
use App\Http\Controllers\IpdPaymentController;
use App\Http\Controllers\IpdPrescriptionController;
use App\Http\Controllers\IpdTimelineController;
use App\Http\Controllers\IssuedItemController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemStockController;
use App\Http\Controllers\LabTechnicianController;
use App\Http\Controllers\LiveConsultationController;
use App\Http\Controllers\LiveMeetingController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\OpdDiagnosisController;
use App\Http\Controllers\OpdPatientDepartmentController;
use App\Http\Controllers\OpdTimelineController;
use App\Http\Controllers\OperationReportController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PathologyCategoryController;
use App\Http\Controllers\PathologyTestController;
use App\Http\Controllers\Patient;
use App\Http\Controllers\PatientAdmissionController;
use App\Http\Controllers\PatientCaseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientDiagnosisTestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentReportController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\PostalController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\RadiologyCategoryController;
use App\Http\Controllers\RadiologyTestController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccinatedPatientController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/users/creates', function () {
    return view('users.new_create');
});

// Routes for Landing Page starts
Route::middleware('setLanguage')->group(function () {
    Route::get('/', [Web\WebController::class, 'index'])->name('front');
    // Routes for Enquiry Form
    Route::post('send-enquiry', [EnquiryController::class, 'store'])->name('send.enquiry');
    Route::get('/contact-us', [EnquiryController::class, 'contactUs'])->name('contact');
    Route::get('/about-us', [Web\WebController::class, 'aboutUs'])->name('aboutUs');
    Route::post('/book-appointment', [Web\WebController::class, 'bookAppointment'])->name('book-appointment');
    Route::get('/appointment', [Web\WebController::class, 'appointment'])->name('appointment');
    Route::post('/appointment-form', [Web\WebController::class, 'appointmentFromOther'])->name('appointment.post');
    Route::get('/our-services', [Web\WebController::class, 'services'])->name('our-services');
    Route::get('/bed-availability', [Web\WebController::class, 'beds'])->name('beds');
    Route::get('/our-doctors', [Web\WebController::class, 'doctors'])->name('our-doctors');
    Route::get('/terms-of-service', [Web\WebController::class, 'termsOfService'])->name('terms-of-service');
    Route::get('/privacy-policy', [Web\WebController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/working-hours', [Web\WebController::class, 'workingHours'])->name('working-hours');
    Route::get('/testimonial', [Web\WebController::class, 'testimonials'])->name('testimonials');
});

//Change language
Route::post('/change-language', [Web\WebController::class, 'changeLanguage']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout.user');
Route::get('/demo', [Web\WebController::class, 'demo'])->name('demo');
Route::get('/modules-of-hms', [Web\WebController::class, 'modulesOfHms'])->name('modules-of-hms');
// Routes for Landing Page ends

// Routes for Appointment
Route::get('appointments/{email}/patient-detail',
    [Web\AppointmentController::class, 'getPatientDetails'])->name('appointment.patient.details');
Route::get('appointment-doctors-list', [Web\AppointmentController::class, 'getDoctors'])->name('appointment.doctor.list');
Route::get('appointment-doctor-list', [Web\AppointmentController::class, 'getDoctorList'])->name('appointment.doctors.list');
Route::get('appointment-booking-slot',
    [Web\AppointmentController::class, 'getBookingSlot'])->name('appointment.get.booking.slot');
Route::get('appointment-doctor-schedule-list', [ScheduleController::class, 'doctorScheduleList'])->name('doctor-schedule-list');
Route::post('appointment-store', [Web\AppointmentController::class, 'store'])->name('web.appointments.store');

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->middleware('verified');

Route::get('theme-mode', [UserController::class, 'changeThemeMode'])->name('user.mode');

Route::middleware('auth', 'verified', 'xss', 'checkUserStatus')->group(function () {
    Route::get('profile', [UserController::class, 'editProfile']);
    Route::post('change-password', [UserController::class, 'changePassword']);
    Route::post('profile-update', [UserController::class, 'profileUpdate']);
    Route::post('update-language', [UserController::class, 'updateLanguage']);

    // stripe payment
    Route::post('/stripe-charge', [StripeController::class, 'createSession']);
    Route::get('payment-success', [StripeController::class, 'paymentSuccess'])->name('payment-success');
    Route::get('failed-payment', [StripeController::class, 'handleFailedPayment'])->name('failed-payment');

    Route::middleware('role:Admin|Patient|Doctor|Receptionist|Nurse|Accountant|Lab Technician|Pharmacist|Case Manager')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('notice-board', [Employee\NoticeBoardController::class, 'index'])->name('employee.noticeboard')->middleware('modules');
            Route::get('notice-board/{id}', [Employee\NoticeBoardController::class, 'show'])->name('noticeboard.show');
            Route::get('export-my-payrolls', [Employee\PayrollController::class, 'userPayrollExport'])->name('my.payrolls.excel');
        });
    });

    Route::middleware('role:Admin|Doctor|Receptionist|Nurse|Accountant|Lab Technician|Pharmacist|Case Manager')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('payroll', [Employee\PayrollController::class, 'index'])->name('payroll')->middleware('modules');
        });
    });

    Route::middleware('role:Admin|Patient|Doctor')->group(function () {
        Route::resource('documents', DocumentController::class);
        Route::get('documents', [DocumentController::class, 'index'])->name('documents.index')->middleware('modules');
        Route::post('documents/{document}/update', [DocumentController::class, 'update']);
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist')->group(function () {
        // Routes for Patients Cases listing
        Route::prefix('patient')->group(function () {
            Route::get('my-cases', [Patient\PatientCaseController::class, 'index'])->name('patients.cases')->middleware('modules');
            Route::get('my-cases/{id}', [Patient\PatientCaseController::class, 'show'])->name('patient.cases.show');

            // Routes for Prescription Listing
            Route::get('my-prescriptions', [Patient\PrescriptionController::class, 'index'])->name('prescriptions.list');
            Route::get('my-prescriptions/{id}', [Patient\PrescriptionController::class, 'show'])->name('prescription.show');
        });
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist')->group(function () {
        // Listing common routes to be accessible by Admin, Doctor, Receptionist and Patient for IPD Patient modules.
        Route::get('ipd-diagnosis', [IpdDiagnosisController::class, 'index'])->name('ipd.diagnosis.index');
        Route::get('ipd-consultant-register',
            [IpdConsultantRegisterController::class, 'index'])->name('ipd.consultant.index');
        Route::get('ipd-charges', [IpdChargeController::class, 'index'])->name('ipd.charge.index');
        Route::get('ipd-prescription', [IpdPrescriptionController::class, 'index'])->name('ipd.prescription.index');
        Route::get('ipd-prescription/{ipdPrescription}',
            [IpdPrescriptionController::class, 'show'])->name('ipd.prescription.show');
        Route::get('ipd-timelines', [IpdTimelineController::class, 'index'])->name('ipd.timelines.index');
        Route::get('ipd-payments', [IpdPaymentController::class, 'index'])->name('ipd.payments.index');
        Route::get('ipd-bills/{ipdPatientDepartment}/pdf', [IpdBillController::class, 'ipdBillConvertToPdf'])
            ->where('ipdPatientDepartment', '[0-9]+');

        Route::get('ipd-diagnosis-download/{ipdDiagnosis}', [IpdDiagnosisController::class, 'downloadMedia']);
        Route::get('ipd-payment-download/{ipdPayment}', [IpdPaymentController::class, 'downloadMedia']);
        Route::get('ipd-timeline-download/{ipdTimeline}', [IpdTimelineController::class, 'downloadMedia']);

        // Listing common routes to be accessible by Admin, Doctor, Receptionist and Patient for OPD Patient modules.
        Route::get('opd-diagnosis', [OpdDiagnosisController::class, 'index'])->name('opd.diagnosis.index');
        Route::get('opd-diagnosis-download/{opdDiagnosis}', [OpdDiagnosisController::class, 'downloadMedia']);
        Route::get('opd-timelines', [OpdTimelineController::class, 'index'])->name('opd.timelines.index');
        Route::get('opd-timelines-download/{opdTimeline}', [OpdTimelineController::class, 'downloadMedia']);
    });

    // excel export routes.
    Route::middleware('role:Patient')->group(function () {
        Route::prefix('patient')->group(function () {
            Route::get('export-prescription',
                [Patient\PrescriptionController::class, 'prescriptionExport'])->name('prescription.excel');

            Route::get('my-ipds', [Patient\IpdPatientDepartmentController::class, 'index'])->name('patient.ipd');
            Route::get('my-ipds/{ipdPatientDepartment}',
                [Patient\IpdPatientDepartmentController::class, 'show'])->name('patient.ipd.show');

            Route::get('my-opds', [Patient\OpdPatientDepartmentController::class, 'index'])->name('patient.opd');
            Route::get('my-opds/{opdPatientDepartment}',
                [Patient\OpdPatientDepartmentController::class, 'show'])->name('patient.opd.show');

            Route::get('my-vaccinated', [Patient\VaccinatedController::class, 'index'])->name('patient.vaccinated');
        });
    });

    // excel export routes.
    Route::middleware('role:Patient|Doctor|Receptionist')->group(function () {
        Route::get('export-appointments', [AppointmentController::class, 'appointmentExport'])->name('appointments.excel');
    });

    // excel export routes.
    Route::middleware('role:Doctor')->group(function () {
        Route::prefix('doctor')->group(function () {
            Route::get('export-schedules', [ScheduleController::class, 'schedulesExport'])->name('schedules.excel');
        });
    });

    // excel export routes.
    Route::middleware('role:Nurse|Doctor')->group(function () {
        Route::get('export-bed-assign', [BedAssignController::class, 'bedAssignExport'])->name('bed.assigns.excel');
    });

    // excel export routes.
    Route::middleware('role:Admin|Doctor|Case Manager|Receptionist')->group(function () {
        Route::get('export-patient-admissions',
            [PatientAdmissionController::class, 'patientAdmissionExport'])->name('patient.admissions.excel');
    });

    // excel export routes.
    Route::middleware('role:Nurse')->group(function () {
        Route::prefix('nurse')->group(function () {
            Route::get('export-beds', [BedController::class, 'bedExport'])->name('beds.excel');
        });
    });

    // excel export routes.
    Route::middleware('role:Receptionist|Case Manager')->group(function () {
        Route::get('export-patient-cases', [PatientCaseController::class, 'patientCaseExport'])->name('patient.cases.excel');
    });

    // excel export routes.
    Route::middleware('role:Receptionist|Lab Technician')->group(function () {
        Route::get('export-patient-diagnosis-test',
            [PatientDiagnosisTestController::class, 'patientDiagnosisTestExport'])->name('patient.diagnosis.test.excel');
    });

    // excel export routes.
    Route::middleware('role:Receptionist')->group(function () {
        Route::prefix('receptionist')->group(function () {
            Route::get('export-insurances', [InsuranceController::class, 'insuranceExport'])->name('insurances.excel');
            Route::get('export-packages', [PackageController::class, 'packageExport'])->name('packages.excel');
            Route::get('export-charges', [ChargeController::class, 'chargeExport'])->name('charges.excel');
            Route::get('export-doctor-opd-charges',
                [DoctorOPDChargeController::class, 'doctorOPDChargeExport'])->name('doctor.opd.charges.excel');
        });
    });

    // excel export routes.
    Route::middleware('role:Pharmacist')->group(function () {
        Route::prefix('pharmacist')->group(function () {
            Route::get('export-brands', [BrandController::class, 'brandExport'])->name('brands.excel');
            Route::get('export-medicines', [MedicineController::class, 'medicineExport'])->name('medicines.excel');
        });
    });

    // excel export routes.
    Route::middleware('role:Accountant')->group(function () {
        Route::prefix('accountant')->group(function () {
            Route::get('export-employee-payrolls',
                [EmployeePayrollController::class, 'employeePayrollExport'])->name('employee.payrolls.excel');
            Route::get('export-services', [ServiceController::class, 'serviceExport'])->name('services.excel');
        });
    });

    // excel export routes.
    Route::middleware('role:Case Manager')->group(function () {
        Route::get('export-ambulance-calls',
            [AmbulanceCallController::class, 'ambulanceCallExport'])->name('ambulance.calls.excel');
    });

    // excel export routes.
    Route::middleware('role:Lab Technician')->group(function () {
        Route::get('export-blood-banks', [BloodBankController::class, 'bloodBankExport'])->name('blood.banks.excel');
        Route::get('export-blood-donors', [BloodDonorController::class, 'bloodDonorExport'])->name('blood.donors.excel');
        Route::get('export-blood-donations',
            [BloodDonationController::class, 'bloodDonationExport'])->name('blood.donations.excel');
        Route::get('export-blood-issues', [BloodIssueController::class, 'export'])->name('blood.issues.excel');
        Route::get('export-radiology-tests',
            [RadiologyTestController::class, 'radiologyTestExport'])->name('radiology.tests.excel');
        Route::get('export-pathology-tests',
            [PathologyTestController::class, 'pathologyTestExport'])->name('pathology.tests.excel');
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist|Nurse|Case Manager|Accountant')->group(function () {
        Route::get('patients/{patient}', [PatientController::class, 'show'])->where('patient',
                '[0-9]+')->name('patients.show');
        Route::get('patient/{patient?}', [PatientController::class, 'getBirthDate'])->name('patients.birthDate');
    });

    Route::middleware('role:Admin|Doctor|Receptionist|Accountant')->group(function () {
        Route::get('doctors/{doctor}', [DoctorController::class, 'show'])->where('doctor', '[0-9]+')->name('doctors_show');
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist|Nurse')->group(function () {
        Route::resource('appointments', AppointmentController::class);
        Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index')->middleware('modules');
        Route::post('appointments/{appointment}', [AppointmentController::class, 'update']);
        Route::get('doctors-list', [AppointmentController::class, 'getDoctors']);
        Route::get('appointment-calendars', [AppointmentCalendarController::class, 'index'])->name('appointment-calendars.index');
        Route::get('calendar-list', [AppointmentCalendarController::class, 'calendarList']);
        Route::get('appointment-detail/{appointment}',
            [AppointmentCalendarController::class, 'getAppointmentDetails'])->name('appointment.details');
        Route::post('appointments/{appointment}/status', [AppointmentController::class, 'status'])
            ->name('appointment.status');
        Route::post('appointments/{appointment}/cancel', [AppointmentController::class, 'cancelAppointment'])
            ->name('appointment.cancel');
    });

    Route::middleware('role:Admin|Receptionist|Patient')->group(function () {
        Route::get('booking-slot', [AppointmentController::class, 'getBookingSlot'])->name('get.booking.slot');
        Route::get('doctor-schedule-list', [ScheduleController::class, 'doctorScheduleList'])->name('admin-doctor-schedule-list');
    });

    Route::middleware('role:Admin|Doctor|Nurse')->group(function () {
        Route::resource('bed-assigns', BedAssignController::class);
        Route::get('bed-assigns', [BedAssignController::class, 'index'])->name('bed-assigns.index')->middleware('modules');
        Route::post('bed-assigns/{bed_assign}/active-deactive', [BedAssignController::class, 'activeDeactiveStatus']);
        Route::get('bed-status', [BedAssignController::class, 'bedStatus'])->name('bed-status');
        Route::get('ipd-patients-list', [BedAssignController::class, 'getIpdPatientsList'])->name('ipd.patient.list');
    });

    Route::middleware('role:Admin|Doctor|Nurse|Receptionist')->group(function () {
        Route::get('beds/{bed}', [BedController::class, 'show'])->where('bed', '[0-9]+');
    });

    Route::middleware('role:Admin|Doctor|Receptionist|Patient')->group(function () {
        Route::get('doctor-departments/{doctorDepartment}', [DoctorDepartmentController::class, 'show'])
            ->where('doctorDepartment', '[0-9]+');
    });

    Route::middleware('role:Admin|Receptionist|Case Manager')->group(function () {
        Route::get('patient-cases', [PatientCaseController::class, 'index'])->name('patient-cases.index')->middleware('modules');
        Route::post('patient-cases', [PatientCaseController::class, 'store'])->name('patient-cases.store');
        Route::get('patient-cases/create', [PatientCaseController::class, 'create'])->name('patient-cases.create');
        Route::delete('patient-cases/{patient_case}', [PatientCaseController::class, 'destroy'])
            ->name('patient-cases.destroy');
        Route::patch('patient-cases/{patient_case}', [PatientCaseController::class, 'update'])
            ->name('patient-cases.update');
        Route::get('patient-cases/{patient_case}/edit', [PatientCaseController::class, 'edit'])
            ->name('patient-cases.edit');
        Route::post('patient-cases/{case_id}/active-deactive', [PatientCaseController::class, 'activeDeActiveStatus']);
    });

    Route::middleware('role:Admin|Receptionist|Case Manager|Doctor')->group(function () {
        Route::resource('charge-categories', ChargeCategoryController::class);
        Route::get('charge-categories',
            [ChargeCategoryController::class, 'index'])->name('charge-categories.index')->middleware('modules');

        Route::resource('charges', ChargeController::class);
        Route::get('charges', [ChargeController::class, 'index'])->name('charges.index')->middleware('modules');
        Route::get('get-charge-categories', [ChargeController::class, 'getChargeCategory']);

        //Doctor OPD Charge Routes
        Route::get('doctor-opd-charges',
            [DoctorOPDChargeController::class, 'index'])->name('doctor-opd-charges.index')->middleware('modules');
        Route::post('doctor-opd-charges', [DoctorOPDChargeController::class, 'store'])->name('doctor-opd-charges.store');
        Route::get('doctor-opd-charges/create', [DoctorOPDChargeController::class, 'create'])->name('doctor-opd-charges.create');
        Route::delete('doctor-opd-charges/{doctorOPDCharge}',
            [DoctorOPDChargeController::class, 'destroy'])->name('doctor-opd-charges.destroy');
        Route::patch('doctor-opd-charges/{doctorOPDCharge}',
            [DoctorOPDChargeController::class, 'update'])->name('doctor-opd-charges.update');
        Route::get('doctor-opd-charges/{doctorOPDCharge}/edit',
            [DoctorOPDChargeController::class, 'edit'])->name('doctor-opd-charges.edit');

        Route::get('doctors', [DoctorController::class, 'index'])->name('doctors.index')->middleware('modules');
        Route::post('doctors', [DoctorController::class, 'store'])->name('doctors.store');
        Route::get('doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
        Route::delete('doctors/{doctor}', [DoctorController::class, 'destroy'])
            ->name('doctors.destroy');
        Route::patch('doctors/{doctor}', [DoctorController::class, 'update'])
            ->name('doctors.update');
        Route::get('doctors/{doctor}/edit', [DoctorController::class, 'edit'])
            ->name('doctors.edit');
        Route::post('doctors/{doctor}/active-deactive', [DoctorController::class, 'activeDeactiveStatus']);
        Route::get('export-doctors', [DoctorController::class, 'doctorExport'])->name('doctors.excel');

        // Listing route for the Enquiry Form details
        Route::get('enquiries', [EnquiryController::class, 'index'])->name('enquiries')->middleware('modules');
        Route::post('enquiries/{id}/active-deactive', [EnquiryController::class, 'activeDeactiveStatus']);
        Route::get('enquiry/{enquiry}', [EnquiryController::class, 'show'])->name('enquiry.show');

        // Radiology Categories routes
        Route::get('radiology-categories',
            [RadiologyCategoryController::class, 'index'])->name('radiology.category.index')->middleware('modules');
        Route::post('radiology-categories', [RadiologyCategoryController::class, 'store'])->name('radiology.category.store');
        Route::get('radiology-categories/{radiologyCategory}/edit',
            [RadiologyCategoryController::class, 'edit'])->name('radiology.category.edit');
        Route::patch('radiology-categories/{radiologyCategory}',
            [RadiologyCategoryController::class, 'update'])->name('radiology.category.update');
        Route::delete('radiology-categories/{radiologyCategory}',
            [RadiologyCategoryController::class, 'destroy'])->name('radiology.category.destroy');

        // Pathology Categories routes
        Route::get('pathology-categories',
            [PathologyCategoryController::class, 'index'])->name('pathology.category.index')->middleware('modules');
        Route::post('pathology-categories', [PathologyCategoryController::class, 'store'])->name('pathology.category.store');
        Route::get('pathology-categories/{pathologyCategory}/edit',
            [PathologyCategoryController::class, 'edit'])->name('pathology.category.edit');
        Route::patch('pathology-categories/{pathologyCategory}',
            [PathologyCategoryController::class, 'update'])->name('pathology.category.update');
        Route::delete('pathology-categories/{pathologyCategory}',
            [PathologyCategoryController::class, 'destroy'])->name('pathology.category.destroy');

        Route::get('doctor-opd-charges',
            [DoctorOPDChargeController::class, 'index'])->name('doctor-opd-charges.index')->middleware('modules');
        Route::post('doctor-opd-charges', [DoctorOPDChargeController::class, 'store'])->name('doctor-opd-charges.store');
        Route::get('doctor-opd-charges/create', [DoctorOPDChargeController::class, 'create'])->name('doctor-opd-charges.create');
        Route::delete('doctor-opd-charges/{doctorOPDCharge}',
            [DoctorOPDChargeController::class, 'destroy'])->name('doctor-opd-charges.destroy');
        Route::patch('doctor-opd-charges/{doctorOPDCharge}',
            [DoctorOPDChargeController::class, 'update'])->name('doctor-opd-charges.update');
        Route::get('doctor-opd-charges/{doctorOPDCharge}/edit',
            [DoctorOPDChargeController::class, 'edit'])->name('doctor-opd-charges.edit');

        Route::get('patients', [PatientController::class, 'index'])->name('patients.index')->middleware('modules');
        Route::post('patients', [PatientController::class, 'store'])->name('patients.store');
        Route::get('patients/create', [PatientController::class, 'create'])->name('patients.create');
        Route::delete('patients/{patient}', [PatientController::class, 'destroy'])
            ->name('patients.destroy');
        Route::patch('patients/{patient}', [PatientController::class, 'update'])
            ->name('patients.update');
        Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])
            ->name('patients.edit');
        Route::post('patients/{patient}/active-deactive', [PatientController::class, 'activeDeactiveStatus']);
        Route::get('export-patients', [PatientController::class, 'patientExport'])->name('patient.excel');

        Route::resource('case-handlers', CaseHandlerController::class)->parameters(['case-handlers' => 'caseHandler']);
        Route::get('case-handlers', [CaseHandlerController::class, 'index'])->name('case-handlers.index')->middleware('modules');
        Route::post('case-handlers/{case_id}/active-deactive', [CaseHandlerController::class, 'activeDeactiveStatus']);
        Route::get('export-case-handlers', [CaseHandlerController::class, 'caseHandlerExport'])->name('case.handler.excel');
    });

    Route::middleware('role:Admin|Doctor|Lab Technician|Pharmacist|Case Manager|Accountant|Receptionist')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('doctor', [Employee\DoctorController::class, 'index'])->name('doctor');
            Route::get('doctor/{id}', [Employee\DoctorController::class, 'show'])->name('doctor.show');
        });
    });

    Route::middleware('role:Pharmacist')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('prescriptions', [Employee\PrescriptionController::class, 'index'])->name('employee.prescriptions');
            Route::get('prescriptions/{id}', [Employee\PrescriptionController::class, 'show'])->name('employee.prescriptions.show');
            Route::get('export-prescription',
                    [Employee\PrescriptionController::class, 'prescriptionExport'])->name('employee.prescriptions.excel');
        });
    });

    Route::middleware('role:Admin|Lab Technician|Pharmacist')->group(function () {
        Route::resource('medicines', MedicineController::class)->parameters(['medicines' => 'medicine']);
        Route::get('medicines', [MedicineController::class, 'index'])->name('medicines.index')->middleware('modules');
        Route::get('medicines-show-modal/{medicine}', [MedicineController::class, 'showModal'])->name('medicines.show.modal');

        Route::resource('categories', CategoryController::class)->parameters(['categories' => 'category']);
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index')->middleware('modules');
        Route::post('categories/{category_id}/active-deactive',
            [CategoryController::class, 'activeDeActiveCategory'])->name('active.deactive');

        Route::get('brands', [BrandController::class, 'index'])->name('brands.index')->middleware('modules');
        Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
        Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
        Route::patch('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::get('brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
    });

    Route::middleware('role:Admin|Doctor|Case Manager|Patient|Receptionist')->group(function () {
        Route::get('patient-admissions',
            [PatientAdmissionController::class, 'index'])->name('patient-admissions.index')->middleware('modules');
        Route::get('insurances/{insurance}', [InsuranceController::class, 'show'])->where('insurance', '[0-9]+');
        Route::get('packages/{package}', [PackageController::class, 'show'])->where('package', '[0-9]+');
    });

    Route::middleware('role:Admin|Patient')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('patient-admissions', [Employee\PatientAdmissionController::class, 'index'])->name('patient-admissions');
            Route::get('patient-admissions/{patient_admission}', [Employee\PatientAdmissionController::class, 'show'])
                ->name('patient.patient-admissions.show')->where('patient_admission', '[0-9]+');
            Route::get('invoices', [Employee\InvoiceController::class, 'index'])->name('invoices');
            Route::get('invoices/{invoice}', [Employee\InvoiceController::class, 'show'])
                ->name('patient.invoices.show')->where('invoice', '[0-9]+');
            Route::get('invoices/{invoice}/pdf', [Employee\InvoiceController::class, 'convertToPdf'])
                ->where('invoice', '[0-9]+');
            Route::get('bills', [Employee\BillController::class, 'index'])->name('employee.bills.index')->middleware('modules');
            Route::get('bills/{bill}', [Employee\BillController::class, 'show'])
                ->name('employee.bills.show')->where('bill', '[0-9]+');
            Route::get('bills/{bill}/pdf', [Employee\BillController::class, 'convertToPdf'])
                ->where('bill', '[0-9]+');
        });
    });

    Route::middleware('role:Admin|Doctor|Case Manager|Receptionist')->group(function () {
        Route::get('patient-admissions/{patient_admission}', [PatientAdmissionController::class, 'show'])
            ->name('patient-admissions.shosw')->where('patient_admission', '[0-9]+');
        Route::get('patient-admissions-show/{patient_admission}', [PatientAdmissionController::class, 'showModal'])
            ->name('patient-admissions.show.modal')->where('patient_admission', '[0-9]+');
        Route::post('patient-admissions', [PatientAdmissionController::class, 'store'])->name('patient-admissions.store');
        Route::get('patient-admissions/create', [PatientAdmissionController::class, 'create'])->name('patient-admissions.create');
        Route::delete('patient-admissions/{patient_admission}', [PatientAdmissionController::class, 'destroy'])
            ->name('patient-admissions.destroy');
        Route::patch('patient-admissions/{patient_admission}', [PatientAdmissionController::class, 'update'])
            ->name('patient-admissions.update');
        Route::get('patient-admissions/{patient_admission}/edit', [PatientAdmissionController::class, 'edit'])
            ->name('patient-admissions.edit');
        Route::post('patient-admissions/{id}/active-deactive', [PatientAdmissionController::class, 'activeDeactiveStatus']);
    });

    Route::middleware('role:Admin|Doctor')->group(function () {
        Route::resource('document-types', DocumentTypeController::class)->parameters(['document-types' => 'documentType']);
        Route::get('document-types',
            [DocumentTypeController::class, 'index'])->name('document-types.index')->middleware('modules');

        Route::resource('schedules', ScheduleController::class)->parameters(['schedules' => 'schedule']);
        Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index')->middleware('modules');

        Route::resource('death-reports', DeathReportController::class)->parameters(['death-reports' => 'deathReport']);
        Route::get('death-reports', [DeathReportController::class, 'index'])->name('death-reports.index')->middleware('modules');

        Route::resource('birth-reports', BirthReportController::class)->parameters(['birth-reports' => 'birthReport']);
        Route::get('birth-reports', [BirthReportController::class, 'index'])->name('birth-reports.index')->middleware('modules');

        Route::resource('operation-reports',
            OperationReportController::class)->parameters(['operation-reports' => 'operationReport']);
        Route::get('operation-reports',
            [OperationReportController::class, 'index'])->name('operation-reports.index')->middleware('modules');

        Route::resource('investigation-reports',
            InvestigationReportController::class)->parameters(['investigation-reports' => 'investigationReport']);
        Route::get('investigation-reports',
            [InvestigationReportController::class, 'index'])->name('investigation-reports.index')->middleware('modules');

        // Route for Prescription
        Route::resource('prescriptions', PrescriptionController::class);
        Route::get('prescriptions/{id}/view', [PrescriptionController::class, 'prescriptionsView']);
        Route::get('prescription-pdf/{id}', [PrescriptionController::class, 'convertToPDF'])->name('prescriptions.pdf');
        Route::post('prescription-medicine', [PrescriptionController::class, 'prescreptionMedicineStore'])->name('prescription.medicine.store');
        Route::get('prescriptions-show-modal/{id}',
            [PrescriptionController::class, 'showModal'])->name('prescriptions.show.modal');
        Route::get('prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index')->middleware('modules');
        Route::post('prescriptions/{prescription}/active-deactive', [PrescriptionController::class, 'activeDeactiveStatus']);

        //Route for Vaccinations
        Route::resource('vaccinations', VaccinationController::class)->middleware('modules');

        //Route for Vaccinated Patients
        Route::get('vaccinations', [VaccinationController::class, 'index'])->name('vaccinations.index')->middleware('modules');
        Route::post('vaccinations', [VaccinationController::class, 'store'])->name('vaccinations.store');
        Route::get('vaccinations/create', [VaccinationController::class, 'create'])->name('vaccinations.create');
        Route::get('vaccinations/{vaccination}', [VaccinationController::class, 'show'])->name('vaccinations.show');
        Route::delete('vaccinations/{vaccination}', [VaccinationController::class, 'destroy'])->name('vaccinations.destroy');
        Route::post('vaccinations/{vaccination}/update', [VaccinationController::class, 'update'])->name('vaccination.update');
        Route::get('vaccinations/{vaccination}/edit', [VaccinationController::class, 'edit'])->name('vaccinations.edit');
        Route::get('export-vaccinations', [VaccinationController::class, 'vaccinationsExport'])->name('vaccinations.excel');

        //Route for Vaccinated Patients
        Route::get('vaccinated-patients',
            [VaccinatedPatientController::class, 'index'])->name('vaccinated-patients.index')->middleware('modules');
        Route::post('vaccinated-patients', [VaccinatedPatientController::class, 'store'])->name('vaccinated-patients.store');
        Route::get('vaccinated-patients/create',
            [VaccinatedPatientController::class, 'create'])->name('vaccinated-patients.create');
        Route::get('vaccinated-patients/{vaccinatedPatient}',
            [VaccinatedPatientController::class, 'show'])->name('vaccinated-patients.show');
        Route::delete('vaccinated-patients/{vaccinatedPatient}',
            [VaccinatedPatientController::class, 'destroy'])->name('vaccinated-patients.destroy');
        Route::post('vaccinated-patients/{vaccinatedPatient}/update',
            [VaccinatedPatientController::class, 'update'])->name('vaccinated-patients.update');
        Route::get('vaccinated-patients/{vaccinatedPatient}/edit',
            [VaccinatedPatientController::class, 'edit'])->name('vaccinated-patients.edit');
        Route::get('export-vaccinated-patients', [VaccinatedPatientController::class, 'vaccinatedPatientExport'])
            ->name('vaccinated-patients.excel');
    });

    Route::middleware('role:Admin|Accountant|Doctor|Nurse|Receptionist|Lab Technician|Pharmacist|Case Manager')->group(function () {
        Route::get('employee-payrolls/{employeePayroll}',
                [EmployeePayrollController::class, 'show'])->where('employeePayroll', '[0-9]+');
        Route::get('employee-payrolls-show/{employeePayroll}',
                [EmployeePayrollController::class, 'showModal'])->where('employeePayroll',
                '[0-9]+')->name('employee-payrolls.show.modal');
    });

    Route::middleware('role:Admin|Accountant|Receptionist')->group(function () {

        //services routes
        Route::resource('services', ServiceController::class)->parameters(['services' => 'service']);
        Route::get('services', [ServiceController::class, 'index'])->name('services.index')->middleware('modules');
        Route::post('services/{service_id}/active-deactive', [ServiceController::class, 'activeDeActiveService']);
    });

    Route::middleware('role:Admin|Accountant')->group(function () {
        Route::resource('accounts', AccountController::class)->parameters(['accounts' => 'account']);
        Route::get('accounts', [AccountController::class, 'index'])->name('accounts.index')->middleware('modules');
        Route::post('accounts/{account}/active-deactive', [AccountController::class, 'activeDeactiveAccount']);

        Route::get('employee-payrolls',
            [EmployeePayrollController::class, 'index'])->name('employee-payrolls.index')->middleware('modules');
        Route::post('employee-payrolls', [EmployeePayrollController::class, 'store'])->name('employee-payrolls.store');
        Route::get('employee-payrolls/create', [EmployeePayrollController::class, 'create'])->name('employee-payrolls.create');
        Route::delete('employee-payrolls/{employeePayroll}', [EmployeePayrollController::class, 'destroy'])
            ->name('employee-payrolls.destroy');
        Route::patch('employee-payrolls/{employeePayroll}', [EmployeePayrollController::class, 'update'])
            ->name('employee-payrolls.update');
        Route::get('employee-payrolls/{employeePayroll}/edit', [EmployeePayrollController::class, 'edit'])
            ->name('employee-payrolls.edit');

        Route::resource('invoices', InvoiceController::class)->parameters(['invoices' => 'invoice']);
        Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index')->middleware('modules');
        Route::post('invoices/{invoice}', [InvoiceController::class, 'update']);
        Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'convertToPdf'])->name('invoices.pdf');

        Route::resource('payments', PaymentController::class);
        Route::get('payments-show-modal/{payment}', [PaymentController::class, 'showModal'])->name('payments.show.modal');
        Route::get('payments', [PaymentController::class, 'index'])->name('payments.index')->middleware('modules');
        Route::get('export-payments', [PaymentController::class, 'paymentExport'])->name('payments.excel');

        // Route for Payment Reports
        Route::get('payment-reports', [PaymentReportController::class, 'index'])->name('payment.reports')->middleware('modules');

        Route::resource('bills', BillController::class);
        Route::get('bills', [BillController::class, 'index'])->name('bills.index')->middleware('modules');
        Route::post('bills/{bill}', [BillController::class, 'update']);
        Route::get('bills/{bill}/pdf', [BillController::class, 'convertToPdf'])->name('bills.pdf');
        Route::get('patient-admission-details',
            [BillController::class, 'getPatientAdmissionDetails'])->name('patient.admission.details');

        //Expense Rout
        Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index')->middleware('modules');
        Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store');
        Route::get('expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
        Route::get('expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
        Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
        Route::post('expenses/{expense}/update', [ExpenseController::class, 'update'])->name('expenses.update');
        Route::get('expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');

        //incomes Rout
        Route::get('incomes', [IncomeController::class, 'index'])->name('incomes.index')->middleware('modules');
        Route::post('incomes', [IncomeController::class, 'store'])->name('incomes.store');
        Route::get('incomes/create', [IncomeController::class, 'create'])->name('incomes.create');
        Route::get('incomes/{income}', [IncomeController::class, 'show'])->name('incomes.show');
        Route::delete('incomes/{income}', [IncomeController::class, 'destroy'])->name('incomes.destroy');
        Route::post('incomes/{income}/update', [IncomeController::class, 'update'])->name('incomes.update');
        Route::get('incomes/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
    });

    Route::middleware('role:Admin|Nurse')->group(function () {
        Route::get('beds', [BedController::class, 'index'])->name('beds.index')->middleware('modules');
        Route::post('beds', [BedController::class, 'store'])->name('beds.store');
        Route::get('beds/create', [BedController::class, 'create'])->name('beds.create');
        Route::delete('beds/{bed}', [BedController::class, 'destroy'])
            ->name('beds.destroy');
        Route::patch('beds/{bed}', [BedController::class, 'update'])
            ->name('beds.update');
        Route::get('beds/{bed}/edit', [BedController::class, 'edit'])
            ->name('beds.edit');
        Route::post('beds/{bed_id}/active-deactive', [BedController::class, 'activeDeActiveStatus']);
        Route::get('/bulk-beds', [BedController::class, 'createBulkBeds'])->name('create.bulk.beds');
        Route::post('/bulk-beds-store', [BedController::class, 'storeBulkBeds'])->name('store.bulk.beds');

        Route::resource('bed-types', BedTypeController::class)->parameters(['bed-types' => 'bedType']);
        Route::get('bed-types', [BedTypeController::class, 'index'])->name('bed-types.index')->middleware('modules');
    });

    Route::middleware('role:Admin|Nurse|Receptionist|Doctor|Case Manager')->group(function () {
        Route::get('patient-cases/{patient_case}', [PatientCaseController::class, 'show'])->where('patient_case',
            '[0-9]+')->name('patient_case_show');
        Route::get('patient-cases-show-modal/{patient_case}', [PatientCaseController::class, 'showModal'])->where('patient_case',
            '[0-9]+')->name('patient_case.show.modal');
    });

    Route::middleware('role:Admin|Receptionist|Case Manager')->group(function () {
        Route::resource('notice-boards', NoticeBoardController::class)->parameters(['notice-boards' => 'noticeBoard']);
        Route::get('notice-boards', [NoticeBoardController::class, 'index'])->name('noticeboard')->middleware('modules');
    });

    Route::middleware('role:Admin|Receptionist|Case Manager')->group(function () {
        Route::resource('ambulances', AmbulanceController::class)->parameters(['ambulances' => 'ambulance']);
        Route::get('ambulances', [AmbulanceController::class, 'index'])->name('ambulances.index')->middleware('modules');
        Route::post('ambulances/{ambulance_id}/active-deactive', [AmbulanceController::class, 'isAvailableAmbulance']);

        // Routes for Mail
        Route::get('mail', [MailController::class, 'index'])->name('mail')->middleware('modules');
        Route::post('send-mail', [MailController::class, 'store'])->name('mail.send');

        Route::resource('ambulance-calls', AmbulanceCallController::class);
        Route::get('ambulance-calls',
            [AmbulanceCallController::class, 'index'])->name('ambulance-calls.index')->middleware('modules');
        Route::get('driver-name', [AmbulanceCallController::class, 'getDriverName'])->name('driver.name');

        Route::get('export-ambulances', [AmbulanceController::class, 'ambulanceExport'])->name('ambulance.excel');
    });

    Route::middleware('role:Admin|Receptionist|Case Manager|Doctor|Accountant|Pharmacist')->group(function () {
        //Sms Rout
        Route::get('sms', [SmsController::class, 'index'])->name('sms.index')->middleware('modules');
        Route::post('sms', [SmsController::class, 'store'])->name('sms.store');
        Route::get('sms/{sms}', [SmsController::class, 'show'])->name('sms.show');
        Route::get('sms-show-modal/{sms}', [SmsController::class, 'showModal'])->name('sms.show.modal');
        Route::delete('sms/{sms}', [SmsController::class, 'destroy'])->name('sms.destroy');
        Route::get('sms-users-lists', [SmsController::class, 'getUsersList'])->name('sms.users.lists');
    });

    Route::middleware('role:Admin|Receptionist|Lab Technician|Pharmacist')->group(function () {
        // radiology test routes
        Route::get('radiology-tests',
            [RadiologyTestController::class, 'index'])->name('radiology.test.index')->middleware('modules');
        Route::get('radiology-tests/create', [RadiologyTestController::class, 'create'])->name('radiology.test.create');
        Route::post('radiology-tests', [RadiologyTestController::class, 'store'])->name('radiology.test.store');
        Route::get('radiology-tests/{radiologyTest}', [RadiologyTestController::class, 'show'])->name('radiology.test.show');
        Route::get('radiology-tests-show-modal/{radiologyTest}',
            [RadiologyTestController::class, 'showModal'])->name('radiology.test.show.modal');
        Route::get('radiology-tests/{radiologyTest}/edit',
            [RadiologyTestController::class, 'edit'])->name('radiology.test.edit');
        Route::patch('radiology-tests/{radiologyTest}',
            [RadiologyTestController::class, 'update'])->name('radiology.test.update');
        Route::delete('radiology-tests/{radiologyTest}',
            [RadiologyTestController::class, 'destroy'])->name('radiology.test.destroy');
        Route::get('radiology-tests/get-standard-charge/{id}',
            [RadiologyTestController::class, 'getStandardCharge'])->name('radiology.test.standard.charge');

        // pathology test routes
        Route::get('pathology-tests',
            [PathologyTestController::class, 'index'])->name('pathology.test.index')->middleware('modules');
        Route::get('pathology-tests/create', [PathologyTestController::class, 'create'])->name('pathology.test.create');
        Route::post('pathology-tests', [PathologyTestController::class, 'store'])->name('pathology.test.store');
        Route::get('pathology-tests/{pathologyTest}', [PathologyTestController::class, 'show'])->name('pathology.test.show');
        Route::get('pathology-tests-show-modal/{pathologyTest}',
            [PathologyTestController::class, 'showModal'])->name('pathology.test.show.modal');
        Route::get('pathology-tests/{pathologyTest}/edit',
            [PathologyTestController::class, 'edit'])->name('pathology.test.edit');
        Route::patch('pathology-tests/{pathologyTest}',
            [PathologyTestController::class, 'update'])->name('pathology.test.update');
        Route::delete('pathology-tests/{pathologyTest}',
            [PathologyTestController::class, 'destroy'])->name('pathology.test.destroy');
        Route::get('pathology-tests/get-standard-charge/{id}',
            [PathologyTestController::class, 'getStandardCharge'])->name('pathology.test.standard.charge');
    });

    Route::middleware('role:Admin|Receptionist')->group(function () {

        //insurance routes
        Route::get('insurances', [InsuranceController::class, 'index'])->name('insurances.index')->middleware('modules');
        Route::post('insurances', [InsuranceController::class, 'store'])->name('insurances.store');
        Route::get('insurances/create', [InsuranceController::class, 'create'])->name('insurances.create');
        Route::delete('insurances/{insurance}', [InsuranceController::class, 'destroy'])
            ->name('insurances.destroy');
        Route::get('insurances/{insurance}/edit', [InsuranceController::class, 'edit'])
            ->name('insurances.edit');
        Route::post('insurances/{insurance}', [InsuranceController::class, 'update'])->name('insurances.update');
        Route::post('insurances/{insurance_id}/active-deactive', [InsuranceController::class, 'activeDeActiveInsurance']);

        //packages routes
        Route::get('packages', [PackageController::class, 'index'])->name('packages.index')->middleware('modules');
        Route::post('packages', [PackageController::class, 'store'])->name('packages.store');
        Route::get('packages/create', [PackageController::class, 'create'])->name('packages.create');
        Route::delete('packages/{package}', [PackageController::class, 'destroy'])
            ->name('packages.destroy');
        Route::get('packages/{package}/edit', [PackageController::class, 'edit'])
            ->name('packages.edit');
        Route::post('packages/{package}', [PackageController::class, 'update'])->name('packages.update');
    });

    Route::middleware('role:Admin|Lab Technician')->group(function () {

        //blood-bank routes
        Route::resource('blood-banks', BloodBankController::class)->parameters(['blood-banks' => 'bloodBank']);
        Route::get('blood-banks', [BloodBankController::class, 'index'])->name('blood-banks.index')->middleware('modules');

        //blood-donor routes
        Route::resource('blood-donors', BloodDonorController::class)->parameters(['blood-donors' => 'bloodDonor']);
        Route::get('blood-donors', [BloodDonorController::class, 'index'])->name('blood-donors.index')->middleware('modules');

        //blood Donations route
        Route::get('blood-donations',
            [BloodDonationController::class, 'index'])->name('blood-donations.index')->middleware('modules');
        Route::post('blood-donations', [BloodDonationController::class, 'store'])->name('blood-donations.store');
        Route::get('blood-donations/{bloodDonation}/edit',
            [BloodDonationController::class, 'edit'])->name('blood-donations.edit');
        Route::post('blood-donations/{bloodDonation}',
            [BloodDonationController::class, 'update'])->name('blood-donations.update');
        Route::delete('blood-donations/{bloodDonation}',
            [BloodDonationController::class, 'destroy'])->name('blood-donations.destroy');

        //blood-issue routes
        Route::get('blood-issues', [BloodIssueController::class, 'index'])->name('blood-issues.index')->middleware('modules');
        Route::post('blood-issues', [BloodIssueController::class, 'store'])->name('blood-issues.store');
        Route::get('blood-issues/{bloodIssue}/edit', [BloodIssueController::class, 'edit'])->name('blood-issues.edit');
        Route::post('blood-issues/{bloodIssue}', [BloodIssueController::class, 'update'])->name('blood-issues.update');
        Route::delete('blood-issues/{bloodIssue}', [BloodIssueController::class, 'destroy'])->name('blood-issues.destroy');
        Route::get('blood-group-list', [BloodIssueController::class, 'getBloodGroup'])->name('blood-issues.list');
    });

    Route::middleware('role:Admin|Accountant')->group(function () {
        Route::get('employees-list', [EmployeePayrollController::class, 'getEmployeesList'])->name('employees.list');
    });

    Route::middleware('role:Admin')->group(function () {
//        Route::resource('departments', 'DepartmentController');
//        Route::post('departments/{department}/active-deactive', 'DepartmentController@activeDeactiveDepartment');
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users-details/{user?}', [UserController::class, 'show'])->name('users.show');
        Route::get('users-details-modal/{user?}', [UserController::class, 'showModal'])->name('users.show.modal');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('users/{user}/active-deactive', [UserController::class, 'activeDeactiveStatus'])->name('users.status');
        Route::post('users/{user}/is-verified', [UserController::class, 'isVerified'])->name('users.verified');

        Route::get('income-expense-report', [HomeController::class, 'incomeExpenseReport'])->name('income-expense-report');

        Route::resource('admins', adminController::class);
        Route::get('admins', [adminController::class, 'index'])->name('admins.index');
        Route::post('admins/{accountant}/active-deactive', [adminController::class, 'activeDeactiveStatus']);

        Route::resource('accountants', AccountantController::class);
        Route::get('accountants', [AccountantController::class, 'index'])->name('accountants.index')->middleware('modules');
        Route::post('accountants/{accountant}/active-deactive', [AccountantController::class, 'activeDeactiveStatus']);

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::resource('currency-settings', CurrencySettingController::class);
        Route::resource('hospital-schedules', HospitalScheduleController::class);
        Route::post('checkRecord', [HospitalScheduleController::class, 'checkRecord'])->name('checkRecord');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('modules', [SettingController::class, 'getModule'])->name('module.index');
        Route::post('modules/{module}/active-deactive', [SettingController::class, 'activeDeactiveStatus'])
            ->name('module.activeDeactiveStatus');

        Route::get('front-settings', [FrontSettingController::class, 'index'])->name('front.settings.index');
        Route::post('front-settings', [FrontSettingController::class, 'update'])->name('front.settings.update');

        Route::get('front-cms-services', [FrontServiceController::class, 'index'])->name('front.cms.services.index');
        Route::get('front-cms-services/create', [FrontServiceController::class, 'create'])->name('front.cms.services.create');
        Route::post('front-cms-services', [FrontServiceController::class, 'store'])->name('front.cms.services.store');
        Route::get('front-cms-services/{id}/edit', [FrontServiceController::class, 'edit'])->name('front.cms.services.edit');
        Route::post('front-cms-services/{id}', [FrontServiceController::class, 'update'])->name('front.cms.services.update');
        Route::delete('front-cms-services/{id}', [FrontServiceController::class, 'destroy'])->name('front.cms.services.destroy');

        Route::get('doctor-departments',
            [DoctorDepartmentController::class, 'index'])->name('doctor-departments.index')->middleware('modules');
        Route::post('doctor-departments', [DoctorDepartmentController::class, 'store'])->name('doctor-departments.store');
        Route::get('doctor-departments/create', [DoctorDepartmentController::class, 'create'])->name('doctor-departments.create');
        Route::delete('doctor-departments/{doctorDepartment}', [DoctorDepartmentController::class, 'destroy'])
            ->name('doctor-departments.destroy');
        Route::patch('doctor-departments/{doctorDepartment}', [DoctorDepartmentController::class, 'update'])
            ->name('doctor-departments.update');
        Route::get('doctor-departments/{doctorDepartment}/edit', [DoctorDepartmentController::class, 'edit'])
            ->name('doctor-departments.edit');

        Route::resource('pharmacists', PharmacistController::class);
        Route::get('pharmacists', [PharmacistController::class, 'index'])->name('pharmacists.index')->middleware('modules');
        Route::post('pharmacists/{pharmacist}/active-deactive', [PharmacistController::class, 'activeDeactiveStatus']);
        Route::get('export-pharmacists', [PharmacistController::class, 'pharmacistExport'])->name('pharmacists.excel');

        Route::resource('nurses', NurseController::class);
        Route::get('nurses', [NurseController::class, 'index'])->name('nurses.index')->middleware('modules');
        Route::post('nurses/{nurse}/active-deactive', [NurseController::class, 'activeDeactiveStatus']);
        Route::get('export-nurses', [NurseController::class, 'nurseExport'])->name('nurses.excel');

        Route::resource('lab-technicians', LabTechnicianController::class);
        Route::get('lab-technicians',
            [LabTechnicianController::class, 'index'])->name('lab-technicians.index')->middleware('modules');
        Route::post('lab-technicians/{labTechnician}/active-deactive', [LabTechnicianController::class, 'activeDeactiveStatus']);
        Route::get('export-lab-technicians',
            [LabTechnicianController::class, 'labTechnicianExport'])->name('lab.technicians.excel');

        Route::resource('receptionists', ReceptionistController::class);
        Route::get('receptionists', [ReceptionistController::class, 'index'])->name('receptionists.index')->middleware('modules');
        Route::post('receptionists/{receptionist}/active-deactive', [ReceptionistController::class, 'activeDeactiveStatus']);
        Route::get('export-receptionists', [ReceptionistController::class, 'receptionistExport'])->name('receptionists.excel');

//        Route::get('export-ambulances', 'AmbulanceController@ambulanceExport')->name('ambulance.excel');
        Route::get('export-incomes', [IncomeController::class, 'incomeExport'])->name('incomes.excel');
        Route::get('export-expenses', [ExpenseController::class, 'expenseExport'])->name('expenses.excel');
        Route::get('export-payment-reports',
            [PaymentReportController::class, 'paymentReportExport'])->name('payment.report.excel');

        Route::resource(
            'advanced-payments',
            AdvancedPaymentController::class
        )->parameters(['advanced-payments' => 'advancedPayment']);
        Route::get(
            'advanced-payments',
            [AdvancedPaymentController::class, 'index']
        )->name('advanced-payments.index')->middleware('modules');

        // Inventory Management routes.
        Route::resource('item-categories', ItemCategoryController::class)->parameters(['item-categories' => 'itemCategory']);
        Route::get('item-categories',
            [ItemCategoryController::class, 'index'])->name('item-categories.index')->middleware('modules');
        Route::get('items-list', [ItemCategoryController::class, 'getItemsList'])->name('items.list');

        Route::get('items', [ItemController::class, 'index'])->name('items.index')->middleware('modules');
        Route::post('items', [ItemController::class, 'store'])->name('items.store');
        Route::get('items/create', [ItemController::class, 'create'])->name('items.create');
        Route::delete('items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
        Route::patch('items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::get('items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::get('items/{item}', [ItemController::class, 'show'])->name('items.show');
        Route::get('item-available-qty', [ItemController::class, 'getAvailableQuantity'])->name('item.available.qty');

        Route::get('item-stocks', [ItemStockController::class, 'index'])->name('item.stock.index')->middleware('modules');
        Route::post('item-stocks', [ItemStockController::class, 'store'])->name('item.stock.store');
        Route::get('item-stocks/create', [ItemStockController::class, 'create'])->name('item.stock.create');
        Route::delete('item-stocks/{itemStock}', [ItemStockController::class, 'destroy'])->name('item.stock.destroy');
        Route::post('item-stocks/{itemStock}', [ItemStockController::class, 'update'])->name('item.stock.update');
        Route::get('item-stocks/{itemStock}/edit', [ItemStockController::class, 'edit'])->name('item.stock.edit');
        Route::get('item-stocks/{itemStock}', [ItemStockController::class, 'show'])->name('item.stock.show');
        Route::get('item-stocks-download/{itemStock}',
            [ItemStockController::class, 'downloadMedia'])->name('item.stock.download');

        Route::get('issued-items', [IssuedItemController::class, 'index'])->name('issued.item.index')->middleware('modules');
        Route::post('issued-items', [IssuedItemController::class, 'store'])->name('issued.item.store');
        Route::get('issued-items/create', [IssuedItemController::class, 'create'])->name('issued.item.create');
        Route::delete('issued-items/{issuedItem}', [IssuedItemController::class, 'destroy'])->name('issued.item.destroy');
        Route::get('issued-items/{issuedItem}', [IssuedItemController::class, 'show'])->name('issued.item.show');
        Route::get('users-list', [DepartmentController::class, 'getUsersList'])->name('users.list');
        Route::get('return-issued-item', [IssuedItemController::class, 'returnIssuedItem'])->name('return.issued.item');
    });

    Route::middleware('role:Admin|Patient')->group(function () {
        Route::prefix('employee')->group(function () {
            Route::get('patient-diagnosis-test',
                [Employee\PatientDiagnosisTestController::class, 'index'])->name('patient-diagnosis-test');
            Route::get('patient-diagnosis-test/{patientDiagnosisTest}',
                [Employee\PatientDiagnosisTestController::class, 'show'])->name('patient-diagnosis-test.show');
            Route::get('patient-diagnosis-test/{patientDiagnosisTest}/pdf',
                [Employee\PatientDiagnosisTestController::class, 'convertToPdf'])->name('employee.patient.diagnosis.test.pdf');
        });
    });

    Route::middleware('role:Admin|Doctor|Receptionist|Lab Technician')->group(function () {
        //Patient Diagnosis Test
        Route::get('patient-diagnosis-test',
            [PatientDiagnosisTestController::class, 'index'])->name('patient.diagnosis.test.index')->middleware('modules');
        Route::post('patient-diagnosis-test',
            [PatientDiagnosisTestController::class, 'store'])->name('patient.diagnosis.test.store');
        Route::get('patient-diagnosis-test/create',
            [PatientDiagnosisTestController::class, 'create'])->name('patient.diagnosis.test.create');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}',
            [PatientDiagnosisTestController::class, 'show'])->name('patient.diagnosis.test.show');
        Route::delete('patient-diagnosis-test/{patientDiagnosisTest}',
            [PatientDiagnosisTestController::class, 'destroy'])->name('patient.diagnosis.test.destroy');
        Route::post('patient-diagnosis-test/{patientDiagnosisTest}/update',
            [PatientDiagnosisTestController::class, 'update'])->name('patient.diagnosis.test.update');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}/edit',
            [PatientDiagnosisTestController::class, 'edit'])->name('patient.diagnosis.test.edit');
        Route::get('patient-diagnosis-test/{patientDiagnosisTest}/pdf',
            [PatientDiagnosisTestController::class, 'convertToPdf'])->name('patient.diagnosis.test.pdf');

        //Diagnosis test Category
        Route::get('diagnosis-categories',
            [DiagnosisCategoryController::class, 'index'])->name('diagnosis.category.index')->middleware('modules');
        Route::post('diagnosis-categories',
            [DiagnosisCategoryController::class, 'store'])->name('diagnosis.category.store');
        Route::get('diagnosis-categories/{diagnosisCategory}',
            [DiagnosisCategoryController::class, 'show'])->name('diagnosis.category.show');
        Route::delete('diagnosis-categories/{diagnosisCategory}',
            [DiagnosisCategoryController::class, 'destroy'])->name('diagnosis.category.destroy');
        Route::patch('diagnosis-categories/{diagnosisCategory}',
            [DiagnosisCategoryController::class, 'update'])->name('diagnosis.category.update');
        Route::get('diagnosis-categories/{diagnosisCategory}/edit',
            [DiagnosisCategoryController::class, 'edit'])->name('diagnosis.category.edit');
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist|Accountant|Case Manager|Nurse')->group(function () {
        Route::get('document-download/{document}', [DocumentController::class, 'downloadMedia']);
    });

    Route::middleware('role:Admin|Accountant')->group(function () {
        Route::get('expense-download/{expense}', [ExpenseController::class, 'downloadMedia']);
        Route::get('income-download/{income}', [IncomeController::class, 'downloadMedia']);
        Route::get('export-incomes', [IncomeController::class, 'incomeExport'])->name('incomes.excel');
        Route::get('export-expenses', [ExpenseController::class, 'expenseExport'])->name('expenses.excel');
    });

    Route::middleware('role:Admin|Doctor')->group(function () {
        Route::get('investigation-download/{investigationReport}', [InvestigationReportController::class, 'downloadMedia']);
    });

    Route::middleware('role:Admin|Doctor|Receptionist')->group(function () {
        // IPD Patient routes
        Route::get('ipds',
                [IpdPatientDepartmentController::class, 'index'])->name('ipd.patient.index')->middleware('modules');
        Route::get('ipds/create', [IpdPatientDepartmentController::class, 'create'])->name('ipd.patient.create');
        Route::post('ipds', [IpdPatientDepartmentController::class, 'store'])->name('ipd.patient.store');
        Route::get('ipds/{ipdPatientDepartment}',
                [IpdPatientDepartmentController::class, 'show'])->name('ipd.patient.show');
        Route::get('ipds/{ipdPatientDepartment}/edit',
                [IpdPatientDepartmentController::class, 'edit'])->name('ipd.patient.edit');
        Route::patch('ipds/{ipdPatientDepartment}',
                [IpdPatientDepartmentController::class, 'update'])->name('ipd.patient.update');
        Route::delete('ipds/{ipdPatientDepartment}',
                [IpdPatientDepartmentController::class, 'destroy'])->name('ipd.patient.destroy');
        Route::get('patient-cases-list',
                [IpdPatientDepartmentController::class, 'getPatientCasesList'])->name('patient.cases.list');
        Route::get('patient-beds-list',
                [IpdPatientDepartmentController::class, 'getPatientBedsList'])->name('patient.beds.list');

        // IPD Diagnosis routes
        Route::post('ipd-diagnosis', [IpdDiagnosisController::class, 'store'])->name('ipd.diagnosis.store');
        Route::get('ipd-diagnosis/{ipdDiagnosis}/edit', [IpdDiagnosisController::class, 'edit'])->name('ipd.diagnosis.edit');
        Route::post('ipd-diagnosis/{ipdDiagnosis}', [IpdDiagnosisController::class, 'update'])->name('ipd.diagnosis.update');
        Route::delete('ipd-diagnosis/{ipdDiagnosis}',
                [IpdDiagnosisController::class, 'destroy'])->name('ipd.diagnosis.destroy');

        // IPD Consultant Register routes.
        Route::post('ipd-consultant-register',
                [IpdConsultantRegisterController::class, 'store'])->name('ipd.consultant.store');
        Route::get('ipd-consultant-register/{ipdConsultantRegister}/edit',
                [IpdConsultantRegisterController::class, 'edit'])->name('ipd.consultant.edit');
        Route::post('ipd-consultant-register/{ipdConsultantRegister}',
                [IpdConsultantRegisterController::class, 'update'])->name('ipd.consultant.update');
        Route::delete('ipd-consultant-register/{ipdConsultantRegister}',
                [IpdConsultantRegisterController::class, 'destroy'])->name('ipd.consultant.destroy');

        // IPD Charges routes.
        Route::post('ipd-charges', [IpdChargeController::class, 'store'])->name('ipd.charge.store');
        Route::get('ipd-charges/{ipdCharge}/edit', [IpdChargeController::class, 'edit'])->name('ipd.charge.edit');
        Route::post('ipd-charges/{ipdCharge}', [IpdChargeController::class, 'update'])->name('ipd.charge.update');
        Route::delete('ipd-charges/{ipdCharge}', [IpdChargeController::class, 'destroy'])->name('ipd.charge.destroy');
        Route::get('charge-category-list',
                [IpdChargeController::class, 'getChargeCategoryList'])->name('charge.category.list');
        Route::get('charge', [IpdChargeController::class, 'getChargeList'])->name('charge.list');
        Route::get('charge-standard-rate',
                [IpdChargeController::class, 'getChargeStandardRate'])->name('charge.standard.rate');

        // IPD Prescription routes
        Route::post('ipd-prescription', [IpdPrescriptionController::class, 'store'])->name('ipd.prescription.store');
        Route::get('ipd-prescription/{ipdPrescription}/edit',
                [IpdPrescriptionController::class, 'edit'])->name('ipd.prescription.edit');
        Route::post('ipd-prescription/{ipdPrescription}',
                [IpdPrescriptionController::class, 'update'])->name('ipd.prescription.update');
        Route::delete('ipd-prescription/{ipdPrescription}',
                [IpdPrescriptionController::class, 'destroy'])->name('ipd.prescription.destroy');
        Route::get('medicine-list', [IpdPrescriptionController::class, 'getMedicineList'])->name('medicine.list');

        // IPD Timelines routes
        Route::post('ipd-timelines', [IpdTimelineController::class, 'store'])->name('ipd.timelines.store');
        Route::get('ipd-timelines/{ipdTimeline}/edit', [IpdTimelineController::class, 'edit'])->name('ipd.timelines.edit');
        Route::post('ipd-timelines/{ipdTimeline}', [IpdTimelineController::class, 'update'])->name('ipd.timelines.update');
        Route::delete('ipd-timelines/{ipdTimeline}',
                [IpdTimelineController::class, 'destroy'])->name('ipd.timelines.destroy');

        // IPD Payment routes
        Route::post('ipd-payments', [IpdPaymentController::class, 'store'])->name('ipd.payments.store');
        Route::get('ipd-payments/{ipdPayment}/edit', [IpdPaymentController::class, 'edit'])->name('ipd.payments.edit');
        Route::post('ipd-payments/{ipdPayment}', [IpdPaymentController::class, 'update'])->name('ipd.payments.update');
        Route::delete('ipd-payments/{ipdPayment}',
                [IpdPaymentController::class, 'destroy'])->name('ipd.payments.destroy');

        // IPD Bill
        Route::post('ipd-bills', [IpdBillController::class, 'store'])->name('ipd.bills.store');

        // OPD Patient routes
        Route::get('opds',
                [OpdPatientDepartmentController::class, 'index'])->name('opd.patient.index')->middleware('modules');
        Route::get('opds/create', [OpdPatientDepartmentController::class, 'create'])->name('opd.patient.create');
        Route::post('opds', [OpdPatientDepartmentController::class, 'store'])->name('opd.patient.store');
        Route::get('opds/{opdPatientDepartment}',
                [OpdPatientDepartmentController::class, 'show'])->name('opd.patient.show');
        Route::get('opds/{opdPatientDepartment}/edit',
                [OpdPatientDepartmentController::class, 'edit'])->name('opd.patient.edit');
        Route::patch('opds/{opdPatientDepartment}',
                [OpdPatientDepartmentController::class, 'update'])->name('opd.patient.update');
        Route::delete('opds/{opdPatientDepartment}',
                [OpdPatientDepartmentController::class, 'destroy'])->name('opd.patient.destroy');
        Route::get('get-doctor-opd-charge',
                [OpdPatientDepartmentController::class, 'getDoctorOPDCharge'])->name('getDoctor.OPDcharge');

        // OPD Diagnosis routes
        Route::post('opd-diagnosis', [OpdDiagnosisController::class, 'store'])->name('opd.diagnosis.store');
        Route::get('opd-diagnosis/{opdDiagnosis}/edit', [OpdDiagnosisController::class, 'edit'])->name('opd.diagnosis.edit');
        Route::post('opd-diagnosis/{opdDiagnosis}', [OpdDiagnosisController::class, 'update'])->name('opd.diagnosis.update');
        Route::delete('opd-diagnosis/{opdDiagnosis}',
                [OpdDiagnosisController::class, 'destroy'])->name('opd.diagnosis.destroy');

        // OPD Timelines routes
        Route::post('opd-timelines', [OpdTimelineController::class, 'store'])->name('opd.timelines.store');
        Route::get('opd-timelines/{opdTimeline}/edit', [OpdTimelineController::class, 'edit'])->name('opd.timelines.edit');
        Route::post('opd-timelines/{opdTimeline}', [OpdTimelineController::class, 'update'])->name('opd.timelines.update');
        Route::delete('opd-timelines/{opdTimeline}',
                [OpdTimelineController::class, 'destroy'])->name('opd.timelines.destroy');
    });

    Route::middleware('role:Admin|Receptionist')->group(function () {
        //Call-log routes
        Route::get('call-logs', [CallLogController::class, 'index'])->name('call_logs.index')->middleware('modules');
        Route::get('call-logs/create', [CallLogController::class, 'create'])->name('call_logs.create');
        Route::post('call-logs', [CallLogController::class, 'store'])->name('call_logs.store');
        Route::get('call-logs/{call_log}/edit', [CallLogController::class, 'edit'])->name('call_logs.edit');
        Route::patch('call-logs/{call_log}', [CallLogController::class, 'update'])->name('call_logs.update');
        Route::delete('call-logs/{call_log}', [CallLogController::class, 'destroy'])->name('call_logs.destroy');
        Route::get('export-call-logs', [CallLogController::class, 'export'])->name('call_logs.excel');

        //ambulance export
//        Route::get('export-ambulances', 'AmbulanceController@ambulanceExport')->name('ambulance.excel');

        //Visitors routes
        Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index')->middleware('modules');
        Route::get('visitors/create', [VisitorController::class, 'create'])->name('visitors.create');
        Route::post('visitors', [VisitorController::class, 'store'])->name('visitors.store');
        Route::get('visitors/{visitor}/edit', [VisitorController::class, 'edit'])->name('visitors.edit');
        Route::patch('visitors/{visitor}', [VisitorController::class, 'update'])->name('visitors.update');
        Route::delete('visitors/{visitor}', [VisitorController::class, 'destroy'])->name('visitors.destroy');
        Route::get('visitors-download/{visitor}', [VisitorController::class, 'downloadMedia']);
        Route::get('export-visitor', [VisitorController::class, 'export'])->name('visitors.excel');

        //Postal receive routes
        Route::get('receives', [PostalController::class, 'index'])->name('receives.index')->middleware('modules');
        Route::post('receives', [PostalController::class, 'store'])->name('receives.store');
        Route::get('receives/{postal}/edit', [PostalController::class, 'edit'])->name('receives.edit');
        Route::post('receives/{postal}', [PostalController::class, 'update'])->name('receives.update');
        Route::delete('receives/{postal}', [PostalController::class, 'destroy'])->name('receives.destroy');
        Route::get('receives/{postal}', [PostalController::class, 'downloadMedia'])->name('receives.download');
        Route::get('receives-download/{postal}', [PostalController::class, 'downloadMedia']);
        Route::get('export-receive', [PostalController::class, 'export'])->name('receives.excel');

        //Postal dispatch routes
        Route::get('dispatches', [PostalController::class, 'index'])->name('dispatches.index')->middleware('modules');
        Route::post('dispatches', [PostalController::class, 'store'])->name('dispatches.store');
        Route::get('dispatches/{postal}/edit', [PostalController::class, 'edit'])->name('dispatches.edit');
        Route::post('dispatches/{postal}', [PostalController::class, 'update'])->name('dispatches.update');
        Route::delete('dispatches/{postal}', [PostalController::class, 'destroy'])->name('dispatches.destroy');
//        Route::get('dispatches/{postal}', 'PostalController@downloadMedia')->name('dispatches.download');
        Route::get('dispatches-download/{postal}', [PostalController::class, 'downloadMedia'])->name('dispatches.download');
        Route::get('export-dispatch', [PostalController::class, 'export'])->name('dispatches.excel');

        //Testimonial routes
        Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index')->middleware('modules');
        Route::post('testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('testimonials/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
        Route::get('testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::post('testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    });

    Route::middleware('role:Admin|Patient|Doctor|Receptionist|Nurse|Accountant|Lab Technician|Pharmacist|Case Manager')->group(function () {

            //Notification routes
        Route::get('/notification/{notification}/read',
                [NotificationController::class, 'readNotification'])->name('read.notification');
        Route::post('/read-all-notification',
                [NotificationController::class, 'readAllNotification'])->name('read.all.notification');
        // Live Meeting
        Route::get('live-meeting',
                [LiveMeetingController::class, 'index'])->name('live.meeting.index')->middleware('modules');
        Route::post('live-meeting', [LiveMeetingController::class, 'liveMeetingStore'])->name('live.meeting.store');
        Route::get('live-meeting/change-status',
                [LiveMeetingController::class, 'getChangeStatus'])->name('live.meeting.change.status');
        Route::get('live-meeting/{liveMeeting}/start',
                [LiveMeetingController::class, 'getLiveStatus'])->name('live.meeting.get.live.status');
        Route::get('live-meeting/{liveMeeting}', [LiveMeetingController::class, 'show'])->name('live.meeting.show');

        Route::get('live-meeting/{liveMeeting}/edit',
                [LiveMeetingController::class, 'edit'])->name('live.meeting.edit');
        Route::post('live-meeting/{liveMeeting}',
                [LiveMeetingController::class, 'update'])->name('live.meeting.update');
        Route::delete('live-meeting/{liveMeeting}',
                [LiveMeetingController::class, 'destroy'])->name('live.meeting.destroy');
    });

    Route::middleware('role:Admin|Patient|Doctor')->group(function () {
        //  Live Consultation
        Route::get('live-consultation',
                [LiveConsultationController::class, 'index'])->name('live.consultation.index')->middleware('modules');
        Route::post('live-consultation', [LiveConsultationController::class, 'store'])->name('live.consultation.store');
        Route::get('live-consultation/{liveConsultation}/edit',
                [LiveConsultationController::class, 'edit'])->name('live.consultation.edit');
        Route::post('live-consultation/{liveConsultation}',
                [LiveConsultationController::class, 'update'])->name('live.consultation.update');
        Route::delete('live-consultation/{liveConsultation}',
                [LiveConsultationController::class, 'destroy'])->name('live.consultation.destroy');
        Route::get('live-consultation-list',
                [LiveConsultationController::class, 'getTypeNumber'])->name('live.consultation.list');
        Route::get('live-consultation/change-status',
                [LiveConsultationController::class, 'getChangeStatus'])->name('live.consultation.change.status');
        Route::get('live-consultation/{liveConsultation}/start',
                [LiveConsultationController::class, 'getLiveStatus'])->name('live.consultation.get.live.status');
        Route::get('live-consultation/{liveConsultation}',
                [LiveConsultationController::class, 'show'])->name('live.consultation.show');
        Route::get('user-zoom-credential/{userZoomCredential}/fetch',
                [LiveConsultationController::class, 'zoomCredential'])->name('zoom.credential');
        Route::post('user-zoom-credential',
                [LiveConsultationController::class, 'zoomCredentialCreate'])->name('zoom.credential.create');
    });
});

Route::get('hms-logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('qr-scan', function () {
    return view('qr');
});

Route::get('/set-language', [Web\WebController::class, 'setLanguage'])->name('set-language');

require __DIR__.'/upgrade.php';
