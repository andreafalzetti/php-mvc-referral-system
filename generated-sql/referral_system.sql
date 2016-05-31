
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- client
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(10) NOT NULL,
    `first_name` VARCHAR(45) NOT NULL,
    `last_name` VARCHAR(45) NOT NULL,
    `dob` VARCHAR(10),
    `email` VARCHAR(45),
    `mobile` VARCHAR(15),
    `address` VARCHAR(256),
    `notes` VARCHAR(45),
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(45) NOT NULL,
    `password` VARCHAR(32) NOT NULL,
    `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- review
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `review`;

CREATE TABLE `review`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `client_id` INTEGER NOT NULL,
    `user_id` INTEGER NOT NULL,
    `status` TINYINT DEFAULT 0 NOT NULL,
    `message` TEXT,
    `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `fk_review_client_idx` (`client_id`),
    INDEX `fk_review_user1_idx` (`user_id`),
    CONSTRAINT `fk_review_client`
        FOREIGN KEY (`client_id`)
        REFERENCES `client` (`id`),
    CONSTRAINT `fk_review_user1`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
