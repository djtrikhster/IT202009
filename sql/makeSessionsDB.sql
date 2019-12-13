CREATE TABLE IF NOT EXISTS `sessions`
(
    `sessions_id` INT(11) NOT NULL,
    `sessions_uid` INT(10) NOT NULL,
    `sessions_token` INT(32) NOT NULL,
    `sessions_serial` INT(32) NOT NULL,
    `sessions_date` VARCHAR(10) NOT NULL,
PRIMARY KEY (`sessions_id`)
);