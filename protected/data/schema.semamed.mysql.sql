-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2013 at 06:45 AM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `semamed`
--

-- --------------------------------------------------------

--
-- Table structure for table `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, NULL),
('Doctor', '4', NULL, 'N;'),
('Doctor', '5', NULL, 'N;'),
('Manager', '2', NULL, 'N;'),
('Manager', '3', NULL, 'N;'),
('Registrator', '2', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, 'Супер пользователь', NULL, 'N;'),
('Authenticated', 2, 'Зарегистрированный пользователь', NULL, 'N;'),
('Conclusion.*', 1, NULL, NULL, 'N;'),
('Conclusion.Admin', 0, NULL, NULL, 'N;'),
('Conclusion.Create', 0, NULL, NULL, 'N;'),
('Conclusion.Delete', 0, NULL, NULL, 'N;'),
('Conclusion.Index', 0, NULL, NULL, 'N;'),
('Conclusion.Update', 0, NULL, NULL, 'N;'),
('Conclusion.View', 0, NULL, NULL, 'N;'),
('deleteOwnTemplate', 1, 'Удаление только своего шаблона', 'return Yii::app()->user->id==$params["owner"];', 'N;'),
('Doctor', 2, 'Описывающий доктор', NULL, 'N;'),
('Doctor.Admin', 0, NULL, NULL, 'N;'),
('Doctor.Create', 0, NULL, NULL, 'N;'),
('Doctor.Delete', 0, NULL, NULL, 'N;'),
('Doctor.GetHospitalDoctorsList', 0, NULL, NULL, 'N;'),
('Doctor.GetHospitalsListJson', 0, NULL, NULL, 'N;'),
('Doctor.GetPatientDoctorInfo', 0, NULL, NULL, 'N;'),
('Doctor.Index', 0, NULL, NULL, 'N;'),
('Doctor.Update', 0, NULL, NULL, 'N;'),
('Doctor.View', 0, NULL, NULL, 'N;'),
('Guest', 2, 'Гость', NULL, 'N;'),
('Hospital.Admin', 0, NULL, NULL, 'N;'),
('Hospital.Create', 0, NULL, NULL, 'N;'),
('Hospital.Delete', 0, NULL, NULL, 'N;'),
('Hospital.GetManagerHospitalsList', 0, NULL, NULL, 'N;'),
('Hospital.Index', 0, NULL, NULL, 'N;'),
('Hospital.Update', 0, NULL, NULL, 'N;'),
('Hospital.View', 0, NULL, NULL, 'N;'),
('Manager', 2, 'Менеджер', NULL, 'N;'),
('Mrtscan.Admin', 0, NULL, NULL, 'N;'),
('Mrtscan.Create', 0, NULL, NULL, 'N;'),
('Mrtscan.Delete', 0, NULL, NULL, 'N;'),
('Mrtscan.GetPrice', 0, NULL, NULL, 'N;'),
('Mrtscan.Index', 0, NULL, NULL, 'N;'),
('Mrtscan.Update', 0, NULL, NULL, 'N;'),
('Mrtscan.View', 0, NULL, NULL, 'N;'),
('Patient.Admin', 0, NULL, NULL, 'N;'),
('Patient.Create', 0, NULL, NULL, 'N;'),
('Patient.Delete', 0, NULL, NULL, 'N;'),
('Patient.GetDoctorsListJson', 0, NULL, NULL, 'N;'),
('Patient.Index', 0, NULL, NULL, 'N;'),
('Patient.Report', 0, NULL, NULL, 'N;'),
('Patient.Save', 0, NULL, NULL, 'N;'),
('Patient.toggle', 0, 'Изменяет битовые значения в модели Пациент', NULL, 'N;'),
('Patient.Update', 0, NULL, NULL, 'N;'),
('Patient.View', 0, NULL, NULL, 'N;'),
('Registration.AddService', 0, NULL, NULL, 'N;'),
('Registration.Admin', 0, NULL, NULL, 'N;'),
('Registration.Create', 0, NULL, NULL, 'N;'),
('Registration.Delete', 0, NULL, NULL, 'N;'),
('Registration.GetMrtscansList', 0, NULL, NULL, 'N;'),
('Registration.Index', 0, NULL, NULL, 'N;'),
('Registration.Patient', 0, NULL, NULL, 'N;'),
('Registration.PatientRegistrations', 0, NULL, NULL, 'N;'),
('Registration.Save', 0, NULL, NULL, 'N;'),
('Registration.Update', 0, NULL, NULL, 'N;'),
('Registration.View', 0, NULL, NULL, 'N;'),
('Registrator', 2, 'Регистратор пациентов', NULL, 'N;'),
('Report.Manager', 0, NULL, NULL, 'N;'),
('Site.*', 1, NULL, NULL, 'N;'),
('Site.Contact', 0, NULL, NULL, 'N;'),
('Site.Error', 0, NULL, NULL, 'N;'),
('Site.Index', 0, NULL, NULL, 'N;'),
('Template.Admin', 0, NULL, NULL, 'N;'),
('Template.Create', 0, NULL, NULL, 'N;'),
('Template.Delete', 0, 'Удаление шаблона', '', 'N;'),
('Template.Index', 0, NULL, NULL, 'N;'),
('Template.Update', 0, NULL, NULL, 'N;'),
('Template.View', 0, NULL, NULL, 'N;'),
('updateOwnTemplate', 1, 'Редактирование только своего шаблона', 'return Yii::app()->user->id==$params["owner"];', 'N;'),
('User.*', 1, NULL, NULL, 'N;'),
('User.Admin', 0, NULL, NULL, 'N;'),
('User.ChangePassword', 0, NULL, NULL, 'N;'),
('User.Create', 0, NULL, NULL, 'N;'),
('User.Delete', 0, NULL, NULL, 'N;'),
('User.GetManagersList', 0, NULL, NULL, 'N;'),
('User.Index', 0, NULL, NULL, 'N;'),
('User.Login', 0, NULL, NULL, 'N;'),
('User.Logout', 0, NULL, NULL, 'N;'),
('User.Update', 0, NULL, NULL, 'N;'),
('User.View', 0, NULL, NULL, 'N;'),
('viewOwnTemplate', 1, 'Правило для показа только шаблонов принадлежащих пользователю', 'return Yii::app()->user->id==$params["owner"];', 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('Doctor', 'Authenticated'),
('Manager', 'Authenticated'),
('Registrator', 'Authenticated'),
('Doctor', 'Conclusion.*'),
('Registrator', 'deleteOwnTemplate'),
('Registrator', 'Doctor.Create'),
('Registrator', 'Doctor.GetHospitalsListJson'),
('Doctor', 'Doctor.GetPatientDoctorInfo'),
('Registrator', 'Doctor.GetPatientDoctorInfo'),
('Authenticated', 'Guest'),
('Registrator', 'Hospital.Create'),
('Guest', 'Mrtscan.Index'),
('Registrator', 'Patient.Create'),
('Registrator', 'Patient.GetDoctorsListJson'),
('Doctor', 'Patient.Index'),
('Manager', 'Patient.Index'),
('Registrator', 'Patient.Index'),
('Manager', 'Patient.Report'),
('Registrator', 'Patient.Save'),
('Manager', 'Patient.toggle'),
('Registrator', 'Patient.toggle'),
('Doctor', 'Patient.View'),
('Registrator', 'Registration.AddService'),
('Registrator', 'Registration.GetMrtscansList'),
('Registrator', 'Registration.Patient'),
('Registrator', 'Registration.Save'),
('Guest', 'Site.*'),
('Site.*', 'Site.Contact'),
('Site.*', 'Site.Error'),
('Site.*', 'Site.Index'),
('Registrator', 'Template.Admin'),
('Registrator', 'Template.Create'),
('deleteOwnTemplate', 'Template.Delete'),
('Registrator', 'Template.Delete'),
('Registrator', 'Template.Index'),
('Registrator', 'Template.OwnUpdate'),
('Registrator', 'Template.Update'),
('Template.OwnUpdate', 'Template.Update'),
('updateOwnTemplate', 'Template.Update'),
('Registrator', 'Template.View'),
('Registrator', 'updateOwnTemplate'),
('Guest', 'User.Login'),
('Guest', 'User.Logout'),
('Registrator', 'viewOwnTemplate');

-- --------------------------------------------------------

--
-- Table structure for table `conclusions`
--

CREATE TABLE IF NOT EXISTS `conclusions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `mrtscan_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`,`mrtscan_id`,`owner_id`),
  KEY `mrtscan_id` (`mrtscan_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hospital_id` (`hospital_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `fullname`, `phone`, `type`, `hospital_id`, `status`, `created_at`, `updated_at`, `created_user`, `updated_user`) VALUES
(1, 'Азаматов К. Н.', '0554 293939', 'Хирург', 2, 0, '2013-02-02 23:13:15', '2013-02-16 16:09:58', 1, 1),
(2, 'Калмурзаев Н. А.', '0700 349584', 'Терапевт', 1, 0, '2013-02-03 01:44:32', '2013-02-04 00:55:03', 1, 1),
(3, 'Тобокелдиев П. М.', '0543 392812', 'Хирург', 1, 0, '2013-02-03 01:45:39', '2013-02-03 01:45:39', 1, 1),
(4, 'Никитов А. З.', '0704 234567', 'Травмотолог', 4, 0, '2013-02-03 01:46:32', '2013-02-03 01:46:32', 1, 1),
(5, 'Витюгов Н. Т.', '0704 392876', 'Терапевт', 5, 0, '2013-02-03 01:47:24', '2013-02-03 01:47:24', 1, 1),
(6, 'Байталиева Айша Калмурзаева', '0700 374636', 'Терапевт', 1, 0, '2013-02-11 21:14:56', '2013-02-11 21:14:56', 1, 1),
(7, 'Энтони Берлускони', '0555 394838', 'Хирург', 3, 0, '2013-02-13 03:06:23', '2013-02-13 03:06:23', 2, 2),
(8, 'test3', 'test3', 'Хирург', 3, 0, '2013-02-13 03:51:59', '2013-02-13 03:51:59', 2, 2),
(9, 'test4', 'test4', 'Хирург', 1, 0, '2013-02-13 03:53:56', '2013-02-13 03:54:21', 2, 1),
(11, 'test6', 'test6', 'Травмотолог', 4, 0, '2013-02-13 09:56:44', '2013-02-13 09:56:44', 2, 2),
(12, 'Кожомамбетов Азамат', '0532 273646', 'Неврохирург', 1, 0, '2013-02-14 06:43:12', '2013-02-14 06:43:12', 1, 1),
(13, 'Тоголок Молдо', '0543 128374', 'Педиатр', 14, 0, '2013-02-16 16:09:06', '2013-02-16 16:09:06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE IF NOT EXISTS `hospitals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `phone`, `manager_id`, `status`, `created_at`, `updated_at`, `created_user`, `updated_user`) VALUES
(1, 'Хирургическая больница №12', '0312 121212', 2, 0, '2013-02-02 21:12:43', '2013-02-02 22:35:08', 1, 1),
(2, 'Областная больница №2', '0312 394858', 2, 0, '2013-02-02 21:37:15', '2013-02-02 21:37:15', 1, 1),
(3, 'Чуйская нерво-травматологическая больница №50', '02222 854834', 3, 0, '2013-02-02 21:38:09', '2013-02-02 21:38:20', 1, 1),
(4, 'Ошская областная больница №5', '02223 95482', 3, 0, '2013-02-02 22:08:57', '2013-02-02 22:08:57', 1, 1),
(5, 'Городская больница №4', '0312 857436', 3, 0, '2013-02-02 22:09:32', '2013-02-11 21:32:32', 1, 1),
(6, 'test', 'test', 2, 0, '2013-02-13 11:46:21', '2013-02-13 11:46:21', 2, 2),
(7, 'test4', 'test4', 2, 0, '2013-02-13 11:48:27', '2013-02-13 11:48:27', 2, 2),
(8, 'test3', 'test3', 2, 0, '2013-02-13 11:50:14', '2013-02-13 11:50:14', 2, 2),
(9, 'test2', 'test2', 2, 0, '2013-02-13 11:51:17', '2013-02-13 11:51:17', 2, 2),
(10, 'test5', 'test5', 2, 0, '2013-02-13 11:53:18', '2013-02-13 11:53:18', 2, 2),
(11, 'test6', 'test6', 2, 0, '2013-02-13 11:56:49', '2013-02-13 11:56:49', 2, 2),
(12, 'test7', 'test7', 2, 0, '2013-02-13 11:57:32', '2013-02-13 11:57:32', 2, 2),
(13, 'ЦСМ №11', '0312 384756', 3, 0, '2013-02-16 16:06:45', '2013-02-16 16:06:45', 1, 1),
(14, 'ЦСМ №12', '312 495860', 3, 0, '2013-02-16 16:08:51', '2013-02-16 16:08:51', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mrtscans`
--

CREATE TABLE IF NOT EXISTS `mrtscans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mrtscans`
--

INSERT INTO `mrtscans` (`id`, `name`, `description`, `price`, `status`, `created_at`, `updated_at`, `created_user`, `updated_user`) VALUES
(1, 'Головной мозг', 'Вся область головного мозга', 2500, 0, '2013-02-03 08:43:23', '2013-02-03 08:43:23', 1, 1),
(2, 'Позвоночник', 'Область позвоночника', 3000, 0, '2013-02-03 09:03:26', '2013-02-03 09:03:26', 1, 1),
(3, 'Ноги', 'Вся нижняя часть ', 3500, 0, '2013-02-03 09:04:05', '2013-02-03 09:04:05', 1, 1),
(4, 'Нижняя часть тела', 'Нижняя часть тела', 2000, 0, '2013-02-04 12:22:10', '2013-02-18 18:05:19', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `doctor_id` int(11) NOT NULL,
  `report` tinyint(1) NOT NULL DEFAULT '0',
  `reported_at` datetime NOT NULL,
  `desc_doctor_id` int(11) NOT NULL DEFAULT '0',
  `payment` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `desc_doctor_id` (`desc_doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `fullname`, `phone`, `birthday`, `sex`, `status`, `doctor_id`, `report`, `reported_at`, `desc_doctor_id`, `payment`, `created_at`, `updated_at`, `created_user`, `updated_user`) VALUES
(1, 'Давыдова К. М.', '0543 283746', '1980-01-29', 1, 2, 4, 1, '0000-00-00 00:00:00', 0, 0, '2013-02-03 09:40:23', '2013-02-07 21:39:23', 1, 1),
(3, 'Хренова Ю. Н.', '0543 273616', '1969-12-12', 1, 2, 1, 1, '0000-00-00 00:00:00', 0, 0, '2012-01-05 21:14:59', '2012-02-07 22:47:20', 1, 1),
(4, 'Ашимканова А. Н.', '0543 239384', '1965-06-22', 1, 2, 2, 1, '0000-00-00 00:00:00', 0, 0, '2013-02-07 20:50:48', '2013-02-07 22:47:16', 1, 1),
(5, 'Ашыралиева Ф. У.', '0549 382736', '1975-06-11', 1, 2, 1, 1, '0000-00-00 00:00:00', 0, 0, '2013-02-07 22:22:06', '2013-02-07 22:47:13', 1, 1),
(6, 'Акбаров К. М.', '0774 122736', '1985-06-27', 1, 1, 5, 0, '0000-00-00 00:00:00', 0, 0, '2013-02-07 23:30:55', '2013-02-07 23:30:55', 1, 1),
(7, 'Калмуратов А. Н.', '0555 394827', '1985-10-20', 1, 2, 4, 1, '0000-00-00 00:00:00', 0, 0, '2013-02-07 23:47:05', '2013-02-09 08:30:15', 1, 1),
(8, 'Маюков А. Н.', '0555 394868', '1976-08-12', 0, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, '2013-02-09 12:02:09', '2013-02-09 12:02:09', 1, 1),
(9, 'test', 'test', '2011-07-13', 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 1, '2013-02-11 09:02:40', '2013-02-11 09:02:40', 1, 1),
(10, 'Test', 'tst', '1964-09-14', 0, 0, 1, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-11 09:33:42', '2013-02-11 09:33:42', 1, 1),
(11, 'test1', 'test1', '1965-06-17', 1, 0, 5, 0, '0000-00-00 00:00:00', 0, 1, '2013-02-11 09:34:43', '2013-02-11 09:34:43', 1, 1),
(12, 'test2', 'test2', '1979-05-05', 0, 1, 5, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-11 19:45:49', '2013-02-11 19:45:49', 1, 1),
(13, 'test3', 'test3', '1969-01-16', 0, 2, 4, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-13 02:29:11', '2013-02-13 02:29:11', 2, 2),
(14, 'test4', 'test4', '1995-06-20', 0, 2, 9, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-13 03:56:57', '2013-02-13 03:56:57', 2, 2),
(15, 'test5', 'test5', '1960-07-12', 0, 1, 11, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-13 09:57:09', '2013-02-13 09:57:09', 2, 2),
(16, 'test5', 'test5', '1975-06-12', 1, 2, 7, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-14 06:41:17', '2013-02-14 06:41:17', 1, 1),
(17, 'test6', 'test6', '1974-07-17', 0, 1, 12, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-14 06:43:39', '2013-02-14 06:43:39', 1, 1),
(18, 'test7', 'test7', '1975-06-25', 0, 1, 4, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-16 13:16:44', '2013-02-16 13:16:44', 2, 2),
(19, 'test8', 'test8', '1974-07-22', 1, 1, 4, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-16 13:26:03', '2013-02-16 13:26:03', 2, 2),
(20, 'Тест Пациент', '0543 239348', '1985-06-15', 0, 1, 4, 1, '0000-00-00 00:00:00', 0, 1, '2013-02-16 16:13:02', '2013-02-16 16:13:02', 1, 1),
(21, 'test9', 'test9', '1996-10-27', 1, 1, 4, 1, '2013-02-21 22:53:42', 0, 1, '2013-02-17 00:14:06', '2013-02-17 00:14:06', 1, 1),
(22, 'Дмитрий Н. К.', '0543 293822', '1964-11-24', 0, 1, 4, 0, '0000-00-00 00:00:00', 0, 1, '2013-02-22 11:01:30', '2013-02-22 11:01:30', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `mrtscan_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discont` decimal(10,2) NOT NULL,
  `price_with_discont` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `report_status` tinyint(1) NOT NULL DEFAULT '0',
  `report_text` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `mrtscan_id` (`mrtscan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `patient_id`, `mrtscan_id`, `price`, `discont`, `price_with_discont`, `status`, `report_status`, `report_text`, `created_at`, `updated_at`, `created_user`, `updated_user`) VALUES
(40, 1, 1, 2500.00, 1000.00, 1500.00, 0, 0, NULL, '2013-02-06 13:54:17', '2013-02-06 13:54:17', 1, 1),
(48, 1, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-07 09:56:13', '2013-02-07 09:56:13', 1, 1),
(49, 1, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-07 09:56:15', '2013-02-07 09:56:15', 1, 1),
(50, 1, 4, 2000.00, 0.00, 2000.00, 0, 0, NULL, '2013-02-07 09:56:51', '2013-02-07 09:56:51', 1, 1),
(52, 3, 3, 3500.00, 900.00, 2600.00, 0, 0, NULL, '2013-02-07 10:04:13', '2013-02-07 10:04:13', 1, 1),
(56, 3, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-07 18:58:49', '2013-02-07 18:58:49', 1, 1),
(64, 6, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-07 23:40:00', '2013-02-07 23:40:00', 1, 1),
(67, 6, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-07 23:41:58', '2013-02-07 23:41:58', 1, 1),
(68, 6, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-07 23:42:02', '2013-02-07 23:42:02', 1, 1),
(69, 7, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-07 23:47:24', '2013-02-07 23:47:24', 1, 1),
(70, 7, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-07 23:47:26', '2013-02-07 23:47:26', 1, 1),
(71, 8, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-09 12:03:51', '2013-02-09 12:03:51', 1, 1),
(72, 8, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-09 12:03:54', '2013-02-09 12:03:54', 1, 1),
(73, 9, 1, 2500.00, 900.00, 1600.00, 0, 0, NULL, '2013-02-11 09:04:43', '2013-02-11 09:04:43', 1, 1),
(74, 9, 3, 3500.00, 3500.00, 0.00, 0, 0, NULL, '2013-02-11 09:04:45', '2013-02-11 09:04:45', 1, 1),
(75, 9, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-11 09:24:40', '2013-02-11 09:24:40', 1, 1),
(76, 10, 1, 2500.00, 1000.00, 1500.00, 0, 0, NULL, '2013-02-11 09:33:49', '2013-02-11 09:33:49', 1, 1),
(77, 10, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-11 09:33:50', '2013-02-11 09:33:50', 1, 1),
(78, 10, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-11 09:33:52', '2013-02-11 09:33:52', 1, 1),
(79, 11, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-11 09:34:48', '2013-02-11 09:34:48', 1, 1),
(80, 11, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-11 09:34:50', '2013-02-11 09:34:50', 1, 1),
(86, 12, 1, 2500.00, 500.00, 2000.00, 0, 0, NULL, '2013-02-11 21:47:32', '2013-02-11 21:47:32', 1, 1),
(87, 12, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-11 21:47:34', '2013-02-11 21:47:34', 1, 1),
(88, 12, 2, 3000.00, 3000.00, 0.00, 0, 0, NULL, '2013-02-11 21:51:20', '2013-02-11 21:51:20', 1, 1),
(89, 13, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-13 02:32:51', '2013-02-13 02:32:51', 2, 2),
(90, 13, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-13 02:32:53', '2013-02-13 02:32:53', 2, 2),
(91, 14, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-13 04:04:27', '2013-02-13 04:04:27', 2, 2),
(92, 14, 1, 2500.00, 90.00, 2410.00, 0, 0, NULL, '2013-02-13 04:04:30', '2013-02-13 04:04:30', 2, 2),
(93, 14, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-13 04:04:33', '2013-02-13 04:04:33', 2, 2),
(94, 15, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-13 10:25:37', '2013-02-13 10:25:37', 2, 2),
(95, 15, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-13 10:25:39', '2013-02-13 10:25:39', 2, 2),
(96, 16, 1, 2500.00, 100.00, 2400.00, 0, 0, NULL, '2013-02-14 06:41:22', '2013-02-14 06:41:22', 1, 1),
(98, 17, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-14 06:44:13', '2013-02-14 06:44:13', 1, 1),
(99, 17, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-14 06:44:16', '2013-02-14 06:44:16', 1, 1),
(100, 16, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-14 06:46:14', '2013-02-14 06:46:14', 1, 1),
(101, 18, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-16 13:16:56', '2013-02-16 13:16:56', 2, 2),
(102, 18, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-16 13:16:58', '2013-02-16 13:16:58', 2, 2),
(106, 19, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-16 14:22:54', '2013-02-16 14:22:54', 1, 1),
(107, 19, 3, 3500.00, 1000.00, 2500.00, 0, 0, NULL, '2013-02-16 14:22:56', '2013-02-16 14:22:56', 1, 1),
(108, 20, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-16 16:13:22', '2013-02-16 16:13:22', 1, 1),
(109, 20, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-16 16:13:24', '2013-02-16 16:13:24', 1, 1),
(114, 3, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-17 09:20:43', '2013-02-17 09:20:43', 1, 1),
(115, 21, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-17 23:39:21', '2013-02-17 23:39:21', 1, 1),
(116, 21, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-17 23:39:24', '2013-02-17 23:39:24', 1, 1),
(117, 21, 2, 3000.00, 0.00, 3000.00, 0, 0, NULL, '2013-02-21 12:30:46', '2013-02-21 12:30:46', 2, 2),
(118, 21, 4, 2000.00, 0.00, 2000.00, 0, 0, NULL, '2013-02-21 12:30:48', '2013-02-21 12:30:48', 2, 2),
(119, 10, 4, 2000.00, 0.00, 2000.00, 0, 0, NULL, '2013-02-22 10:50:42', '2013-02-22 10:50:42', 2, 2),
(120, 22, 2, 3000.00, 1000.00, 2000.00, 0, 0, NULL, '2013-02-22 11:01:52', '2013-02-22 11:01:52', 2, 2),
(121, 22, 4, 2000.00, 0.00, 2000.00, 0, 0, NULL, '2013-02-22 11:01:57', '2013-02-22 11:01:57', 2, 2),
(122, 22, 1, 2500.00, 0.00, 2500.00, 0, 0, NULL, '2013-02-22 14:05:23', '2013-02-22 14:05:23', 2, 2),
(123, 22, 3, 3500.00, 0.00, 3500.00, 0, 0, NULL, '2013-02-22 14:05:25', '2013-02-22 14:05:25', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Rights`
--

CREATE TABLE IF NOT EXISTS `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` text NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `owner_id`, `name`, `file`, `description`, `created_at`, `updated_at`, `created_user`, `updated_user`) VALUES
(39, 3, 'Внутричерепной гипертонизия', '512725de33015.docx', 'Внутричерепной гипертонизия', '2013-02-22 14:01:34', '2013-02-22 14:01:34', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `lastvisit_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `email`, `created_at`, `lastvisit_at`, `superuser`, `status`, `type`) VALUES
(1, 'Санжарбек Аматов', 'sanzhar', '4eae18cf9e54a0f62b44176d074cbe2f', 'asanjarbek@gmail.com', '2013-02-02 13:28:11', '2013-02-28 06:20:45', 1, 1, 0),
(2, 'Бакыт Эшмурзаев', 'bakyt', '24f25aa3ef8d41974bbb5b69741f2508', 'ebakyt@yahoo.com', '2013-02-02 13:57:25', '2013-02-27 21:48:48', 0, 1, 1),
(3, 'Нурбек Бойтоев Анделек', 'nurba', '4eae18cf9e54a0f62b44176d074cbe2f', 'nurbek@mail.com', '2013-02-02 13:57:59', '2013-02-27 21:50:20', 0, 1, 1),
(4, 'Доктор 1', 'doctor1', '4eae18cf9e54a0f62b44176d074cbe2f', 'doctor@gmail.kg', '2013-02-27 21:39:05', '2013-02-27 21:52:25', 1, 1, 2),
(5, 'Доктор 2', 'doctor2', '4eae18cf9e54a0f62b44176d074cbe2f', 'doctor2@gmail.kg', '2013-02-27 21:40:10', '2013-02-27 21:46:01', 1, 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conclusions`
--
ALTER TABLE `conclusions`
  ADD CONSTRAINT `conclusions_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `conclusions_ibfk_2` FOREIGN KEY (`mrtscan_id`) REFERENCES `mrtscans` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `conclusions_ibfk_3` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospitals_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`mrtscan_id`) REFERENCES `mrtscans` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
