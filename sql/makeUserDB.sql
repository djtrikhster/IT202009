CREATE TABLE IF NOT EXISTS `accounts`
(
    `id` INT NOT NULL AUTO_INCREMENT, 
    `u_name` VARCHAR(40) NOT NULL,
    `f_name` VARCHAR(40) NOT NULL, 
    `l_name` VARCHAR(40) NOT NULL, 
    `email` VARCHAR(120) NOT NULL, 
    `pass` VARCHAR(100) NOT NULL, 
    `hash` VARCHAR(32) NOT NULL, 
    `active` BOOL NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
);