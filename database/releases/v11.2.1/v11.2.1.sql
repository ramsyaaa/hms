-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 20, 2022 at 06:49 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infy_hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'country_code', '+91', '2022-09-21 01:35:12', '2022-09-21 01:35:12'),
(2, 'app_name', 'HMS', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(3, 'app_logo', 'http://infy-hms.test/web/img/logo.jpg', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(4, 'company_name', 'InfyOmLabs', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(5, 'current_currency', 'inr', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(6, 'hospital_address', '16/A saint Joseph Park', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(7, 'hospital_email', 'cityhospital@gmail.com', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(8, 'hospital_phone', '+919876543210', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(9, 'hospital_from_day', 'Mon to Fri', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(10, 'hospital_from_time', '9 AM to 9 PM', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(11, 'favicon', 'http://infy-hms.test/web/img/favicon.png', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(12, 'facebook_url', 'https://www.facebook.com/infyom/', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(13, 'twitter_url', 'https://twitter.com/infyom?lang=en', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(14, 'instagram_url', 'https://www.instagram.com/?hl=en', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(15, 'linkedIn_url', 'https://www.linkedin.com/organization-guest/company/infyom-technologies?challengeId=AQFgQaMxwSxCdAAAAXOA_wosiB2vYdQEoITs6w676AzV8cu8OzhnWEBNUQ7LCG4vds5-A12UIQk1M4aWfKmn6iM58OFJbpoRiA&submissi', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(16, 'about_us', 'Over past 10+ years of experience and skills in various technologies, we built great scalable products.\nWhatever technology we worked with, we just not build products for our clients but we a', '2022-09-21 01:35:13', '2022-09-21 01:35:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 20, 2022 at 06:51 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infy_hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `is_active`, `route`, `created_at`, `updated_at`) VALUES
(1, 'Employee Bills', 1, 'employee.bills.index', '2022-09-21 01:35:12', '2022-09-21 01:35:12'),
(2, 'Employee Bills Show', 1, 'employee.bills.show', '2022-09-21 01:35:12', '2022-09-21 01:35:12'),
(3, 'Employee Noticeboard', 1, 'employee.noticeboard', '2022-09-21 01:35:12', '2022-09-21 01:35:12'),
(4, 'Employee Patient Diagnosis Test Pdf', 1, 'employee.patient.diagnosis.test.pdf', '2022-09-21 01:35:12', '2022-09-21 01:35:12'),
(5, 'Patients', 1, 'patients.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(6, 'Doctors', 1, 'doctors.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(7, 'Accountants', 1, 'accountants.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(8, 'Medicines', 1, 'medicines.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(9, 'Nurses', 1, 'nurses.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(10, 'Receptionists', 1, 'receptionists.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(11, 'Lab Technicians', 1, 'lab-technicians.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(12, 'Pharmacists', 1, 'pharmacists.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(13, 'Birth Reports', 1, 'birth-reports.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(14, 'Death Reports', 1, 'death-reports.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(15, 'Investigation Reports', 1, 'investigation-reports.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(16, 'Operation Reports', 1, 'operation-reports.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(17, 'Income', 1, 'incomes.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(18, 'Expense', 1, 'expenses.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(19, 'SMS', 1, 'sms.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(20, 'IPD Patients', 1, 'ipd.patient.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(21, 'OPD Patients', 1, 'opd.patient.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(22, 'Accounts', 1, 'accounts.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(23, 'Employee Payrolls', 1, 'employee-payrolls.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(24, 'Invoices', 1, 'invoices.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(25, 'Payments', 1, 'payments.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(26, 'Payment Reports', 1, 'payment.reports', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(27, 'Advance Payments', 1, 'advanced-payments.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(28, 'Bills', 1, 'bills.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(29, 'Bed Types', 1, 'bed-types.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(30, 'Beds', 1, 'beds.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(31, 'Bed Assigns', 1, 'bed-assigns.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(32, 'Blood Banks', 1, 'blood-banks.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(33, 'Blood Donors', 1, 'blood-donors.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(34, 'Documents', 1, 'documents.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(35, 'Document Types', 1, 'document-types.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(36, 'Services', 1, 'services.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(37, 'Insurances', 1, 'insurances.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(38, 'Packages', 1, 'packages.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(39, 'Ambulances', 1, 'ambulances.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(40, 'Ambulances Calls', 1, 'ambulance-calls.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(41, 'Appointments', 1, 'appointments.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(42, 'Call Logs', 1, 'call_logs.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(43, 'Visitors', 1, 'visitors.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(44, 'Postal Receive', 1, 'receives.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(45, 'Postal Dispatch', 1, 'dispatches.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(46, 'Notice Boards', 1, 'noticeboard', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(47, 'Mail', 1, 'mail', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(48, 'Enquires', 1, 'enquiries', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(49, 'Charge Categories', 1, 'charge-categories.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(50, 'Charges', 1, 'charges.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(51, 'Doctor OPD Charges', 1, 'doctor-opd-charges.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(52, 'Items Categories', 1, 'item-categories.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(53, 'Items', 1, 'items.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(54, 'Item Stocks', 1, 'item.stock.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(55, 'Issued Items', 1, 'issued.item.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(56, 'Diagnosis Categories', 1, 'diagnosis.category.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(57, 'Diagnosis Tests', 1, 'patient.diagnosis.test.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(58, 'Pathology Categories', 1, 'pathology.category.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(59, 'Pathology Tests', 1, 'pathology.test.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(60, 'Radiology Categories', 1, 'radiology.category.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(61, 'Radiology Tests', 1, 'radiology.test.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(62, 'Medicine Categories', 1, 'categories.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(63, 'Medicine Brands', 1, 'brands.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(64, 'Doctor Departments', 1, 'doctor-departments.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(65, 'Schedules', 1, 'schedules.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(66, 'Prescriptions', 1, 'prescriptions.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(67, 'Cases', 1, 'patient-cases.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(68, 'Case Handlers', 1, 'case-handlers.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(69, 'Patient Admissions', 1, 'patient-admissions.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(70, 'My Payrolls', 1, 'payroll', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(71, 'Patient Cases', 1, 'patients.cases', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(72, 'Testimonial', 1, 'testimonials.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(73, 'Blood Donations', 1, 'blood-donations.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(74, 'Blood Issues', 1, 'blood-issues.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(75, 'Live Consultations', 1, 'live.consultation.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(76, 'Live Meetings', 1, 'live.meeting.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(77, 'Vaccinations', 1, 'vaccinations.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13'),
(78, 'Vaccinated Patients', 1, 'vaccinated-patients.index', '2022-09-21 01:35:13', '2022-09-21 01:35:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

