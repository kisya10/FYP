CREATE DATABASE timetable;

USE timetable;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    eth_address VARCHAR(42) NOT NULL,
    UNIQUE (username),
    UNIQUE (eth_address)
);

CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    class_name VARCHAR(100) NOT NULL,
    class_time VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE DATABASE IF NOT EXISTS timetable;

USE timetable;

-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `eth_address` VARCHAR(42) NOT NULL,
    UNIQUE (`username`),
    UNIQUE (`eth_address`)
);

-- Table structure for table `schedules`
CREATE TABLE IF NOT EXISTS `schedules` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `class_name` VARCHAR(100) NOT NULL,
    `class_time` VARCHAR(50) NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);
