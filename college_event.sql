-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2026 at 01:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Sneha', 'snehamishra242286@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-02-10 15:13:49'),
(3, 'amangupta', 'sm07@gmail.com', '$2y$10$HOVhRGTGnjjvUuPcGGXfs.PwvrFqZUfeo0puTFToI/qQk9eUs3EQS', '2026-04-06 20:00:02'),
(5, 'Aman', 'gupta.amanghs@gmail.com', '$2y$10$Jw.8gZJAWKqscVx2gkixrOJ4hdmMpLAS5b5cYzdPy4l0x4hx2QsS6', '2026-06-04 09:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(100) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `event_id`, `created_at`) VALUES
(1, 'TEC1', 1, '2026-06-04 10:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_details` text DEFAULT NULL,
  `status` enum('live','closed','cancelled') NOT NULL DEFAULT 'live',
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `max_slots` int(11) NOT NULL DEFAULT 0,
  `event_description` text DEFAULT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `event_category` varchar(100) DEFAULT NULL,
  `event_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `event_details`, `status`, `price`, `max_slots`, `event_description`, `event_location`, `event_category`, `event_image`) VALUES
(1, 'Tech Fest', '2025-02-10', '💻 Tech Fest — Event Details\r\n\r\nDetails:\r\n📅 Date: 10 February 2026\r\n📍 Venue: Computer Labs & Seminar Hall\r\n🎯 Participants: IT and non-IT students\r\n🧠 Activities: Coding contests, workshops, project exhibitions\r\n🚀 Focus: Innovation and technology\r\nDescription:\r\nTech Fest is a technology-oriented academic event designed to encourage innovation, problem-solving, and technical learning among students. The event offers hands-on experience through competitions, workshops, and project demonstrations. It motivates students to explore modern technologies and enhances their technical skills for future career opportunities. 🤖⚙️', 'live', 0.00, 0, NULL, NULL, NULL, NULL),
(2, 'Cultural Day', '2026-03-05', '🎭 Cultural Day — Event Details\r\n\r\nDetails:\r\n📅 Date: 5 March 2026\r\n📍 Venue: College Auditorium\r\n🎯 Participants: Students from all departments\r\n🎨 Events: Dance, music, drama, fashion show\r\n🎉 Theme: Celebration of culture and diversity\r\nDescription:\r\nCultural Day is a vibrant celebration that showcases the artistic and cultural talents of students. The event brings together diverse traditions, performances, and creative expressions on a single platform. It helps students build confidence, express creativity, and appreciate cultural diversity while strengthening bonds within the college community. ✨🎶', 'live', 0.00, 0, 'NNNAAA', 'MUMBAI', 'Technical', '1780568004_email-svgrepo-com.png'),
(3, 'Sports Meet', '2026-04-01', '🏆 Sports Meet — Event Details\r\n\r\nDetails:\r\n📅 Date: 1 April 2026\r\n📍 Venue: College Sports Ground\r\n🎯 Participants: All students\r\n🏅 Activities: Track events, team sports, indoor & outdoor games\r\n🏆 Awards: Medals and certificates\r\nDescription:\r\nThe Sports Meet is an annual college event aimed at promoting physical fitness, teamwork, and sportsmanship among students. It provides a competitive yet friendly platform for students to participate in various sports activities and demonstrate their athletic skills. The event encourages discipline, leadership, and a healthy lifestyle while creating an atmosphere of enthusiasm and unity. 💪⚽', 'live', 0.00, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_mobile` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `members` int(11) DEFAULT 1,
  `registration_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `event_id`, `user_id`, `student_name`, `student_email`, `student_mobile`, `created_at`, `members`, `registration_code`) VALUES
(2, 3, 0, 'Sneha Mishra', 'sm5737057@gmail.com', '9833438711', '2026-02-06 15:14:21', 1, NULL),
(4, 1, 6, 'Aman', 'gupta.amanghs@gmail.com', '9324717458', '2026-06-04 11:30:35', 1, 'TEC1');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `members` int(11) DEFAULT 1,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, 'sneha', 'sm7@gmail.com', '$2y$10$SIZTlqXecXjRLktZ3ROpkOAWFXj1eYoloDxeQH4A18in8hGOr3JSa', '2026-02-07 17:07:27'),
(2, 'Sneha Mishra', 'sneha@amdeveloper.site', '$2y$10$stRUeo.pNDVFvql4sAQl9uFqXe2NJ4RaosraeySwQY0173iM99yBa', '2026-02-07 19:58:08'),
(3, 'Sneha Mishra', 'snehamishra242286@gmail.com', '$2y$10$Whh2fOBt8sEL5CmvYX9m5OUCGlz0VU6PNUqBCtGwD5gqTiOLlhdqK', '2026-02-08 06:27:45'),
(4, 'aman', 'sm07@gmail.com', '$2y$10$rGx7VAVUVn7aW84YA3v0WOU0saDI0Kwxc62BaYNoEo8xlg.wap7Oa', '2026-04-06 19:42:38'),
(5, 'sm', 'test@gmail.com', '$2y$10$vK/mhOKxGggmNoJRDIHWbuRLXRUVrfoY7J6STWiL2nIPTJeqVzcF6', '2026-04-07 16:20:50'),
(6, 'Aman', 'gupta.amanghs@gmail.com', '$2y$10$T1oiUkYzmiXJagganj/Qsu7gqA7wKFryO0v0g/ZX9QURGMwHpU8D6', '2026-06-04 08:54:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon_code` (`coupon_code`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
