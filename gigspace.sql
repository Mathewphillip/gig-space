-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2026 at 09:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gigspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_url` text DEFAULT NULL,
  `file_type` varchar(20) DEFAULT NULL,
  `related_type` varchar(20) DEFAULT NULL,
  `related_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `proposal` text NOT NULL,
  `delivery_time` int(11) NOT NULL COMMENT 'days',
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `project_id`, `freelancer_id`, `amount`, `proposal`, `delivery_time`, `status`, `created_at`, `updated_at`) VALUES
(7, 8, 5, 2500.00, 'Dear Client,\r\n\r\nI am very interested in your E-commerce Platform Development project and believe I am a strong fit for the job. I have experience building modern web applications with secure authentication systems, responsive user interfaces, payment integrations, and scalable backend architectures.\r\n\r\nFor this project, I can develop a clean, fast, and fully responsive e-commerce platform that includes:\r\n\r\n* User authentication and account management\r\n* Product management system\r\n* Shopping cart and secure checkout\r\n* Order tracking functionality\r\n* Admin dashboard\r\n* Product search and filtering\r\n* Wishlist and review features\r\n* Mobile-friendly responsive design\r\n\r\n### Proposed Tech Stack\r\n\r\n* Frontend: React / Next.js\r\n* Backend: Node.js or Laravel\r\n* Database: PostgreSQL or MySQL\r\n* Authentication: JWT / Session-based authentication\r\n* Payment Integration: Stripe or PayPal\r\n\r\nI focus on writing clean, maintainable, and secure code while ensuring good UI/UX and performance optimization.\r\n\r\n### Estimated Timeline\r\n\r\nApproximately 5–7 weeks depending on final requirements and revisions.\r\n\r\n### Why Choose Me?\r\n\r\n* Strong full-stack development experience\r\n* Good communication and regular updates\r\n* Scalable and maintainable architecture\r\n* Attention to responsive and modern UI design\r\n\r\nI would be happy to discuss the project further and share relevant portfolio work.\r\n\r\nLooking forward to working with you.\r\n\r\nBest regards,', 60, 'accepted', '2026-05-03 10:52:40', '2026-05-03 10:54:33'),
(8, 9, 5, 1000.00, 'Dear Client,\r\n\r\nI am excited to submit my proposal for the Student Management System Development project. I have experience building secure and scalable web applications and I believe I can deliver a modern system that meets your institution’s academic and administrative needs.\r\n\r\nBased on your requirements, I can develop a complete system with features such as:\r\n\r\n* Student registration and profile management\r\n* Attendance tracking\r\n* Course and timetable management\r\n* Examination and grading system\r\n* Fee/payment management\r\n* Role-based authentication and access control\r\n* Notifications and announcements\r\n* Dashboard analytics and reporting\r\n* Responsive interface for desktop and mobile devices\r\n\r\n## Proposed Technology Stack\r\n\r\n* Frontend: React.js\r\n* Backend: Django REST Framework\r\n* Database: PostgreSQL\r\n* Authentication: JWT Authentication\r\n* Hosting/Deployment: VPS or Cloud Deployment\r\n\r\nI will focus on:\r\n\r\n* Clean and maintainable code\r\n* Strong security practices\r\n* Fast and responsive UI/UX\r\n* Scalable system architecture\r\n* Proper database design and optimization\r\n\r\n## Estimated Timeline\r\n\r\nApproximately 5 weeks depending on final requirements and feedback cycles.\r\n\r\n## Why Work With Me?\r\n\r\n* Strong understanding of management systems\r\n* Good communication and regular progress updates\r\n* Attention to performance and usability\r\n* Ability to build both frontend and backend systems\r\n\r\nI am confident I can deliver a professional and reliable Student Management System tailored to your institution’s needs.\r\n\r\nI would be happy to discuss the project further and answer any questions you may have.\r\n\r\nBest regards,', 37, 'rejected', '2026-05-03 10:59:29', '2026-05-03 11:02:56'),
(9, 9, 4, 1200.00, 'Dear Client,\r\n\r\nI am excited to submit my proposal for the Student Management System Development project. I have experience building secure and scalable web applications and I believe I can deliver a modern system that meets your institution’s academic and administrative needs.\r\n\r\nBased on your requirements, I can develop a complete system with features such as:\r\n\r\n* Student registration and profile management\r\n* Attendance tracking\r\n* Course and timetable management\r\n* Examination and grading system\r\n* Fee/payment management\r\n* Role-based authentication and access control\r\n* Notifications and announcements\r\n* Dashboard analytics and reporting\r\n* Responsive interface for desktop and mobile devices\r\n\r\n## Proposed Technology Stack\r\n\r\n* Frontend: React.js\r\n* Backend: Django REST Framework\r\n* Database: PostgreSQL\r\n* Authentication: JWT Authentication\r\n* Hosting/Deployment: VPS or Cloud Deployment\r\n\r\nI will focus on:\r\n\r\n* Clean and maintainable code\r\n* Strong security practices\r\n* Fast and responsive UI/UX\r\n* Scalable system architecture\r\n* Proper database design and optimization\r\n\r\n## Estimated Timeline\r\n\r\nApproximately 5 weeks depending on final requirements and feedback cycles.\r\n\r\n## Why Work With Me?\r\n\r\n* Strong understanding of management systems\r\n* Good communication and regular progress updates\r\n* Attention to performance and usability\r\n* Ability to build both frontend and backend systems\r\n\r\nI am confident I can deliver a professional and reliable Student Management System tailored to your institution’s needs.\r\n\r\nI would be happy to discuss the project further and answer any questions you may have.\r\n\r\nBest regards,', 30, 'accepted', '2026-05-03 11:01:16', '2026-05-03 11:02:56'),
(10, 10, 4, 1600.00, 'Dear Client,\r\n\r\nI am pleased to submit my proposal for the Hostel Management System Development project. After reviewing your requirements, I am confident that I can build a secure, scalable, and user-friendly system that will efficiently manage hostel operations and improve the overall experience for both administrators and students.\r\n\r\n## Understanding of the Project\r\n\r\nThe system will include essential functionalities such as:\r\n\r\n* Student registration and profile management\r\n* Hostel and room allocation management\r\n* Bed space availability tracking\r\n* Booking and reservation system\r\n* Online payment tracking\r\n* Receipt generation\r\n* Maintenance request handling\r\n* Role-based access control\r\n* Notifications and announcements\r\n* Responsive admin dashboard and analytics\r\n\r\nI will ensure the platform is modern, responsive, and optimized for performance across both desktop and mobile devices.\r\n\r\n## Proposed Technology Stack\r\n\r\n* Frontend: React.js / Next.js\r\n* Backend: Django REST Framework\r\n* Database: PostgreSQL\r\n* Authentication: JWT Authentication\r\n* Deployment: VPS or Cloud Hosting\r\n\r\n## What I Will Deliver\r\n\r\n* Clean and maintainable codebase\r\n* Secure authentication and authorization system\r\n* Optimized database structure\r\n* Responsive and intuitive UI/UX\r\n* Scalable architecture for future upgrades\r\n* Regular project updates and communication\r\n\r\n## Estimated Timeline\r\n\r\nThe project can be completed within approximately 5 weeks depending on the final scope and feedback process.\r\n\r\n## Why Choose Me?\r\n\r\n* Experience building management systems\r\n* Strong understanding of frontend and backend development\r\n* Focus on performance, security, and usability\r\n* Commitment to delivering quality work on time\r\n\r\nI would be happy to discuss the project further and share ideas on how we can make the system efficient and reliable.\r\n\r\nLooking forward to working with you.\r\n\r\nBest regards,', 34, 'accepted', '2026-05-03 13:14:59', '2026-05-03 15:44:10'),
(11, 11, 5, 2300.00, 'Dear Client,\r\n\r\nI am excited to submit my proposal for the Hotel Management System Development project. After reviewing your requirements, I am confident that I can develop a modern, secure, and scalable solution that will help streamline hotel operations and improve customer management.\r\n\r\nI have experience building management systems and understand the importance of performance, usability, and reliability in hotel operations.\r\n\r\n## Features I Will Implement\r\n\r\n* Customer registration and profile management\r\n* Room booking and reservation system\r\n* Real-time room availability tracking\r\n* Check-in and check-out management\r\n* Payment and invoice management\r\n* Receipt generation\r\n* Staff management system\r\n* Role-based access control\r\n* Dashboard analytics and reporting\r\n* Notifications and email alerts\r\n* Responsive mobile and desktop interface\r\n\r\n## Proposed Technology Stack\r\n\r\n* Frontend: React.js / Next.js\r\n* Backend: Django REST Framework\r\n* Database: PostgreSQL\r\n* Authentication: JWT Authentication\r\n* Deployment: Cloud/VPS Hosting\r\n\r\n## What You Can Expect\r\n\r\n* Clean and maintainable code\r\n* Secure authentication and data handling\r\n* Modern and intuitive UI/UX\r\n* Optimized database and system performance\r\n* Scalable architecture for future improvements\r\n* Regular progress updates and communication\r\n\r\n## Estimated Timeline\r\n\r\nThe complete system can be delivered within approximately 6 weeks depending on the final project scope and revisions.\r\n\r\n## Why Choose Me?\r\n\r\n* Strong experience in full-stack development\r\n* Good understanding of management system workflows\r\n* Focus on quality, security, and usability\r\n* Commitment to delivering projects on time\r\n\r\nI would be glad to discuss the project further and share ideas that can help make the system more efficient and user-friendly.\r\n\r\nLooking forward to working with you.\r\n\r\nBest regards,', 60, 'accepted', '2026-05-05 04:36:56', '2026-05-05 04:46:03'),
(12, 12, 5, 400.00, 'Dear Client,\r\n\r\nI am excited to submit my proposal for the Gym Management System Development project. After reviewing your requirements, I am confident that I can build a modern, secure, and efficient system that will simplify gym operations and provide a smooth experience for administrators, trainers, and members.\r\n\r\nI have experience developing management systems and understand the importance of usability, performance, and scalability in such platforms.\r\n\r\n## Features I Will Develop\r\n\r\n* Member registration and profile management\r\n* Membership plan management\r\n* Trainer management system\r\n* Class scheduling and booking\r\n* Attendance tracking\r\n* Payment and subscription management\r\n* Invoice and receipt generation\r\n* Role-based access control\r\n* Dashboard analytics and reporting\r\n* Notifications and reminders\r\n* Responsive design for mobile and desktop devices\r\n\r\n## Proposed Technology Stack\r\n\r\n* Frontend: React.js / Next.js\r\n* Backend: Django REST Framework\r\n* Database: PostgreSQL\r\n* Authentication: JWT Authentication\r\n* Deployment: VPS or Cloud Hosting\r\n\r\n## What You Can Expect\r\n\r\n* Clean and maintainable code\r\n* Modern and intuitive UI/UX\r\n* Secure authentication and data handling\r\n* Optimized database structure and performance\r\n* Scalable architecture for future upgrades\r\n* Regular communication and progress updates\r\n\r\n## Estimated Timeline\r\n\r\nThe project can be completed within approximately 5 weeks depending on the final scope and revisions.\r\n\r\n## Why Choose Me?\r\n\r\n* Strong full-stack development experience\r\n* Experience building management systems\r\n* Focus on quality, security, and responsiveness\r\n* Commitment to delivering projects on time\r\n\r\nI would be happy to discuss the project further and share ideas that can improve the overall system workflow and user experience.\r\n\r\nLooking forward to working with you.\r\n\r\nBest regards', 46, 'accepted', '2026-05-05 06:29:04', '2026-05-05 06:39:06'),
(13, 13, 4, 500.00, 'Hello,\r\n\r\nI would love to work on your concert graphic design project. I am a creative graphic designer with experience in designing promotional materials such as concert posters, event flyers, social media graphics, banners, and branding content that attract attention and increase audience engagement.\r\n\r\nFor your project, I can create:\r\n\r\n* Professional concert posters\r\n* Eye-catching social media flyers\r\n* Ticket and pass designs\r\n* Event banners and cover images\r\n* Modern and vibrant branding visuals\r\n\r\nI focus on clean layouts, bold typography, attractive color combinations, and high-quality visuals that match the energy and excitement of music events. All designs will be delivered in high resolution together with editable source files.\r\n\r\nWhy choose me?\r\n\r\n* Fast communication\r\n* Creative and modern designs\r\n* Attention to detail\r\n* On-time delivery\r\n* Unlimited revisions until satisfaction\r\n\r\nI am ready to start immediately and would be happy to discuss your concert theme, audience, and preferred style to create something outstanding.\r\n\r\nLooking forward to working with you.\r\n\r\nBest regards', 10, 'accepted', '2026-05-05 12:41:12', '2026-05-05 12:51:19'),
(14, 13, 7, 650.00, 'Hello,\r\n\r\nI would love to work on your concert graphic design project. I am a creative graphic designer with experience in designing promotional materials such as concert posters, event flyers, social media graphics, banners, and branding content that attract attention and increase audience engagement.\r\n\r\nFor your project, I can create:\r\n\r\n* Professional concert posters\r\n* Eye-catching social media flyers\r\n* Ticket and pass designs\r\n* Event banners and cover images\r\n* Modern and vibrant branding visuals\r\n\r\nI focus on clean layouts, bold typography, attractive color combinations, and high-quality visuals that match the energy and excitement of music events. All designs will be delivered in high resolution together with editable source files.\r\n\r\nWhy choose me?\r\n\r\n* Fast communication\r\n* Creative and modern designs\r\n* Attention to detail\r\n* On-time delivery\r\n* Unlimited revisions until satisfaction\r\n\r\nI am ready to start immediately and would be happy to discuss your concert theme, audience, and preferred style to create something outstanding.\r\n\r\nLooking forward to working with you.\r\n\r\nBest regards', 7, 'rejected', '2026-05-05 12:49:07', '2026-05-05 12:51:19'),
(15, 16, 5, 3300.00, 'Hello,\r\n\r\nI would love to work on your School Management System project. I have experience developing management systems and understand the importance of building a secure, reliable, and user-friendly platform for handling school operations efficiently.\r\n\r\nI can help you develop features such as:\r\n\r\n* Student and teacher management\r\n* Attendance tracking\r\n* Fees/payment management\r\n* Results and grading system\r\n* Timetable management\r\n* Notifications and announcements\r\n* Admin dashboard\r\n* Reports generation\r\n* Role-based access control\r\n\r\nI am comfortable working with technologies such as React, Django, PHP, Node.js, PostgreSQL, and MySQL depending on your preferred stack and project requirements.\r\n\r\nWhy choose me?\r\n\r\n* Clean and scalable code structure\r\n* Modern and responsive UI\r\n* Strong database design\r\n* Good communication and regular progress updates\r\n* On-time delivery\r\n* Long-term support if needed\r\n\r\nI focus on performance, security, and usability to ensure the system is efficient for administrators, teachers, students, and parents.\r\n\r\nI am ready to start immediately and would be happy to discuss the project requirements and timeline further.\r\n\r\nLooking forward to working with you.', 60, 'accepted', '2026-05-06 16:37:45', '2026-05-06 17:11:54'),
(16, 17, 8, 1500.00, 'Hello,\r\n\r\nI am very interested in developing your freelancing marketplace mobile application. I have experience building modern web and mobile applications using technologies such as React Native, Django, Firebase, Node.js, PostgreSQL, and MySQL.\r\n\r\nYour project is very exciting, and I understand the importance of creating a secure, scalable, and user-friendly platform where clients and freelancers can interact smoothly.\r\n\r\nI can help you build features such as:\r\n\r\n* User authentication and profiles\r\n* Job posting and bidding system\r\n* Real-time messaging/chat\r\n* Notifications\r\n* Payment integration\r\n* Ratings and reviews\r\n* Admin dashboard\r\n* Search and filtering functionality\r\n\r\nWhat you can expect from me:\r\n\r\n* Clean and maintainable code\r\n* Modern UI/UX design\r\n* Fast communication and regular updates\r\n* Scalable backend architecture\r\n* On-time delivery\r\n* Support after project completion\r\n\r\nI pay close attention to performance, security, and overall user experience to ensure the application runs smoothly across devices.\r\n\r\nI am ready to start immediately and would love to discuss your project requirements, preferred technologies, and timeline in more detail.\r\n\r\nLooking forward to working with you.\r\n\r\nBest regards,', 55, 'accepted', '2026-05-06 16:53:53', '2026-05-06 16:57:33'),
(17, 15, 8, 3000.00, 'Hello,\r\n\r\nI am interested in developing your freelancing marketplace mobile application similar to Fiverr or Upwork. I have experience building scalable mobile and web applications with secure authentication, real-time communication, and clean modern UI/UX designs.\r\n\r\nI understand the importance of creating a smooth and reliable platform where clients can post jobs, freelancers can bid, communicate, and manage projects efficiently.\r\n\r\nI can develop all the required features including:\r\n\r\n* User registration and login system (client & freelancer roles)\r\n* Profile management for users\r\n* Job/project posting and bidding system\r\n* Real-time chat and messaging\r\n* Notifications system\r\n* Payment integration\r\n* Reviews and ratings system\r\n* Admin dashboard for full system control\r\n* Search and filtering functionality\r\n\r\nI am comfortable working with technologies such as React Native or Flutter for the frontend, and Node.js, Django, or Firebase for the backend depending on your preference. I also have experience working with PostgreSQL and MySQL databases.\r\n\r\nWhat you can expect from me:\r\n\r\n* Clean, scalable, and well-structured code\r\n* Modern and responsive UI/UX design\r\n* Secure authentication and data protection\r\n* Regular progress updates and good communication\r\n* Timely delivery of milestones\r\n* Post-project support if needed\r\n\r\nI focus on building systems that are not only functional but also optimized for performance and future scaling.\r\n\r\nI am ready to start immediately and would be happy to discuss your requirements, preferred tech stack, and timeline in more detail.\r\n\r\nLooking forward to working with you.', 60, 'accepted', '2026-05-06 17:15:48', '2026-05-06 17:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Web Development', 'Website design, frontend and backend development services'),
(2, 'Mobile App Development', 'Android and iOS app development services'),
(3, 'Graphic Design', 'Logos, branding, posters, and visual design services'),
(4, 'Digital Marketing', 'SEO, social media marketing, and online advertising services'),
(5, 'Writing & Translation', 'Content writing, copywriting, editing, and translation'),
(6, 'Video & Animation', 'Video editing, motion graphics, and animation services'),
(7, 'Music & Audio', 'Voice over, music production, and sound editing services'),
(8, 'Data & Analytics', 'Data analysis, visualization, and business insights'),
(9, 'Programming & Tech', 'Software development, APIs, and system building services'),
(10, 'Business Services', 'Virtual assistance, consulting, and administrative support');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `order_id`, `created_at`, `updated_at`) VALUES
(6, 6, '2026-05-03 10:54:34', '2026-05-05 04:40:33'),
(7, 7, '2026-05-03 11:02:56', '2026-05-03 11:21:07'),
(8, 8, '2026-05-03 11:14:50', '2026-05-04 06:21:35'),
(9, 9, '2026-05-03 15:44:10', '2026-05-05 04:22:37'),
(10, 10, '2026-05-03 16:47:53', '2026-05-04 06:21:28'),
(11, 11, '2026-05-05 04:46:03', '2026-05-05 04:47:50'),
(12, 12, '2026-05-05 06:04:06', '2026-05-05 06:08:05'),
(13, 13, '2026-05-05 06:39:06', '2026-05-05 06:39:06'),
(14, 14, '2026-05-05 12:51:19', '2026-05-05 12:53:48'),
(15, 15, '2026-05-05 13:11:57', '2026-05-05 13:13:20'),
(16, 16, '2026-05-05 13:12:37', '2026-05-05 13:14:11'),
(17, 17, '2026-05-06 16:57:33', '2026-05-06 16:57:33'),
(18, 18, '2026-05-06 17:11:54', '2026-05-06 17:11:54'),
(19, 19, '2026-05-06 17:17:22', '2026-05-06 17:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_profiles`
--

CREATE TABLE `freelancer_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `experience_level` varchar(20) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT 0.0,
  `total_reviews` int(11) DEFAULT 0,
  `completed_orders` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freelancer_profiles`
--

INSERT INTO `freelancer_profiles` (`id`, `user_id`, `title`, `experience_level`, `rating`, `total_reviews`, `completed_orders`, `created_at`, `updated_at`) VALUES
(4, 7, 'Graphics designer', 'intermediate', 0.0, 0, 0, '2026-05-03 10:41:01', '2026-05-03 10:41:01'),
(5, 8, 'Developer', 'expert', 0.0, 0, 0, '2026-05-03 10:44:11', '2026-05-03 10:44:11'),
(6, 10, 'writer', 'beginner', 0.0, 0, 0, '2026-05-05 12:14:24', '2026-05-05 12:14:24'),
(7, 11, 'Graphics Designer', 'expert', 0.0, 0, 0, '2026-05-05 12:47:58', '2026-05-05 12:47:58'),
(8, 13, 'mobile developer', 'expert', 0.0, 0, 0, '2026-05-06 16:52:34', '2026-05-06 16:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_skills`
--

CREATE TABLE `freelancer_skills` (
  `id` int(11) NOT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `skill_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freelancer_skills`
--

INSERT INTO `freelancer_skills` (`id`, `freelancer_id`, `skill_id`) VALUES
(17, 4, 80),
(15, 4, 81),
(16, 4, 82),
(18, 4, 85),
(20, 5, 1),
(19, 5, 3),
(21, 5, 12),
(24, 5, 20),
(22, 5, 35),
(23, 5, 40),
(27, 6, 110),
(26, 6, 130),
(25, 6, 131),
(28, 6, 132),
(29, 6, 135),
(30, 6, 136),
(33, 7, 80),
(31, 7, 81),
(32, 7, 82),
(34, 7, 83),
(36, 7, 104),
(35, 7, 105),
(37, 7, 106),
(38, 7, 142),
(39, 7, 143),
(43, 8, 1),
(42, 8, 4),
(41, 8, 11),
(40, 8, 20);

-- --------------------------------------------------------

--
-- Table structure for table `gigs`
--

CREATE TABLE `gigs` (
  `id` int(11) NOT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `delivery_time` int(11) DEFAULT NULL,
  `revisions` int(11) DEFAULT 0,
  `status` enum('active','paused','deleted') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gigs`
--

INSERT INTO `gigs` (`id`, `freelancer_id`, `category_id`, `title`, `description`, `price`, `delivery_time`, `revisions`, `status`, `created_at`, `updated_at`) VALUES
(5, 4, 3, 'framer design', 'a minimalistic digital artifact', 300.00, 7, 2, 'paused', '2026-05-03 11:11:15', '2026-05-03 11:18:36'),
(6, 5, 1, 'full stack website', 'fully functional web app', 800.00, 12, 3, 'active', '2026-05-03 11:12:19', '2026-05-05 13:08:05'),
(7, 7, 3, 'hotel flyer', 'hotel flyer showing a burger menu', 150.00, 7, 2, 'active', '2026-05-05 13:07:44', '2026-05-05 13:07:44'),
(8, 6, 5, 'book surrounded by idiots', 'idiots ...', 50.00, 12, 5, 'active', '2026-05-05 13:11:21', '2026-05-05 13:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `gig_images`
--

CREATE TABLE `gig_images` (
  `id` int(11) NOT NULL,
  `gig_id` int(11) DEFAULT NULL,
  `image_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gig_images`
--

INSERT INTO `gig_images` (`id`, `gig_id`, `image_url`) VALUES
(2, 5, '1777806675_69f72d5330655.jpg'),
(3, 6, '1777806739_69f72d93a4e79.jpg'),
(4, 7, '1777986464_69f9eba0e04cb.jpg'),
(5, 8, '1777986681_69f9ec796bfb9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `message_type` enum('text','image','file') DEFAULT 'text',
  `attachment_url` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `message`, `message_type`, `attachment_url`, `is_read`, `created_at`) VALUES
(9, 8, 6, 'i really wanted a design  mockup for my school website', 'text', NULL, 1, '2026-05-03 11:14:50'),
(10, 8, 7, 'okay', 'text', NULL, 1, '2026-05-03 11:15:43'),
(11, 7, 7, 'hey', 'text', NULL, 1, '2026-05-03 11:17:45'),
(12, 7, 7, 'hey', 'text', NULL, 1, '2026-05-03 11:20:51'),
(13, 7, 6, 'hello', 'text', NULL, 1, '2026-05-03 11:21:07'),
(14, 10, 6, 'i need a fully functional website for my project its a hotel website', 'text', NULL, 1, '2026-05-03 16:47:53'),
(15, 8, 7, 'will see', 'text', NULL, 1, '2026-05-03 17:10:53'),
(16, 8, 6, 'waiting', 'text', NULL, 1, '2026-05-03 17:11:30'),
(17, 10, 6, 'hello', 'text', NULL, 1, '2026-05-04 06:21:28'),
(18, 8, 6, 'hey', 'text', NULL, 1, '2026-05-04 06:21:35'),
(19, 9, 6, 'hello', 'text', NULL, 1, '2026-05-05 04:22:37'),
(20, 6, 6, 'are you ready', 'text', NULL, 1, '2026-05-05 04:22:49'),
(21, 6, 8, 'yes please', 'text', NULL, 1, '2026-05-05 04:40:33'),
(22, 11, 6, 'hey', 'text', NULL, 1, '2026-05-05 04:47:32'),
(23, 11, 8, 'hello', 'text', NULL, 1, '2026-05-05 04:47:50'),
(24, 12, 9, 'i need a gym website for me', 'text', NULL, 1, '2026-05-05 06:04:06'),
(25, 12, 8, 'alright', 'text', NULL, 1, '2026-05-05 06:08:05'),
(26, 14, 9, 'hello', 'text', NULL, 1, '2026-05-05 12:53:16'),
(27, 14, 7, 'hey', 'text', NULL, 1, '2026-05-05 12:53:48'),
(28, 15, 9, 'i need around 50 copies', 'text', NULL, 1, '2026-05-05 13:11:57'),
(29, 16, 9, 'i need you also for my kebab shop to design my product graphics', 'text', NULL, 1, '2026-05-05 13:12:37'),
(30, 15, 10, 'alright boss', 'text', NULL, 1, '2026-05-05 13:13:20'),
(31, 16, 11, 'alright my boss we shall keep in touch', 'text', NULL, 1, '2026-05-05 13:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `gig_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `status` enum('pending','paid','submitted','accepted','in_progress','delivered','completed','cancelled') DEFAULT 'pending',
  `requirements` text DEFAULT NULL,
  `delivery_note` text DEFAULT NULL,
  `delivery_file_url` text DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `paid_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `gig_id`, `project_id`, `client_id`, `freelancer_id`, `status`, `requirements`, `delivery_note`, `delivery_file_url`, `total_price`, `started_at`, `delivered_at`, `completed_at`, `created_at`, `updated_at`, `paid_at`) VALUES
(6, NULL, 8, 6, 5, 'pending', 'Project: E-commerce Platform Development\nBid Amount: $2500.00\nDelivery: 60 days', NULL, NULL, 2500.00, NULL, NULL, NULL, '2026-05-03 10:54:33', '2026-05-03 10:54:33', NULL),
(7, NULL, 9, 6, 4, 'pending', 'Project: Student Management System Development\nBid Amount: $1200.00\nDelivery: 30 days', NULL, NULL, 1200.00, NULL, NULL, NULL, '2026-05-03 11:02:56', '2026-05-03 11:02:56', NULL),
(8, 5, NULL, 6, 4, 'completed', 'i really wanted a design  mockup for my school website', NULL, NULL, 300.00, NULL, NULL, '2026-05-05 06:00:54', '2026-05-03 11:14:50', '2026-05-05 06:00:54', '2026-05-05 09:00:31'),
(9, NULL, 10, 6, 4, 'pending', 'Project: Hostel Management System Development\nBid Amount: $1600.00\nDelivery: 34 days', NULL, NULL, 1600.00, NULL, NULL, NULL, '2026-05-03 15:44:10', '2026-05-03 15:44:10', NULL),
(10, 6, NULL, 6, 5, 'completed', 'i need a fully functional website for my project its a hotel website', NULL, NULL, 800.00, NULL, NULL, '2026-05-05 05:57:40', '2026-05-03 16:47:53', '2026-05-05 05:57:40', '2026-05-05 08:57:25'),
(11, NULL, 11, 6, 5, 'pending', 'Project: Hotel Management System Development\nBid Amount: $2300.00\nDelivery: 60 days', NULL, NULL, 2300.00, NULL, NULL, NULL, '2026-05-05 04:46:03', '2026-05-05 04:46:03', NULL),
(12, 6, NULL, 9, 5, 'completed', 'i need a gym website for me', NULL, NULL, 800.00, NULL, NULL, '2026-05-05 06:04:15', '2026-05-05 06:04:06', '2026-05-05 06:04:15', '2026-05-05 09:04:09'),
(13, NULL, 12, 9, 5, 'pending', 'Project: Gym Management System Development\nBid Amount: $400.00\nDelivery: 46 days', NULL, NULL, 400.00, NULL, NULL, NULL, '2026-05-05 06:39:06', '2026-05-05 06:39:06', NULL),
(14, NULL, 13, 9, 4, 'pending', 'Project: Concert Graphic Designer Needed – Posters, Social Media Flyers & Event Branding\nBid Amount: $500.00\nDelivery: 10 days', NULL, NULL, 500.00, NULL, NULL, NULL, '2026-05-05 12:51:19', '2026-05-05 12:51:19', NULL),
(15, 8, NULL, 9, 6, 'completed', 'i need around 50 copies', NULL, NULL, 50.00, NULL, NULL, '2026-05-05 13:15:30', '2026-05-05 13:11:57', '2026-05-05 13:15:30', '2026-05-05 16:14:43'),
(16, 7, NULL, 9, 7, 'completed', 'i need you also for my kebab shop to design my product graphics', NULL, NULL, 150.00, NULL, NULL, '2026-05-05 13:15:38', '2026-05-05 13:12:37', '2026-05-05 13:15:38', '2026-05-05 16:14:49'),
(17, NULL, 17, 12, 8, 'pending', 'Project: E-Commerce Website Developer Needed for Online Store\nBid Amount: $1500.00\nDelivery: 55 days', NULL, NULL, 1500.00, NULL, NULL, NULL, '2026-05-06 16:57:33', '2026-05-06 16:57:33', NULL),
(18, NULL, 16, 12, 5, 'pending', 'Project: School Management System Developer Needed\nBid Amount: $3300.00\nDelivery: 60 days', NULL, NULL, 3300.00, NULL, NULL, NULL, '2026-05-06 17:11:54', '2026-05-06 17:11:54', NULL),
(19, NULL, 15, 6, 8, 'pending', 'Project: Mobile App Developer Needed for Freelancing Marketplace Application\nBid Amount: $3000.00\nDelivery: 60 days', NULL, NULL, 3000.00, NULL, NULL, NULL, '2026-05-06 17:17:22', '2026-05-06 17:17:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `profile_image` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `university` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `full_name`, `phone_number`, `profile_image`, `bio`, `country`, `university`, `created_at`, `updated_at`) VALUES
(6, 6, 'matovu mathew phillip', '0760153839', '1777803597_69f7214d83676.jpeg', '', 'uganda', NULL, '2026-05-03 10:18:20', '2026-05-03 10:20:26'),
(7, 7, 'mutesi joan', '', '1777804427_69f7248b54d85.jpg', '', '', NULL, '2026-05-03 10:33:27', '2026-05-03 10:34:03'),
(8, 8, 'Fancy Pamela', '', '1777804526_69f724ee52d5e.jpg', '', '', NULL, '2026-05-03 10:35:05', '2026-05-03 10:35:26'),
(9, 9, 'kasozi remigious', '0789292992', '1777956943_69f9784fed7d9.jpg', '', '', NULL, '2026-05-05 04:55:15', '2026-05-05 04:55:43'),
(10, 10, 'Hattan', '0765555882', '1777983155_69f9deb3990e9.jpg', '', 'uganda', NULL, '2026-05-05 12:10:24', '2026-05-05 13:27:07'),
(11, 11, 'Ericom', '0762525267', '1777985204_69f9e6b457a5f.jpeg', '', 'uganda', NULL, '2026-05-05 12:43:56', '2026-05-05 13:27:25'),
(12, 12, '', '', '1778085072_69fb6cd0999a9.jpg', '', '', NULL, '2026-05-06 16:30:50', '2026-05-06 16:31:12'),
(13, 13, '', '', '1778086173_69fb711d1f7e4.jpg', '', '', NULL, '2026-05-06 16:39:02', '2026-05-06 16:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `budget_min` decimal(10,2) DEFAULT NULL,
  `budget_max` decimal(10,2) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('open','closed','completed') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `client_id`, `category_id`, `title`, `description`, `budget_min`, `budget_max`, `deadline`, `status`, `created_at`, `updated_at`) VALUES
(8, 6, 10, 'E-commerce Platform Development', 'We are looking for an experienced full-stack developer or development team to build a modern and scalable e-commerce platform for our growing online business. The platform should provide customers with a smooth shopping experience while offering administrators powerful tools to manage products, orders, and users.\r\n\r\nProject Requirements\r\n\r\nThe system should include the following core features:\r\n\r\nUser registration and login system\r\nProduct listing and categorization\r\nProduct search and filtering\r\nShopping cart and checkout functionality\r\nSecure online payment integration\r\nOrder tracking system\r\nAdmin dashboard for managing products, users, and orders\r\nWishlist and product review functionality\r\nResponsive design for mobile and desktop devices\r\nEmail notifications for orders and account activities\r\nPreferred Technologies\r\n\r\nWe are open to different technology stacks, but developers experienced with the following are encouraged to apply:\r\n\r\nReact / Next.js\r\nPHP / Laravel\r\nNode.js\r\nMySQL or PostgreSQL\r\nREST APIs\r\nPayment gateway integrations\r\nAdditional Notes\r\n\r\nThe platform should be secure, scalable, and optimized for performance. Clean UI/UX design is highly important. Experience with modern e-commerce systems and previous portfolio samples will be an added advantage.\r\n\r\nBudget & Timeline\r\nBudget: Open for discussion\r\nDuration: 4–8 weeks depending on scope and experience level\r\n\r\nPlease include:\r\n\r\nYour portfolio or previous projects\r\nProposed tech stack\r\nEstimated delivery timeline\r\nSuggested cost quotation', 1500.00, 3000.00, '2026-05-31', '', '2026-05-03 10:29:57', '2026-05-03 10:54:33'),
(9, 6, 8, 'Student Management System Development', 'We are seeking a skilled software developer to design and develop a modern Student Management System for our institution. The system should simplify academic and administrative operations while providing an easy-to-use interface for administrators, teachers, and students.\r\n\r\n## Core Features Required\r\n\r\n* Student registration and profile management\r\n* Course and subject management\r\n* Attendance tracking\r\n* Examination and grading system\r\n* Timetable management\r\n* Fee/payment management\r\n* Role-based access control (Admin, Teacher, Student)\r\n* Dashboard analytics and reports\r\n* Notifications and announcements\r\n* Responsive design for desktop and mobile devices\r\n\r\n## Technical Requirements\r\n\r\nThe system should be:\r\n\r\n* Secure and scalable\r\n* Easy to maintain and upgrade\r\n* Optimized for performance\r\n* Built with a clean and modern UI\r\n\r\nPreferred technologies include:\r\n\r\n* PHP/Laravel, Django, or Node.js\r\n* MySQL or PostgreSQL\r\n* React or Vue.js for frontend development\r\n\r\n## Project Details\r\n\r\n* Project Type: Fixed Price\r\n* Experience Level: Intermediate to Expert\r\n* Duration: 4–6 weeks\r\n* Budget: Open for discussion\r\n\r\n## Additional Information\r\n\r\nDevelopers with prior experience in school or education management systems are highly preferred. Please include links to previous work, estimated timeline, and your recommended technology stack in your proposal.', 700.00, 1500.00, '2026-05-30', '', '2026-05-03 10:57:25', '2026-05-03 11:02:56'),
(10, 6, 10, 'Hostel Management System Development', '# Hostel Management System Development\r\n\r\nWe are looking for a skilled developer to build a modern Hostel Management System that will help streamline hostel operations, room allocation, student management, and payment tracking.\r\n\r\nThe goal of the system is to improve efficiency in managing hostel activities while providing an easy and user-friendly experience for administrators and students.\r\n\r\n## Required Features\r\n\r\n* Student registration and profile management\r\n* Hostel and room management\r\n* Room allocation and booking system\r\n* Bed space availability tracking\r\n* Online payment management\r\n* Receipt generation\r\n* Maintenance request reporting\r\n* Admin dashboard with analytics\r\n* Role-based access control\r\n* Notifications and announcements\r\n* Search and filtering functionalities\r\n* Responsive design for mobile and desktop\r\n\r\n## Technical Expectations\r\n\r\nThe system should:\r\n\r\n* Be secure and scalable\r\n* Have a modern and clean user interface\r\n* Support future upgrades and integrations\r\n* Include proper database structure and optimization\r\n\r\nPreferred technologies:\r\n\r\n* React, Vue.js, or Next.js\r\n* Django, Laravel, or Node.js\r\n* MySQL or PostgreSQL\r\n\r\n## Project Details\r\n\r\n* Project Type: Fixed Price\r\n* Experience Level: Intermediate/Expert\r\n* Timeline: 4–6 weeks\r\n* Budget: Open for negotiation\r\n\r\n## Additional Notes\r\n\r\nDevelopers with previous experience in management systems are encouraged to apply. Please include:\r\n\r\n* Portfolio or past projects\r\n* Proposed tech stack\r\n* Estimated delivery timeline\r\n* Cost estimate\r\n\r\nWe are looking for a reliable developer who can deliver a stable, efficient, and user-friendly solution.', 1500.00, 1800.00, '2026-05-28', '', '2026-05-03 11:31:30', '2026-05-03 15:44:10'),
(11, 6, 10, 'Hotel Management System Development', '# Hotel Management System Development\r\n\r\nWe are looking for an experienced software developer or development team to build a modern Hotel Management System that will help automate hotel operations and improve customer service efficiency.\r\n\r\nThe system should provide an easy-to-use interface for hotel administrators, receptionists, and customers while handling reservations, room management, payments, and reporting.\r\n\r\n## Required Features\r\n\r\n* Customer registration and profile management\r\n* Room booking and reservation system\r\n* Room availability tracking\r\n* Check-in and check-out management\r\n* Online payment integration\r\n* Invoice and receipt generation\r\n* Staff management\r\n* Role-based access control\r\n* Dashboard analytics and reports\r\n* Notifications and email alerts\r\n* Search and filtering functionalities\r\n* Responsive design for desktop and mobile devices\r\n\r\n## Technical Requirements\r\n\r\nThe system should:\r\n\r\n* Be secure and scalable\r\n* Have a clean and modern UI/UX\r\n* Support future feature expansion\r\n* Be optimized for speed and performance\r\n\r\nPreferred technologies:\r\n\r\n* React.js / Next.js\r\n* Laravel, Django, or Node.js\r\n* MySQL or PostgreSQL\r\n\r\n## Project Details\r\n\r\n* Project Type: Fixed Price\r\n* Experience Level: Intermediate to Expert\r\n* Timeline: 5–8 weeks\r\n* Budget: Open for discussion\r\n\r\n## Additional Information\r\n\r\nDevelopers with previous experience building hotel, booking, or management systems are highly preferred.\r\n\r\nPlease include:\r\n\r\n* Portfolio or previous projects\r\n* Proposed technology stack\r\n* Estimated delivery timeline\r\n* Cost quotation\r\n\r\nWe are looking for a reliable and skilled developer who can deliver a professional and efficient solution.', 2000.00, 2500.00, '2026-05-27', '', '2026-05-03 16:04:50', '2026-05-05 04:46:03'),
(12, 9, 10, 'Gym Management System Development', 'We are looking for a skilled software developer to build a complete Gym Management System that will help manage memberships, trainers, classes, bookings, and payments efficiently.\r\n\r\nThe system should provide an easy and modern experience for gym administrators, trainers, and members while automating daily gym operations.\r\n\r\n## Required Features\r\n\r\n* Member registration and profile management\r\n* Membership plan management\r\n* Trainer management\r\n* Class scheduling and booking system\r\n* Attendance tracking\r\n* Payment and subscription tracking\r\n* Invoice and receipt generation\r\n* Role-based access control\r\n* Dashboard analytics and reporting\r\n* Notifications and reminders\r\n* Search and filtering functionalities\r\n* Responsive design for desktop and mobile devices\r\n\r\n## Technical Requirements\r\n\r\nThe system should:\r\n\r\n* Be secure and scalable\r\n* Have a modern and intuitive UI/UX\r\n* Support future feature upgrades\r\n* Be optimized for performance\r\n\r\nPreferred technologies:\r\n\r\n* React.js / Next.js\r\n* Laravel, Django, or Node.js\r\n* MySQL or PostgreSQL\r\n\r\n## Project Details\r\n\r\n* Project Type: Fixed Price\r\n* Experience Level: Intermediate to Expert\r\n* Timeline: 4–6 weeks\r\n* Budget: Open for negotiation\r\n\r\n## Additional Notes\r\n\r\nDevelopers with experience building management or booking systems are highly encouraged to apply.\r\n\r\nPlease include:\r\n\r\n* Portfolio or previous work\r\n* Proposed technology stack\r\n* Estimated timeline\r\n* Cost quotation\r\n\r\nWe are looking for a reliable developer who can deliver a professional, stable, and user-friendly solution.', 200.00, 500.00, '2026-05-21', '', '2026-05-05 05:00:35', '2026-05-05 06:39:06'),
(13, 9, 3, 'Concert Graphic Designer Needed – Posters, Social Media Flyers & Event Branding', 'Project Description:\r\nWe are looking for a creative and experienced graphic designer to create eye-catching promotional materials for an upcoming concert event. The goal is to develop professional and modern designs that attract attention both online and offline.\r\n\r\nThe project includes designing:\r\n\r\nConcert posters\r\nSocial media flyers/posts\r\nEvent banners\r\nTicket/pass designs\r\nPromotional cover images\r\nOptional motion graphics (bonus)\r\n\r\nThe concert theme is energetic, vibrant, and entertainment-focused, so we need designs that stand out and create excitement for the audience.\r\n\r\nRequirements:\r\n\r\nStrong creativity and modern design skills\r\nExperience in event/concert branding is an advantage\r\nAbility to deliver high-quality editable files\r\nGood communication and ability to meet deadlines\r\nKnowledge of Photoshop, Illustrator, Canva, or related tools\r\n\r\nPreferred Style:\r\nModern, colorful, bold typography, lighting effects, music/concert atmosphere, and professional layouts.\r\n\r\nDeliverables:\r\n\r\nHigh-resolution PNG/JPG files\r\nEditable source files (PSD/AI/CDR/etc.)\r\nSocial media optimized versions\r\n\r\nBudget:\r\nOpen to proposals\r\n\r\nDeadline:\r\nTo be discussed with the selected freelancer\r\n\r\nAdditional Notes:\r\nPlease attach your portfolio or previous event/concert designs when placing a bid. Creative ideas are highly welcome.', 200.00, 800.00, '2026-05-29', '', '2026-05-05 12:35:55', '2026-05-05 12:51:19'),
(14, 6, 1, 'Restaurant Management System Needed (Desktop/Web Application)', 'Project Description:\r\nWe are looking for an experienced software developer to build a complete Restaurant Management System for managing daily restaurant operations efficiently. The system should have a modern interface, be easy to use, and support fast performance.\r\n\r\nThe project can be developed as a desktop application, web application, or hybrid solution depending on the developer’s expertise.\r\n\r\nMain Features Required:\r\n\r\nUser login and role management\r\nFood/menu management\r\nOrder processing system\r\nTable reservation management\r\nBilling and invoice generation\r\nPayment tracking\r\nInventory/stock management\r\nSales and reports dashboard\r\nCustomer management\r\nReceipt printing support\r\n\r\nPreferred Technologies:\r\nOpen to different technologies such as:\r\n\r\nPHP/MySQL\r\nReact + Node.js\r\nPython/Django\r\nC#\r\nJava\r\nAny suitable modern stack\r\n\r\nRequirements:\r\n\r\nClean and user-friendly UI/UX\r\nSecure database handling\r\nResponsive and efficient system\r\nWell-structured code\r\nAbility to provide future support if needed\r\n\r\nDeliverables:\r\n\r\nComplete source code\r\nDatabase files\r\nDocumentation/setup guide\r\nExecutable or deployable project files\r\n\r\nBudget:\r\nOpen to discussion based on experience and quality\r\n\r\nDeadline:\r\nTo be discussed\r\n\r\nAdditional Notes:\r\nPlease include your portfolio or previous management system projects when bidding. Developers with experience in POS or restaurant systems are highly preferred.', 1200.00, 2500.00, '2026-05-31', 'open', '2026-05-05 13:22:12', '2026-05-05 13:22:12'),
(15, 6, 2, 'Mobile App Developer Needed for Freelancing Marketplace Application', 'Project Description:\r\nWe are looking for a skilled mobile app developer to build a modern freelancing marketplace application similar to platforms like Fiverr or Upwork. The app should allow clients to post jobs/projects and freelancers to bid, communicate, and manage work efficiently.\r\n\r\nThe application should have a professional UI/UX, smooth performance, and secure user management.\r\n\r\nCore Features Required:\r\n\r\nUser registration and login\r\nClient and freelancer profiles\r\nJob/project posting system\r\nBidding/proposal system\r\nReal-time chat/messaging\r\nNotifications system\r\nPayment integration\r\nReviews and ratings\r\nAdmin dashboard\r\nSearch and filtering options\r\n\r\nPreferred Technologies:\r\n\r\nReact Native / Flutter\r\nFirebase / Node.js / Django backend\r\nMySQL or PostgreSQL database\r\n\r\nRequirements:\r\n\r\nClean modern design\r\nSecure authentication system\r\nResponsive mobile interface\r\nScalable architecture\r\nGood communication and timely delivery\r\n\r\nDeliverables:\r\n\r\nFull source code\r\nAPI/backend files\r\nDatabase structure\r\nAPK/app build files\r\nSetup documentation\r\n\r\nBudget:\r\nOpen to proposals\r\n\r\nDeadline:\r\nFlexible depending on project scope\r\n\r\nAdditional Notes:\r\nPlease share previous mobile app projects or marketplace systems you have worked on. Experience with chat systems and payment integrations is a plus.', 2500.00, 3500.00, '2026-05-31', '', '2026-05-05 13:24:09', '2026-05-06 17:17:22'),
(16, 12, 10, 'School Management System Developer Needed', '**Project Title:**\r\nSchool Management System Developer Needed\r\n\r\n**Project Description:**\r\nWe are looking for a skilled developer to build a complete School Management System for managing students, teachers, academic records, and administrative operations efficiently.\r\n\r\nThe system should have a modern, easy-to-use interface and support different user roles such as administrators, teachers, students, and accountants.\r\n\r\n**Key Features Required:**\r\n\r\n* Student registration and management\r\n* Teacher/staff management\r\n* Attendance tracking\r\n* Fees/payment management\r\n* Results and grading system\r\n* Timetable management\r\n* Notifications and announcements\r\n* Parent/student portal\r\n* Reports generation\r\n* Admin dashboard\r\n\r\n**Preferred Technologies:**\r\n\r\n* PHP/MySQL\r\n* React + Node.js\r\n* Django/Python\r\n* Java or C#\r\n* Any modern and scalable stack\r\n\r\n**Requirements:**\r\n\r\n* Secure authentication system\r\n* Responsive and user-friendly design\r\n* Well-structured database\r\n* Clean and maintainable code\r\n* Ability to handle future upgrades\r\n\r\n**Deliverables:**\r\n\r\n* Full source code\r\n* Database files\r\n* Setup and installation guide\r\n* Documentation\r\n\r\n**Budget:**\r\nOpen to proposals\r\n\r\n**Deadline:**\r\nTo be discussed with the selected freelancer\r\n\r\n**Additional Notes:**\r\nPlease include previous school or management system projects in your proposal. Experience with report generation and role-based access systems is highly preferred.', 3000.00, 3500.00, '2026-06-17', '', '2026-05-06 16:32:07', '2026-05-06 17:11:54'),
(17, 12, 1, 'E-Commerce Website Developer Needed for Online Store', '**Project Title:**\r\nE-Commerce Website Developer Needed for Online Store\r\n\r\n**Project Description:**\r\nWe are looking for a professional web developer to build a modern and responsive e-commerce website for selling products online. The website should have a clean UI/UX, secure payment integration, and an easy-to-manage admin panel.\r\n\r\nThe goal is to create a fast, user-friendly, and scalable online shopping platform that works smoothly across desktop and mobile devices.\r\n\r\n**Required Features:**\r\n\r\n* User registration and login\r\n* Product listing and categories\r\n* Shopping cart and checkout system\r\n* Secure payment integration\r\n* Order tracking\r\n* Admin dashboard\r\n* Inventory management\r\n* Search and filtering functionality\r\n* Discount/coupon system\r\n* Responsive design\r\n\r\n**Preferred Technologies:**\r\n\r\n* React / Next.js\r\n* PHP/Laravel\r\n* Node.js\r\n* Django\r\n* MySQL or PostgreSQL\r\n\r\n**Requirements:**\r\n\r\n* Modern and attractive UI design\r\n* Secure database and authentication system\r\n* SEO-friendly structure\r\n* Fast loading performance\r\n* Clean and maintainable code\r\n\r\n**Deliverables:**\r\n\r\n* Complete source code\r\n* Database files\r\n* Deployment/setup guide\r\n* Admin access documentation\r\n\r\n**Budget:**\r\nOpen to proposals\r\n\r\n**Deadline:**\r\nFlexible depending on project scope\r\n\r\n**Additional Notes:**\r\nPlease share previous e-commerce projects or portfolio samples when placing a bid. Experience with payment gateways and responsive design is highly preferred.', 1200.00, 1500.00, '2026-05-29', '', '2026-05-06 16:33:39', '2026-05-06 16:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `reviewee_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`) VALUES
(142, '2D Animation'),
(143, '3D Animation'),
(121, 'A/B Testing'),
(82, 'Adobe Illustrator'),
(81, 'Adobe Photoshop'),
(83, 'Adobe XD'),
(22, 'Angular'),
(38, 'ASP.NET Core'),
(144, 'Audio Editing'),
(152, 'Automation Scripting'),
(62, 'AWS'),
(63, 'Azure'),
(85, 'Blender'),
(131, 'Blog Writing'),
(5, 'C'),
(7, 'C#'),
(6, 'C++'),
(66, 'CI/CD'),
(86, 'Cinema 4D'),
(36, 'CodeIgniter'),
(108, 'Content Marketing'),
(130, 'Content Writing'),
(122, 'Conversion Rate Optimization'),
(133, 'Copy Editing'),
(110, 'Copywriting'),
(43, 'Data Analysis'),
(44, 'Data Science'),
(45, 'Data Visualization'),
(47, 'Deep Learning'),
(32, 'Django'),
(60, 'Docker'),
(107, 'Email Marketing'),
(31, 'Express.js'),
(105, 'Facebook Ads'),
(34, 'FastAPI'),
(80, 'Figma'),
(33, 'Flask'),
(150, 'Git'),
(151, 'GitHub'),
(8, 'Go'),
(104, 'Google Ads'),
(120, 'Google Analytics'),
(64, 'Google Cloud'),
(71, 'GraphQL'),
(123, 'Heatmaps Analysis'),
(84, 'InDesign'),
(4, 'Java'),
(1, 'JavaScript'),
(10, 'Kotlin'),
(61, 'Kubernetes'),
(35, 'Laravel'),
(65, 'Linux Administration'),
(46, 'Machine Learning'),
(72, 'Microservices'),
(42, 'MongoDB'),
(141, 'Motion Graphics'),
(23, 'Next.js'),
(68, 'Nginx'),
(30, 'Node.js'),
(41, 'NoSQL'),
(24, 'Nuxt.js'),
(102, 'Off-page SEO'),
(101, 'On-page SEO'),
(12, 'PHP'),
(154, 'Postman'),
(134, 'Proofreading'),
(90, 'Prototyping'),
(3, 'Python'),
(50, 'PyTorch'),
(20, 'React'),
(136, 'Research Writing'),
(70, 'REST API Development'),
(9, 'Rust'),
(135, 'Script Writing'),
(100, 'SEO'),
(67, 'Serverless'),
(109, 'Social Media Management'),
(37, 'Spring Boot'),
(40, 'SQL'),
(48, 'Statistics'),
(25, 'Svelte'),
(11, 'Swift'),
(73, 'System Design'),
(103, 'Technical SEO'),
(132, 'Technical Writing'),
(49, 'TensorFlow'),
(106, 'TikTok Ads'),
(2, 'TypeScript'),
(87, 'UI Design'),
(88, 'UX Design'),
(140, 'Video Editing'),
(145, 'Voice Over'),
(21, 'Vue.js'),
(74, 'WebSockets'),
(89, 'Wireframing'),
(153, 'Zapier');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`) VALUES
(2, 'mathewphillip@gmail.com', '2026-05-03 11:25:08'),
(3, 'mutesijoan@gmail.com', '2026-05-03 11:25:27'),
(4, 'fancypamela@gmail.com', '2026-05-03 11:25:45'),
(5, 'benjaminsamuel@gmail.com', '2026-05-03 11:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` enum('client','freelancer') DEFAULT 'client',
  `is_verified` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `is_verified`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
(6, 'mathew', 'mathewphillip@gmail.com', '$2y$10$74c44YWQTFI3yai1nXPcouWd8p95SFXAoDUIAr9McRBB5qWAR6Iyi', 'client', 0, 1, '2026-05-08 04:52:11', '2026-05-03 09:48:51', '2026-05-08 04:52:11'),
(7, 'Jojo', 'mutesijoan@gmail.com', '$2y$10$NizAvlrzvYL3U/bS5CmE5Osun2ABavmjRVZRAtO4N1qrIJRs7XYzu', 'freelancer', 0, 1, '2026-05-06 09:23:17', '2026-05-03 10:33:05', '2026-05-06 09:23:17'),
(8, 'Fancy', 'pamela@gmail.com', '$2y$10$57r/EYQuv/93UNKLO6qkCud9Hmo57fedr62rIIyLZ5avZaBe54aVC', 'freelancer', 0, 1, '2026-05-06 16:35:43', '2026-05-03 10:34:39', '2026-05-06 16:35:43'),
(9, 'remmy', 'remmy@gmail.com', '$2y$10$sXrju3s9FdADGsHguaVSb.KCrM.qhKehTnM3ZMlUQ0U8AiKqqKLZO', 'client', 0, 1, '2026-05-05 12:19:11', '2026-05-05 04:50:00', '2026-05-05 12:19:11'),
(10, 'hattan', 'hattan@gmail.com', '$2y$10$r/f5fhUYe99Z9x.aw1FAbeOCMPTDkRqUCdDRfP7fU125HwmLqkULO', 'freelancer', 0, 1, '2026-05-05 12:09:41', '2026-05-05 12:09:25', '2026-05-05 12:14:24'),
(11, 'Erico', 'eric@gmail.com', '$2y$10$finhHKgFpJF8sFbWUALieeimopxJZJXXBjEiQxurXKfNoNvr1IuFK', 'freelancer', 0, 1, '2026-05-06 16:35:11', '2026-05-05 12:43:21', '2026-05-06 16:35:11'),
(12, 'Dan Magic', 'Daniel@gmail.com', '$2y$10$2zf8aNdIkwF3ZzYn0mAsYuDzB3dMTodl6.UVOmW8uH4ut4VRqUxcS', 'client', 0, 1, '2026-05-06 16:30:47', '2026-05-06 16:30:33', '2026-05-06 16:30:47'),
(13, 'Dennis', 'dennis@gmail.com', '$2y$10$1Eh0n5DEYi.CFwKeQkwSc.tfyFI0WXd56Tb6crCA.oAIArkiBiNEm', 'freelancer', 0, 1, '2026-05-07 12:40:44', '2026-05-06 16:38:42', '2026-05-07 12:40:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_bid` (`project_id`,`freelancer_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `freelancer_profiles`
--
ALTER TABLE `freelancer_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `freelancer_skills`
--
ALTER TABLE `freelancer_skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `freelancer_id` (`freelancer_id`,`skill_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- Indexes for table `gigs`
--
ALTER TABLE `gigs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `gig_images`
--
ALTER TABLE `gig_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gig_id` (`gig_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gig_id` (`gig_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `freelancer_id` (`freelancer_id`),
  ADD KEY `fk_orders_project` (`project_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `reviewer_id` (`reviewer_id`),
  ADD KEY `reviewee_id` (`reviewee_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `freelancer_profiles`
--
ALTER TABLE `freelancer_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `freelancer_skills`
--
ALTER TABLE `freelancer_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `gigs`
--
ALTER TABLE `gigs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gig_images`
--
ALTER TABLE `gig_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `freelancer_profiles`
--
ALTER TABLE `freelancer_profiles`
  ADD CONSTRAINT `freelancer_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `freelancer_skills`
--
ALTER TABLE `freelancer_skills`
  ADD CONSTRAINT `freelancer_skills_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `freelancer_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gigs`
--
ALTER TABLE `gigs`
  ADD CONSTRAINT `gigs_ibfk_1` FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gigs_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `gig_images`
--
ALTER TABLE `gig_images`
  ADD CONSTRAINT `gig_images_ibfk_1` FOREIGN KEY (`gig_id`) REFERENCES `gigs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
