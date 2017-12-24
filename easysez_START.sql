-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE DATABASE "easysez" -------------------------------
CREATE DATABASE IF NOT EXISTS `easysez` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `easysez`;
-- ---------------------------------------------------------


-- CREATE TABLE "client" -----------------------------------
-- DROP TABLE "client" -----------------------------------------
DROP TABLE IF EXISTS `client` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "client" ---------------------------------------
CREATE TABLE `client` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`fname` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NULL,
	`sname` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	`company` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NULL,
	`phone` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	`email` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	`website` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "flag" -------------------------------------
-- DROP TABLE "flag" -------------------------------------------
DROP TABLE IF EXISTS `flag` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "flag" -----------------------------------------
CREATE TABLE `flag` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 32 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	`color` VarChar( 32 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "groups" -----------------------------------
-- DROP TABLE "groups" -----------------------------------------
DROP TABLE IF EXISTS `groups` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "groups" ---------------------------------------
CREATE TABLE `groups` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`created_at` DateTime NOT NULL,
	`updated_at` DateTime NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `name` UNIQUE( `name` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "groups_users" -----------------------------
-- DROP TABLE "groups_users" -----------------------------------
DROP TABLE IF EXISTS `groups_users` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "groups_users" ---------------------------------
CREATE TABLE `groups_users` ( 
	`group_id` Int( 11 ) UNSIGNED NOT NULL,
	`user_id` Int( 11 ) UNSIGNED NOT NULL,
	CONSTRAINT `group_user` UNIQUE( `group_id`, `user_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "order" ------------------------------------
-- DROP TABLE "order" ------------------------------------------
DROP TABLE IF EXISTS `order` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "order" ----------------------------------------
CREATE TABLE `order` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`client_id` Int( 11 ) NOT NULL,
	`product_id` Int( 11 ) NOT NULL,
	`qty` Float( 12, 0 ) NULL,
	`status_id` Int( 11 ) UNSIGNED NOT NULL DEFAULT '1',
	`user_id` Int( 11 ) NOT NULL,
	`price` Float( 12, 0 ) NULL,
	`note` Text CHARACTER SET utf8 COLLATE utf8_polish_ci NULL,
	`date` DateTime NOT NULL,
	`finishdate` Date NULL,
	`deadline` Date NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "order_flags" ------------------------------
-- DROP TABLE "order_flags" ------------------------------------
DROP TABLE IF EXISTS `order_flags` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "order_flags" ----------------------------------
CREATE TABLE `order_flags` ( 
	`flag_id` Int( 11 ) NOT NULL,
	`order_id` Int( 11 ) NOT NULL )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "product" ----------------------------------
-- DROP TABLE "product" ----------------------------------------
DROP TABLE IF EXISTS `product` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "product" --------------------------------------
CREATE TABLE `product` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	`unit_id` Int( 11 ) NOT NULL,
	`unitprice` Float( 12, 0 ) NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "state" ------------------------------------
-- DROP TABLE "state" ------------------------------------------
DROP TABLE IF EXISTS `state` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "state" ----------------------------------------
CREATE TABLE `state` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "status" -----------------------------------
-- DROP TABLE "status" -----------------------------------------
DROP TABLE IF EXISTS `status` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "status" ---------------------------------------
CREATE TABLE `status` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 64 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	`color` VarChar( 32 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	`state_id` Int( 11 ) NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "statuslog" --------------------------------
-- DROP TABLE "statuslog" --------------------------------------
DROP TABLE IF EXISTS `statuslog` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "statuslog" ------------------------------------
CREATE TABLE `statuslog` ( 
	`date` DateTime NOT NULL,
	`order_id` Int( 11 ) NOT NULL,
	`comment` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NULL,
	`username` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	`status` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "unit" -------------------------------------
-- DROP TABLE "unit" -------------------------------------------
DROP TABLE IF EXISTS `unit` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "unit" -----------------------------------------
CREATE TABLE `unit` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 128 ) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_polish_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "users" ------------------------------------
-- DROP TABLE "users" ------------------------------------------
DROP TABLE IF EXISTS `users` CASCADE;
-- -------------------------------------------------------------


-- CREATE TABLE "users" ----------------------------------------
CREATE TABLE `users` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`created_at` DateTime NOT NULL,
	`updated_at` DateTime NOT NULL,
	`ip` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`username` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`email` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`password` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`action_token` Char( 64 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
	`access_token` Char( 64 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
	`activated` TinyInt( 1 ) NOT NULL DEFAULT '0',
	`banned` TinyInt( 1 ) NOT NULL DEFAULT '0',
	`failed_attempts` Int( 11 ) NOT NULL DEFAULT '0',
	`last_fail_at` DateTime NULL,
	`locked_until` DateTime NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `email` UNIQUE( `email` ),
	CONSTRAINT `username` UNIQUE( `username` ) )
CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- Dump data of "client" -----------------------------------
-- ---------------------------------------------------------


-- Dump data of "flag" -------------------------------------
-- ---------------------------------------------------------


-- Dump data of "groups" -----------------------------------
BEGIN;

INSERT INTO `groups`(`id`,`created_at`,`updated_at`,`name`) VALUES ( '1', '2000-01-01 00:00:00', '2000-01-01 00:00:00', 'admin' );
INSERT INTO `groups`(`id`,`created_at`,`updated_at`,`name`) VALUES ( '2', '2000-01-01 00:00:00', '2000-01-01 00:00:00', 'user' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "groups_users" -----------------------------
BEGIN;

INSERT INTO `groups_users`(`group_id`,`user_id`) VALUES ( '1', '1' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "order" ------------------------------------
-- ---------------------------------------------------------


-- Dump data of "order_flags" ------------------------------
-- ---------------------------------------------------------


-- Dump data of "product" ----------------------------------
-- ---------------------------------------------------------


-- Dump data of "state" ------------------------------------
BEGIN;

INSERT INTO `state`(`id`,`name`) VALUES ( '0', '_null_' );
INSERT INTO `state`(`id`,`name`) VALUES ( '1', 'start' );
INSERT INTO `state`(`id`,`name`) VALUES ( '2', 'progress' );
INSERT INTO `state`(`id`,`name`) VALUES ( '3', 'end' );
COMMIT;
-- ---------------------------------------------------------


-- Dump data of "status" -----------------------------------
-- ---------------------------------------------------------


-- Dump data of "statuslog" --------------------------------
-- ---------------------------------------------------------


-- Dump data of "unit" -------------------------------------
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
BEGIN;

INSERT INTO `users`(`id`,`created_at`,`updated_at`,`ip`,`username`,`email`,`password`,`action_token`,`access_token`,`activated`,`banned`,`failed_attempts`,`last_fail_at`,`locked_until`) VALUES ( '1', '2000-01-01 00:00:00', '2000-01-01 00:00:00', '127.0.0.1', 'Admin', 'admin@localhost', '$2y$10$nAoOaKwIBHwVO7mLrQAVfed.C2uxm3l4th3UEYkl1ivPgSWzGCWEC', '5ab8e8b1a6c95c4d1c816a6e3273e7058a1a4161893fd0941d340a4d6047a185', 'b5148d4723b9539f1aada92e442594ce1e9625d18a04998ff0aa7c77290dc7c8', '1', '0', '0', NULL, NULL );
COMMIT;
-- ---------------------------------------------------------


-- CREATE INDEX "group_id" ---------------------------------
-- CREATE INDEX "group_id" -------------------------------------
CREATE INDEX `group_id` USING BTREE ON `groups_users`( `group_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "user_id" ----------------------------------
-- CREATE INDEX "user_id" --------------------------------------
CREATE INDEX `user_id` USING BTREE ON `groups_users`( `user_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "client_id" --------------------------------
-- CREATE INDEX "client_id" ------------------------------------
CREATE INDEX `client_id` USING BTREE ON `order`( `client_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "product_id" -------------------------------
-- CREATE INDEX "product_id" -----------------------------------
CREATE INDEX `product_id` USING BTREE ON `order`( `product_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "status_id" --------------------------------
-- CREATE INDEX "status_id" ------------------------------------
CREATE INDEX `status_id` USING BTREE ON `order`( `status_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "user_id" ----------------------------------
-- CREATE INDEX "user_id" --------------------------------------
CREATE INDEX `user_id` USING BTREE ON `order`( `user_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "unit_id" ----------------------------------
-- CREATE INDEX "unit_id" --------------------------------------
CREATE INDEX `unit_id` USING BTREE ON `product`( `unit_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "state_id" ---------------------------------
-- CREATE INDEX "state_id" -------------------------------------
CREATE INDEX `state_id` USING BTREE ON `status`( `state_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "order_id" ---------------------------------
-- CREATE INDEX "order_id" -------------------------------------
CREATE INDEX `order_id` USING BTREE ON `statuslog`( `order_id` );
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE LINK "groups" ------------------------------------
-- DROP LINK "groups" ------------------------------------------
ALTER TABLE `groups_users` DROP FOREIGN KEY `groups`;
-- -------------------------------------------------------------


-- CREATE LINK "groups" ----------------------------------------
ALTER TABLE `groups_users`
	ADD CONSTRAINT `groups` FOREIGN KEY ( `group_id` )
	REFERENCES `groups`( `id` )
	ON DELETE Cascade
	ON UPDATE No Action;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE LINK "users" -------------------------------------
-- DROP LINK "users" -------------------------------------------
ALTER TABLE `groups_users` DROP FOREIGN KEY `users`;
-- -------------------------------------------------------------


-- CREATE LINK "users" -----------------------------------------
ALTER TABLE `groups_users`
	ADD CONSTRAINT `users` FOREIGN KEY ( `user_id` )
	REFERENCES `users`( `id` )
	ON DELETE Cascade
	ON UPDATE No Action;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


