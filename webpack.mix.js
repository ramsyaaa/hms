const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Copy Fonts
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts',
    'public/assets/webfonts');

mix.copyDirectory('resources/assets/img', 'public/assets/img');
mix.copyDirectory('resources/assets/theme/images', 'public/assets/images');
mix.copyDirectory('resources/assets/theme/webfonts', 'public/webfonts');
mix.copyDirectory('resources/assets/theme/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/theme/css/fonts', 'public/assets/css/fonts');

// mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.css', 'public/assets/css/plugins/daterangepicker.css');
// mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.js', 'public/assets/js/plugins/daterangepicker.js');

// Copy CSS
mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css',
    'public/assets/css/all.min.css');

// mix.copy('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',
//     'public/assets/css/jquery.toast.min.css');

// mix.copy('node_modules/intl-tel-input/build/css/intlTelInput.css',
//     'public/assets/css/int-tel/css/intlTelInput.css');
// mix.copy('node_modules/intl-tel-input/build/css/intlTelInput.css',
//     'public/assets/css/int-tel/css/intlTelInput.css');
mix.copyDirectory('node_modules/intl-tel-input/build/img',
    'public/assets/img');
// mix.copy('node_modules/intl-tel-input/build/js/intlTelInput.js',
//     'public/assets/js/int-tel/js/intlTelInput.min.js');
// mix.copy('node_modules/intl-tel-input/build/js/utils.js',
//     'public/assets/js/int-tel/js/utils.min.js');

// mix.copy('node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
//     'public/assets/css/owl.carousel.min.css');
// mix.copy('node_modules/lightgallery/css/lightgallery.css',
//     'public/assets/css/lightgallery.css');
// mix.copy('node_modules/lightgallery/css/lg-transitions.css',
//     'public/assets/css/lg-transitions.css');
//
// mix.copy('node_modules/fullcalendar/main.min.css', 'public/assets/css/plugins/fullcalendar.bundle.css');
// mix.combine([
//     'node_modules/fullcalendar/main.js',
//     'node_modules/fullcalendar/locales-all.min.js',
// ], 'public/assets/js/plugins/fullcalendar.bundle.js');

//AOS Css-js
// mix.copy('node_modules/aos/dist/aos.css',
//     'public/assets/css/aos.css');
// mix.copy('node_modules/aos/dist/aos.js',
//     'public/assets/js/aos.js');

// // Compile CSS
// mix.sass('resources/assets/sass/bootstrap.scss',
//     'public/assets/css/bootstrap.css').
//     sass('resources/assets/sass/infy-loader.scss',
//         'public/assets/css/infy-loader.css').
//     sass('resources/assets/sass/custom.scss', 'public/assets/css/custom.css').
//     sass('resources/assets/sass/dark-custom.scss', 'public/assets/css/dark-custom.css').
//     sass('resources/assets/sass/home_custom.scss',
//         'public/assets/css/home_custom.css').
//     sass('resources/assets/sass/sub-header.scss',
//         'public/assets/css/sub-header.css').
//     sass('resources/assets/sass/detail-header.scss',
//     'public/assets/css/detail-header.css').sass('resources/assets/sass_old/timeline.scss',
//     'public/assets/css/timeline.css').sass('resources/assets/sass/bill-pdf.scss',
//     'public/assets/css/bill-pdf.css').sass('resources/assets/sass/invoice-pdf.scss',
//     'public/assets/css/invoice-pdf.css').sass('resources/assets/sass/diagnosis-test-pdf.scss',
//     'public/assets/css/diagnosis-test-pdf.css').sass('resources/assets/sass/contacts/contact.scss',
//     'public/assets/css/contacts/contact.css').sass('resources/assets/sass/selectize-input.scss','public/assets/css/selectize-input.css')
// .sass('resources/assets/sass/livewire-table.scss','public/assets/css/livewire-table.css')
//     .version();

// Compile JS
// mix.js('resources/assets/js/custom/custom.js',
//     'public/assets/js/custom/custom.js').
//     js('resources/assets/js/custom/helpers.js',
//         'public/assets/js/custom/helpers.js').
//     js('resources/assets/js/custom/custom-datatable.js',
//         'public/assets/js/custom/custom-datatable.js').
//     js('resources/assets/js/custom/new-edit-modal-form.js',
//         'public/assets/js/custom/new-edit-modal-form.js').
//     js('resources/assets/js/custom/delete.js',
//         'public/assets/js/custom/delete.js').js('resources/assets/js/custom/reset_models.js',
//     'public/assets/js/custom/reset_models.js').js('resources/assets/js/custom/add-edit-profile-picture.js',
//     'public/assets/js/custom/add-edit-profile-picture.js').js('resources/assets/js/appointments/appointments.js',
//     'public/assets/js/appointments/appointments.js').js('resources/assets/js/appointments/create-edit.js',
//     'public/assets/js/appointments/create-edit.js').js('resources/assets/js/brands/brands.js',
//     'public/assets/js/brands/brands.js').js('resources/assets/js/category/category.js',
//         'public/assets/js/category/category.js').
//     js('resources/assets/js/category/medicines_list.js',
//         'public/assets/js/category/medicines_list.js').
//     js('resources/assets/js/nurses/nurses.js',
//         'public/assets/js/nurses/nurses.js').
//     js('resources/assets/js/nurses/nurses_data_listing.js',
//         'public/assets/js/nurses/nurses_data_listing.js').
//     js('resources/assets/js/nurses/create-edit.js',
//         'public/assets/js/nurses/create-edit.js').
//     js('resources/assets/js/doctors/doctors.js',
//         'public/assets/js/doctors/doctors.js').
//     js('resources/assets/js/doctors/doctors_data_listing.js',
//         'public/assets/js/doctors/doctors_data_listing.js').
//     js('resources/assets/js/doctors/create-edit.js',
//         'public/assets/js/doctors/create-edit.js').
//     js('resources/assets/js/lab_technicians/lab_technicians.js',
//         'public/assets/js/lab_technicians/lab_technicians.js').
//     js('resources/assets/js/lab_technicians/lab_technicians_data_listing.js',
//         'public/assets/js/lab_technicians/lab_technicians_data_listing.js').
//     js('resources/assets/js/lab_technicians/create-edit.js',
//         'public/assets/js/lab_technicians/create-edit.js').
//     js('resources/assets/js/receptionists/receptionists.js',
//         'public/assets/js/receptionists/receptionists.js').
//     js('resources/assets/js/receptionists/receptionists_data_listing.js',
//         'public/assets/js/receptionists/receptionists_data_listing.js').
//     js('resources/assets/js/receptionists/create-edit.js',
//         'public/assets/js/receptionists/create-edit.js').
//     js('resources/assets/js/pharmacists/pharmacists.js',
//         'public/assets/js/pharmacists/pharmacists.js').
//     js('resources/assets/js/pharmacists/pharmacists_data_listing.js',
//         'public/assets/js/pharmacists/pharmacists_data_listing.js').
//     js('resources/assets/js/pharmacists/create-edit.js',
//         'public/assets/js/pharmacists/create-edit.js').
//     js('resources/assets/js/patients/patients.js',
//         'public/assets/js/patients/patients.js').
//     js('resources/assets/js/patients/patients_data_listing.js',
//         'public/assets/js/patients/patients_data_listing.js').
//     js('resources/assets/js/patients/create-edit.js',
//         'public/assets/js/patients/create-edit.js').
//     js('resources/assets/js/accountants/accountants.js',
//         'public/assets/js/accountants/accountants.js').
//     js('resources/assets/js/accountants/accountants_data_listing.js',
//         'public/assets/js/accountants/accountants_data_listing.js').
//     js('resources/assets/js/accountants/create-edit.js',
//         'public/assets/js/accountants/create-edit.js').
//     js('resources/assets/js/custom/input_price_format.js',
//         'public/assets/js/custom/input_price_format.js').
//     js('resources/assets/js/bills/bill.js', 'public/assets/js/bills/bill.js').
//     js('resources/assets/js/bills/new.js', 'public/assets/js/bills/new.js').
//     js('resources/assets/js/bills/edit.js', 'public/assets/js/bills/edit.js').
//     js('resources/assets/js/blood_donors/blood_donors.js',
//         'public/assets/js/blood_donors/blood_donors.js').
//     js('resources/assets/js/blood_banks/blood_banks.js',
//         'public/assets/js/blood_banks/blood_banks.js').
//     js('resources/assets/js/bed_types/bed_types.js',
//         'public/assets/js/bed_types/bed_types.js').
//     js('resources/assets/js/bed_types/beds_view_list.js',
//         'public/assets/js/bed_types/beds_view_list.js').
//     js('resources/assets/js/beds/beds.js',
//         'public/assets/js/beds/beds.js').
//     js('resources/assets/js/beds/beds_assigns_view_list.js',
//         'public/assets/js/beds/beds_assigns_view_list.js').
//     js('resources/assets/js/beds/bulk_beds.js',
//         'public/assets/js/beds/bulk_beds.js').
//     js('resources/assets/js/beds/create-edit.js',
//         'public/assets/js/beds/create-edit.js').
//     js('resources/assets/js/medicines/medicines.js',
//         'public/assets/js/medicines/medicines.js').
//     js('resources/assets/js/medicines/new.js',
//         'public/assets/js/medicines/new.js').
//     js('resources/assets/js/document_type/doc_type.js',
//         'public/assets/js/document_type/doc_type.js').
//     js('resources/assets/js/document/document.js',
//         'public/assets/js/document/document.js').
//     js('resources/assets/js/document_type/user_documents.js',
//         'public/assets/js/document_type/user_documents.js').
//     js('resources/assets/js/notice_boards/notice_boards.js',
//         'public/assets/js/notice_boards/notice_boards.js').
//     js('resources/assets/js/notice_boards/create-edit.js',
//         'public/assets/js/notice_boards/create-edit.js').
//     js('resources/assets/js/bed_assign/bed_assign.js',
//         'public/assets/js/bed_assign/bed_assign.js').
//     js('resources/assets/js/bed_assign/create-edit.js',
//         'public/assets/js/bed_assign/create-edit.js').
//     js('resources/assets/js/death_reports/death_reports.js',
//         'public/assets/js/death_reports/death_reports.js').
//     js('resources/assets/js/death_reports/create-edit.js',
//     'public/assets/js/death_reports/create-edit.js').js('resources/assets/js/user_profile/user_profile.js',
//     'public/assets/js/user_profile/user_profile.js').js('resources/assets/js/birth_reports/birth_reports.js',
//     'public/assets/js/birth_reports/birth_reports.js').js('resources/assets/js/birth_reports/create-edit.js',
//     'public/assets/js/birth_reports/create-edit.js').js('resources/assets/js/operation_reports/operation_reports.js',
//     'public/assets/js/operation_reports/operation_reports.js').js('resources/assets/js/operation_reports/create-edit.js',
//     'public/assets/js/operation_reports/create-edit.js').js('resources/assets/js/employee_payrolls/employee_payrolls.js',
//     'public/assets/js/employee_payrolls/employee_payrolls.js').js('resources/assets/js/employee_payrolls/payrolls.js',
//     'public/assets/js/employee_payrolls/payrolls.js').js('resources/assets/js/employee_payrolls/edit.js',
//     'public/assets/js/employee_payrolls/edit.js').js('resources/assets/js/patient_cases/patient_cases.js',
//     'public/assets/js/patient_cases/patient_cases.js').js('resources/assets/js/patient_cases/create-edit.js',
//     'public/assets/js/patient_cases/create-edit.js').js('resources/assets/js/employee/my_payrolls.js',
//     'public/assets/js/employee/my_payrolls.js').js('resources/assets/js/employee/doctors.js',
//     'public/assets/js/employee/doctors.js').js('resources/assets/js/settings/setting.js',
//     'public/assets/js/settings/setting.js').
//     js('resources/assets/js/doctors_departments/doctors_departments.js',
//         'public/assets/js/doctors_departments/doctors_departments.js').js('resources/assets/js/doctors_departments/doctor_departments_list.js',
//     'public/assets/js/doctors_departments/doctor_departments_list.js').js('resources/assets/js/investigation_reports/investigation_reports.js',
//     'public/assets/js/investigation_reports/investigation_reports.js').js('resources/assets/js/investigation_reports/create-edit.js',
//     'public/assets/js/investigation_reports/create-edit.js').js('resources/assets/js/accounts/accounts.js',
//     'public/assets/js/accounts/accounts.js').js('resources/assets/js/accounts/payments_list.js',
//     'public/assets/js/accounts/payments_list.js').js('resources/assets/js/insurances/insurances.js',
//     'public/assets/js/insurances/insurances.js').js('resources/assets/js/insurances/create-edit.js',
//     'public/assets/js/insurances/create-edit.js').js('resources/assets/js/payments/payments.js',
//     'public/assets/js/payments/payments.js').js('resources/assets/js/payment_reports/payments_reports.js',
//     'public/assets/js/payment_reports/payments_reports.js').js('resources/assets/js/payments/create-edit.js',
//     'public/assets/js/payments/create-edit.js').js('resources/assets/js/hospital_schedule/create-edit.js',
//     'public/assets/js/hospital_schedule/create-edit.js').js('resources/assets/js/invoices/invoice.js',
//     'public/assets/js/invoices/invoice.js').js('resources/assets/js/invoices/new.js',
//     'public/assets/js/invoices/new.js').js('resources/assets/js/schedules/schedules.js',
//     'public/assets/js/schedules/schedules.js').js('resources/assets/js/schedules/create-edit.js',
//     'public/assets/js/schedules/create-edit.js').js('resources/assets/js/services/services.js',
//     'public/assets/js/services/services.js').js('resources/assets/js/services/create-edit.js',
//     'public/assets/js/services/create-edit.js').js('resources/assets/js/packages/packages.js',
//     'public/assets/js/packages/packages.js').js('resources/assets/js/packages/create-edit.js',
//     'public/assets/js/packages/create-edit.js').js('resources/assets/js/case_handlers/case_handlers.js',
//     'public/assets/js/case_handlers/case_handlers.js').
//     //     js('resources/assets/js/case_handlers/case_handlers_data_listing.js',
//     //         'public/assets/js/case_handlers/case_handlers_data_listing.js').
//     js('resources/assets/js/case_handlers/create-edit.js',
//         'public/assets/js/case_handlers/create-edit.js').js('resources/assets/js/patient_cases_list/patient_cases_list.js',
//     'public/assets/js/patient_cases_list/patient_cases_list.js').js('resources/assets/js/employee/notice_boards.js',
//         'public/assets/js/employee/notice_boards.js').js('resources/assets/js/advanced_payments/advanced_payments.js',
//     'public/assets/js/advanced_payments/advanced_payments.js').js('resources/assets/js/advanced_payments/create-edit.js',
//     'public/assets/js/advanced_payments/create-edit.js').js('resources/assets/js/patient_admissions/patient_admission.js',
//     'public/assets/js/patient_admissions/patient_admission.js').js('resources/assets/js/patient_admissions/create-edit.js',
//     'public/assets/js/patient_admissions/create-edit.js').js('resources/assets/js/appointment_calendar/appointment_calendar.js',
//     'public/assets/js/appointment_calendar/appointment_calendar.js').js('resources/assets/js/enquiry/enquiry.js',
//     'public/assets/js/enquiry/enquiry.js').js('resources/assets/js/ambulances/ambulances.js',
//     'public/assets/js/ambulances/ambulances.js').js('resources/assets/js/ambulances/create-edit.js',
//     'public/assets/js/ambulances/create-edit.js').js('resources/assets/js/ambulance_call/ambulance_calls.js',
//     'public/assets/js/ambulance_call/ambulance_calls.js').js('resources/assets/js/ambulance_call/create-edit.js',
//     'public/assets/js/ambulance_call/create-edit.js').js('resources/assets/js/prescriptions/prescriptions.js',
//     'public/assets/js/prescriptions/prescriptions.js').js('resources/assets/js/patient_prescriptions/patient_prescriptions.js',
//     'public/assets/js/patient_prescriptions/patient_prescriptions.js').js('resources/assets/js/patient_prescriptions/create-edit.js',
//     'public/assets/js/patient_prescriptions/create-edit.js').js('resources/assets/js/prescriptions/create-edit.js',
//     'public/assets/js/prescriptions/create-edit.js').
//     js('resources/assets/js/employee/patient_admission.js',
//         'public/assets/js/employee/patient_admission.js').
//     js('resources/assets/js/employee/invoice.js',
//         'public/assets/js/employee/invoice.js').
//     js('resources/assets/js/employee/bill.js',
//         'public/assets/js/employee/bill.js').
//     js('resources/assets/js/charge_categories/charge_categories.js',
//         'public/assets/js/charge_categories/charge_categories.js').
//     js('resources/assets/js/charge_categories/create-edit.js',
//         'public/assets/js/charge_categories/create-edit.js').
//     js('resources/assets/js/charges/charges.js',
//         'public/assets/js/charges/charges.js').
//     js('resources/assets/js/charges/create-edit.js',
//         'public/assets/js/charges/create-edit.js').
//     js('resources/assets/js/radiology_categories/radiology_categories.js',
//         'public/assets/js/radiology_categories/radiology_categories.js').
//     js('resources/assets/js/pathology_categories/pathology_categories.js',
//         'public/assets/js/pathology_categories/pathology_categories.js').
//     js('resources/assets/js/radiology_tests/radiology_tests.js',
//         'public/assets/js/radiology_tests/radiology_tests.js').
//     js('resources/assets/js/radiology_tests/create-edit.js',
//         'public/assets/js/radiology_tests/create-edit.js').
//     js('resources/assets/js/doctor_opd_charges/doctor_opd_charges.js',
//         'public/assets/js/doctor_opd_charges/doctor_opd_charges.js').
//     js('resources/assets/js/pathology_tests/pathology_tests.js',
//         'public/assets/js/pathology_tests/pathology_tests.js').
//     js('resources/assets/js/pathology_tests/create-edit.js',
//         'public/assets/js/pathology_tests/create-edit.js').
//     js('resources/assets/js/expenses/expenses.js',
//         'public/assets/js/expenses/expenses.js').
//     js('resources/assets/js/incomes/incomes.js',
//     'public/assets/js/incomes/incomes.js').js('resources/assets/js/web/plugin.js',
//     'public/assets/js/web/plugin.js').js('resources/assets/js/sms/sms.js',
//     'public/assets/js/sms/sms.js').js('resources/assets/js/custom/phone-number-country-code.js',
//     'public/assets/js/custom/phone-number-country-code.js').js('resources/assets/js/dashboard/dashboard.js',
//     'public/assets/js/dashboard/dashboard.js').js('resources/assets/js/mail/mail.js',
//     'public/assets/js/mail/mail.js').js('resources/assets/js/patient_diagnosis_test/create-edit.js',
//     'public/assets/js/patient_diagnosis_test/create-edit.js').js('resources/assets/js/patient_diagnosis_test/patient_diagnosis_test.js',
//     'public/assets/js/patient_diagnosis_test/patient_diagnosis_test.js').js('resources/assets/js/diagnosis_category/diagnosis_category.js',
//     'public/assets/js/diagnosis_category/diagnosis_category.js').
//         js('resources/assets/js/sidebar_menu_search/sidebar_menu_search.js',
//             'public/assets/js/sidebar_menu_search/sidebar_menu_search.js').
//     js('resources/assets/js/employee/patient_diagnosis_test.js',
//         'public/assets/js/employee/patient_diagnosis_test.js').js('resources/assets/js/item_categories/item_categories.js',
//     'public/assets/js/item_categories/item_categories.js').
//     js('resources/assets/js/items/items.js',
//         'public/assets/js/items/items.js').
//     js('resources/assets/js/items/create-edit.js',
//         'public/assets/js/items/create-edit.js').
//     js('resources/assets/js/item_stocks/item_stocks.js',
//         'public/assets/js/item_stocks/item_stocks.js').
//     js('resources/assets/js/item_stocks/create-edit.js',
//     'public/assets/js/item_stocks/create-edit.js').js('resources/assets/js/issued_items/issued_items.js',
//     'public/assets/js/issued_items/issued_items.js').js('resources/assets/js/issued_items/create.js',
//     'public/assets/js/issued_items/create.js').js('resources/assets/js/ipd_patients/ipd_patients.js',
//     'public/assets/js/ipd_patients/ipd_patients.js').js('resources/assets/js/ipd_patients/create.js',
//     'public/assets/js/ipd_patients/create.js').js('resources/assets/js/ipd_diagnosis/ipd_diagnosis.js',
//     'public/assets/js/ipd_diagnosis/ipd_diagnosis.js').js('resources/assets/js/ipd_consultant_register/ipd_consultant_register.js',
//     'public/assets/js/ipd_consultant_register/ipd_consultant_register.js').js('resources/assets/js/ipd_charges/ipd_charges.js',
//     'public/assets/js/ipd_charges/ipd_charges.js').js('resources/assets/js/ipd_prescriptions/ipd_prescriptions.js',
//     'public/assets/js/ipd_prescriptions/ipd_prescriptions.js').js('resources/assets/js/ipd_timelines/ipd_timelines.js',
//     'public/assets/js/ipd_timelines/ipd_timelines.js').js('resources/assets/js/ipd_payments/ipd_payments.js',
//     'public/assets/js/ipd_payments/ipd_payments.js').js('resources/assets/js/ipd_patients_list/ipd_patients.js',
//     'public/assets/js/ipd_patients_list/ipd_patients.js').js('resources/assets/js/ipd_patients_list/ipd_diagnosis.js',
//     'public/assets/js/ipd_patients_list/ipd_diagnosis.js').js('resources/assets/js/ipd_patients_list/ipd_consultant_register.js',
//     'public/assets/js/ipd_patients_list/ipd_consultant_register.js').js('resources/assets/js/ipd_patients_list/ipd_charges.js',
//     'public/assets/js/ipd_patients_list/ipd_charges.js').js('resources/assets/js/ipd_patients_list/ipd_prescriptions.js',
//     'public/assets/js/ipd_patients_list/ipd_prescriptions.js').js('resources/assets/js/ipd_patients_list/ipd_timelines.js',
//     'public/assets/js/ipd_patients_list/ipd_timelines.js').js('resources/assets/js/ipd_patients_list/ipd_payments.js',
//     'public/assets/js/ipd_patients_list/ipd_payments.js').js('resources/assets/js/ipd_bills/ipd_bills.js',
//     'public/assets/js/ipd_bills/ipd_bills.js').js('resources/assets/js/opd_patients/opd_patients.js',
//     'public/assets/js/opd_patients/opd_patients.js').js('resources/assets/js/opd_patients/create.js',
//     'public/assets/js/opd_patients/create.js').js('resources/assets/js/opd_patients/visits.js',
//     'public/assets/js/opd_patients/visits.js').js('resources/assets/js/ipd_patients_list/ipd_stripe_payment.js',
//     'public/assets/js/ipd_patients_list/ipd_stripe_payment.js').js('resources/assets/js/opd_diagnosis/opd_diagnosis.js',
//         'public/assets/js/opd_diagnosis/opd_diagnosis.js').
//     js('resources/assets/js/opd_timelines/opd_timelines.js',
//     'public/assets/js/opd_timelines/opd_timelines.js').js('resources/assets/js/opd_patients_list/opd_patients.js',
//     'public/assets/js/opd_patients_list/opd_patients.js').js('resources/assets/js/opd_patients_list/visits.js',
//     'public/assets/js/opd_patients_list/visits.js').js('resources/assets/js/opd_patients_list/opd_diagnosis.js',
//     'public/assets/js/opd_patients_list/opd_diagnosis.js').js('resources/assets/js/opd_patients_list/opd_timelines.js',
//     'public/assets/js/opd_patients_list/opd_timelines.js').js('resources/assets/js/opd_tab_active/opd_tab_active.js',
//     'public/assets/js/opd_tab_active/opd_tab_active.js').js('resources/assets/js/call_logs/call_log.js',
//     'public/assets/js/call_logs/call_log.js').js('resources/assets/js/call_logs/create-edit.js',
//     'public/assets/js/call_logs/create-edit.js').js('resources/assets/js/visitors/visitor.js',
//     'public/assets/js/visitors/visitor.js').js('resources/assets/js/visitors/create-edit.js',
//     'public/assets/js/visitors/create-edit.js').js('resources/assets/js/postals/postal.js',
//     'public/assets/js/postals/postal.js').js('resources/assets/js/appointments/patient_appointment.js',
//     'public/assets/js/appointments/patient_appointment.js').js('resources/assets/js/testimonials/testimonial.js',
//     'public/assets/js/testimonials/testimonial.js').
//     js('resources/assets/js/blood_donations/blood_donations.js',
//         'public/assets/js/blood_donations/blood_donations.js').
//     js('resources/assets/js/blood_issues/blood_issues.js',
//         'public/assets/js/blood_issues/blood_issues.js').
//     js('resources/assets/js/live_consultations/live_consultations.js',
//         'public/assets/js/live_consultations/live_consultations.js').
//     js('resources/assets/js/live_consultations/live_meetings.js',
//         'public/assets/js/live_consultations/live_meetings.js').
//     js('resources/assets/js/vaccinations/vaccinations.js',
//         'public/assets/js/vaccinations/vaccinations.js').
//     js('resources/assets/js/vaccinated_patients/vaccinated_patients.js',
//         'public/assets/js/vaccinated_patients/vaccinated_patients.js').
//     js('resources/assets/js/vaccinated_patients/patient_vaccinated.js',
//         'public/assets/js/vaccinated_patients/patient_vaccinated.js').
//     js('resources/assets/js/users/user.js',
//         'public/assets/js/users/user.js').
//     js('resources/assets/js/users/create-edit.js',
//     'public/assets/js/users/create-edit.js').js('resources/assets/js/front_settings/front_settings.js',
//     'public/assets/js/front_settings/front_settings.js').js('resources/assets/js/web/appointment.js',
//     'public/assets/js/web/appointment.js').js('resources/assets/js/accounts/accounts_details_edit.js',
//     'public/assets/js/accounts/accounts_details_edit.js').
//     //     js('resources/assets/js/advanced_payments/advanced_payments_edit.js',
//     //         'public/assets/js/advanced_payments/advanced_payments_edit.js').
//     js('resources/assets/js/bed_types/bed_types_details_edit.js',
//         'public/assets/js/bed_types/bed_types_details_edit.js').js('resources/assets/js/beds/beds-details-edit.js',
//     'public/assets/js/beds/beds-details-edit.js').js('resources/assets/js/document/document-details-edit.js',
//     'public/assets/js/document/document-details-edit.js').js('resources/assets/js/document_type/doc_type-details-edit.js',
//     'public/assets/js/document_type/doc_type-details-edit.js').js('resources/assets/js/doctors_departments/doctors_departments-details-edit.js',
//     'public/assets/js/doctors_departments/doctors_departments-details-edit.js').js('resources/assets/js/birth_reports/create-details-edit.js',
//     'public/assets/js/birth_reports/create-details-edit.js').js('resources/assets/js/death_reports/death_reports-details-edit.js',
//     'public/assets/js/death_reports/death_reports-details-edit.js').
//     js('resources/assets/js/operation_reports/create-details-edit.js',
//     'public/assets/js/operation_reports/create-details-edit.js').js('resources/assets/js/category/category-details-edit.js',
//     'public/assets/js/category/category-details-edit.js').
//     js('resources/assets/js/diagnosis_category/diagnosis_category-details-edit.js',
//         'public/assets/js/diagnosis_category/diagnosis_category-details-edit.js').
//     js('resources/assets/js/expenses/expenses-details-edit.js',
//         'public/assets/js/expenses/expenses-details-edit.js').
//     js('resources/assets/js/charge_categories/create-details-edit.js',
//         'public/assets/js/charge_categories/create-details-edit.js').
//     js('resources/assets/js/charges/create-details-edit.js',
//         'public/assets/js/charges/create-details-edit.js').
//     js('resources/assets/js/notice_boards/create-details-edit.js',
//         'public/assets/js/notice_boards/create-details-edit.js').
//     js('resources/assets/js/incomes/incomes-details-edit.js',
//         'public/assets/js/incomes/incomes-details-edit.js').
//     js('resources/assets/js/front_settings/cms/create-edit.js',
//         'public/assets/js/front_settings/cms/create-edit.js').
//     js('resources/assets/js/front_settings/front_services/front_services.js',
//         'public/assets/js/front_settings/front_services/front_services.js').
//     js('resources/assets/js/front_settings/contact_us.js',
//         'public/assets/js/front_settings/contact_us.js').
//     js('resources/assets/js/employee_prescriptions/employee_prescriptions.js',
//     'public/assets/js/employee_prescriptions/employee_prescriptions.js')
//     .version();

// backend third party css

// mix.styles([
//     'node_modules/bootstrap-daterangepicker/daterangepicker.css',
//     'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
//     'node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',
//     'node_modules/intl-tel-input/build/css/intlTelInput.css',
//     'node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
//     'node_modules/lightgallery/css/lightgallery.css',
//     'node_modules/lightgallery/css/lg-transitions.css',
//     'node_modules/fullcalendar/main.min.css',
//     'node_modules/aos/dist/aos.css',
// ], 'public/css/third-party.css').version()

mix.styles('resources/assets/theme/css/style.css', 'public/assets/css/style.css');
mix.styles('resources/assets/theme/css/style.dark.css', 'public/assets/css/style.dark.css');
mix.styles('resources/assets/theme/css/plugins.css', 'public/assets/css/plugins.css');
mix.styles('resources/assets/theme/css/plugins.dark.css', 'public/assets/css/plugins.dark.css');
mix.styles('resources/assets/sass/phone-number-dark.scss','public/assets/css/phone-number-dark.css')

// third-party css
mix.styles([
    // 'resources/assets/theme/css/theme.css',
    'resources/assets/theme/css/third-party.css',
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
    'node_modules/quill/dist/quill.snow.css',
    // 'node_modules/quill/dist/quill.core.css',
    'node_modules/quill/dist/quill.bubble.css',
], 'public/assets/css/third-party.css')

// backend page css

// mix.sass('resources/assets/sass/main.scss', 'public/css/pages.css').version()
// mix.sass('resources/assets/sass/dark-custom.scss',
//     'public/assets/css/dark-custom.css').version()
mix.sass('resources/assets/sass/bill-pdf.scss',
    'public/assets/css/bill-pdf.css').version()
mix.sass('resources/assets/sass/prescriptions-pdf.scss',
    'public/assets/css/prescriptions-pdf.css').version()
mix.sass('resources/assets/sass/invoice-pdf.scss',
    'public/assets/css/invoice-pdf.css').version()
mix.sass('resources/assets/sass/diagnosis-test-pdf.scss',
    'public/assets/css/diagnosis-test-pdf.css').version()
mix.sass('resources/assets/sass/custom.scss',
    'public/assets/css/custom.css').version()
mix.sass('resources/assets/sass/custom-auth.scss',
    'public/assets/css/custom-auth.css').version()

//front-css
mix.sass('resources/assets/front/scss/bootstrap.scss',
    'public/web_front/css/bootstrap.css').version()
// mix.sass('resources/assets/front/scss/custom.scss',
//     'public/web_front/css/custom.css').version()
// mix.sass('resources/assets/front/scss/home.scss',
//     'public/web_front/css/home.css').version()
// mix.sass('resources/assets/front/scss/layout.scss',
//     'public/web_front/css/layout.css').version();
// mix.sass('resources/assets/front/scss/doctors.scss',
//     'public/web_front/css/doctors.css').version()
// mix.sass('resources/assets/front/scss/about.scss',
//     'public/web_front/css/about.css').version()
// mix.sass('resources/assets/front/scss/contact.scss',
//     'public/web_front/css/contact.css').version()
// mix.sass('resources/assets/front/scss/appointment.scss',
//     'public/web_front/css/appointment.css').version()
// mix.sass('resources/assets/front/scss/working-hours.scss',
//     'public/web_front/css/working-hours.css').version()
// mix.sass('resources/assets/front/scss/testimonials.scss',
//     'public/web_front/css/testimonials.css').version();

mix.styles([
    'public/web_front/css/slick.css',
    'public/web_front/css/slick-theme.css',
    'public/web_front/css/jquery-ui.min.css',
    'public/web_front/css/style.css',
    'resources/assets/front/scss/bootstrap.scss',
    'public/assets/css/all.min.css',
    'public/web_front/css/remixicon.css',
    'public/web_front/css/selectize.min.css',   
    'resources/assets/sass/selectize-input.scss',
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
], 'public/css/front-third-party.css').version();

mix.sass('resources/assets/front/scss/main.scss'
, 'public/css/front-pages.css').version();

// third-party js
mix.scripts([
    'resources/assets/theme/js/vendor.js',
    'resources/assets/theme/js/plugins.js',
    'node_modules/chart.js/dist/chart.js',
    'node_modules/intl-tel-input/build/js/intlTelInput.js',
    'node_modules/intl-tel-input/build/js/utils.js',
    'node_modules/quill/dist/quill.min.js',
    'node_modules/moment/min/moment-with-locales.js',
    'node_modules/moment-round/src/moment-round.js',
], 'public/assets/js/third-party.js').version();

// backend third party js
//
// mix.scripts([
//     'node_modules/bootstrap-daterangepicker/daterangepicker.js',
//     'node_modules/intl-tel-input/build/js/intlTelInput.js',
//     'node_modules/intl-tel-input/build/js/utils.js',
//     'node_modules/fullcalendar/main.js',
//     'node_modules/fullcalendar/locales-all.min.js',
//     'node_modules/@fortawesome/fontawesome-free/js/fontawesome.js',
//     'node_modules/aos/dist/aos.js'
// ], 'public/js/third-party.js')

//backend page js

mix.js([
    'resources/assets/js/turbo.js',
    'resources/assets/js/custom/custom.js',
    'resources/assets/js/custom/helpers.js',
    'resources/assets/js/custom/custom-datatable.js',
    'resources/assets/js/custom/new-edit-modal-form.js',
    'resources/assets/js/custom/delete.js',
    'resources/assets/js/sidebar_menu_search/sidebar_menu_search.js',
    'resources/assets/js/custom/reset_models.js',
    'resources/assets/js/custom/add-edit-profile-picture.js',
    'resources/assets/js/appointments/appointments.js',
    'resources/assets/js/appointments/create-edit.js',
    'resources/assets/js/brands/brands.js',
    'resources/assets/js/category/category.js',
    'resources/assets/js/category/medicines_list.js',
    'resources/assets/js/nurses/nurses.js',
    'resources/assets/js/nurses/nurses_data_listing.js',
    'resources/assets/js/nurses/create-edit.js',
    'resources/assets/js/doctors/doctors.js',
    'resources/assets/js/doctors/doctors_data_listing.js',
    'resources/assets/js/doctors/create-edit.js',
    'resources/assets/js/lab_technicians/lab_technicians.js',
    'resources/assets/js/lab_technicians/lab_technicians_data_listing.js',
    'resources/assets/js/lab_technicians/create-edit.js',
    'resources/assets/js/receptionists/receptionists.js',
    'resources/assets/js/receptionists/receptionists_data_listing.js',
    'resources/assets/js/receptionists/create-edit.js',
    'resources/assets/js/pharmacists/pharmacists.js',
    'resources/assets/js/pharmacists/pharmacists_data_listing.js',
    'resources/assets/js/pharmacists/create-edit.js',
    'resources/assets/js/patients/patients.js',
    'resources/assets/js/patients/patients_data_listing.js',
    'resources/assets/js/patients/create-edit.js',
    'resources/assets/js/admins/admin.js',
    'resources/assets/js/accountants/accountants.js',
    'resources/assets/js/accountants/accountants_data_listing.js',
    'resources/assets/js/accountants/create-edit.js',
    'resources/assets/js/custom/input_price_format.js',
    'resources/assets/js/bills/bill.js',
    'resources/assets/js/bills/new.js',
    'resources/assets/js/bills/edit.js',
    'resources/assets/js/blood_donors/blood_donors.js',
    'resources/assets/js/blood_banks/blood_banks.js',
    'resources/assets/js/bed_types/bed_types.js',
    'resources/assets/js/bed_types/beds_view_list.js',
    'resources/assets/js/beds/beds.js',
    'resources/assets/js/beds/beds_assigns_view_list.js',
    'resources/assets/js/beds/bulk_beds.js',
    'resources/assets/js/beds/create-edit.js',
    'resources/assets/js/medicines/medicines.js',
    'resources/assets/js/medicines/new.js',
    'resources/assets/js/document_type/doc_type.js',
    'resources/assets/js/document/document.js',
    'resources/assets/js/document_type/user_documents.js',
    'resources/assets/js/notice_boards/notice_boards.js',
    'resources/assets/js/notice_boards/create-edit.js',
    'resources/assets/js/bed_assign/bed_assign.js',
    'resources/assets/js/bed_assign/create-edit.js',
    'resources/assets/js/death_reports/death_reports.js',
    'resources/assets/js/death_reports/create-edit.js',
    'resources/assets/js/user_profile/user_profile.js',
    'resources/assets/js/birth_reports/birth_reports.js',
    'resources/assets/js/birth_reports/create-edit.js',
    'resources/assets/js/operation_reports/operation_reports.js',
    'resources/assets/js/operation_reports/create-edit.js',
    'resources/assets/js/employee_payrolls/employee_payrolls.js',
    'resources/assets/js/employee_payrolls/payrolls.js',
    'resources/assets/js/employee_payrolls/edit.js',
    'resources/assets/js/patient_cases/patient_cases.js',
    'resources/assets/js/patient_cases/create-edit.js',
    'resources/assets/js/employee/my_payrolls.js',
    'resources/assets/js/employee/doctors.js',
    'resources/assets/js/settings/setting.js',
    'resources/assets/js/doctors_departments/doctors_departments.js',
    'resources/assets/js/doctors_departments/doctor_departments_list.js',
    'resources/assets/js/investigation_reports/investigation_reports.js',
    'resources/assets/js/investigation_reports/create-edit.js',
    'resources/assets/js/accounts/accounts.js',
    'resources/assets/js/accounts/payments_list.js',
    'resources/assets/js/insurances/insurances.js',
    'resources/assets/js/insurances/create-edit.js',
    'resources/assets/js/payments/payments.js',
    'resources/assets/js/payment_reports/payments_reports.js',
    'resources/assets/js/payments/create-edit.js',
    'resources/assets/js/hospital_schedule/create-edit.js',
    'resources/assets/js/invoices/invoice.js',
    'resources/assets/js/invoices/new.js',
    'resources/assets/js/schedules/schedules.js',
    'resources/assets/js/schedules/create-edit.js',
    'resources/assets/js/services/services.js',
    'resources/assets/js/services/create-edit.js',
    'resources/assets/js/packages/packages.js',
    'resources/assets/js/packages/create-edit.js',
    'resources/assets/js/case_handlers/case_handlers.js',
    'resources/assets/js/case_handlers/create-edit.js',
    'resources/assets/js/patient_cases_list/patient_cases_list.js',
    'resources/assets/js/employee/notice_boards.js',
    'resources/assets/js/advanced_payments/advanced_payments.js',
    'resources/assets/js/advanced_payments/create-edit.js',
    'resources/assets/js/patient_admissions/patient_admission.js',
    'resources/assets/js/patient_admissions/create-edit.js',
    'resources/assets/js/appointment_calendar/appointment_calendar.js',
    'resources/assets/js/enquiry/enquiry.js',
    'resources/assets/js/ambulances/ambulances.js',
    'resources/assets/js/ambulances/create-edit.js',
    'resources/assets/js/ambulance_call/ambulance_calls.js',
    'resources/assets/js/ambulance_call/create-edit.js',
    'resources/assets/js/prescriptions/prescriptions.js',
    'resources/assets/js/patient_prescriptions/patient_prescriptions.js',
    'resources/assets/js/patient_prescriptions/create-edit.js',
    'resources/assets/js/prescriptions/create-edit.js',
    'resources/assets/js/employee/patient_admission.js',
    'resources/assets/js/employee/invoice.js',
    'resources/assets/js/employee/bill.js',
    'resources/assets/js/charge_categories/charge_categories.js',
    'resources/assets/js/charge_categories/create-edit.js',
    'resources/assets/js/charges/charges.js',
    'resources/assets/js/charges/create-edit.js',
    'resources/assets/js/radiology_categories/radiology_categories.js',
    'resources/assets/js/pathology_categories/pathology_categories.js',
    'resources/assets/js/radiology_tests/radiology_tests.js',
    'resources/assets/js/radiology_tests/create-edit.js',
    'resources/assets/js/doctor_opd_charges/doctor_opd_charges.js',
    'resources/assets/js/pathology_tests/pathology_tests.js',
    'resources/assets/js/pathology_tests/create-edit.js',
    'resources/assets/js/expenses/expenses.js',
    'resources/assets/js/incomes/incomes.js',
    'resources/assets/js/web/plugin.js',
    'resources/assets/js/sms/sms.js',
    'resources/assets/js/custom/phone-number-country-code.js',
    'resources/assets/js/dashboard/dashboard.js',
    'resources/assets/js/mail/mail.js',
    'resources/assets/js/patient_diagnosis_test/create-edit.js',
    'resources/assets/js/patient_diagnosis_test/patient_diagnosis_test.js',
    'resources/assets/js/diagnosis_category/diagnosis_category.js',
    'resources/assets/js/employee/patient_diagnosis_test.js',
    'resources/assets/js/item_categories/item_categories.js',
    'resources/assets/js/items/items.js',
    'resources/assets/js/items/create-edit.js',
    'resources/assets/js/item_stocks/item_stocks.js',
    'resources/assets/js/item_stocks/create-edit.js',
    'resources/assets/js/issued_items/issued_items.js',
    'resources/assets/js/issued_items/create.js',
    'resources/assets/js/ipd_patients/ipd_patients.js',
    'resources/assets/js/ipd_patients/create.js',
    'resources/assets/js/ipd_diagnosis/ipd_diagnosis.js',
    'resources/assets/js/ipd_consultant_register/ipd_consultant_register.js',
    'resources/assets/js/ipd_charges/ipd_charges.js',
    'resources/assets/js/ipd_prescriptions/ipd_prescriptions.js',
    'resources/assets/js/ipd_timelines/ipd_timelines.js',
    'resources/assets/js/ipd_payments/ipd_payments.js',
    'resources/assets/js/ipd_patients_list/ipd_patients.js',
    'resources/assets/js/ipd_patients_list/ipd_diagnosis.js',
    'resources/assets/js/ipd_patients_list/ipd_consultant_register.js',
    'resources/assets/js/ipd_patients_list/ipd_charges.js',
    'resources/assets/js/ipd_patients_list/ipd_prescriptions.js',
    'resources/assets/js/ipd_patients_list/ipd_timelines.js',
    'resources/assets/js/ipd_patients_list/ipd_payments.js',
    'resources/assets/js/ipd_patients_list/ipd_stripe_payment.js',
    'resources/assets/js/ipd_bills/ipd_bills.js',
    'resources/assets/js/opd_patients/opd_patients.js',
    'resources/assets/js/opd_patients/create.js',
    'resources/assets/js/opd_patients/visits.js',
    'resources/assets/js/opd_diagnosis/opd_diagnosis.js',
    'resources/assets/js/opd_timelines/opd_timelines.js',
    'resources/assets/js/opd_patients_list/opd_patients.js',
    'resources/assets/js/opd_patients_list/visits.js',
    'resources/assets/js/opd_patients_list/opd_diagnosis.js',
    'resources/assets/js/opd_patients_list/opd_timelines.js',
    'resources/assets/js/opd_tab_active/opd_tab_active.js',
    'resources/assets/js/call_logs/call_log.js',
    'resources/assets/js/call_logs/create-edit.js',
    'resources/assets/js/visitors/visitor.js',
    'resources/assets/js/visitors/create-edit.js',
    'resources/assets/js/postals/postal.js',
    'resources/assets/js/appointments/patient_appointment.js',
    'resources/assets/js/testimonials/testimonial.js',
    'resources/assets/js/blood_donations/blood_donations.js',
    'resources/assets/js/blood_issues/blood_issues.js',
    'resources/assets/js/live_consultations/live_consultations.js',
    'resources/assets/js/live_consultations/live_meetings.js',
    'resources/assets/js/vaccinations/vaccinations.js',
    'resources/assets/js/vaccinated_patients/vaccinated_patients.js',
    'resources/assets/js/vaccinated_patients/patient_vaccinated.js',
    'resources/assets/js/users/user.js',
    'resources/assets/js/users/create-edit.js',
   'resources/assets/js/front_settings/front_settings.js',
    'resources/assets/js/accounts/accounts_details_edit.js',
    'resources/assets/js/bed_types/bed_types_details_edit.js',
    'resources/assets/js/beds/beds-details-edit.js',
    'resources/assets/js/document/document-details-edit.js',
    'resources/assets/js/document_type/doc_type-details-edit.js',
    'resources/assets/js/doctors_departments/doctors_departments-details-edit.js',
    'resources/assets/js/birth_reports/create-details-edit.js',
    'resources/assets/js/death_reports/death_reports-details-edit.js',
    'resources/assets/js/operation_reports/create-details-edit.js',
    'resources/assets/js/category/category-details-edit.js',
    'resources/assets/js/diagnosis_category/diagnosis_category-details-edit.js',
    'resources/assets/js/expenses/expenses-details-edit.js',
    'resources/assets/js/charge_categories/create-details-edit.js',
    'resources/assets/js/charges/create-details-edit.js',
    'resources/assets/js/notice_boards/create-details-edit.js',
    'resources/assets/js/incomes/incomes-details-edit.js',
    'resources/assets/js/front_settings/cms/create-edit.js',
    'resources/assets/js/front_settings/front_services/front_services.js',
    'resources/assets/js/employee_prescriptions/employee_prescriptions.js',
    'resources/assets/js/currency_settings/create_edit.js',
], 'public/js/pages.js')

// front third party css    
// mix.styles([
//     'node_modules/intl-tel-input/build/css/intlTelInput.css',
// ], 'public/css/front-third-party.css').version()

// front page css

mix.sass('resources/assets/sass/front-main.scss', 'public/css/front-pages.css').
    version()

// front third-party js
mix.scripts([
    'resources/assets/theme/js/vendor.js',
    'resources/assets/theme/js/plugins.js',
    'public/web_front/js/jquery.min.js',
    'node_modules/intl-tel-input/build/js/intlTelInput.js',
    'node_modules/intl-tel-input/build/js/utils.js',
    'node_modules/moment/min/moment-with-locales.js',
    'node_modules/@fortawesome/fontawesome-free/js/all.min.js',
    'public/web_front/js/slick.min.js',
    'public/web_front/js/jquery.meanmenu.js',
    'public/web_front/js/owl.carousel.min.js',
    'public/web_front/js/jquery.appear.js',
    'public/web_front/js/jquery.magnific-popup.min.js',
    'public/web_front/js/selectize.min.js',
    'public/web_front/js/jquery-ui.js',
    'public/web_front/js/jquery-ui-i18n.min.js',
    'public/web_front/js/aos.js',
    'public/web_front/js/jquery.ajaxchimp.min.js',
    'public/web_front/js/form-validator.min.js',
    'public/web_front/js/main.js',
], 'public/js/front-third-party.js').version()

//front side page js
mix.js([
    'resources/assets/js/turbo.js',
    'resources/assets/js/web/plugin.js',
    'resources/assets/js/custom/helpers.js',
    'resources/assets/js/custom/custom.js',
    'resources/assets/js/web/web.js',
    'resources/assets/js/web/appointment.js',
    'resources/assets/js/custom/front-side-phone-number-country-code.js',
    'resources/assets/js/front_settings/contact_us.js',
], 'public/js/front-pages.js')





