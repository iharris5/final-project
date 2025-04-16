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
('/assets/views/main/images/IMG_1421.jpeg'),
('/assets/views/main/images/IMG_2355.jpeg'),
('/assets/views/main/images/IMG_3409.jpeg'),
('/assets/views/main/images/IMG_3553.jpeg'),
('/assets/views/main/images/IMG_3575.jpeg'),
('/assets/views/main/images/IMG_3951.jpeg'),
('/assets/views/main/images/IMG_5545.jpeg'),
('/assets/views/main/images/IMG_6056.jpeg'),
('/assets/views/main/images/IMG_6161.jpeg'),
('/assets/views/main/images/IMG_9383.jpeg');

	
