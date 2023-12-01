-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema megasport
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema megasport
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `megasport` DEFAULT CHARACTER SET utf8 ;
USE `megasport` ;

-- -----------------------------------------------------
-- Table `megasport`.`access_levels`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`access_levels` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` CHAR(1) NOT NULL,
  `description` VARCHAR(50) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(256) NOT NULL,
  `phone` VARCHAR(16) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `salt` VARCHAR(5) NOT NULL,
  `register_date` DATETIME NOT NULL,
  `access_level` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `access_level`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_users_accesslvls_idx` (`access_level` ASC) VISIBLE,
  CONSTRAINT `fk_users_accesslvls`
    FOREIGN KEY (`access_level`)
    REFERENCES `megasport`.`access_levels` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `receiptdate` DATE NULL,
  `price` FLOAT NOT NULL,
  `VAT` INT NOT NULL DEFAULT 13,
  `VATincluded` TINYINT NOT NULL DEFAULT 1,
  `height` FLOAT NOT NULL,
  `length` FLOAT NOT NULL,
  `width` FLOAT NOT NULL,
  `warranty` INT NOT NULL,
  `availability` TINYINT NOT NULL DEFAULT 1,
  `description` TEXT(65535) NULL,
  `edit_date` DATETIME NOT NULL,
  `created_by` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `created_by`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_products_users1_idx` (`created_by` ASC) VISIBLE,
  CONSTRAINT `fk_products_users1`
    FOREIGN KEY (`created_by`)
    REFERENCES `megasport`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `edit_date` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`properties`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`properties` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `type` VARCHAR(10) NOT NULL,
  `edit_date` DATETIME NOT NULL,
  `category` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `category`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_properties_categories1_idx` (`category` ASC) VISIBLE,
  CONSTRAINT `fk_properties_categories1`
    FOREIGN KEY (`category`)
    REFERENCES `megasport`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`property_values`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`property_values` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(50) NOT NULL,
  `edit_date` DATETIME NOT NULL,
  `property` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `property`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_property_values_properties1_idx` (`property` ASC) VISIBLE,
  CONSTRAINT `fk_property_values_properties1`
    FOREIGN KEY (`property`)
    REFERENCES `megasport`.`properties` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`statuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`statuses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `symbol` CHAR(1) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`countries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`countries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `phone_code` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`cities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`cities` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `country` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `country`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_cities_countries1_idx` (`country` ASC) VISIBLE,
  CONSTRAINT `fk_cities_countries1`
    FOREIGN KEY (`country`)
    REFERENCES `megasport`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`delivery_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`delivery_types` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TINYTEXT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`deliveries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`deliveries` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `zip` VARCHAR(9) NULL,
  `street` VARCHAR(50) NOT NULL,
  `building` VARCHAR(50) NOT NULL,
  `apartments` VARCHAR(5) NULL,
  `note` TINYTEXT NULL,
  `country` INT UNSIGNED NOT NULL,
  `city` INT UNSIGNED NOT NULL,
  `delivery_type` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `country`, `city`, `delivery_type`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_deliveries_countries1_idx` (`country` ASC) VISIBLE,
  INDEX `fk_deliveries_cities1_idx` (`city` ASC) VISIBLE,
  INDEX `fk_deliveries_delivery_types1_idx` (`delivery_type` ASC) VISIBLE,
  CONSTRAINT `fk_deliveries_countries1`
    FOREIGN KEY (`country`)
    REFERENCES `megasport`.`countries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_deliveries_cities1`
    FOREIGN KEY (`city`)
    REFERENCES `megasport`.`cities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_deliveries_delivery_types1`
    FOREIGN KEY (`delivery_type`)
    REFERENCES `megasport`.`delivery_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`payment_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`payment_types` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TINYTEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`payments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_date` DATETIME NOT NULL,
  `paid` TINYINT NOT NULL,
  `payment_type` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `payment_type`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_payments_payment_types1_idx` (`payment_type` ASC) VISIBLE,
  CONSTRAINT `fk_payments_payment_types1`
    FOREIGN KEY (`payment_type`)
    REFERENCES `megasport`.`payment_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_date` DATETIME NOT NULL,
  `system_id` VARCHAR(45) NOT NULL,
  `status` INT UNSIGNED NOT NULL,
  `delivery` INT UNSIGNED NOT NULL,
  `payment` INT UNSIGNED NOT NULL,
  `user` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `status`, `delivery`, `payment`, `user`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `system_id_UNIQUE` (`system_id` ASC) VISIBLE,
  INDEX `fk_orders_statuses1_idx` (`status` ASC) VISIBLE,
  INDEX `fk_orders_deliveries1_idx` (`delivery` ASC) VISIBLE,
  INDEX `fk_orders_payments1_idx` (`payment` ASC) VISIBLE,
  INDEX `fk_orders_users1_idx` (`user` ASC) VISIBLE,
  CONSTRAINT `fk_orders_statuses1`
    FOREIGN KEY (`status`)
    REFERENCES `megasport`.`statuses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_deliveries1`
    FOREIGN KEY (`delivery`)
    REFERENCES `megasport`.`deliveries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_payments1`
    FOREIGN KEY (`payment`)
    REFERENCES `megasport`.`payments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`user`)
    REFERENCES `megasport`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`catalog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`catalog` (
  `product` INT UNSIGNED NOT NULL,
  `category` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`product`, `category`),
  INDEX `fk_products_has_categories_categories1_idx` (`category` ASC) VISIBLE,
  INDEX `fk_products_has_categories_products1_idx` (`product` ASC) VISIBLE,
  CONSTRAINT `fk_products_has_categories_products1`
    FOREIGN KEY (`product`)
    REFERENCES `megasport`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_categories_categories1`
    FOREIGN KEY (`category`)
    REFERENCES `megasport`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megasport`.`basket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megasport`.`basket` (
  `product` INT UNSIGNED NOT NULL,
  `user` INT UNSIGNED NOT NULL,
  `count` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`product`, `user`),
  INDEX `fk_products_has_users_users1_idx` (`user` ASC) VISIBLE,
  INDEX `fk_products_has_users_products1_idx` (`product` ASC) VISIBLE,
  CONSTRAINT `fk_products_has_users_products1`
    FOREIGN KEY (`product`)
    REFERENCES `megasport`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_users_users1`
    FOREIGN KEY (`user`)
    REFERENCES `megasport`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
