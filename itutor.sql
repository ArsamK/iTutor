-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 07:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profilePic` blob DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `accountStatus` tinyint(1) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `Admin_AfterInsert` AFTER INSERT ON `admin` FOR EACH ROW BEGIN
    INSERT INTO alluser (email, user_type) VALUES (NEW.email, 'Admin');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Admin_DeleteTrigger` AFTER DELETE ON `admin` FOR EACH ROW BEGIN
    DELETE FROM alluser WHERE email = OLD.email;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alluser`
--

CREATE TABLE `alluser` (
  `userid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_type` enum('Student','Teacher','Admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alluser`
--

INSERT INTO `alluser` (`userid`, `email`, `user_type`) VALUES
(32, 'arsamkhan27726@gmail.com', 'Teacher'),
(34, 'daniya@outlook.com', 'Student'),
(35, 'arsamkhan2@gmail.com', 'Teacher'),
(36, 'arsamkhan2@yahoo.com', 'Teacher'),
(37, 'zayyan@yahoo.com', 'Teacher'),
(38, 'zayyan1@yahoo.com', 'Teacher'),
(39, 'zayyan12@yahoo.com', 'Teacher'),
(40, 'zayyan123@yahoo.com', 'Teacher'),
(41, 'arsamkhan23@gmail.com', 'Teacher'),
(42, 'arsamkhan26@gmail.com', 'Teacher'),
(43, 'arsamkhan267@gmail.com', 'Teacher'),
(44, 'zayyan1234@yahoo.com', 'Teacher'),
(45, 'arsamkhan277267@gmail.com', 'Teacher'),
(46, 'arsamkhan2772678@gmail.com', 'Teacher'),
(47, 'arsamkhan27726789@gmail.com', 'Teacher'),
(48, 'daniya12@yahoo.com', 'Teacher'),
(49, 'daniya123@yahoo.com', 'Teacher'),
(50, 'daniya1234@yahoo.com', 'Teacher'),
(51, 'daniya12345@yahoo.com', 'Teacher'),
(52, 'umer1@yahoo.com', 'Teacher'),
(53, 'umer12@yahoo.com', 'Teacher'),
(54, 'ahmed1@yahoo.com', 'Teacher'),
(56, 'ahmed12@yahoo.com', 'Teacher'),
(57, 'arsamkhan5555@gmail.com', 'Teacher'),
(58, 'zayyankhan@email.com', 'Teacher'),
(59, 'noorkhan@gmail.com', 'Teacher'),
(60, 'arsamkhan277267889@gmail.com', 'Teacher'),
(61, 'zaid@gmail.com', 'Student'),
(62, 'amir@gmail.com', 'Student'),
(63, 'umers@gmail.com', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(255) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`) VALUES
(1, 'What kind of tutors does iTutor look for?', 'No specific certification or teaching experience is required! We welcome tutors who:\r\n\r\n1) Enjoy sharing knowledge and making a difference in students’ lives\r\n2) Have outstanding communication skills\r\n3) Are willing to provide a personalized learning experience to international students'),
(2, 'What subject can i teach?', 'We have over 10 subjects on iTutor, including languages, school and university subjects.'),
(3, 'How do I become an online tutor at iTutor?', '1) Provide some basic information about yourself.\n2) Upload your headshot photo.\n3) Describe your strengths as a tutor.\n4) Record a short video introduction (up to 2 mins long).\n5) Choose your availability.\nYou’ll see tips and examples at each step of the registration process to help you create a great tutor profile. When you complete registration, our Tutor Success team will review your profile within 5 business days. Once your profile is approved, students from around the world will see it on Preply and will be able to book lessons with you.'),
(4, 'How can I get my profile approved quickly?', 'Make sure you use a real photo of yourself, take the time to record a short video and describe your strengths as a tutor in the description. A surefire way to get approved is to follow the tips given at each step of the registration process.\r\n\r\nAlso, be sure to avoid mentioning any contact details, lesson prices or misleading information in your profile description and video.'),
(5, 'Why should I teach on iTutor?', 'Because it’s easy and flexible! If you teach with iTutor, you:\r\n\r\n1) earn by sharing what you know.\r\n2) get a steady stream of new students looking to learn online. \r\n3) manage your lessons and connect with students easily. \r\n4) teach whenever and wherever you want\r\nuse safe payment methods (Easypaisa). \r\n5) get support from our friendly team through professional development webinars, live chat and email. \r\n6) join a community of expert tutors who are always there for you. \r\n...and more to come! We’re constantly improving the platform and teaching tools for our tutors based on their needs.'),
(6, 'What computer equipment do I need to teach on iTutor?', 'You will need a laptop or a desktop computer, a stable internet connection, a webcam, and a microphone for conducting lessons in the iTutor virtual classroom.'),
(7, 'Is it free to create a profile on iTutor?', 'Yes. It is free to create a tutor profile, get exposure to students, and use iTutor’s tools and materials. We only charge a commission for the lessons that you have taught. The commission for a trial lesson with a new student is 100%. The commission for the subsequent lessons starts at 33% and decreases to 18%: the more hours you teach on iTutor, the lower the rate of commission.');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `languageid` int(11) NOT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`languageid`, `language`) VALUES
(1, 'English'),
(2, 'Urdu'),
(3, 'Sindhi'),
(4, 'Punjabi'),
(5, 'Balochi'),
(6, 'Pashto');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lessonid` int(11) NOT NULL,
  `lessonTime` time NOT NULL,
  `lessonDate` int(255) NOT NULL,
  `lessonMonth` int(255) NOT NULL,
  `lessonYear` int(255) NOT NULL,
  `lessonDay` varchar(255) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `lessonStatus` enum('Scheduled','Completed','Canceled','Pending','Other') DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `studentid` int(11) DEFAULT NULL,
  `subjectid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lessonid`, `lessonTime`, `lessonDate`, `lessonMonth`, `lessonYear`, `lessonDay`, `duration`, `price`, `lessonStatus`, `teacherid`, `studentid`, `subjectid`) VALUES
(52, '12:00:00', 5, 5, 2024, 'sunday', 55, 800.00, 'Completed', 24, 15, 1),
(53, '12:00:00', 5, 5, 2024, 'sunday', 55, 800.00, 'Completed', 24, 15, 1),
(54, '12:00:00', 5, 5, 2024, 'sunday', 55, 800.00, 'Completed', 24, 15, 1),
(55, '11:00:00', 4, 5, 2024, 'saturday', 55, 800.00, 'Completed', 24, 15, 1),
(56, '11:00:00', 4, 5, 2024, 'saturday', 55, 800.00, 'Completed', 24, 15, 1),
(57, '11:00:00', 5, 5, 2024, 'sunday', 55, 800.00, 'Completed', 24, 15, 1),
(58, '16:00:00', 5, 5, 2024, 'sunday', 55, 800.00, 'Completed', 24, 15, 1),
(59, '19:00:00', 5, 5, 2024, 'sunday', 55, 800.00, 'Completed', 24, 17, 1),
(60, '18:00:00', 5, 5, 2024, 'sunday', 55, 800.00, 'Completed', 24, 17, 1),
(61, '00:00:00', 6, 5, 2024, 'monday', 55, 700.00, 'Completed', 50, 17, 2),
(62, '09:00:00', 17, 5, 2024, 'friday', 55, 800.00, 'Completed', 24, 17, 1),
(63, '10:00:00', 17, 5, 2024, 'friday', 55, 800.00, 'Completed', 24, 17, 1),
(64, '10:00:00', 24, 5, 2024, 'friday', 55, 800.00, 'Completed', 24, 17, 1),
(75, '09:00:00', 15, 6, 2024, 'saturday', 55, 800.00, 'Scheduled', 24, 17, 1),
(76, '18:00:00', 9, 6, 2024, 'sunday', 55, 800.00, 'Completed', 24, 17, 1),
(77, '11:00:00', 1, 6, 2024, 'saturday', 55, 800.00, 'Completed', 24, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploaded_for` varchar(255) NOT NULL,
  `uploaded_by` varchar(255) NOT NULL,
  `uploader_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `filename`, `uploaded_for`, `uploaded_by`, `uploader_type`) VALUES
(1, 'whiteback.png', '24', '17', NULL),
(2, 'whiteback.png', '24', '17', NULL),
(3, 'WhatsApp Image 2021-05-12 at 1.05.33 AM.jpeg', '24', '17', NULL),
(4, 'WhatsApp Image 2021-05-12 at 1.05.33 AM.jpeg', '24', '17', NULL),
(5, 'whiteback.png', '24', '17', NULL),
(6, 'Arsamkhan.jpg', '17', '24', NULL),
(7, 'whiteback.png', '17', '24', 'Teacher'),
(8, 'Registration Form.docx', '15', '24', 'Teacher'),
(9, 'FYP-Guidelines - Isra University-Hyd.pdf', '17', '24', 'Teacher'),
(10, 'Capture.PNG', '17', '24', 'Teacher'),
(11, 'Capture.PNG', '17', '24', 'Teacher'),
(12, 'Capture.PNG', '15', '24', 'Teacher'),
(13, 'Capture.PNG', '17', '24', 'Teacher'),
(14, 'Capture.PNG', '17', '24', 'Teacher'),
(15, 'Capture.PNG', '15', '24', 'Teacher'),
(16, 'Capture.PNG', '15', '24', 'Teacher'),
(17, 'Capture.PNG', '17', '24', 'Teacher'),
(18, 'My New App.accdb', '17', '24', 'Teacher'),
(19, 'ahmed.docx', '24', '17', 'Student'),
(20, 'zayyan ppt.pptx', '24', '17', 'Student'),
(21, 'My New App.accdb', '24', '17', 'Student'),
(22, 'zayyankhan PMG ppt presentation.pptx', '17', '24', 'Teacher'),
(23, 'zayyan ppt.pptx', '50', '17', 'Student'),
(24, 'My New App.accdb', '50', '17', 'Student'),
(25, 'Assignment 2 of SQA(th) Arsam khan 2007-bscs002.docx', '24', '17', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageid` int(11) NOT NULL,
  `senderemail` varchar(100) NOT NULL,
  `receiveremail` varchar(100) NOT NULL,
  `messageText` text DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Reviewer` int(11) DEFAULT NULL,
  `Reviewed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `accountStatus` tinyint(1) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `fname`, `lname`, `email`, `password`, `phone`, `profilePic`, `registrationDate`, `accountStatus`, `gender`, `DOB`, `country`, `timezone`, `mname`) VALUES
(15, 'Daniya', 'khan', 'daniya@outlook.com', '$2y$10$JXb6Ernn0N3UqkKXiEfcHOLXch4QKHVCXK0t2MV1H5vTJydcRjAB6', '03433538832', '1711871048_3f881b2f405958ba.jpg', '2024-03-31', NULL, 'Female', '2000-10-09', 'Pakistan', 'UTC+05:00', ''),
(16, 'Zaid', 'hassan', 'zaid@gmail.com', '$2y$10$0mUVvz3W5pVe9vnjZ5.Z5.yuTkK9fZqmE/UxAzOs1TyBF9IyQHwvG', '03123383961', '1713753230_665ac506cd0c2585.jpeg', '2024-04-22', NULL, 'Male', '2001-11-30', 'Pakistan', 'UTC+05:00', ''),
(17, 'Amir', '', 'amir@gmail.com', '$2y$10$m/NGWVkTlEMLHMPrYX8n5O5/oYGjUlyaPWyn7upX1tAx85u1FJxTW', '03123383961', '1714902040_7a405980005ac2e9.jpeg', '2024-05-05', NULL, 'Male', '2001-02-06', 'Pakistan', 'UTC+05:00', ''),
(18, 'Umer', 'Shareef', 'umers@gmail.com', '$2y$10$jIMnb6aVnYO9vma0cqxWfed47DRjqXFG9UJ6uGpuzxMB.e2EROZby', '03123383961', '1717873627_ba37684b881897ec.png', '2024-06-08', NULL, 'Male', '2001-02-16', 'Pakistan', 'UTC+05:00', '');

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `Student_AfterInsert` AFTER INSERT ON `student` FOR EACH ROW BEGIN
    INSERT INTO alluser (email, user_type) VALUES (NEW.email, 'Student');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Student_DeleteTrigger` AFTER DELETE ON `student` FOR EACH ROW BEGIN
    DELETE FROM alluser WHERE email = OLD.email;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectid` int(11) NOT NULL,
  `subjectName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `subjectName`) VALUES
(1, 'Web Development'),
(2, 'Kotlin'),
(3, 'C++'),
(4, 'C#'),
(5, 'Javascript'),
(6, 'Python'),
(7, 'PHP'),
(8, 'OOPs'),
(9, 'MYSQL'),
(10, 'Automata');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `headline` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `videoLinks` varchar(255) DEFAULT NULL,
  `rates` decimal(10,2) DEFAULT NULL,
  `teacherintro` text DEFAULT NULL,
  `subjectid` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherid`, `fname`, `mname`, `lname`, `email`, `password`, `phone`, `profilePicture`, `registrationDate`, `DOB`, `gender`, `age`, `country`, `experience`, `timezone`, `headline`, `description`, `videoLinks`, `rates`, `teacherintro`, `subjectid`, `city`) VALUES
(24, 'Arsam', '', 'Khan', 'arsamkhan27726@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtu.be/Wl7hr5b8db4 ', 800.00, 'Hello, my name is Arsam, and I am originally from the\n                  vibrant city of\n                  Islamabad, Pakistan.', 1, 'Hyderabad'),
(25, 'Arsam', '', 'Khan', 'arsamkhan2@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtube.com/watch?v=qKVW_wJs91Q&list=RD5BBmPVk99JI&index=6', 800.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 2, 'Hyderabad'),
(26, 'Samar', '', 'Khan', 'arsamkhan2@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=tBbdSzwxqyY&list=RD5BBmPVk99JI&index=5', 1000.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 7, 'Hyderabad'),
(27, 'Zayyan', '', 'Khan', 'zayyan@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=EXZGPRCV4D0', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 3, 'Hyderabad'),
(28, 'Zayyan', '', 'Khan', 'zayyan1@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=5BBmPVk99JI', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 3, 'Hyderabad'),
(29, 'Zayyan', '', 'Khan', 'zayyan12@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 3, 'karachi'),
(30, 'Zayyan', '', 'Khan', 'zayyan123@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 3, 'karachi'),
(31, 'Arsam', '', 'Khan', 'arsamkhan23@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtube.com/watch?v=qKVW_wJs91Q&list=RD5BBmPVk99JI&index=6', 800.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 2, 'karachi'),
(32, 'Arsam', '', 'Khan', 'arsamkhan26@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtu.be/Wl7hr5b8db4', 800.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 5, 'DG khan'),
(34, 'Arsam', '', 'Khan', 'arsamkhan267@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtu.be/Wl7hr5b8db4', 800.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 5, 'DI khan'),
(35, 'Zayyan', '', 'Khan', 'zayyan1234@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 3, 'DI khan'),
(36, 'Arsam', '', 'Khan', 'arsamkhan277267@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtu.be/Wl7hr5b8db4', 800.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 10, 'DI  khan'),
(37, 'Arsam', '', 'Khan', 'arsamkhan2772678@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtu.be/Wl7hr5b8db4', 800.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 10, 'DG khan'),
(38, 'Arsam', '', 'Khan', 'arsamkhan27726789@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtu.be/Wl7hr5b8db4', 800.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 10, 'Peshawar'),
(39, 'Daniya', '', 'Khan', 'daniya12@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 8, 'Multan'),
(40, 'Daniya', '', 'Khan', 'daniya123@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 9, 'Lahore'),
(41, 'Daniya', '', 'Khan', 'daniya1234@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 9, 'Lahore'),
(42, 'Daniya', '', 'Khan', 'daniya12345@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 9, 'Muree'),
(43, 'Umer', '', 'Khan', 'umer1@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 10, 'Muree'),
(44, 'Umer', '', 'Khan', 'umer12@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 10, 'Muree'),
(45, 'Umer', '', 'Khan', 'ahmed1@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 10, 'Lahore'),
(47, 'Ahmed', '', 'Khan', 'ahmed12@yahoo.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\n', 'https://www.youtube.com/watch?v=coInHMUQzCg', 500.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 5, 'Lahore'),
(48, 'Ahmed', '', 'khan', 'arsamkhan5555@gmail.com', '$2y$10$j1I.CzL1w37..IWn49ceJenmckNgsKY4.Cl6fh.guuFASP297b4Xe', '03123344376', '1712512558_621381b18cb2c62a.jpeg', '2024-04-07', '2000-02-01', 'Male', 24, 'Pakistan', 'I have a decade of experience in teaching kotlin!', 'UTC+05:00', 'Kotlin tutor with 10 years of experience!', 'I have a decade of experience in teaching kotlin!', 'https://www.youtube.com/watch?v=p80VyQ5wLvg', 1200.00, 'hey, this is Ahmed, a kotlin developer!', 2, 'Hyderabad'),
(49, 'Zayyan', '', 'khan', 'zayyankhan@email.com', '$2y$10$zluP43NbZtlM1AKcG.CX/enY5jyz390wVChGC3sFfjuSuARTheTXy', '03433538832', '1712517531_1c4a260c243fa756.jpg', '2024-04-07', '2001-02-05', 'Male', 22, 'Pakistan', 'This is Arsam khan.', 'UTC+05:00', 'This is Arsam khan.', 'This is Arsam khan.', 'https://www.youtube.com/watch?v=p80VyQ5wLvg', 1200.00, 'This is Arsam khan.', 3, 'Hyderabad'),
(50, 'Noor', '', 'khan', 'noorkhan@gmail.com', '$2y$10$BZJ3xhMdm4k.rp3alIS1sujc/UGiSuklnfqHqddmuHnw8lUsKM.cu', '03433538832', '1712517755_d3c2c70ad5768225.jpeg', '2024-04-07', '2001-01-30', 'Female', 22, 'Pakistan', 'This is Noor, a mobile app developer!', 'UTC+05:00', 'This is Noor, a mobile app developer!', 'This is Noor, a mobile app developer!', 'https://www.youtube.com/watch?v=p80VyQ5wLvg', 700.00, 'This is Noor, a mobile app developer!', 2, 'Islamabad'),
(51, 'Arsam', '', 'Khan', 'arsamkhan277267889@gmail.com', '$2y$10$xY/8Z/ENuIqDSQzBvufc1.YNouAJf.H/UsGcUvG.VHyEWGXT/T5iS', '03433538832', '1711803867_a4ae62d12f6442e1.png', '2024-03-30', '2001-10-09', 'Male', 23, 'Pakistan', 'I\'ve been coding for years, and I\'ll be teaching you guys all sorts of programming paradigms, tricks,\r\n                  HTML, CSS, JavaScript, and SQL and many more. I\'ll help you build a mindset that you would be able to\r\n                  create any of the applications you want.', 'UTC+05:00', 'I have over 3 years teaching and training experience.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'https://youtu.be/Wl7hr5b8db4', 800.00, 'Hello, my name is Arsam, and I am originally from the\r\n                  vibrant city of\r\n                  Islamabad, Pakistan.', 3, 'Peshawar');

--
-- Triggers `teacher`
--
DELIMITER $$
CREATE TRIGGER `Teacher_AfterInsert` AFTER INSERT ON `teacher` FOR EACH ROW BEGIN
    INSERT INTO alluser (email, user_type) VALUES (NEW.email, 'Teacher');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Teacher_DeleteTrigger` AFTER DELETE ON `teacher` FOR EACH ROW BEGIN
    DELETE FROM alluser WHERE email = OLD.email;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teacheravailability`
--

CREATE TABLE `teacheravailability` (
  `id` int(11) NOT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacheravailability`
--

INSERT INTO `teacheravailability` (`id`, `teacherid`, `day`, `start_time`, `end_time`) VALUES
(46, 24, 'monday', '09:00:00', '12:00:00'),
(47, 24, 'monday', '16:00:00', '20:00:00'),
(48, 24, 'tuesday', '09:00:00', '12:00:00'),
(49, 24, 'wednesday', '09:00:00', '12:00:00'),
(50, 24, 'friday', '09:00:00', '12:00:00'),
(51, 24, 'saturday', '09:00:00', '12:00:00'),
(52, 24, 'sunday', '09:00:00', '20:00:00'),
(53, 48, 'monday', '00:00:00', '06:00:00'),
(54, 49, 'monday', '11:00:00', '20:00:00'),
(55, 50, 'monday', '00:00:00', '02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teachercertification`
--

CREATE TABLE `teachercertification` (
  `tcert_id` int(11) NOT NULL,
  `certTitle` varchar(100) DEFAULT NULL,
  `certStartYear` int(11) DEFAULT NULL,
  `certEndYear` int(11) DEFAULT NULL,
  `certLink` varchar(255) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `issued_by` varchar(100) DEFAULT NULL,
  `subjectid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachercertification`
--

INSERT INTO `teachercertification` (`tcert_id`, `certTitle`, `certStartYear`, `certEndYear`, `certLink`, `teacherid`, `issued_by`, `subjectid`) VALUES
(27, 'Programming with PHP', 2023, 2024, 'https://www.sololearn.com/certificates/CT-Z6U1HBZA', 24, 'Sololearn', 7),
(28, 'Programming with PHP', 2022, 2022, 'https:://arsam.com', 50, 'Isra university', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teachereducation`
--

CREATE TABLE `teachereducation` (
  `tedu_id` int(11) NOT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `startYear` int(11) DEFAULT NULL,
  `institute` varchar(100) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `endYear` int(11) DEFAULT NULL,
  `degreeType` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachereducation`
--

INSERT INTO `teachereducation` (`tedu_id`, `degree`, `startYear`, `institute`, `teacherid`, `endYear`, `degreeType`, `specialization`) VALUES
(23, 'Pre engineering', 2018, 'Govt: Degree college kohsar', 24, 2020, '', 'App development'),
(24, 'Bachelors in computer science', 2020, 'Isra University', 24, 2024, '', 'Web development'),
(25, 'Pre engineering', 2020, 'Govt: Degree college kohsar', 50, 2022, '', 'App development');

-- --------------------------------------------------------

--
-- Table structure for table `teacherlanguage`
--

CREATE TABLE `teacherlanguage` (
  `languageid` int(11) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacherlanguage`
--

INSERT INTO `teacherlanguage` (`languageid`, `language`, `teacherid`) VALUES
(20, 'English', 24),
(21, 'Sindhi', 24),
(22, 'English', 48),
(23, 'English', 49),
(24, 'Urdu', 49),
(25, 'English', 50);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionid` int(11) NOT NULL,
  `PaymentAmount` decimal(10,2) DEFAULT NULL,
  `PaymentStatus` enum('Success','Pending','Failed') DEFAULT NULL,
  `TransactionDate` datetime DEFAULT NULL,
  `lessonid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `alluser`
--
ALTER TABLE `alluser`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`languageid`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lessonid`),
  ADD KEY `teacherid` (`teacherid`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageid`),
  ADD UNIQUE KEY `senderemail` (`senderemail`),
  ADD UNIQUE KEY `receiveremail` (`receiveremail`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `Reviewer` (`Reviewer`),
  ADD KEY `Reviewed` (`Reviewed`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `teacheravailability`
--
ALTER TABLE `teacheravailability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `teachercertification`
--
ALTER TABLE `teachercertification`
  ADD PRIMARY KEY (`tcert_id`),
  ADD KEY `teacherid` (`teacherid`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `teachereducation`
--
ALTER TABLE `teachereducation`
  ADD PRIMARY KEY (`tedu_id`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `teacherlanguage`
--
ALTER TABLE `teacherlanguage`
  ADD PRIMARY KEY (`languageid`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionid`),
  ADD KEY `lessonid` (`lessonid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alluser`
--
ALTER TABLE `alluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `languageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lessonid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `teacheravailability`
--
ALTER TABLE `teacheravailability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `teachercertification`
--
ALTER TABLE `teachercertification`
  MODIFY `tcert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `teachereducation`
--
ALTER TABLE `teachereducation`
  MODIFY `tedu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `teacherlanguage`
--
ALTER TABLE `teacherlanguage`
  MODIFY `languageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`),
  ADD CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`),
  ADD CONSTRAINT `lessons_ibfk_3` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`subjectid`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`senderemail`) REFERENCES `alluser` (`email`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiveremail`) REFERENCES `alluser` (`email`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`Reviewer`) REFERENCES `student` (`studentid`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`Reviewed`) REFERENCES `teacher` (`teacherid`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`subjectid`);

--
-- Constraints for table `teacheravailability`
--
ALTER TABLE `teacheravailability`
  ADD CONSTRAINT `teacheravailability_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`);

--
-- Constraints for table `teachercertification`
--
ALTER TABLE `teachercertification`
  ADD CONSTRAINT `teachercertification_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`),
  ADD CONSTRAINT `teachercertification_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`subjectid`);

--
-- Constraints for table `teachereducation`
--
ALTER TABLE `teachereducation`
  ADD CONSTRAINT `teachereducation_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`);

--
-- Constraints for table `teacherlanguage`
--
ALTER TABLE `teacherlanguage`
  ADD CONSTRAINT `teacherlanguage_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`lessonid`) REFERENCES `lessons` (`lessonid`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `UpdateLessonStatus` ON SCHEDULE EVERY 1 HOUR STARTS '2024-05-24 20:31:06' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    -- Update the lessonStatus to 'completed' for lessons that have passed
    UPDATE Lessons
    SET lessonStatus = 'completed'
    WHERE lessonStatus = 'scheduled'
    AND STR_TO_DATE(CONCAT(lessonYear, '-', lessonMonth, '-', lessonDate, ' ', lessonTime), '%Y-%m-%d %H:%i:%s') < NOW();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
