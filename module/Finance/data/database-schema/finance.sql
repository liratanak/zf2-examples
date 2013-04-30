use finance;

DROP TABLE `tests`;
CREATE TABLE `tests` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`test` varchar(50) NOT NULL DEFAULT '',
	`result` varchar(50) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;