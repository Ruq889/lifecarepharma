-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2024 at 08:55 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `life_pharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `appointment_datetime` datetime NOT NULL,
  `problem` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prescription` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `name`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 'Neurologist', 'A neurologist is a medical doctor who specializes in diagnosing and treating disorders of the nervous system. This includes the brain, spinal cord, nerves, and muscles. Neurologists are trained to identify and manage a wide range of conditions, such as epilepsy, stroke, multiple sclerosis, Alzheimer\'s disease, Parkinson\'s disease, and various types of headaches. They use a combination of clinical evaluation, diagnostic tests, and medical treatments to help patients manage neurological conditions and improve their quality of life. In some cases, they may also work closely with other specialists, such as neurosurgeons or physical therapists, to provide comprehensive care.', 1, 0, '2024-02-01 11:38:45', '2024-02-02 05:10:40'),
(3, 'Orthopedic', 'Orthopedic medicine is a branch of medicine that focuses on the diagnosis, treatment, and prevention of disorders and injuries related to the musculoskeletal system. This includes bones, joints, ligaments, tendons, muscles, and nerves. Orthopedic doctors, also known as orthopedic surgeons, are trained to address a wide range of musculoskeletal conditions, from fractures and sprains to more complex issues such as arthritis and congenital deformities. Treatment methods can include medication, physical therapy, and surgical interventions.', 1, 0, '2024-02-01 11:40:16', '2024-02-01 11:40:16'),
(4, 'Cardiologist', 'A cardiologist is a medical doctor who specializes in diagnosing and treating disorders of the heart and blood vessels. They are trained to manage a wide range of cardiovascular conditions, including heart disease, heart attacks, heart rhythm disorders, and heart failure. Cardiologists use various diagnostic tests, such as electrocardiograms (ECGs), echocardiograms, and stress tests, to assess the heart\'s function and structure. Treatment options may include medication, lifestyle modifications, and in some cases, surgical interventions such as angioplasty or bypass surgery. Cardiologists play a crucial role in helping patients maintain heart health and manage cardiovascular conditions.', 1, 0, '2024-02-02 07:04:17', '2024-02-02 07:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('admin','doctor','pharmacist','staff','user') NOT NULL,
  `name` varchar(80) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `contact`, `email`, `password`, `address`, `image`, `speciality_id`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', '', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', NULL, NULL, NULL, 1, 0, '2024-01-31 07:11:18', '2024-02-03 07:13:34'),
(2, 'doctor', 'Kendra Sean', '9578401290', 'KendraSean@armyspy.com', '25d55ad283aa400af464c76d713c07ad', 'Address', 'doctor1.jpg', 2, 'A seasoned neurologist who has closely worked with the government and various NGOs over the years and has earned for herself the reputation of being the most sought after neurologist.', 1, 0, '2024-01-31 07:47:12', '2024-02-02 07:48:00'),
(4, 'doctor', 'Jeffrey Williams', '9652060029', 'JeffreyWilliams@armyspy.com', '25d55ad283aa400af464c76d713c07ad', 'Address', 'doctor2.jpg', 4, 'One of the best cardiologists in the two with more than 7 years of experience as a cardiac surgeon. Dr. Jeffrey Williams is amazingly friendly and incredibly flawless in her practice.', 1, 0, '2024-01-31 10:02:18', '2024-02-02 11:57:57'),
(7, 'doctor', 'Charlie Sheppard', '9658201394', 'CharlieSheppard@armyspy.com', '25d55ad283aa400af464c76d713c07ad', '40 Thompsons Lane\r\nMELKSHAM\r\nSN12 6BQ', 'doctor3.jpg', 3, 'He has led more than 100 successful orthopedic surgeries and has worked for more than 5 years at a military hospital. His experience and reputation speaks for his expertise.', 1, 0, '2024-02-01 11:32:21', '2024-02-02 07:48:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
