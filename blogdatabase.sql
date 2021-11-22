-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2021 at 06:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(50) NOT NULL,
  `contents` longtext NOT NULL,
  `title` varchar(255) NOT NULL,
  `descriptions` longtext NOT NULL,
  `img_links` varchar(255) DEFAULT NULL,
  `created_by` int(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`id`, `contents`, `title`, `descriptions`, `img_links`, `created_by`, `created`, `updated`) VALUES
(1, 'Welcome to Blog Post!Welcome to Blog Post!Welcome to Blog Post!\r\n\r\nWelcome to Blog Post!Welcome to Blog Post!Welcome to Blog Post!\r\n\r\nWelcome to Blog Post!Welcome to Blog Post!Welcome to Blog Post!\r\n\r\nWelcome to Blog Post!Welcome to Blog Post!Welcome to Blog Post!', 'Welcome to Blog Post!', 'Welcome to Blog Post!Welcome to Blog Post!\r\nWelcome to Blog Post!Welcome to Blog Post!\r\nWelcome to Blog Post!Welcome to Blog Post!\r\nWelcome to Blog Post!Welcome to Blog Post!', NULL, 1, '2021-11-17 04:00:57', NULL),
(2, 'Welcome to Blog Post!\r\nWelcome to Blog Post!\r\nWelcome to Blog Post!\r\n', 'Welcome to Blog Post!', 'Welcome to Blog Post!\r\nWelcome to Blog Post!', NULL, 1, '2021-11-17 04:36:09', NULL),
(3, 'Welcome to Blog Post!Welcome to Blog Post!\r\n\r\nWelcome to Blog Post!Welcome to Blog Post!', 'Welcome to Blog Post!', 'Welcome to Blog Post!\r\n\r\nWelcome to Blog Post!', NULL, 1, '2021-11-17 04:43:41', NULL),
(4, 'ewqeqweqwe \r\n\r\nqwe\r\nqw \r\nqwe \r\nqe\r\n\r\neqw', 'Welcome to Blog Post!', 'qwewqewq', NULL, 1, '2021-11-17 05:14:39', NULL),
(5, 'eqweqweqweq', 'Welcome to Blog Post!', 'qweqweqw', NULL, 1, '2021-11-17 06:31:01', NULL),
(6, 'Welcome to Blog Post!\r\n\r\nWelcome to Blog Post!\r\n\r\nWelcome to Blog Post!\r\n\r\nWelcome to Blog Post!\r\n\r\nWelcome to Blog Post!\r\n\r\nWelcome to Blog Post!', 'Welcome to Blog Post!', 'Welcome to Blog Post!\r\n\r\nWelcome to Blog Post!\r\n\r\nWelcome to Blog Post!', NULL, 1, '2021-11-17 06:39:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_categories`
--

CREATE TABLE `blog_post_categories` (
  `blog_post_id` int(50) NOT NULL,
  `category_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post_categories`
--

INSERT INTO `blog_post_categories` (`blog_post_id`, `category_id`) VALUES
(1, 1),
(1, 3),
(2, 3),
(2, 4),
(3, 2),
(3, 4),
(4, 1),
(4, 4),
(5, 3),
(5, 6),
(6, 1),
(6, 3),
(6, 4),
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_comment`
--

CREATE TABLE `blog_post_comment` (
  `id` int(50) NOT NULL,
  `comment` longtext NOT NULL,
  `user_id` int(50) NOT NULL,
  `blog_post_id` int(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post_comment`
--

INSERT INTO `blog_post_comment` (`id`, `comment`, `user_id`, `blog_post_id`, `created`, `updated`) VALUES
(1, 'qweqwewqeqweqwe\r\nwqqwe', 1, 4, '2021-11-17 06:17:03', NULL),
(2, 'qkecqwvwei \r\nqwlekjqwe', 1, 4, '2021-11-17 06:28:16', NULL),
(3, 'iquyeashdkj', 1, 5, '2021-11-17 06:31:07', NULL),
(4, 'owieurqowruq', 1, 5, '2021-11-17 06:37:54', NULL),
(5, 'Welcome to Blog Post!', 1, 6, '2021-11-17 06:39:14', NULL),
(6, 'Welcome to Blog Post!', 1, 6, '2021-11-17 06:39:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_types`
--

CREATE TABLE `category_types` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_types`
--

INSERT INTO `category_types` (`id`, `name`) VALUES
(1, 'Web Design'),
(2, 'HTML'),
(3, 'Javascript'),
(4, 'CSS'),
(5, 'Tutorials'),
(6, 'Freebies');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Ryan'),
(2, 'castro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_post_comment`
--
ALTER TABLE `blog_post_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_types`
--
ALTER TABLE `category_types`
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
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_post_comment`
--
ALTER TABLE `blog_post_comment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_types`
--
ALTER TABLE `category_types`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
