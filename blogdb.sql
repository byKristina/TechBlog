-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2019 at 01:24 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Java'),
(2, 'Javascript'),
(3, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(50) NOT NULL,
  `alt` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `alt`, `url`) VALUES
(1, 'post1', 'img/post/post1.jpg'),
(2, 'post2', 'img/post/post2.jpg'),
(3, 'post3', 'img/post/post3.jpg'),
(4, 'post4', 'img/post/post4.jpg'),
(5, 'post5', 'img/post/post5.jpg'),
(6, 'post6', 'img/post/post6.jpg'),
(7, 'post7', 'img/post/post7.jpg'),
(84, 'Novii', 'img/post/1530038989post2.jpg'),
(85, 'Novii', 'img/post/1530040083post2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(30) NOT NULL,
  `menutype_id` int(20) NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menutype_id`, `url`, `name`, `position`) VALUES
(1, 1, 'index.php?page=home', 'Home', 1),
(2, 2, 'index.php?page=home', 'Home', 1),
(3, 1, 'index.php?page=contact', 'Contact', 2),
(4, 2, 'index.php?page=contact', 'Contact', 3),
(7, 1, 'index.php?page=survey', 'Survey', 3),
(8, 2, 'index.php?page=survey', 'Survey', 4),
(10, 1, 'index.php?page=login', 'Login/Register', 5),
(11, 2, 'modules/logout.php', 'Logout', 4),
(12, 2, 'index.php?page=userPosts', 'My Posts', 2),
(16, 3, 'index.php', 'Dashboard', 1),
(17, 3, 'users.php', 'Users', 2),
(18, 3, 'posts.php', 'Posts', 3),
(19, 3, 'menu.php', 'Menu', 4),
(20, 3, 'categories.php', 'Categories', 5);

-- --------------------------------------------------------

--
-- Table structure for table `menutype`
--

CREATE TABLE `menutype` (
  `id` int(10) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menutype`
--

INSERT INTO `menutype` (`id`, `name`) VALUES
(1, 'main'),
(2, 'user'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(11) NOT NULL,
  `question` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `question`) VALUES
(1, 'Java'),
(3, 'Javascript'),
(4, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `poll_option`
--

CREATE TABLE `poll_option` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll_option`
--

INSERT INTO `poll_option` (`id`, `poll_id`, `user_id`) VALUES
(1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(255) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(20) NOT NULL,
  `category_id` int(20) NOT NULL,
  `image_id` int(20) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `name`, `user_id`, `category_id`, `image_id`, `description`, `date`) VALUES
(1, 'An Intro to Web Scraping with lxml and Python', 2, 3, 3, 'Why should you bother learning how to web scrape? If your job doesn’t require you to learn it, then let me give you some motivation.\r\n\r\nWhat if you want to create a website which curates the cheapest products from Amazon, Walmart, and a couple of other online stores? A lot of these online stores don’t provide you with an easy way to access their information using an API. In the absence of an API, your only choice is to create a web scraper. This allows you to extract information from these websites automatically and makes that information easy to use.', '2018-06-19 10:38:18'),
(5, 'What exactly can you do with Python? ', 1, 3, 2, 'Well that’s a tricky question to answer, because there are so many applications for Python.', '2018-06-19 16:02:46'),
(7, 'Learning Python: From Zero to Hero', 1, 3, 4, 'Python Object-Oriented Programming mode: ON\r\nPython, as an Object-Oriented programming language, has these concepts: class and object.\r\n\r\nA class is a blueprint, a model for its objects.\r\n\r\nSo again, a class it is just a model, or a way to define attributes and behavior (as we talked about in the theory section). As an example, a vehicle class has its own attributes that define what objects are vehicles. The number of wheels, type of tank, seating capacity, and maximum velocity are all attributes of a vehicle.', '2018-06-19 16:14:53'),
(9, 'Java Design Patterns', 1, 1, 1, 'Design Patterns are very popular among software developers. A design pattern is a well described solution to a common software problem. ', '2018-06-19 17:06:11'),
(11, 'Javascript News', 2, 2, 5, 'According to RedMonk programming language rankings and GitHut.info, JavaScript is leading the pack in the terms of repositories and the most discussed programming language on StackOverFlow. The numbers itself speaks about the future of JavaScript as it has grown beyond the initial capabilities of simple DOM manipulations.\r\n\r\nLearning JavaScript, on the other hand, can be a tricky proposition. New libraries, features, API’s or Style Guide, pop up almost every day. The speed of iteration is beyond imagination, and that is why reading leading JavaScript blogs are the best approach to keep up with new changes.', '2018-06-19 17:18:29'),
(13, 'Debugging JavaScript', 2, 2, 6, 'Learning to debug is an essential skill for taking the next step as a developer. It\'s important to understand and leverage the vast array of tools that exist for a given languge. Unfortunately, debugging might not seem as obvious when working with JavaScript outside of a full-fledged IDE. At least not initially. Let\'s take a look at getting started debugging JavaScript in the Google Chrome Dev Tools as well as my favorite text editor for Web Development, Visual Studio Code.', '2018-06-19 17:33:35'),
(15, 'Top 10 ES6 Features Every Busy JavaScript Developer Must Know', 1, 2, 7, 'Here’s the list of the top 10 best ES6 features for a busy software engineer (in no particular order):\r\n\r\nDefault Parameters in ES6\r\nTemplate Literals in ES6\r\nMulti-line Strings in ES6\r\nDestructuring Assignment in ES6\r\nEnhanced Object Literals in ES6\r\nArrow Functions in ES6\r\nPromises in ES6\r\nBlock-Scoped Constructs Let and Const\r\nClasses in ES6\r\nModules in ES6', '2018-06-19 17:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(2) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `firstName` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` bit(1) NOT NULL,
  `role_id` int(2) NOT NULL,
  `token` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `active`, `role_id`, `token`) VALUES
(1, 'Admin', 'Admin', 'admin', 'admin@gmail.com', '33ea10d2c0f1bc9fff0e309e09d66c4c', b'1', 1, ''),
(2, 'User', 'User', 'user', 'user@gmail.com', '6e5898b54c0cec9a84460534ef32871a', b'1', 1, ''),
(59, 'Firstname', 'Lastname', 'username', 'kristina.pecic@gmail.com', '32250170a0dca92d53ec9624f336ca24', b'0', 2, 'a7eb9be7c5cefa8ca8a7dea3da62e6b2'),
(60, 'Firstname', 'Lastname', 'username', 'kristina.pecic@gmail.com', '32250170a0dca92d53ec9624f336ca24', b'0', 2, '064c443d60abffe8b8b994ac3a7b86ad'),
(61, 'Firstname', 'Lastname', 'username', 'kristina.pecic@gmail.com', '32250170a0dca92d53ec9624f336ca24', b'0', 2, '97f2597ce92ae37d8d026cd865b51b12'),
(62, 'Firstname', 'Lastname', 'username', 'kristina.pecic@gmail.com', '32250170a0dca92d53ec9624f336ca24', b'0', 2, '982e798c969c3c07b1d3ec9455e66d24'),
(63, 'Firstname', 'Lastname', 'username', 'kristina.pecic@gmail.com', '32250170a0dca92d53ec9624f336ca24', b'0', 2, 'e643b174ffd58754f9e55c8420b2ddfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menutype_id` (`menutype_id`);

--
-- Indexes for table `menutype`
--
ALTER TABLE `menutype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_option`
--
ALTER TABLE `poll_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poll_id` (`poll_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `menutype`
--
ALTER TABLE `menutype`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `poll_option`
--
ALTER TABLE `poll_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`menutype_id`) REFERENCES `menutype` (`id`);

--
-- Constraints for table `poll_option`
--
ALTER TABLE `poll_option`
  ADD CONSTRAINT `poll_option_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`),
  ADD CONSTRAINT `poll_option_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
