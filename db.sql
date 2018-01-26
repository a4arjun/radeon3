-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2017 at 08:39 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radeon`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_members`
--

CREATE TABLE `blog_members` (
  `memberID` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_members`
--

INSERT INTO `blog_members` (`memberID`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$hLzjGYK4ctg3vzxKjqyVleZrGwenlegb7vBazd.i6KQxLjvseGGpa', 'admin@yoursite.com');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `postID` int(11) UNSIGNED NOT NULL,
  `postTitle` varchar(255) DEFAULT NULL,
  `postDesc` text,
  `postCont` text,
  `postDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`postID`, `postTitle`, `postDesc`, `postCont`, `postDate`) VALUES
(7, 'Website launched', '<p>Trying to edit a post that had been already written</p>\r\n', '<p>Hell yeah. It works</p>\r\n', '2017-06-07 19:30:55'),
(8, 'Just another post', '<p>A sample post that tells about something and something</p>\r\n', '<p>content goes here</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2017-06-07 19:32:08'),
(9, 'Sample post', '<p>A sample post to check whether everything works perfect.</p>\r\n', '<p>Of course yes</p>\r\n', '2017-09-29 07:21:46');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pid` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `isRoot` int(11) NOT NULL DEFAULT '1',
  `content` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pid`, `title`, `isRoot`, `content`) VALUES
(8, 'Services', 1, '<div class=\"row\">\r\n<h1>Welcome to Canvas</h1>\r\n\r\n<p>Creating a website by coding is a hard job. It is definitely a time consuming process and hard task for beginers. So, almost everyone switched to CMS like WordPress, Joomla, SilverStripe etc. The above list of CMS are good. But, users have to work in backend. Means, everytime you create a page or a post, You need to watch a live preview about the page you have created. But, Canvas brings you the new level of cusomisation. Designing a webpage now became easier. Yeah. Just like you are creting a document in Office wares like MS Word, LibreOffice writer etc. Sounds good? Oh. You are still can&#39;t find the editor for adding content? This is it. This is not a documentary page of Canvas. This is a WYSIWYG page designer. Let&#39;s go.</p>\r\n\r\n<div class=\"col-lg-4\">\r\n<h2>News 1</h2>\r\n\r\n<p>Some newses and notifications for students and visitors who surfs the site. This include the published results, Exam timetables, special class notifications etc. It will be helpful for students as well as teachers.</p>\r\n\r\n<p><a class=\"btn btn-default\" href=\"#\">Read more &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 -->\r\n\r\n<div class=\"col-lg-4\">\r\n<h2>News 2</h2>\r\n\r\n<p>Some newses and notifications for students and visitors who surfs the site. This include the published results, Exam timetables, special class notifications etc. It will be helpful for students as well as teachers.</p>\r\n\r\n<p><a class=\"btn btn-default\" href=\"#\">Read more &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 -->\r\n\r\n<div class=\"col-lg-4\">\r\n<h2>News 3</h2>\r\n\r\n<p>Some newses and notifications for students and visitors who surfs the site. This include the published results, Exam timetables, special class notifications etc. It will be helpful for students as well as teachers.</p>\r\n\r\n<p><a class=\"btn btn-default\" href=\"#\">Read more &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 --></div>\r\n<!-- /.row -->\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-4\">\r\n<h2>News 1</h2>\r\n\r\n<p>Some newses and notifications for students and visitors who surfs the site. This include the published results, Exam timetables, special class notifications etc. It will be helpful for students as well as teachers.</p>\r\n\r\n<p><a class=\"btn btn-default\" href=\"#\">Read more &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 -->\r\n\r\n<div class=\"col-lg-4\">\r\n<h2>News 2</h2>\r\n\r\n<p>Some newses and notifications for students and visitors who surfs the site. This include the published results, Exam timetables, special class notifications etc. It will be helpful for students as well as teachers.</p>\r\n\r\n<p><a class=\"btn btn-default\" href=\"#\">Read more &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 -->\r\n\r\n<div class=\"col-lg-4\">\r\n<h2>News 3</h2>\r\n\r\n<p>Some newses and notifications for students and visitors who surfs the site. This include the published results, Exam timetables, special class notifications etc. It will be helpful for students as well as teachers.</p>\r\n\r\n<p><a class=\"btn btn-default\" href=\"#\">Read more &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 --></div>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_members`
--
ALTER TABLE `blog_members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_members`
--
ALTER TABLE `blog_members`
  MODIFY `memberID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `postID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
