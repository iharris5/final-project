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

	
