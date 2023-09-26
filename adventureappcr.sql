-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema adventureapp_mvc
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema adventureapp_mvc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `adventureapp_mvc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `adventureapp_mvc` ;

-- -----------------------------------------------------
-- Table `adventureapp_mvc`.`activities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adventureapp_mvc`.`activities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `description` LONGTEXT NOT NULL,
  `price` DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `adventureapp_mvc`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adventureapp_mvc`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NOT NULL,
  `lastName` VARCHAR(60) NOT NULL,
  `email` VARCHAR(90) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  `admin` TINYINT(1) NOT NULL,
  `verified` TINYINT(1) NOT NULL,
  `token` VARCHAR(15) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_0900_ai_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `adventureapp_mvc`.`reservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adventureapp_mvc`.`reservations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NULL DEFAULT NULL,
  `time` TIME NULL DEFAULT NULL,
  `userId` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `userId_idx` (`userId` ASC) VISIBLE,
  CONSTRAINT `userId`
    FOREIGN KEY (`userId`)
    REFERENCES `adventureapp_mvc`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `adventureapp_mvc`.`activitiesxreservation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adventureapp_mvc`.`activitiesxreservation` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `activityId` INT NULL DEFAULT NULL,
  `reservationId` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `reservationId_idx` (`reservationId` ASC) VISIBLE,
  INDEX `activityId_idx` (`activityId` ASC) VISIBLE,
  CONSTRAINT `activityId`
    FOREIGN KEY (`activityId`)
    REFERENCES `adventureapp_mvc`.`activities` (`id`)
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `reservationId`
    FOREIGN KEY (`reservationId`)
    REFERENCES `adventureapp_mvc`.`reservations` (`id`)
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
