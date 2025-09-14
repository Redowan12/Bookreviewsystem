-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2025 at 07:49 AM
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
-- Database: `book_review_system1`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `created_at`, `image`, `category_id`) VALUES
(15, 'The Great Gatsby', 'F. Scott Fitzgerald', 'A story of the wealthy Jay Gatsby and his love for Daisy Buchanan during the Roaring Twenties.', '2025-09-10 21:12:18', 'thegreatgatsby.jpg', 1),
(16, 'To Kill a Mockingbird', 'Harper Lee', 'A young girl, Scout, learns about racism and injustice in the Deep South through her father Atticus Finch.', '2025-09-10 21:12:18', 'moking.jpg', 1),
(17, '1984', 'George Orwell', 'A dystopian tale about a totalitarian regime that monitors every aspect of citizens’ lives.', '2025-09-10 21:12:18', '1984.png', 1),
(18, 'A Brief History of Time', 'Stephen Hawking', 'Explains the origins, structure, and eventual fate of the universe in a simple, approachable way.', '2025-09-10 21:12:18', 'brief.jpg', 2),
(19, 'Cosmos', 'Carl Sagan', 'Explores the universe, scientific discovery, and humanity’s place in the cosmos.', '2025-09-10 21:12:18', 'cosmos.jpg', 2),
(20, 'The Gene: An Intimate History', 'Siddhartha Mukherjee', 'A detailed exploration of genetics, heredity, and the human genome.', '2025-09-10 21:12:18', 'gene.jpg', 2),
(21, 'The 7 Habits of Highly Effective People', 'Stephen R. Covey', 'A guide to personal and professional effectiveness through seven key habits.', '2025-09-10 21:12:18', '7.jpg', 3),
(22, 'How to Win Friends & Influence People', 'Dale Carnegie', 'Practical advice for improving communication, relationships, and leadership skills.', '2025-09-10 21:12:18', 'win.jpg', 3),
(23, 'Atomic Habits', 'James Clear', 'Explains how small daily habits can lead to remarkable results over time.', '2025-09-10 21:12:18', 'atomic.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Fiction'),
(2, 'Non-Fiction'),
(3, 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `book_id`, `user_id`, `rating`, `review_text`, `created_at`) VALUES
(15, 15, 2, 5, 'good book', '2025-09-10 21:38:51'),
(16, 15, 2, 5, 'dd', '2025-09-11 09:45:34'),
(17, 17, 2, 1, 'aaaa', '2025-09-11 09:55:29'),
(18, 15, 2, 5, 'aaaaa', '2025-09-11 09:55:57'),
(19, 15, 1, 5, 'dddd', '2025-09-11 10:30:14'),
(20, 22, 6, 5, 'best book ever', '2025-09-13 22:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Redowan', 'redowan.bhuiyan20@gmail.com', '$2y$10$ss7eu7vGkg3wDb6GVIA.J.d5JjfilHYAHgnmyNfu1e5bcHGhlkAQu', 'user'),
(2, 'Redowan1', 'redowanahmed669@gmail.com', '$2y$10$RxR1MgHcPrdJvKjLARjUFu9wHuZSKypTOq1pAnvi67UbSSy1eq0sO', 'admin'),
(3, 'redowan2', 'redowan2@gmail.com', '$2y$10$pmQaPif2GqqWfdvJmAm3n.B/x7yuD4MKi1DfmhO7LIajmgmBVP/lW', 'user'),
(4, 'junayet', 'junayet22@gmail.com', '$2y$10$NK8Q7NgNL4IRuvMOcCtqPu/n5dGqd8g07F7nuavbJlyoJFTNqXTYS', 'admin'),
(5, 'shafin', 'shafin1@gmail.com', '$2y$10$.kgMSVYfd/7baBgp6JL3FOUhkyV8hDOGp//yq9rUjJC6oJZHxpHhW', NULL),
(6, 'rafin', 'rafin1@gmail.com', '$2y$10$IlcEPK0L7WBLc6CCo2agt.2vT54tf0zQ0kjLa2D7IUeAKOGM15Daq', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
