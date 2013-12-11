DROP TABLE IF EXISTS `types`;

CREATE TABLE `types` (
	`type_id` int(3) NOT NULL,
	`position` varchar(20) NOT NULL,
	`pay_type` varchar(6) NOT NULL,
	`wage` int(4) NOT NULL,
	PRIMARY KEY (`type_id`)
);

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
	`employee_id` int(8)  NOT NULL ,
	`name` varchar(15) NOT NULL,
	`password` varchar(100) NOT NULL,
	`bank_account` bigint(20) unsigned NOT NULL,
	`type_id` int(3) NOT NULL,
	`admin` boolean NOT NULL,
	PRIMARY KEY (`employee_id`),
	FOREIGN KEY (`type_id`) references types(type_id)
);



DROP TABLE IF EXISTS `timecards`;

CREATE TABLE `timecards` (
	`timecard_id` int(10)  NOT NULL ,
	`start_time` datetime NOT NULL,
	`end_time` datetime NOT NULL,
	`submitted` boolean NOT NULL,
	`paid` boolean NOT NULL,
	PRIMARY KEY (`timecard_id`)
);


DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
	`project_id` int(8)  NOT NULL,
	`name` varchar(30) NOT NULL,
	PRIMARY KEY (`project_id`)
);


DROP TABLE IF EXISTS `dayworks`;

CREATE TABLE `dayworks` (
	`employee_id` int(8) NOT NULL,
	`timecard_id` int(10) NOT NULL,
	`project_id` int(8) NOT NULL,
	PRIMARY KEY (`employee_id`, `timecard_id`),
	FOREIGN KEY (`employee_id`) references employees(employee_id),
	FOREIGN KEY (`timecard_id`) references timecards(timecard_id),
	FOREIGN KEY (`project_id`) references projects(project_id)
);
