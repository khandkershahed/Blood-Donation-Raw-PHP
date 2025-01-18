
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2024 at 10:51 AM
-- Server version: 10.5.26-MariaDB
-- PHP Version: 8.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tacperfumes_ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--


-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    blood_type VARCHAR(10),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    date_of_birth DATE,
    username VARCHAR(255),
    password VARCHAR(255),
    contact_number VARCHAR(15),
    email VARCHAR(255),
    street_address_1 VARCHAR(255),
    street_address_2 VARCHAR(255),
    city VARCHAR(100),
    area VARCHAR(100),
    availability VARCHAR(100),
    last_donated_date DATE,
    weight DECIMAL(5,2),
    donated_before ENUM('yes', 'no'),
    registration_type ENUM('receiver', 'donor', 'both') 
);


CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the notifications table
CREATE TABLE `notifications` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,   -- The recipient user ID (the donor)
    `message` TEXT NOT NULL,   -- The notification message
    `status` ENUM('unread', 'read') DEFAULT 'unread', -- Notification status
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Time of notification
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Last updated time
);

CREATE TABLE requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT NOT NULL,
    requester_id INT(255) NOT NULL,
    requester_name VARCHAR(255) NOT NULL,
    requester_phone VARCHAR(15) NOT NULL,
    blood_type VARCHAR(10) NOT NULL,
    message TEXT,
    location VARCHAR(255) NOT NULL,
    urgency ENUM('immediate', 'today', 'within_3_days') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (donor_id) REFERENCES users(id),
    FOREIGN KEY (requester_id) REFERENCES users(id),
);

