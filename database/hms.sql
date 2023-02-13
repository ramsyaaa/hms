-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table hospital.accountants
CREATE TABLE IF NOT EXISTS `accountants` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accountants_user_id_foreign` (`user_id`),
  CONSTRAINT `accountants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.accountants: ~0 rows (approximately)

-- Dumping structure for table hospital.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.accounts: ~0 rows (approximately)

-- Dumping structure for table hospital.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int DEFAULT NULL,
  `owner_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.addresses: ~0 rows (approximately)

-- Dumping structure for table hospital.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_default` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.admins: ~0 rows (approximately)

-- Dumping structure for table hospital.advanced_payments
CREATE TABLE IF NOT EXISTS `advanced_payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` bigint unsigned NOT NULL,
  `receipt_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advanced_payments_patient_id_foreign` (`patient_id`),
  KEY `advanced_payments_amount_index` (`amount`),
  CONSTRAINT `advanced_payments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.advanced_payments: ~0 rows (approximately)

-- Dumping structure for table hospital.ambulances
CREATE TABLE IF NOT EXISTS `ambulances` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_number` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_model` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_made` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `vehicle_type` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ambulances_vehicle_number_index` (`vehicle_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ambulances: ~0 rows (approximately)

-- Dumping structure for table hospital.ambulance_calls
CREATE TABLE IF NOT EXISTS `ambulance_calls` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `ambulance_id` int unsigned NOT NULL,
  `driver_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ambulance_calls_patient_id_foreign` (`patient_id`),
  KEY `ambulance_calls_ambulance_id_foreign` (`ambulance_id`),
  KEY `ambulance_calls_date_index` (`date`),
  CONSTRAINT `ambulance_calls_ambulance_id_foreign` FOREIGN KEY (`ambulance_id`) REFERENCES `ambulances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ambulance_calls_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ambulance_calls: ~0 rows (approximately)

-- Dumping structure for table hospital.appointments
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `opd_date` datetime NOT NULL,
  `problem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_doctor_id_foreign` (`doctor_id`),
  KEY `appointments_opd_date_index` (`opd_date`),
  KEY `appointments_patient_id_foreign` (`patient_id`),
  KEY `appointments_department_id_foreign` (`department_id`),
  CONSTRAINT `appointments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `doctor_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.appointments: ~0 rows (approximately)
INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `department_id`, `opd_date`, `problem`, `is_completed`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, '2023-02-12 08:00:00', NULL, 1, '2023-02-10 07:30:56', '2023-02-10 07:31:37');

-- Dumping structure for table hospital.beds
CREATE TABLE IF NOT EXISTS `beds` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `bed_type` int unsigned NOT NULL,
  `bed_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `charge` int NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beds_bed_type_foreign` (`bed_type`),
  KEY `beds_is_available_index` (`is_available`),
  CONSTRAINT `beds_bed_type_foreign` FOREIGN KEY (`bed_type`) REFERENCES `bed_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.beds: ~6 rows (approximately)
INSERT INTO `beds` (`id`, `bed_type`, `bed_id`, `name`, `description`, `charge`, `is_available`, `created_at`, `updated_at`) VALUES
	(1, 1, 'LLHLRTJ1', 'Penyakit Dalam 1', 'Khusus untuk penyakit dalam', 100000, 1, '2023-02-12 18:09:59', '2023-02-12 18:09:59'),
	(2, 1, 'LC2YWBLZ', 'Penyakit Dalam 2', 'Khusus untuk penyakit dalam', 100000, 1, '2023-02-12 18:09:59', '2023-02-12 18:09:59'),
	(3, 1, 'R4VVOPG7', 'Kulit dan Kelamin 1', 'Khusus untuk penyakit kulit dan kelamin', 150000, 1, '2023-02-12 18:09:59', '2023-02-12 18:09:59'),
	(4, 1, '6ZXVGEE4', 'Kulit dan Kelamin 2', 'Khusus untuk penyakit kulit dan kelamin', 150000, 1, '2023-02-12 18:09:59', '2023-02-12 18:09:59'),
	(5, 2, 'OPXD6NDT', 'Anak 1', 'Khusus untuk anak', 100000, 1, '2023-02-12 18:11:30', '2023-02-12 18:11:30'),
	(6, 2, '2WPKLW18', 'Anak 2', 'Khusus untuk anak', 100000, 1, '2023-02-12 18:11:30', '2023-02-12 18:11:30');

-- Dumping structure for table hospital.bed_assigns
CREATE TABLE IF NOT EXISTS `bed_assigns` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `bed_id` int unsigned NOT NULL,
  `ipd_patient_department_id` int unsigned DEFAULT NULL,
  `patient_id` int unsigned NOT NULL,
  `case_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign_date` datetime NOT NULL,
  `discharge_date` datetime DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bed_assigns_bed_id_foreign` (`bed_id`),
  KEY `bed_assigns_patient_id_foreign` (`patient_id`),
  KEY `bed_assigns_created_at_assign_date_index` (`created_at`,`assign_date`),
  KEY `bed_assigns_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  CONSTRAINT `bed_assigns_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bed_assigns_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bed_assigns_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.bed_assigns: ~0 rows (approximately)

-- Dumping structure for table hospital.bed_types
CREATE TABLE IF NOT EXISTS `bed_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bed_types_title_index` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.bed_types: ~0 rows (approximately)
INSERT INTO `bed_types` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Tulip', 'Untuk Kamar Tipe Tulip', '2023-02-10 07:22:55', '2023-02-12 18:08:03'),
	(2, 'Anyelir', NULL, '2023-02-12 18:10:46', '2023-02-12 18:10:46');

-- Dumping structure for table hospital.bills
CREATE TABLE IF NOT EXISTS `bills` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `bill_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int unsigned NOT NULL,
  `bill_date` datetime NOT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patient_admission_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bills_patient_id_foreign` (`patient_id`),
  KEY `bills_bill_date_index` (`bill_date`),
  CONSTRAINT `bills_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.bills: ~0 rows (approximately)

-- Dumping structure for table hospital.bill_items
CREATE TABLE IF NOT EXISTS `bill_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bill_id` int unsigned NOT NULL,
  `qty` int unsigned NOT NULL,
  `price` double(8,2) NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_items_bill_id_foreign` (`bill_id`),
  CONSTRAINT `bill_items_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.bill_items: ~0 rows (approximately)

-- Dumping structure for table hospital.birth_reports
CREATE TABLE IF NOT EXISTS `birth_reports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `case_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `date` datetime NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `birth_reports_patient_id_foreign` (`patient_id`),
  KEY `birth_reports_doctor_id_foreign` (`doctor_id`),
  KEY `birth_reports_date_index` (`date`),
  CONSTRAINT `birth_reports_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `birth_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.birth_reports: ~0 rows (approximately)

-- Dumping structure for table hospital.blood_banks
CREATE TABLE IF NOT EXISTS `blood_banks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `blood_group` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remained_bags` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blood_banks_remained_bags_index` (`remained_bags`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.blood_banks: ~0 rows (approximately)
INSERT INTO `blood_banks` (`id`, `blood_group`, `remained_bags`, `created_at`, `updated_at`) VALUES
	(1, 'O', 10, '2023-02-10 07:10:24', '2023-02-10 07:10:24'),
	(2, 'A', 12, '2023-02-10 07:10:30', '2023-02-10 07:10:30');

-- Dumping structure for table hospital.blood_donations
CREATE TABLE IF NOT EXISTS `blood_donations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `blood_donor_id` int unsigned NOT NULL,
  `bags` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blood_donations_blood_donor_id_foreign` (`blood_donor_id`),
  CONSTRAINT `blood_donations_blood_donor_id_foreign` FOREIGN KEY (`blood_donor_id`) REFERENCES `blood_donors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.blood_donations: ~0 rows (approximately)

-- Dumping structure for table hospital.blood_donors
CREATE TABLE IF NOT EXISTS `blood_donors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `gender` int NOT NULL,
  `blood_group` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_donate_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blood_donors_created_at_last_donate_date_index` (`created_at`,`last_donate_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.blood_donors: ~0 rows (approximately)

-- Dumping structure for table hospital.blood_issues
CREATE TABLE IF NOT EXISTS `blood_issues` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `issue_date` datetime NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `donor_id` int unsigned NOT NULL,
  `patient_id` int unsigned NOT NULL,
  `amount` bigint DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blood_issues_doctor_id_foreign` (`doctor_id`),
  KEY `blood_issues_donor_id_foreign` (`donor_id`),
  KEY `blood_issues_patient_id_foreign` (`patient_id`),
  CONSTRAINT `blood_issues_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blood_issues_donor_id_foreign` FOREIGN KEY (`donor_id`) REFERENCES `blood_donors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blood_issues_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.blood_issues: ~0 rows (approximately)

-- Dumping structure for table hospital.brands
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brands_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.brands: ~0 rows (approximately)

-- Dumping structure for table hospital.call_logs
CREATE TABLE IF NOT EXISTS `call_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `call_type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.call_logs: ~0 rows (approximately)

-- Dumping structure for table hospital.case_handlers
CREATE TABLE IF NOT EXISTS `case_handlers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `case_handlers_user_id_foreign` (`user_id`),
  CONSTRAINT `case_handlers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.case_handlers: ~0 rows (approximately)

-- Dumping structure for table hospital.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.categories: ~0 rows (approximately)

-- Dumping structure for table hospital.charges
CREATE TABLE IF NOT EXISTS `charges` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `charge_type` int NOT NULL,
  `charge_category_id` int unsigned NOT NULL,
  `code` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_charge` bigint NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charges_charge_category_id_foreign` (`charge_category_id`),
  KEY `charges_code_index` (`code`),
  CONSTRAINT `charges_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.charges: ~0 rows (approximately)

-- Dumping structure for table hospital.charge_categories
CREATE TABLE IF NOT EXISTS `charge_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `charge_type` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charge_categories_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.charge_categories: ~0 rows (approximately)

-- Dumping structure for table hospital.currency_settings
CREATE TABLE IF NOT EXISTS `currency_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.currency_settings: ~2 rows (approximately)
INSERT INTO `currency_settings` (`id`, `currency_name`, `currency_icon`, `currency_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 'Rupiah', 'Rp.', 'IDR', '2023-02-10 07:07:06', '2023-02-10 07:07:06', NULL);

-- Dumping structure for table hospital.death_reports
CREATE TABLE IF NOT EXISTS `death_reports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `case_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `date` datetime NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `death_reports_patient_id_foreign` (`patient_id`),
  KEY `death_reports_doctor_id_foreign` (`doctor_id`),
  KEY `death_reports_date_index` (`date`),
  CONSTRAINT `death_reports_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `death_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.death_reports: ~0 rows (approximately)

-- Dumping structure for table hospital.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.departments: ~0 rows (approximately)
INSERT INTO `departments` (`id`, `name`, `is_active`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(2, 'Doctor', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(3, 'Patient', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(4, 'Nurse', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(5, 'Receptionist', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(6, 'Pharmacist', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(7, 'Accountant', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(8, 'Case Manager', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(9, 'Lab Technician', 1, 'web', '2023-02-09 23:57:03', '2023-02-09 23:57:03'),
	(10, 'Admin', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(11, 'Doctor', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(12, 'Patient', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(13, 'Nurse', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(14, 'Receptionist', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(15, 'Pharmacist', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(16, 'Accountant', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(17, 'Case Manager', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(18, 'Lab Technician', 1, 'web', '2023-02-09 23:57:55', '2023-02-09 23:57:55'),
	(19, 'Admin', 1, 'web', '2023-02-09 23:58:09', '2023-02-09 23:58:09'),
	(20, 'Doctor', 1, 'web', '2023-02-09 23:58:10', '2023-02-09 23:58:10'),
	(21, 'Patient', 1, 'web', '2023-02-09 23:58:10', '2023-02-09 23:58:10'),
	(22, 'Nurse', 1, 'web', '2023-02-09 23:58:10', '2023-02-09 23:58:10'),
	(23, 'Receptionist', 1, 'web', '2023-02-09 23:58:10', '2023-02-09 23:58:10'),
	(24, 'Pharmacist', 1, 'web', '2023-02-09 23:58:10', '2023-02-09 23:58:10'),
	(25, 'Accountant', 1, 'web', '2023-02-09 23:58:10', '2023-02-09 23:58:10'),
	(26, 'Case Manager', 1, 'web', '2023-02-09 23:58:10', '2023-02-09 23:58:10'),
	(27, 'Lab Technician', 1, 'web', '2023-02-09 23:58:10', '2023-02-09 23:58:10'),
	(28, 'Admin', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(29, 'Doctor', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(30, 'Patient', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(31, 'Nurse', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(32, 'Receptionist', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(33, 'Pharmacist', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(34, 'Accountant', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(35, 'Case Manager', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(36, 'Lab Technician', 1, 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32');

-- Dumping structure for table hospital.diagnosis_categories
CREATE TABLE IF NOT EXISTS `diagnosis_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diagnosis_categories_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.diagnosis_categories: ~1 rows (approximately)
INSERT INTO `diagnosis_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Check Fisik', NULL, '2023-02-10 07:32:02', '2023-02-10 07:32:02');

-- Dumping structure for table hospital.doctors
CREATE TABLE IF NOT EXISTS `doctors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `doctor_department_id` bigint unsigned NOT NULL,
  `specialist` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctors_user_id_foreign` (`user_id`),
  KEY `doctors_doctor_department_id_foreign` (`doctor_department_id`),
  CONSTRAINT `doctors_doctor_department_id_foreign` FOREIGN KEY (`doctor_department_id`) REFERENCES `doctor_departments` (`id`),
  CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.doctors: ~1 rows (approximately)
INSERT INTO `doctors` (`id`, `user_id`, `doctor_department_id`, `specialist`, `created_at`, `updated_at`) VALUES
	(1, 7, 1, 'Anak', '2023-02-10 07:22:30', '2023-02-10 07:22:30');

-- Dumping structure for table hospital.doctor_departments
CREATE TABLE IF NOT EXISTS `doctor_departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_departments_title_index` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.doctor_departments: ~0 rows (approximately)
INSERT INTO `doctor_departments` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Anak', 'Spesialis Anak', '2023-02-10 07:10:04', '2023-02-10 07:10:04');

-- Dumping structure for table hospital.doctor_opd_charges
CREATE TABLE IF NOT EXISTS `doctor_opd_charges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned NOT NULL,
  `standard_charge` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_opd_charges_doctor_id_foreign` (`doctor_id`),
  KEY `doctor_opd_charges_created_at_index` (`created_at`),
  CONSTRAINT `doctor_opd_charges_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.doctor_opd_charges: ~0 rows (approximately)

-- Dumping structure for table hospital.documents
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `uploaded_by` bigint unsigned NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.documents: ~0 rows (approximately)

-- Dumping structure for table hospital.document_types
CREATE TABLE IF NOT EXISTS `document_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_types_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.document_types: ~0 rows (approximately)

-- Dumping structure for table hospital.employee_payrolls
CREATE TABLE IF NOT EXISTS `employee_payrolls` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sr_no` bigint NOT NULL,
  `payroll_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int NOT NULL,
  `owner_id` int NOT NULL,
  `owner_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `net_salary` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `basic_salary` double NOT NULL,
  `allowance` double NOT NULL,
  `deductions` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_payrolls_id_sr_no_index` (`id`,`sr_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.employee_payrolls: ~0 rows (approximately)

-- Dumping structure for table hospital.enquiries
CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewed_by` bigint unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enquiries_viewed_by_foreign` (`viewed_by`),
  KEY `enquiries_created_at_index` (`created_at`),
  CONSTRAINT `enquiries_viewed_by_foreign` FOREIGN KEY (`viewed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.enquiries: ~0 rows (approximately)

-- Dumping structure for table hospital.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `expense_head` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_date_index` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.expenses: ~0 rows (approximately)

-- Dumping structure for table hospital.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table hospital.front_services
CREATE TABLE IF NOT EXISTS `front_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.front_services: ~0 rows (approximately)
INSERT INTO `front_services` (`id`, `name`, `short_description`, `created_at`, `updated_at`) VALUES
	(1, 'Cardiology', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(2, 'Orthopedics', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(3, 'Pulmonology', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(4, 'Dental Care', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(5, 'Medicine', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(6, 'Ambulance', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(7, 'Ophthalmology', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(8, 'Neurology', 'image Cardiology Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.', '2023-02-09 23:59:34', '2023-02-09 23:59:34');

-- Dumping structure for table hospital.front_settings
CREATE TABLE IF NOT EXISTS `front_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.front_settings: ~28 rows (approximately)
INSERT INTO `front_settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
	(1, 'about_us_title', 'About For HMS', '1', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(2, 'about_us_description', 'HMS will teach physicians and nurses from around the world the principles of blood management, as well as how to manage their own blood conservation programs. The hospital was chosen based on the reputation its bloodless program has established in the medical community and because of its nationally recognized results.\n\nWe are a group of creative nerds making awesome stuff for Web and Mobile. We just love to contribute to open source technologies. We always try to build something which helps developers to save their time. so they can spend a bit more time with their friends And family.', '1', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(3, 'about_us_mission', 'We are providing advanced emergency services. We have well-equipped emergency and trauma center with facilities.', '1', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(4, 'about_us_image', 'http://localhost/assets/img/default_image.jpg', '1', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(5, 'home_page_experience', '10', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(6, 'home_page_title', 'Find Local Specialists Best Services', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(7, 'home_page_description', 'Our medical clinic provides quality care for the entire family while maintaining a personable atmosphere best services.', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(8, 'home_page_image', 'http://127.0.0.1:8000/uploads/13/eldery_treatment_03.jpg', '2', '2023-02-09 23:59:34', '2023-02-12 17:53:37'),
	(9, 'terms_conditions', 'terms_conditions', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(10, 'privacy_policy', 'privacy_policy', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(11, 'home_page_certified_doctor_image', 'http://127.0.0.1:8000/uploads/14/Healthcare-Character-01.jpg', '2', '2023-02-09 23:59:34', '2023-02-12 17:53:37'),
	(12, 'home_page_certified_doctor_text', 'Quality Healthcare', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(13, 'home_page_certified_doctor_title', 'Have Certified and High Quality Doctor For You', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(14, 'home_page_certified_doctor_description', 'Our medical clinic provides quality care for the entire family while maintaining a personable atmosphere best services. Our medical clinic provides quality. Our medical clinic provides quality care for the entire family while maintaining lizam a personable atmosphere best services. Our medical clinic provides.', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(15, 'home_page_box_title', 'Free Consulting', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(16, 'home_page_box_description', 'Proin gravida nibh vel velit auctor aliquet.', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(17, 'home_page_step_1_title', 'Check Doctor Profile', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(18, 'home_page_step_1_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(19, 'home_page_step_2_title', 'Request Consulting', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(20, 'home_page_step_2_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(21, 'home_page_step_3_title', 'Receive Consulting', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(22, 'home_page_step_3_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(23, 'home_page_step_4_title', 'Get Your Solution', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(24, 'home_page_step_4_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit.', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(25, 'home_page_certified_box_title', 'Certified Doctor', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(26, 'home_page_certified_box_description', 'Proin gravida nibh vel velit auctor aliquet.', '2', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(27, 'appointment_title', 'Contact Now and Get the Best Doctor Service Today', '3', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(28, 'appointment_description', 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor nisi elit consequat ipsum nec sagittis.', '3', '2023-02-09 23:59:34', '2023-02-09 23:59:34');

-- Dumping structure for table hospital.hospital_schedules
CREATE TABLE IF NOT EXISTS `hospital_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `day_of_week` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.hospital_schedules: ~0 rows (approximately)
INSERT INTO `hospital_schedules` (`id`, `day_of_week`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
	(1, '1', '00:00', '23:45', '2023-02-10 07:26:47', '2023-02-10 07:26:47'),
	(2, '2', '00:00', '23:45', '2023-02-10 07:26:47', '2023-02-10 07:26:47'),
	(3, '3', '00:00', '23:45', '2023-02-10 07:26:47', '2023-02-10 07:26:47'),
	(4, '4', '00:00', '23:45', '2023-02-10 07:26:47', '2023-02-10 07:26:47'),
	(5, '5', '00:00', '23:45', '2023-02-10 07:26:47', '2023-02-10 07:26:47'),
	(6, '6', '00:00', '23:45', '2023-02-10 07:26:47', '2023-02-10 07:26:47'),
	(7, '7', '00:00', '23:45', '2023-02-10 07:26:47', '2023-02-10 07:26:47');

-- Dumping structure for table hospital.incomes
CREATE TABLE IF NOT EXISTS `incomes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `income_head` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incomes_date_index` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.incomes: ~0 rows (approximately)

-- Dumping structure for table hospital.insurances
CREATE TABLE IF NOT EXISTS `insurances` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_tax` double NOT NULL,
  `discount` double DEFAULT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `insurance_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `insurance_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_rate` double NOT NULL,
  `total` double NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insurances_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.insurances: ~0 rows (approximately)

-- Dumping structure for table hospital.insurance_diseases
CREATE TABLE IF NOT EXISTS `insurance_diseases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `insurance_id` int unsigned NOT NULL,
  `disease_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_charge` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insurance_diseases_insurance_id_foreign` (`insurance_id`),
  CONSTRAINT `insurance_diseases_insurance_id_foreign` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.insurance_diseases: ~0 rows (approximately)

-- Dumping structure for table hospital.investigation_reports
CREATE TABLE IF NOT EXISTS `investigation_reports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `doctor_id` bigint unsigned NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `investigation_reports_patient_id_foreign` (`patient_id`),
  KEY `investigation_reports_doctor_id_foreign` (`doctor_id`),
  KEY `investigation_reports_date_index` (`date`),
  CONSTRAINT `investigation_reports_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `investigation_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.investigation_reports: ~0 rows (approximately)

-- Dumping structure for table hospital.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int unsigned NOT NULL,
  `invoice_date` date NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_patient_id_foreign` (`patient_id`),
  KEY `invoices_invoice_date_index` (`invoice_date`),
  CONSTRAINT `invoices_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.invoices: ~0 rows (approximately)

-- Dumping structure for table hospital.invoice_items
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int unsigned NOT NULL,
  `invoice_id` int unsigned NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL,
  `price` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_account_id_foreign` (`account_id`),
  KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `invoice_items_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.invoice_items: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_bills
CREATE TABLE IF NOT EXISTS `ipd_bills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ipd_patient_department_id` int unsigned NOT NULL,
  `total_charges` int NOT NULL,
  `total_payments` int NOT NULL,
  `gross_total` int NOT NULL,
  `discount_in_percentage` int NOT NULL,
  `tax_in_percentage` int NOT NULL,
  `other_charges` int NOT NULL,
  `net_payable_amount` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipd_bills_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  CONSTRAINT `ipd_bills_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_bills: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_charges
CREATE TABLE IF NOT EXISTS `ipd_charges` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ipd_patient_department_id` int unsigned NOT NULL,
  `date` date NOT NULL,
  `charge_type_id` int NOT NULL,
  `charge_category_id` int unsigned NOT NULL,
  `charge_id` int unsigned NOT NULL,
  `standard_charge` int DEFAULT NULL,
  `applied_charge` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipd_charges_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  KEY `ipd_charges_charge_category_id_foreign` (`charge_category_id`),
  KEY `ipd_charges_charge_id_foreign` (`charge_id`),
  CONSTRAINT `ipd_charges_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_charges_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_charges: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_consultant_registers
CREATE TABLE IF NOT EXISTS `ipd_consultant_registers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ipd_patient_department_id` int unsigned NOT NULL,
  `applied_date` datetime NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `instruction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipd_consultant_registers_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  KEY `ipd_consultant_registers_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `ipd_consultant_registers_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_consultant_registers_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_consultant_registers: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_diagnoses
CREATE TABLE IF NOT EXISTS `ipd_diagnoses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ipd_patient_department_id` int unsigned NOT NULL,
  `report_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_date` datetime NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipd_diagnoses_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  CONSTRAINT `ipd_diagnoses_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_diagnoses: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_patient_departments
CREATE TABLE IF NOT EXISTS `ipd_patient_departments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `ipd_number` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symptoms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `admission_date` datetime NOT NULL,
  `case_id` int unsigned NOT NULL,
  `is_old_patient` tinyint(1) DEFAULT '0',
  `doctor_id` bigint unsigned DEFAULT NULL,
  `bed_type_id` int unsigned DEFAULT NULL,
  `bed_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bill_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ipd_patient_departments_ipd_number_unique` (`ipd_number`),
  KEY `ipd_patient_departments_patient_id_foreign` (`patient_id`),
  KEY `ipd_patient_departments_case_id_foreign` (`case_id`),
  KEY `ipd_patient_departments_doctor_id_foreign` (`doctor_id`),
  KEY `ipd_patient_departments_bed_type_id_foreign` (`bed_type_id`),
  KEY `ipd_patient_departments_bed_id_foreign` (`bed_id`),
  CONSTRAINT `ipd_patient_departments_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_patient_departments_bed_type_id_foreign` FOREIGN KEY (`bed_type_id`) REFERENCES `bed_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_patient_departments_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `patient_cases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_patient_departments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_patient_departments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_patient_departments: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_payments
CREATE TABLE IF NOT EXISTS `ipd_payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ipd_patient_department_id` int unsigned NOT NULL,
  `amount` int NOT NULL,
  `date` date NOT NULL,
  `payment_mode` tinyint NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `transaction_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipd_payments_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  CONSTRAINT `ipd_payments_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_payments: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_prescriptions
CREATE TABLE IF NOT EXISTS `ipd_prescriptions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ipd_patient_department_id` int unsigned NOT NULL,
  `header_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `footer_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipd_prescriptions_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  CONSTRAINT `ipd_prescriptions_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_prescriptions: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_prescription_items
CREATE TABLE IF NOT EXISTS `ipd_prescription_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ipd_prescription_id` int unsigned NOT NULL,
  `category_id` int unsigned NOT NULL,
  `medicine_id` int unsigned NOT NULL,
  `dosage` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipd_prescription_items_ipd_prescription_id_foreign` (`ipd_prescription_id`),
  KEY `ipd_prescription_items_category_id_foreign` (`category_id`),
  KEY `ipd_prescription_items_medicine_id_foreign` (`medicine_id`),
  CONSTRAINT `ipd_prescription_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_prescription_items_ipd_prescription_id_foreign` FOREIGN KEY (`ipd_prescription_id`) REFERENCES `ipd_prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ipd_prescription_items_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_prescription_items: ~0 rows (approximately)

-- Dumping structure for table hospital.ipd_timelines
CREATE TABLE IF NOT EXISTS `ipd_timelines` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ipd_patient_department_id` int unsigned NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `visible_to_person` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ipd_timelines_ipd_patient_department_id_foreign` (`ipd_patient_department_id`),
  CONSTRAINT `ipd_timelines_ipd_patient_department_id_foreign` FOREIGN KEY (`ipd_patient_department_id`) REFERENCES `ipd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.ipd_timelines: ~0 rows (approximately)

-- Dumping structure for table hospital.issued_items
CREATE TABLE IF NOT EXISTS `issued_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `issued_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `issued_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `item_category_id` int unsigned NOT NULL,
  `item_id` int unsigned NOT NULL,
  `quantity` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `issued_items_department_id_foreign` (`department_id`),
  KEY `issued_items_user_id_foreign` (`user_id`),
  KEY `issued_items_item_category_id_foreign` (`item_category_id`),
  KEY `issued_items_item_id_foreign` (`item_id`),
  CONSTRAINT `issued_items_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `issued_items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `issued_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `issued_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.issued_items: ~0 rows (approximately)

-- Dumping structure for table hospital.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_category_id` int unsigned NOT NULL,
  `unit` bigint NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `available_quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_item_category_id_foreign` (`item_category_id`),
  CONSTRAINT `items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.items: ~0 rows (approximately)

-- Dumping structure for table hospital.item_categories
CREATE TABLE IF NOT EXISTS `item_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_categories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.item_categories: ~0 rows (approximately)

-- Dumping structure for table hospital.item_stocks
CREATE TABLE IF NOT EXISTS `item_stocks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `item_category_id` int unsigned NOT NULL,
  `item_id` int unsigned NOT NULL,
  `supplier_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `purchase_price` double NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_stocks_item_category_id_foreign` (`item_category_id`),
  KEY `item_stocks_item_id_foreign` (`item_id`),
  CONSTRAINT `item_stocks_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_stocks_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.item_stocks: ~0 rows (approximately)

-- Dumping structure for table hospital.lab_technicians
CREATE TABLE IF NOT EXISTS `lab_technicians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lab_technicians_user_id_foreign` (`user_id`),
  CONSTRAINT `lab_technicians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.lab_technicians: ~0 rows (approximately)

-- Dumping structure for table hospital.live_consultations
CREATE TABLE IF NOT EXISTS `live_consultations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned NOT NULL,
  `patient_id` int unsigned NOT NULL,
  `consultation_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultation_date` datetime NOT NULL,
  `host_video` tinyint(1) NOT NULL,
  `participant_video` tinyint(1) NOT NULL,
  `consultation_duration_minutes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meeting_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `time_zone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `live_consultations_doctor_id_foreign` (`doctor_id`),
  KEY `live_consultations_patient_id_foreign` (`patient_id`),
  CONSTRAINT `live_consultations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `live_consultations_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.live_consultations: ~0 rows (approximately)

-- Dumping structure for table hospital.live_meetings
CREATE TABLE IF NOT EXISTS `live_meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `consultation_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultation_date` datetime NOT NULL,
  `consultation_duration_minutes` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `host_video` tinyint(1) NOT NULL,
  `participant_video` tinyint(1) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meeting_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_zone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.live_meetings: ~0 rows (approximately)

-- Dumping structure for table hospital.live_meetings_candidates
CREATE TABLE IF NOT EXISTS `live_meetings_candidates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `live_meeting_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.live_meetings_candidates: ~0 rows (approximately)

-- Dumping structure for table hospital.mails
CREATE TABLE IF NOT EXISTS `mails` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `to` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachments` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mails_user_id_foreign` (`user_id`),
  CONSTRAINT `mails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.mails: ~0 rows (approximately)

-- Dumping structure for table hospital.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `collection_name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsive_images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `conversions_disk` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generated_conversions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.media: ~0 rows (approximately)
INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`, `conversions_disk`, `uuid`, `generated_conversions`) VALUES
	(13, 'App\\Models\\FrontSetting', 8, 'homepage-image', 'eldery_treatment_03', 'eldery_treatment_03.jpg', 'image/png', 'public', 62671, '[]', '[]', '[]', 1, '2023-02-12 17:53:37', '2023-02-12 17:53:37', 'public', '68760426-baa0-49af-a502-4e62f9294c31', '[]'),
	(14, 'App\\Models\\FrontSetting', 11, 'homepage-image', 'Healthcare Character-01', 'Healthcare-Character-01.jpg', 'image/png', 'public', 96772, '[]', '[]', '[]', 1, '2023-02-12 17:53:37', '2023-02-12 17:53:37', 'public', 'e37e5c4c-fd48-4f9d-acfa-562df56e9b4d', '[]'),
	(15, 'App\\Models\\Setting', 3, 'settings', 'logo', 'logo.png', 'image/png', 'public', 96390, '[]', '[]', '[]', 1, '2023-02-12 17:58:34', '2023-02-12 17:58:34', 'public', '1d996e1b-4ffd-440a-836a-2b2e2dbbe263', '[]'),
	(16, 'App\\Models\\User', 7, 'profile_photo', 'safa', 'safa.jpg', 'image/jpeg', 'public', 142712, '[]', '[]', '[]', 1, '2023-02-12 18:03:18', '2023-02-12 18:03:18', 'public', '472e3242-22cc-44fa-9db9-c716234353d2', '[]'),
	(17, 'App\\Models\\Setting', 11, 'settings', 'logo', 'logo.png', 'image/png', 'public', 96390, '[]', '[]', '[]', 1, '2023-02-12 19:26:40', '2023-02-12 19:26:40', 'public', 'eebd3b08-d400-4d09-99c6-64d2e53706af', '[]');

-- Dumping structure for table hospital.medicines
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned DEFAULT NULL,
  `brand_id` int unsigned DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `salt_composition` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `side_effects` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medicines_category_id_foreign` (`category_id`),
  KEY `medicines_brand_id_foreign` (`brand_id`),
  KEY `160` (`name`),
  CONSTRAINT `medicines_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `medicines_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.medicines: ~0 rows (approximately)

-- Dumping structure for table hospital.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.migrations: ~183 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_05_03_000001_create_customer_columns', 1),
	(4, '2019_05_03_000002_create_subscriptions_table', 1),
	(5, '2019_05_03_000003_create_subscription_items_table', 1),
	(6, '2019_08_19_000000_create_failed_jobs_table', 1),
	(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(8, '2020_02_06_031618_create_categories_table', 1),
	(9, '2020_02_12_053840_create_doctor_departments_table', 1),
	(10, '2020_02_12_053932_create_departments_table', 1),
	(11, '2020_02_13_042835_create_brands_table', 1),
	(12, '2020_02_13_053840_create_doctors_table', 1),
	(13, '2020_02_13_054103_create_patients_table', 1),
	(14, '2020_02_13_094724_create_bills_table', 1),
	(15, '2020_02_13_095024_create_medicines_table', 1),
	(16, '2020_02_13_095125_create_bill_items_table', 1),
	(17, '2020_02_13_111857_create_nurses_table', 1),
	(18, '2020_02_13_125601_create_addresses_table', 1),
	(19, '2020_02_13_141104_create_media_table', 1),
	(20, '2020_02_14_051650_create_lab_technicians_table', 1),
	(21, '2020_02_14_055353_create_appointments_table', 1),
	(22, '2020_02_14_091441_create_receptionists_table', 1),
	(23, '2020_02_14_093246_create_pharmacists_table', 1),
	(24, '2020_02_17_053450_create_accountants_table', 1),
	(25, '2020_02_17_080856_create_bed_types_table', 1),
	(26, '2020_02_17_092326_create_blood_banks_table', 1),
	(27, '2020_02_17_105627_create_beds_table', 1),
	(28, '2020_02_17_110620_create_blood_donors_table', 1),
	(29, '2020_02_17_135716_create_permission_tables', 1),
	(30, '2020_02_18_042327_create_notice_boards_table', 1),
	(31, '2020_02_18_042442_create_document_types_table', 1),
	(32, '2020_02_18_060222_create_patient_cases_table', 1),
	(33, '2020_02_18_060223_create_operation_reports_table', 1),
	(34, '2020_02_18_064953_create_bed_assigns_table', 1),
	(35, '2020_02_18_092202_create_documents_table', 1),
	(36, '2020_02_18_094758_create_birth_reports_table', 1),
	(37, '2020_02_18_111020_create_death_reports_table', 1),
	(38, '2020_02_19_080336_create_employee_payrolls_table', 1),
	(39, '2020_02_19_134502_create_settings_table', 1),
	(40, '2020_02_21_090236_create_investigation_reports_table', 1),
	(41, '2020_02_21_095439_create_accounts_table', 1),
	(42, '2020_02_22_070658_create_payments_table', 1),
	(43, '2020_02_22_090112_create_insurances_table', 1),
	(44, '2020_02_22_091537_create_insurance_disease_table', 1),
	(45, '2020_02_24_055136_create_invoices_table', 1),
	(46, '2020_02_24_055518_create_schedules_table', 1),
	(47, '2020_02_24_055702_create_invoice_items_table', 1),
	(48, '2020_02_25_105042_create_services_table', 1),
	(49, '2020_02_25_131030_create_packages_table', 1),
	(50, '2020_02_25_131108_create_package_services_table', 1),
	(51, '2020_02_27_120948_create_patient_admissions_table', 1),
	(52, '2020_02_28_031410_create_case_handlers_table', 1),
	(53, '2020_03_02_043813_create_advanced_payments_table', 1),
	(54, '2020_03_02_065845_add_patient_admission_id_to_bills', 1),
	(55, '2020_03_03_062243_add_patient_id_to_bills', 1),
	(56, '2020_03_03_113334_create_schedule_day_table', 1),
	(57, '2020_03_26_052336_create_ambulances_table', 1),
	(58, '2020_03_26_081157_create_mails_table', 1),
	(59, '2020_03_27_061641_create_enquiries_table', 1),
	(60, '2020_03_27_063148_create_ambulance_calls_table', 1),
	(61, '2020_03_31_122219_create_prescriptions_table', 1),
	(62, '2020_04_11_052629_create_charge_categories_table', 1),
	(63, '2020_04_11_053929_create_pathology_categories_table', 1),
	(64, '2020_04_11_070859_create_radiology_categories_table', 1),
	(65, '2020_04_11_090903_create_charges_table', 1),
	(66, '2020_04_13_050643_create_radiology_tests_table', 1),
	(67, '2020_04_14_093339_create_pathology_tests_table', 1),
	(68, '2020_04_24_111205_create_doctor_opd_charge_table', 1),
	(69, '2020_04_28_094118_create_expenses_table', 1),
	(70, '2020_05_01_055137_create_incomes_table', 1),
	(71, '2020_05_11_083050_add_notes_documents_table', 1),
	(72, '2020_05_12_075825_create_sms_table', 1),
	(73, '2020_06_22_071531_add_index_to_accounts_table', 1),
	(74, '2020_06_22_071943_add_index_to_doctor_opd_charges_table', 1),
	(75, '2020_06_22_072921_add_index_to_bed_assigns_table', 1),
	(76, '2020_06_22_073042_add_index_to_medicines_table', 1),
	(77, '2020_06_22_073457_add_index_to_employee_payrolls_table', 1),
	(78, '2020_06_22_074937_add_index_to_notice_boards_table', 1),
	(79, '2020_06_22_075222_add_index_to_blood_donors_table', 1),
	(80, '2020_06_22_075359_add_index_to_packages_table', 1),
	(81, '2020_06_22_075506_add_index_to_bed_types_table', 1),
	(82, '2020_06_22_075725_add_index_to_services_table', 1),
	(83, '2020_06_22_080944_add_index_to_invoices_table', 1),
	(84, '2020_06_22_081601_add_index_to_payments_table', 1),
	(85, '2020_06_22_081802_add_index_to_advanced_payments_table', 1),
	(86, '2020_06_22_081909_add_index_to_bills_table', 1),
	(87, '2020_06_22_082548_add_index_to_beds_table', 1),
	(88, '2020_06_22_082942_add_index_to_blood_banks_table', 1),
	(89, '2020_06_22_083511_add_index_to_users_table', 1),
	(90, '2020_06_22_084750_add_index_to_patient_cases_table', 1),
	(91, '2020_06_22_084912_add_index_to_patient_admissions_table', 1),
	(92, '2020_06_22_085036_add_index_to_document_types_table', 1),
	(93, '2020_06_22_085128_add_index_to_insurances_table', 1),
	(94, '2020_06_22_085317_add_index_to_ambulances_table', 1),
	(95, '2020_06_22_090509_add_index_to_ambulance_calls_table', 1),
	(96, '2020_06_22_091253_add_index_to_doctor_departments_table', 1),
	(97, '2020_06_22_091455_add_index_to_appointments_table', 1),
	(98, '2020_06_22_091617_add_index_to_birth_reports_table', 1),
	(99, '2020_06_22_091632_add_index_to_death_reports_table', 1),
	(100, '2020_06_22_091651_add_index_to_investigation_reports_table', 1),
	(101, '2020_06_22_091828_add_index_to_operation_reports_table', 1),
	(102, '2020_06_22_092018_add_index_to_categories_table', 1),
	(103, '2020_06_22_092149_add_index_to_brands_table', 1),
	(104, '2020_06_22_092324_add_index_to_pathology_tests_table', 1),
	(105, '2020_06_22_092338_add_index_to_pathology_categories_table', 1),
	(106, '2020_06_22_092347_add_index_to_radiology_tests_table', 1),
	(107, '2020_06_22_092357_add_index_to_radiology_categories_table', 1),
	(108, '2020_06_22_092651_add_index_to_expenses_table', 1),
	(109, '2020_06_22_092702_add_index_to_incomes_table', 1),
	(110, '2020_06_22_092855_add_index_to_charges_table', 1),
	(111, '2020_06_22_092905_add_index_to_charge_categories_table', 1),
	(112, '2020_06_22_093234_add_index_to_enquiries_table', 1),
	(113, '2020_06_24_044648_create_diagnosis_categories_table', 1),
	(114, '2020_06_25_080242_create_patient_diagnosis_tests_table', 1),
	(115, '2020_06_26_054352_create_patient_diagnosis_properties_table', 1),
	(116, '2020_07_15_044653_remove_serial_visibility_from_schedules_table', 1),
	(117, '2020_07_15_121336_change_ambulances_table_column', 1),
	(118, '2020_07_22_052934_change_bed_assigns_table_column', 1),
	(119, '2020_07_29_095430_change_invoice_items_table_column', 1),
	(120, '2020_08_26_081235_create_item_categories_table', 1),
	(121, '2020_08_26_101134_create_items_table', 1),
	(122, '2020_08_26_125032_create_item_stocks_table', 1),
	(123, '2020_08_27_141547_create_issued_items_table', 1),
	(124, '2020_09_08_064222_create_ipd_patient_departments_table', 1),
	(125, '2020_09_08_114627_create_ipd_diagnoses_table', 1),
	(126, '2020_09_09_065624_create_ipd_consultant_registers_table', 1),
	(127, '2020_09_09_135505_create_ipd_charges_table', 1),
	(128, '2020_09_10_112306_create_ipd_prescriptions_table', 1),
	(129, '2020_09_10_114203_create_ipd_prescription_items_table', 1),
	(130, '2020_09_11_045308_create_modules_table', 1),
	(131, '2020_09_12_050715_create_ipd_payments_table', 1),
	(132, '2020_09_12_071821_create_ipd_timelines_table', 1),
	(133, '2020_09_12_103003_create_ipd_bills_table', 1),
	(134, '2020_09_14_083759_create_opd_patient_departments_table', 1),
	(135, '2020_09_14_144731_add_ipd_patient_department_id_to_bed_assigns_table', 1),
	(136, '2020_09_15_064044_create_transactions_table', 1),
	(137, '2020_09_16_103204_create_opd_diagnoses_table', 1),
	(138, '2020_09_16_114031_create_opd_timelines_table', 1),
	(139, '2020_09_23_045100_change_patient_diagnosis_properties_table', 1),
	(140, '2020_09_24_053229_add_ipd_bill_column_in_ipd_patient_departments_table', 1),
	(141, '2020_10_09_085838_create_call_logs_table', 1),
	(142, '2020_10_12_125133_create_visitors_table', 1),
	(143, '2020_10_14_044134_create_postals_table', 1),
	(144, '2020_10_30_043500_add_route_in_modules_table', 1),
	(145, '2020_10_31_062448_add_complete_in_appointments_table', 1),
	(146, '2020_11_02_050736_create_testimonials_table', 1),
	(147, '2020_11_07_121633_add_region_code_in_sms_table', 1),
	(148, '2020_11_19_093810_create_blood_donations_table', 1),
	(149, '2020_11_20_113830_create_blood_issues_table', 1),
	(150, '2020_11_24_131253_create_notifications_table', 1),
	(151, '2020_12_28_131351_create_live_consultations_table', 1),
	(152, '2020_12_31_062506_create_live_meetings_table', 1),
	(153, '2020_12_31_091242_create_live_meetings_candidates_table', 1),
	(154, '2021_01_05_100425_create_user_zoom_credential_table', 1),
	(155, '2021_01_06_105407_add_metting_id_to_live_meetings_table', 1),
	(156, '2021_02_23_065200_create_vaccinations_table', 1),
	(157, '2021_02_23_065252_create_vaccinated_patients_table', 1),
	(158, '2021_04_05_085646_create_front_settings_table', 1),
	(159, '2021_05_10_000000_add_uuid_to_failed_jobs_table', 1),
	(160, '2021_05_29_103036_add_conversions_disk_column_in_media_table', 1),
	(161, '2021_06_07_104022_change_patient_foreign_key_type_in_appointments_table', 1),
	(162, '2021_06_08_073918_change_department_foreign_key_in_appointments_table', 1),
	(163, '2021_06_21_082754_update_amount_datatype_in_bills_table', 1),
	(164, '2021_06_21_082845_update_amount_datatype_in_bill_items_table', 1),
	(165, '2021_11_11_061443_create_front_services_table', 1),
	(166, '2021_11_12_100750_create_hospital_schedules_table', 1),
	(167, '2021_11_12_105805_add_social_details_in_users_table', 1),
	(168, '2022_02_18_101938_add_darkmode_to_users_table', 1),
	(169, '2022_04_09_064645_change_doctor_foreign_in_operation_reports_table', 1),
	(170, '2022_05_16_104947_add_default_length_in_table', 1),
	(171, '2022_07_29_200345_add_prescription_fields', 1),
	(172, '2022_08_01_204917_create_prescriptions_medicines_table', 1),
	(173, '2022_08_26_225704_change_charges_standard_charge_column', 1),
	(174, '2022_08_30_011825_change_item_unit_column', 1),
	(175, '2022_09_06_202047_change_amount_at_blood_issue', 1),
	(176, '2022_09_07_184901_change_dose_number_column', 1),
	(177, '2022_09_08_065652_add_country_code_field_in_settings', 1),
	(178, '2022_09_08_201840_defalut_new_module_seeder', 1),
	(179, '2022_09_26_214705_create_admins_table', 1),
	(180, '2022_09_30_205212_create_currency_settings_table', 1),
	(181, '2022_10_06_165905_create_admin_module_seeder_migration', 1),
	(182, '2022_10_07_204913_create_default_currency_seeder_migration', 1),
	(183, '2022_10_11_183203_create_change_field_type_employee_payroll', 1);

-- Dumping structure for table hospital.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  UNIQUE KEY `model_has_permissions_model_type_unique` (`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table hospital.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.model_has_roles: ~0 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 4),
	(3, 'App\\Models\\User', 5),
	(2, 'App\\Models\\User', 7);

-- Dumping structure for table hospital.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `route` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.modules: ~5 rows (approximately)
INSERT INTO `modules` (`id`, `name`, `is_active`, `route`, `created_at`, `updated_at`) VALUES
	(1, 'Employee Bills', 1, 'employee.bills.index', '2022-12-01 06:36:25', '2022-12-01 06:36:25'),
	(2, 'Employee Bills Show', 1, 'employee.bills.show', '2022-12-01 06:36:25', '2022-12-01 06:36:25'),
	(3, 'Employee Noticeboard', 1, 'employee.noticeboard', '2022-12-01 06:36:25', '2022-12-01 06:36:25'),
	(4, 'Employee Patient Diagnosis Test Pdf', 1, 'employee.patient.diagnosis.test.pdf', '2022-12-01 06:36:25', '2022-12-01 06:36:25'),
	(5, 'Admin', 1, 'admins.index', '2022-12-01 06:36:25', '2022-12-01 06:36:25'),
	(6, 'Patients', 1, 'patients.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(7, 'Doctors', 1, 'doctors.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(8, 'Accountants', 1, 'accountants.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(9, 'Medicines', 1, 'medicines.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(10, 'Nurses', 1, 'nurses.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(11, 'Receptionists', 1, 'receptionists.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(12, 'Lab Technicians', 1, 'lab-technicians.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(13, 'Pharmacists', 1, 'pharmacists.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(14, 'Birth Reports', 1, 'birth-reports.index', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(15, 'Death Reports', 1, 'death-reports.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(16, 'Investigation Reports', 1, 'investigation-reports.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(17, 'Operation Reports', 1, 'operation-reports.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(18, 'Income', 1, 'incomes.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(19, 'Expense', 1, 'expenses.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(20, 'SMS', 1, 'sms.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(21, 'IPD Patients', 1, 'ipd.patient.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(22, 'OPD Patients', 1, 'opd.patient.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(23, 'Accounts', 1, 'accounts.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(24, 'Employee Payrolls', 1, 'employee-payrolls.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(25, 'Invoices', 1, 'invoices.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(26, 'Payments', 1, 'payments.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(27, 'Payment Reports', 1, 'payment.reports', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(28, 'Advance Payments', 1, 'advanced-payments.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(29, 'Bills', 1, 'bills.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(30, 'Bed Types', 1, 'bed-types.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(31, 'Beds', 1, 'beds.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(32, 'Bed Assigns', 1, 'bed-assigns.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(33, 'Blood Banks', 1, 'blood-banks.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(34, 'Blood Donors', 1, 'blood-donors.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(35, 'Documents', 1, 'documents.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(36, 'Document Types', 1, 'document-types.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(37, 'Services', 1, 'services.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(38, 'Insurances', 1, 'insurances.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(39, 'Packages', 1, 'packages.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(40, 'Ambulances', 1, 'ambulances.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(41, 'Ambulances Calls', 1, 'ambulance-calls.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(42, 'Appointments', 1, 'appointments.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(43, 'Call Logs', 1, 'call_logs.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(44, 'Visitors', 1, 'visitors.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(45, 'Postal Receive', 1, 'receives.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(46, 'Postal Dispatch', 1, 'dispatches.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(47, 'Notice Boards', 1, 'noticeboard', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(48, 'Mail', 1, 'mail', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(49, 'Enquires', 1, 'enquiries', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(50, 'Charge Categories', 1, 'charge-categories.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(51, 'Charges', 1, 'charges.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(52, 'Doctor OPD Charges', 1, 'doctor-opd-charges.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(53, 'Items Categories', 1, 'item-categories.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(54, 'Items', 1, 'items.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(55, 'Item Stocks', 1, 'item.stock.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(56, 'Issued Items', 1, 'issued.item.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(57, 'Diagnosis Categories', 1, 'diagnosis.category.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(58, 'Diagnosis Tests', 1, 'patient.diagnosis.test.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(59, 'Pathology Categories', 1, 'pathology.category.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(60, 'Pathology Tests', 1, 'pathology.test.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(61, 'Radiology Categories', 1, 'radiology.category.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(62, 'Radiology Tests', 1, 'radiology.test.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(63, 'Medicine Categories', 1, 'categories.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(64, 'Medicine Brands', 1, 'brands.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(65, 'Doctor Departments', 1, 'doctor-departments.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(66, 'Schedules', 1, 'schedules.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(67, 'Prescriptions', 1, 'prescriptions.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(68, 'Cases', 1, 'patient-cases.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(69, 'Case Handlers', 1, 'case-handlers.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(70, 'Patient Admissions', 1, 'patient-admissions.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(71, 'My Payrolls', 1, 'payroll', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(72, 'Patient Cases', 1, 'patients.cases', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(73, 'Testimonial', 1, 'testimonials.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(74, 'Blood Donations', 1, 'blood-donations.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(75, 'Blood Issues', 1, 'blood-issues.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(76, 'Live Consultations', 1, 'live.consultation.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(77, 'Live Meetings', 1, 'live.meeting.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(78, 'Vaccinations', 1, 'vaccinations.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(79, 'Vaccinated Patients', 1, 'vaccinated-patients.index', '2023-02-09 23:59:34', '2023-02-09 23:59:34');

-- Dumping structure for table hospital.notice_boards
CREATE TABLE IF NOT EXISTS `notice_boards` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notice_boards_created_at_id_index` (`created_at`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.notice_boards: ~0 rows (approximately)

-- Dumping structure for table hospital.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `notification_for` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.notifications: ~0 rows (approximately)

-- Dumping structure for table hospital.nurses
CREATE TABLE IF NOT EXISTS `nurses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nurses_user_id_foreign` (`user_id`),
  CONSTRAINT `nurses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.nurses: ~0 rows (approximately)

-- Dumping structure for table hospital.opd_diagnoses
CREATE TABLE IF NOT EXISTS `opd_diagnoses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `opd_patient_department_id` int unsigned NOT NULL,
  `report_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_date` datetime NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `opd_diagnoses_opd_patient_department_id_foreign` (`opd_patient_department_id`),
  CONSTRAINT `opd_diagnoses_opd_patient_department_id_foreign` FOREIGN KEY (`opd_patient_department_id`) REFERENCES `opd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.opd_diagnoses: ~0 rows (approximately)

-- Dumping structure for table hospital.opd_patient_departments
CREATE TABLE IF NOT EXISTS `opd_patient_departments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `opd_number` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symptoms` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `appointment_date` datetime NOT NULL,
  `case_id` int unsigned DEFAULT NULL,
  `is_old_patient` tinyint(1) DEFAULT '0',
  `doctor_id` bigint unsigned DEFAULT NULL,
  `standard_charge` double NOT NULL,
  `payment_mode` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `opd_patient_departments_opd_number_unique` (`opd_number`),
  KEY `opd_patient_departments_patient_id_foreign` (`patient_id`),
  KEY `opd_patient_departments_case_id_foreign` (`case_id`),
  KEY `opd_patient_departments_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `opd_patient_departments_case_id_foreign` FOREIGN KEY (`case_id`) REFERENCES `patient_cases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opd_patient_departments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opd_patient_departments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.opd_patient_departments: ~0 rows (approximately)

-- Dumping structure for table hospital.opd_timelines
CREATE TABLE IF NOT EXISTS `opd_timelines` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `opd_patient_department_id` int unsigned NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `visible_to_person` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `opd_timelines_opd_patient_department_id_foreign` (`opd_patient_department_id`),
  CONSTRAINT `opd_timelines_opd_patient_department_id_foreign` FOREIGN KEY (`opd_patient_department_id`) REFERENCES `opd_patient_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.opd_timelines: ~0 rows (approximately)

-- Dumping structure for table hospital.operation_reports
CREATE TABLE IF NOT EXISTS `operation_reports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `case_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `date` datetime NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operation_reports_patient_id_foreign` (`patient_id`),
  KEY `operation_reports_date_index` (`date`),
  KEY `operation_reports_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `operation_reports_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `operation_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.operation_reports: ~0 rows (approximately)

-- Dumping structure for table hospital.packages
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `discount` double NOT NULL,
  `total_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `packages_created_at_name_index` (`created_at`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.packages: ~0 rows (approximately)

-- Dumping structure for table hospital.package_services
CREATE TABLE IF NOT EXISTS `package_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int unsigned NOT NULL,
  `service_id` int unsigned NOT NULL,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_services_package_id_foreign` (`package_id`),
  KEY `package_services_service_id_foreign` (`service_id`),
  CONSTRAINT `package_services_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `package_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.package_services: ~0 rows (approximately)

-- Dumping structure for table hospital.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.password_resets: ~0 rows (approximately)

-- Dumping structure for table hospital.pathology_categories
CREATE TABLE IF NOT EXISTS `pathology_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pathology_categories_name_unique` (`name`),
  KEY `pathology_categories_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.pathology_categories: ~0 rows (approximately)

-- Dumping structure for table hospital.pathology_tests
CREATE TABLE IF NOT EXISTS `pathology_tests` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `test_name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int unsigned NOT NULL,
  `unit` int DEFAULT NULL,
  `subcategory` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_days` int DEFAULT NULL,
  `charge_category_id` int unsigned NOT NULL,
  `standard_charge` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pathology_tests_category_id_foreign` (`category_id`),
  KEY `pathology_tests_charge_category_id_foreign` (`charge_category_id`),
  KEY `pathology_tests_test_name_index` (`test_name`),
  CONSTRAINT `pathology_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `pathology_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pathology_tests_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.pathology_tests: ~0 rows (approximately)

-- Dumping structure for table hospital.patients
CREATE TABLE IF NOT EXISTS `patients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patients_user_id_foreign` (`user_id`),
  CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.patients: ~1 rows (approximately)
INSERT INTO `patients` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 5, '2023-02-10 07:14:42', '2023-02-10 07:14:42');

-- Dumping structure for table hospital.patient_admissions
CREATE TABLE IF NOT EXISTS `patient_admissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_admission_id` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int unsigned NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `admission_date` datetime NOT NULL,
  `discharge_date` datetime DEFAULT NULL,
  `package_id` int unsigned DEFAULT NULL,
  `insurance_id` int unsigned DEFAULT NULL,
  `bed_id` int unsigned DEFAULT NULL,
  `policy_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_relation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_contact` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patient_admissions_patient_admission_id_unique` (`patient_admission_id`),
  KEY `patient_admissions_patient_id_foreign` (`patient_id`),
  KEY `patient_admissions_doctor_id_foreign` (`doctor_id`),
  KEY `patient_admissions_package_id_foreign` (`package_id`),
  KEY `patient_admissions_insurance_id_foreign` (`insurance_id`),
  KEY `patient_admissions_bed_id_foreign` (`bed_id`),
  KEY `patient_admissions_admission_date_index` (`admission_date`),
  CONSTRAINT `patient_admissions_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_admissions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_admissions_insurance_id_foreign` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_admissions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_admissions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.patient_admissions: ~0 rows (approximately)

-- Dumping structure for table hospital.patient_cases
CREATE TABLE IF NOT EXISTS `patient_cases` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `case_id` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int unsigned NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `date` datetime NOT NULL,
  `fee` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patient_cases_case_id_unique` (`case_id`),
  KEY `patient_cases_patient_id_foreign` (`patient_id`),
  KEY `patient_cases_doctor_id_foreign` (`doctor_id`),
  KEY `patient_cases_date_index` (`date`),
  CONSTRAINT `patient_cases_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_cases_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.patient_cases: ~0 rows (approximately)

-- Dumping structure for table hospital.patient_diagnosis_properties
CREATE TABLE IF NOT EXISTS `patient_diagnosis_properties` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_diagnosis_id` bigint unsigned NOT NULL,
  `property_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_diagnosis_properties_created_at_index` (`created_at`),
  KEY `patient_diagnosis_properties_patient_diagnosis_id_foreign` (`patient_diagnosis_id`),
  CONSTRAINT `patient_diagnosis_properties_patient_diagnosis_id_foreign` FOREIGN KEY (`patient_diagnosis_id`) REFERENCES `patient_diagnosis_tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.patient_diagnosis_properties: ~0 rows (approximately)
INSERT INTO `patient_diagnosis_properties` (`id`, `patient_diagnosis_id`, `property_name`, `property_value`, `created_at`, `updated_at`) VALUES
	(1, 1, 'age', '10', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(2, 1, 'height', '7', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(3, 1, 'weight', '30', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(4, 1, 'average_glucose', '10', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(5, 1, 'fasting_blood_sugar', '10', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(6, 1, 'urine_sugar', '10', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(7, 1, 'blood_pressure', '10', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(8, 1, 'diabetes', '10', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(9, 1, 'cholesterol', '10', '2023-02-10 07:32:50', '2023-02-10 07:32:50'),
	(10, 1, 'Ada radang', 'Iya', '2023-02-10 07:32:50', '2023-02-10 07:32:50');

-- Dumping structure for table hospital.patient_diagnosis_tests
CREATE TABLE IF NOT EXISTS `patient_diagnosis_tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `report_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_diagnosis_tests_created_at_index` (`created_at`),
  KEY `patient_diagnosis_tests_patient_id_foreign` (`patient_id`),
  KEY `patient_diagnosis_tests_doctor_id_foreign` (`doctor_id`),
  KEY `patient_diagnosis_tests_category_id_foreign` (`category_id`),
  CONSTRAINT `patient_diagnosis_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `diagnosis_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_diagnosis_tests_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_diagnosis_tests_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.patient_diagnosis_tests: ~0 rows (approximately)
INSERT INTO `patient_diagnosis_tests` (`id`, `patient_id`, `doctor_id`, `category_id`, `report_number`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 'CPYMEO0O', '2023-02-10 07:32:50', '2023-02-10 07:32:50');

-- Dumping structure for table hospital.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `payment_date` date NOT NULL,
  `account_id` int unsigned NOT NULL,
  `pay_to` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_account_id_foreign` (`account_id`),
  KEY `payments_payment_date_index` (`payment_date`),
  CONSTRAINT `payments_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.payments: ~0 rows (approximately)

-- Dumping structure for table hospital.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.permissions: ~0 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'manage_users', 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(2, 'manage_beds', 'web', '2023-02-09 23:59:32', '2023-02-09 23:59:32'),
	(3, 'manage_wards', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(4, 'manage_appointments', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(5, 'manage_prescriptions', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(6, 'manage_patients', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(7, 'manage_blood_bank', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(8, 'manage_reports', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(9, 'manage_payrolls', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(10, 'manage_settings', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(11, 'manage_notice_board', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(12, 'manage_doctors', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(13, 'manage_nurses', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(14, 'manage_receptionists', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(15, 'manage_pharmacists', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(16, 'manage_accountants', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(17, 'manage_invoices', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(18, 'manage_operations_history', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(19, 'manage_admit_history', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(20, 'manage_blood_donor', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(21, 'manage_medicines', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(22, 'manage_department', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(23, 'manage_doctor_departments', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(24, 'manage_lab_technicians', 'web', '2023-02-09 23:59:33', '2023-02-09 23:59:33');

-- Dumping structure for table hospital.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table hospital.pharmacists
CREATE TABLE IF NOT EXISTS `pharmacists` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pharmacists_user_id_foreign` (`user_id`),
  CONSTRAINT `pharmacists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.pharmacists: ~0 rows (approximately)

-- Dumping structure for table hospital.postals
CREATE TABLE IF NOT EXISTS `postals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.postals: ~0 rows (approximately)

-- Dumping structure for table hospital.prescriptions
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `doctor_id` bigint unsigned DEFAULT NULL,
  `food_allergies` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tendency_bleed` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heart_disease` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `high_blood_pressure` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diabetic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surgery` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accident` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical_history` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_medication` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `female_pregnancy` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breast_feeding` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health_insurance` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `low_income` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plus_rate` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temperature` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `problem_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advice` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_visit_qty` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_visit_time` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prescriptions_patient_id_foreign` (`patient_id`),
  KEY `prescriptions_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.prescriptions: ~0 rows (approximately)

-- Dumping structure for table hospital.prescriptions_medicines
CREATE TABLE IF NOT EXISTS `prescriptions_medicines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prescription_id` int unsigned NOT NULL,
  `medicine` int unsigned NOT NULL,
  `dosage` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prescriptions_medicines_prescription_id_foreign` (`prescription_id`),
  KEY `prescriptions_medicines_medicine_foreign` (`medicine`),
  CONSTRAINT `prescriptions_medicines_medicine_foreign` FOREIGN KEY (`medicine`) REFERENCES `medicines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prescriptions_medicines_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.prescriptions_medicines: ~0 rows (approximately)

-- Dumping structure for table hospital.radiology_categories
CREATE TABLE IF NOT EXISTS `radiology_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `radiology_categories_name_unique` (`name`),
  KEY `radiology_categories_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.radiology_categories: ~0 rows (approximately)

-- Dumping structure for table hospital.radiology_tests
CREATE TABLE IF NOT EXISTS `radiology_tests` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `test_name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int unsigned NOT NULL,
  `subcategory` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_days` int DEFAULT NULL,
  `charge_category_id` int unsigned NOT NULL,
  `standard_charge` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `radiology_tests_category_id_foreign` (`category_id`),
  KEY `radiology_tests_charge_category_id_foreign` (`charge_category_id`),
  KEY `radiology_tests_test_name_index` (`test_name`),
  CONSTRAINT `radiology_tests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `radiology_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `radiology_tests_charge_category_id_foreign` FOREIGN KEY (`charge_category_id`) REFERENCES `charge_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.radiology_tests: ~0 rows (approximately)

-- Dumping structure for table hospital.receptionists
CREATE TABLE IF NOT EXISTS `receptionists` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receptionists_user_id_foreign` (`user_id`),
  CONSTRAINT `receptionists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.receptionists: ~0 rows (approximately)

-- Dumping structure for table hospital.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.role_has_permissions: ~0 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(4, 2),
	(5, 2),
	(6, 2),
	(7, 2),
	(8, 2),
	(11, 2),
	(12, 2),
	(13, 2),
	(14, 2),
	(15, 2),
	(18, 2),
	(20, 2),
	(21, 2),
	(22, 2),
	(4, 3),
	(5, 3),
	(7, 3),
	(8, 3),
	(11, 3),
	(12, 3),
	(13, 3),
	(14, 3),
	(15, 3),
	(19, 3),
	(21, 3),
	(2, 4),
	(3, 4),
	(4, 4),
	(5, 4),
	(6, 4),
	(7, 4),
	(8, 4),
	(11, 4),
	(12, 4),
	(13, 4),
	(14, 4),
	(15, 4),
	(18, 4),
	(20, 4),
	(21, 4),
	(22, 4),
	(2, 5),
	(3, 5),
	(4, 5),
	(6, 5),
	(7, 5),
	(8, 5),
	(11, 5),
	(12, 5),
	(13, 5),
	(14, 5),
	(15, 5),
	(18, 5),
	(19, 5),
	(20, 5),
	(22, 5),
	(24, 5),
	(11, 6),
	(15, 6),
	(21, 6),
	(11, 7),
	(15, 7),
	(21, 7);

-- Dumping structure for table hospital.schedules
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned NOT NULL,
  `per_patient_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.schedules: ~0 rows (approximately)
INSERT INTO `schedules` (`id`, `doctor_id`, `per_patient_time`, `created_at`, `updated_at`) VALUES
	(1, 1, '00:30:00', '2023-02-10 07:29:49', '2023-02-10 07:29:49');

-- Dumping structure for table hospital.schedule_days
CREATE TABLE IF NOT EXISTS `schedule_days` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint unsigned NOT NULL,
  `schedule_id` int unsigned NOT NULL,
  `available_on` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_from` time NOT NULL,
  `available_to` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_days_doctor_id_foreign` (`doctor_id`),
  KEY `schedule_days_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `schedule_days_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `schedule_days_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.schedule_days: ~0 rows (approximately)
INSERT INTO `schedule_days` (`id`, `doctor_id`, `schedule_id`, `available_on`, `available_from`, `available_to`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Monday', '08:00:00', '10:00:00', '2023-02-10 07:29:49', '2023-02-10 07:29:49'),
	(2, 1, 1, 'Tuesday', '00:00:00', '00:00:00', '2023-02-10 07:29:49', '2023-02-10 07:29:49'),
	(3, 1, 1, 'Wednesday', '00:00:00', '00:00:00', '2023-02-10 07:29:49', '2023-02-10 07:29:49'),
	(4, 1, 1, 'Thursday', '00:00:00', '00:00:00', '2023-02-10 07:29:49', '2023-02-10 07:29:49'),
	(5, 1, 1, 'Friday', '00:00:00', '00:00:00', '2023-02-10 07:29:49', '2023-02-10 07:29:49'),
	(6, 1, 1, 'Saturday', '00:00:00', '00:00:00', '2023-02-10 07:29:49', '2023-02-10 07:29:49'),
	(7, 1, 1, 'Sunday', '08:00:00', '10:00:00', '2023-02-10 07:29:49', '2023-02-10 07:29:49');

-- Dumping structure for table hospital.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL,
  `rate` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.services: ~0 rows (approximately)

-- Dumping structure for table hospital.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.settings: ~17 rows (approximately)
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'country_code', '+62', '2022-12-01 06:36:25', '2023-02-10 07:05:26'),
	(2, 'app_name', 'RSUD Sultan Fatah', '2023-02-09 23:59:33', '2023-02-12 18:00:47'),
	(3, 'app_logo', 'http://127.0.0.1:8000/uploads/15/logo.png', '2023-02-09 23:59:33', '2023-02-12 17:58:34'),
	(4, 'company_name', 'RSUD Sultan Fatah Kabupaten Demak', '2023-02-09 23:59:33', '2023-02-12 18:00:47'),
	(5, 'current_currency', 'idr', '2023-02-09 23:59:33', '2023-02-12 17:58:34'),
	(6, 'hospital_address', '16/A saint Joseph Park', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(7, 'hospital_email', 'rsud.sulfat@demakkab.go.id', '2023-02-09 23:59:33', '2023-02-12 17:58:34'),
	(8, 'hospital_phone', '+622176602154', '2023-02-09 23:59:33', '2023-02-12 17:58:34'),
	(9, 'hospital_from_day', 'Mon to Fri', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(10, 'hospital_from_time', '9 AM to 9 PM', '2023-02-09 23:59:33', '2023-02-09 23:59:33'),
	(11, 'favicon', 'http://127.0.0.1:8000/uploads/17/logo.png', '2023-02-09 23:59:34', '2023-02-12 19:26:40'),
	(12, 'facebook_url', 'https://www.facebook.com/infyom/', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(13, 'twitter_url', 'https://twitter.com/infyom?lang=en', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(14, 'instagram_url', 'https://www.instagram.com/?hl=en', '2023-02-09 23:59:34', '2023-02-09 23:59:34'),
	(15, 'linkedIn_url', 'https://www.linkedin.com/organization-guest/company/infyom-technologies?challengeId=AQFgQaMxwSxCdAAAAXOA_wosiB2vYdQEoITs6w676AzV8cu8OzhnWEBNUQ7LCG4vds5-A12UIQk1M4aWfKmn6iM58OFJbpoRiA&amp;subm', '2023-02-09 23:59:34', '2023-02-10 07:05:26'),
	(16, 'about_us', 'Over past 10+ years of experience and skills in various technologies, we built great scalable products.\r\nWhatever technology we worked with, we just not build products for our clients but we', '2023-02-09 23:59:34', '2023-02-12 17:58:34'),
	(17, 'country_name', 'id', NULL, '2023-02-10 07:05:26');

-- Dumping structure for table hospital.sms
CREATE TABLE IF NOT EXISTS `sms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `send_to` bigint unsigned DEFAULT NULL,
  `region_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sms_send_to_foreign` (`send_to`),
  KEY `sms_send_by_foreign` (`send_by`),
  CONSTRAINT `sms_send_by_foreign` FOREIGN KEY (`send_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sms_send_to_foreign` FOREIGN KEY (`send_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.sms: ~0 rows (approximately)

-- Dumping structure for table hospital.subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.subscriptions: ~0 rows (approximately)

-- Dumping structure for table hospital.subscription_items
CREATE TABLE IF NOT EXISTS `subscription_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint unsigned NOT NULL,
  `stripe_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_items_subscription_id_stripe_plan_unique` (`subscription_id`,`stripe_plan`),
  KEY `subscription_items_stripe_id_index` (`stripe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.subscription_items: ~0 rows (approximately)

-- Dumping structure for table hospital.testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.testimonials: ~0 rows (approximately)

-- Dumping structure for table hospital.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stripe_transaction_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `user_id` int NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.transactions: ~0 rows (approximately)

-- Dumping structure for table hospital.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int NOT NULL,
  `qualification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `owner_id` int DEFAULT NULL,
  `owner_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `language` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedIn_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `thememode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_stripe_id_index` (`stripe_id`),
  KEY `users_first_name_index` (`first_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `department_id`, `first_name`, `last_name`, `email`, `password`, `designation`, `phone`, `gender`, `qualification`, `blood_group`, `dob`, `email_verified_at`, `owner_id`, `owner_type`, `status`, `language`, `remember_token`, `facebook_url`, `twitter_url`, `instagram_url`, `linkedIn_url`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `thememode`) VALUES
	(4, 1, 'Super', 'Admin', 'admin@hms.com', '$2y$10$LgM1in4hThfaUqb82DMKgeczLD/cHQGBdNRCtDxnlG3.s.BO4k53.', NULL, '7878454512', 1, NULL, 'B+', '1994-12-12', '2023-02-09 23:59:32', NULL, NULL, 1, 'en', 'rbgmqn32nJGTbFBMJJY2MPd7BQqJdeLcjmG0H2q8yzn20Rt0KLC29Av5ovRp', NULL, NULL, NULL, NULL, '2023-02-09 23:59:32', '2023-02-09 23:59:32', NULL, NULL, NULL, NULL, '0'),
	(5, 3, 'Muhammad', 'Syakirin', 'djeldrago22@gmail.com', '$2y$10$ntmbDzA2QeUep8k/hMcLquzx61Zy1JVE3li2u5sVd5b.lxSnT/PoW', NULL, '5349417505', 0, NULL, NULL, NULL, '2023-02-09 23:59:32', 1, 'App\\Models\\Patient', 1, 'en', 'n8HGsyfu10dnpQ63q7guL5Z7cDUGpN5M7EklbC5L0TVlniF8A8XdJoDzYg9y', NULL, NULL, NULL, NULL, '2023-02-10 07:14:42', '2023-02-10 07:14:42', NULL, NULL, NULL, NULL, '0'),
	(7, 2, 'dr. Safa', 'Aulia', 'safa@gmail.com', '$2y$10$ntmbDzA2QeUep8k/hMcLquzx61Zy1JVE3li2u5sVd5b.lxSnT/PoW', 'Head', '+62812131413', 1, 'S3', 'O', '2023-01-31', '2023-02-10 21:25:47', 1, 'App\\Models\\Doctor', 1, 'en', 'AQzWQeT8Tv7Qu4wH8Qz4AKn8UhGycWMZyifErhuX3FFR4j5BcACyZj1R6EXw', NULL, NULL, NULL, NULL, '2023-02-10 07:22:30', '2023-02-10 07:22:30', NULL, NULL, NULL, NULL, '0');

-- Dumping structure for table hospital.user_zoom_credential
CREATE TABLE IF NOT EXISTS `user_zoom_credential` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `zoom_api_key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom_api_secret` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_zoom_credential_user_id_foreign` (`user_id`),
  CONSTRAINT `user_zoom_credential_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.user_zoom_credential: ~0 rows (approximately)

-- Dumping structure for table hospital.vaccinated_patients
CREATE TABLE IF NOT EXISTS `vaccinated_patients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int unsigned NOT NULL,
  `vaccination_id` int unsigned NOT NULL,
  `vaccination_serial_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dose_number` bigint NOT NULL,
  `dose_given_date` datetime NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vaccinated_patients_id_index` (`id`),
  KEY `vaccinated_patients_patient_id_index` (`patient_id`),
  KEY `vaccinated_patients_vaccination_id_index` (`vaccination_id`),
  CONSTRAINT `vaccinated_patients_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vaccinated_patients_vaccination_id_foreign` FOREIGN KEY (`vaccination_id`) REFERENCES `vaccinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.vaccinated_patients: ~0 rows (approximately)

-- Dumping structure for table hospital.vaccinations
CREATE TABLE IF NOT EXISTS `vaccinations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufactured_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vaccinations_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.vaccinations: ~0 rows (approximately)

-- Dumping structure for table hospital.visitors
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purpose` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_person` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hospital.visitors: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
