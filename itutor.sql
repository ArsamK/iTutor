-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 01:06 PM
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
    INSERT INTO alluser (email) VALUES (NEW.email);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alluser`
--

CREATE TABLE `alluser` (
  `userid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `uploaded_for` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `languageid` int(11) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lessonid` int(11) NOT NULL,
  `lessonDateTime` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `lessonStatus` enum('Scheduled','Completed','Canceled','Pending','Other') DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `studentid` int(11) DEFAULT NULL,
  `subjectid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `profilePic` blob DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `accountStatus` tinyint(1) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `Student_AfterInsert` AFTER INSERT ON `student` FOR EACH ROW BEGIN
    INSERT INTO alluser (email) VALUES (NEW.email);
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
  `address` varchar(255) DEFAULT NULL,
  `profilePicture` blob DEFAULT NULL,
  `registrationDate` date DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `videoLinks` text DEFAULT NULL,
  `rates` decimal(10,2) DEFAULT NULL,
  `teacherintro` text DEFAULT NULL,
  `subjectid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `teacher`
--
DELIMITER $$
CREATE TRIGGER `Teacher_AfterInsert` AFTER INSERT ON `teacher` FOR EACH ROW BEGIN
    INSERT INTO alluser (email) VALUES (NEW.email);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teacheravailability`
--

CREATE TABLE `teacheravailability` (
  `TeacherID` int(11) NOT NULL,
  `DayOfWeek` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `Availability` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Availability`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `teachereducation`
--

CREATE TABLE `teachereducation` (
  `tedu_id` int(11) NOT NULL,
  `eduTitle` varchar(100) DEFAULT NULL,
  `eduYear` int(11) DEFAULT NULL,
  `institute` varchar(100) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `uploaded_by` (`uploaded_by`),
  ADD KEY `uploaded_for` (`uploaded_for`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`languageid`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lessonid`),
  ADD KEY `teacherid` (`teacherid`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `subjectid` (`subjectid`);

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
  ADD PRIMARY KEY (`TeacherID`,`DayOfWeek`);

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
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `languageid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lessonid` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachercertification`
--
ALTER TABLE `teachercertification`
  MODIFY `tcert_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachereducation`
--
ALTER TABLE `teachereducation`
  MODIFY `tedu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `teacher` (`teacherid`),
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`uploaded_for`) REFERENCES `student` (`studentid`);

--
-- Constraints for table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `language_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`);

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
  ADD CONSTRAINT `teacheravailability_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teacher` (`teacherid`);

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
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`lessonid`) REFERENCES `lessons` (`lessonid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
