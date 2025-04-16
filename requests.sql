CREATE DATABASE `CustomsByNico`;

USE `CustomsByNico`;

CREATE TABLE `requests`
(
	`id` int (11) NOT NULL AUTO_INCREMENT,
	`email` varchar(80) NOT NULL,
	`design` text NOT NULL,
	`shoe_size` varchar(80) NOT NULL,
	`name` varchar(80) NOT NULL,
	`lives_in_US` enum('Yes', 'No') NOT NULL DEFAULT 'No',
	`mailing_address` text NOT NULL,
	`form_of_contact` enum('Email', 'Instagram') NOT NULL DEFAULT 'Email',
	`insta_handle` text NULL,
	`payment_method` enum('Paypal', 'Zelle', 'Invoice', 'Cash') NOT NULL
	primary key (`id`)
);

CREATE TABLE `shoe_pics` (
	`id` int AUTO_INCREMENT,
	`image_url` varchar(255) NOT NULL,
	primary key (`id`)
);

INSERT INTO shoe_pics (image_url) 
VALUES
('https://i.imgur.com/SGLWSpC.jpeg'),
('https://i.imgur.com/Na9alLL.jpeg'),
('https://i.imgur.com/wsKWLjr.jpeg'),
('https://i.imgur.com/yrHK7h9.jpeg'),
('https://i.imgur.com/I7vlAx0.jpeg'),
('https://i.imgur.com/z1CQFnh.jpeg'),
('https://i.imgur.com/MowkYrh.jpeg'),
('https://i.imgur.com/ZaX4q67.jpeg'),
('https://i.imgur.com/mD77UxN.jpeg'),
('https://i.imgur.com/YSiv4TT.jpeg');

	
