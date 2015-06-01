-- --------------------------------------------------------
-- Host:                         ukryama.mysql.ukraine.com.ua
-- Server version:               5.1.72-cll-lve - MySQL Community Server (GPL)
-- Server OS:                    unknown-linux-gnu
-- HeidiSQL Version:             8.0.0.4464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for ukryama_ukryama
DROP DATABASE IF EXISTS `ukryama_ukryama`;
CREATE DATABASE IF NOT EXISTS `ukryama_ukryama` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ukryama_ukryama`;


-- Dumping structure for table ukryama_ukryama.comment_setting
DROP TABLE IF EXISTS `comment_setting`;
CREATE TABLE IF NOT EXISTS `comment_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(50) NOT NULL,
  `registeredOnly` tinyint(1) NOT NULL DEFAULT '0',
  `useCaptcha` tinyint(1) NOT NULL DEFAULT '0',
  `allowSubcommenting` tinyint(1) NOT NULL DEFAULT '1',
  `premoderate` tinyint(1) NOT NULL DEFAULT '0',
  `isSuperuser` text,
  `orderComments` enum('ASC','DESC') NOT NULL DEFAULT 'ASC',
  `useGravatar` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.month_stats
DROP TABLE IF EXISTS `month_stats`;
CREATE TABLE IF NOT EXISTS `month_stats` (
  `month` varchar(50) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `paid` int(11) NOT NULL,
  PRIMARY KEY (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_atype_htype_rel
DROP TABLE IF EXISTS `yii_atype_htype_rel`;
CREATE TABLE IF NOT EXISTS `yii_atype_htype_rel` (
  `ht_id` int(11) NOT NULL COMMENT 'Hole type ID',
  `at_id` int(11) NOT NULL COMMENT 'Relevant authority ID',
  PRIMARY KEY (`ht_id`,`at_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_comments
DROP TABLE IF EXISTS `yii_comments`;
CREATE TABLE IF NOT EXISTS `yii_comments` (
  `owner_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(12) NOT NULL DEFAULT '0',
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `parent_id` int(12) NOT NULL DEFAULT '0',
  `creator_id` int(12) NOT NULL DEFAULT '0',
  `user_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_text` text COLLATE utf8_unicode_ci,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `link` int(12) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_name` (`owner_name`,`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_event
DROP TABLE IF EXISTS `yii_event`;
CREATE TABLE IF NOT EXISTS `yii_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `message` varchar(2048) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lng` varchar(100) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_event_media
DROP TABLE IF EXISTS `yii_event_media`;
CREATE TABLE IF NOT EXISTS `yii_event_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `e_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_globals
DROP TABLE IF EXISTS `yii_globals`;
CREATE TABLE IF NOT EXISTS `yii_globals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `var` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_holes
DROP TABLE IF EXISTS `yii_holes`;
CREATE TABLE IF NOT EXISTS `yii_holes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(10) unsigned NOT NULL,
  `LATITUDE` double(13,11) NOT NULL,
  `LONGITUDE` double(14,11) NOT NULL,
  `ADDRESS` text NOT NULL,
  `STATE` enum('fresh','inprogress','fixed','achtung','prosecutor','gibddre') NOT NULL DEFAULT 'fresh',
  `createdate` int(11) DEFAULT NULL,
  `updatedate` int(11) DEFAULT NULL,
  `DATE_CREATED` int(10) unsigned NOT NULL,
  `DATE_STATUS` int(10) unsigned DEFAULT NULL,
  `COMMENT1` text,
  `COMMENT2` text,
  `TYPE_ID` int(11) NOT NULL,
  `region_id` int(10) unsigned DEFAULT NULL,
  `ADR_CITY` varchar(50) DEFAULT NULL,
  `PREMODERATED` tinyint(1) DEFAULT '0',
  `ROAD_TYPE` enum('city','highway') NOT NULL DEFAULT 'city',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_answers
DROP TABLE IF EXISTS `yii_hole_answers`;
CREATE TABLE IF NOT EXISTS `yii_hole_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `createdate` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_answer_files
DROP TABLE IF EXISTS `yii_hole_answer_files`;
CREATE TABLE IF NOT EXISTS `yii_hole_answer_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) NOT NULL,
  `file_name` varchar(511) COLLATE utf8_unicode_ci NOT NULL,
  `file_type` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_answer_results_xref
DROP TABLE IF EXISTS `yii_hole_answer_results_xref`;
CREATE TABLE IF NOT EXISTS `yii_hole_answer_results_xref` (
  `answer_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`,`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_check
DROP TABLE IF EXISTS `yii_hole_check`;
CREATE TABLE IF NOT EXISTS `yii_hole_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hole_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `region_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_fixeds
DROP TABLE IF EXISTS `yii_hole_fixeds`;
CREATE TABLE IF NOT EXISTS `yii_hole_fixeds` (
  `hole_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_fix` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `createdate` int(11) DEFAULT NULL,
  PRIMARY KEY (`hole_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_pictures
DROP TABLE IF EXISTS `yii_hole_pictures`;
CREATE TABLE IF NOT EXISTS `yii_hole_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hole_id` int(11) NOT NULL,
  `type` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` int(11) DEFAULT NULL COMMENT 'useful when new photo is uploaded',
  `pic_date` int(11) DEFAULT NULL COMMENT 'Usually for new photo (after adding a hole)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_requests
DROP TABLE IF EXISTS `yii_hole_requests`;
CREATE TABLE IF NOT EXISTS `yii_hole_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hole_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gibdd_id` int(11) NOT NULL,
  `date_sent` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ref` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_request_sent
DROP TABLE IF EXISTS `yii_hole_request_sent`;
CREATE TABLE IF NOT EXISTS `yii_hole_request_sent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rcpt` tinytext,
  `hole_id` int(11) DEFAULT NULL,
  `mailme` varchar(3) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ddate` date DEFAULT NULL,
  `req` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_hole_types
DROP TABLE IF EXISTS `yii_hole_types`;
CREATE TABLE IF NOT EXISTS `yii_hole_types` (
  `id` int(11) NOT NULL,
  `lang` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` int(3) NOT NULL DEFAULT '0',
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_messengers
DROP TABLE IF EXISTS `yii_messengers`;
CREATE TABLE IF NOT EXISTS `yii_messengers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` bigint(20) DEFAULT NULL,
  `messenger` int(10) DEFAULT NULL,
  `uin` varchar(114) DEFAULT NULL COMMENT 'Ідентифікатор в соцмережі (а також емейл, телефон і т.і)',
  `status` int(10) DEFAULT NULL COMMENT 'Чи використовувати для комунікації з користувачем',
  PRIMARY KEY (`id`),
  KEY `FK_yii_messangers_yii_usergroups_user` (`user`),
  KEY `FK_yii_messangers_yii_messangers_items` (`messenger`),
  CONSTRAINT `FK_Messenger_types` FOREIGN KEY (`messenger`) REFERENCES `yii_messengers_items` (`id`),
  CONSTRAINT `FK_yii_messangers_yii_usergroups_user` FOREIGN KEY (`user`) REFERENCES `yii_usergroups_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблиця з налагодженням месенджерів для користувача';

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_news
DROP TABLE IF EXISTS `yii_news`;
CREATE TABLE IF NOT EXISTS `yii_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(10) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `introtext` text COLLATE utf8_unicode_ci NOT NULL,
  `fulltext` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_payments
DROP TABLE IF EXISTS `yii_payments`;
CREATE TABLE IF NOT EXISTS `yii_payments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `hole_id` int(10) DEFAULT '0' COMMENT 'Зв''язана з ямою',
  `description` varchar(500) DEFAULT '0' COMMENT 'Опис',
  `amount` float DEFAULT '0' COMMENT 'Сума',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата операції (проставляється нашим сервером при поверненні запиту з ПриватБанку)',
  `status` varchar(15) DEFAULT NULL COMMENT 'Статус платіжки. Береться з оберненого запиту від ПриватБанку',
  `type` varchar(15) DEFAULT 'LiqPay' COMMENT 'Тип платіжного інструменту. На випадок декількох платіжних систем',
  `transaction_id` int(30) DEFAULT NULL COMMENT 'ID платежу у платіжній системі ',
  `currency` varchar(50) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hole_id` (`hole_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Табличка, що базується на callback запитах з платіжних сист.';

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_poll
DROP TABLE IF EXISTS `yii_poll`;
CREATE TABLE IF NOT EXISTS `yii_poll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll` varchar(45) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `vote` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_usergroups_access
DROP TABLE IF EXISTS `yii_usergroups_access`;
CREATE TABLE IF NOT EXISTS `yii_usergroups_access` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `element` int(3) NOT NULL,
  `element_id` bigint(20) NOT NULL,
  `module` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_usergroups_configuration
DROP TABLE IF EXISTS `yii_usergroups_configuration`;
CREATE TABLE IF NOT EXISTS `yii_usergroups_configuration` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rule` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_usergroups_cron
DROP TABLE IF EXISTS `yii_usergroups_cron`;
CREATE TABLE IF NOT EXISTS `yii_usergroups_cron` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lapse` int(6) DEFAULT NULL,
  `last_occurrence` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_usergroups_lookup
DROP TABLE IF EXISTS `yii_usergroups_lookup`;
CREATE TABLE IF NOT EXISTS `yii_usergroups_lookup` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `element` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` int(5) DEFAULT NULL,
  `text` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_usergroups_user
DROP TABLE IF EXISTS `yii_usergroups_user`;
CREATE TABLE IF NOT EXISTS `yii_usergroups_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) DEFAULT NULL,
  `username` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_bitrix_pass` tinyint(1) NOT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `second_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `question` text COLLATE utf8_unicode_ci,
  `answer` text COLLATE utf8_unicode_ci,
  `creation_date` datetime DEFAULT NULL,
  `activation_code` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_time` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `ban` datetime DEFAULT NULL,
  `ban_reason` text COLLATE utf8_unicode_ci,
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  `xml_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `external_auth_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` enum('ua','ru') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ua',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `group_id_idxfk` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_usergroups_user_profile
DROP TABLE IF EXISTS `yii_usergroups_user_profile`;
CREATE TABLE IF NOT EXISTS `yii_usergroups_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ug_id` bigint(20) DEFAULT NULL,
  `avatar` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `site` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aboutme` text COLLATE utf8_unicode_ci NOT NULL,
  `request_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `request_signature` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_user_area_shapes
DROP TABLE IF EXISTS `yii_user_area_shapes`;
CREATE TABLE IF NOT EXISTS `yii_user_area_shapes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ug_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_user_area_shape_points
DROP TABLE IF EXISTS `yii_user_area_shape_points`;
CREATE TABLE IF NOT EXISTS `yii_user_area_shape_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shape_id` int(11) NOT NULL,
  `point_num` int(11) NOT NULL,
  `lat` double(14,11) NOT NULL,
  `lng` double(14,11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_user_selected_lists
DROP TABLE IF EXISTS `yii_user_selected_lists`;
CREATE TABLE IF NOT EXISTS `yii_user_selected_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gibdd_id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table ukryama_ukryama.yii_user_selected_lists_holes_xref
DROP TABLE IF EXISTS `yii_user_selected_lists_holes_xref`;
CREATE TABLE IF NOT EXISTS `yii_user_selected_lists_holes_xref` (
  `list_id` int(11) NOT NULL,
  `hole_id` int(11) NOT NULL,
  PRIMARY KEY (`list_id`,`hole_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping structure for table ukryama_ukryama.yii_authority
DROP TABLE IF EXISTS `yii_authority`;
CREATE TABLE IF NOT EXISTS `yii_authority` (
  `id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `type` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `index` varchar(10) NOT NULL,
  `o_name` varchar(100) DEFAULT NULL,
  `o_pos` varchar(100) DEFAULT NULL,
  `o_phone` varchar(20) DEFAULT NULL,
  `o_email` varchar(100) DEFAULT NULL,
  `o_fax` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ukryama_ukryama.yii_authority: ~71 rows (approximately)
DELETE FROM `yii_authority`;
/*!40000 ALTER TABLE `yii_authority` DISABLE KEYS */;
INSERT INTO `yii_authority` (`id`, `lang`, `type`, `region_id`, `name`, `address`, `index`, `o_name`, `o_pos`, `o_phone`, `o_email`, `o_fax`) VALUES
	(1, 'ru', 1, 115, 'Прокуратура Голосеевского района города Киева', 'ул. Горького, 39, г. Киев', '03150', 'Прокурор Голосеевского Района города Киева', 'Прокурор', '+38-044-284-31-76', 'press.holosiiv@kyiv.gp.gov.ua', '+38-044-287-00-39'),
	(1, 'ua', 1, 115, 'Прокуратура Голосіївського району міста Києва', 'вул. Горького, 39, м. Київ', '03150', 'Прокурор Голосіївського району м. Києва', 'Прокурор', '+38-044-284-31-76', 'press.holosiiv@kyiv.gp.gov.ua', '+38-044-287-00-39'),
	(2, 'ru', 2, 115, 'УГАИ ГУМВД Украины в г. Киеве', 'ул. Богдана Хмельницького, 54, г. Киев', '01030', '', 'Начальник', '044-272-46-59', '', ''),
	(2, 'ua', 2, 115, 'УДАІ ГУМВС України в м. Києві', 'вул. Богдана Хмельницького, 54, м. Київ', '01030', '', 'Начальник', '044-272-46-59', '', ''),
	(3, 'ru', 2, 11, 'УГАИ ГУМВД Украины в Киевской области', 'ул. Ф. Эрнста, 3, г. Киев', '03048', '', 'Начальник', '044-272-46-59', '', ''),
	(3, 'ua', 2, 11, 'УДАІ ГУМВС України у Київській області', 'вул. Ф. Ернста, 3, м. Київ', '03048', '', 'Начальник', '044-272-46-59', '', ''),
	(4, 'ru', 1, 115, 'Прокуратура г. Киева', 'ул. Предславинская, 43/9, г. Киев', '03150', '', '', '(044) 524-82-61', '', ''),
	(4, 'ua', 1, 115, 'Прокуратура м. Києва', 'вул. Предславиньска, 43/9, м. Київ', '03150', '', '', '(044) 524-82-61', '', ''),
	(5, 'ru', 4, 1, 'Гос. Финансовая Инспекция Украины', 'ул. Сагайдачного, 4, г. Киев', '04070', 'Пётр Петрович Андреев', 'Глава Государственной Финансовой Инспекции Украины', '(044) 417-82-22', 'postmast@dkrs.gov.ua', '(044) 462-51-55'),
	(5, 'ua', 4, 1, 'Держ. Фінансова Iнспекція України', 'вул. Сагайдачного, 4, м. Київ', '04070', 'Петро Петрович АНДРЄЄВ', 'Голова Державної фінансової інспекції України', '(044) 417-82-22', 'postmast@dkrs.gov.ua', '(044) 462-51-55'),
	(6, 'ru', 4, 115, 'Гос. Финансовая Инспекция в г. Киеве', 'ул. Артема, 18, г. Киев', '04053', 'Олександр Викторович КАРАБАНОВ', 'Начальник Госфининспекции', '(044) 272-60-17', 'kyivkru@ukr.net', '(044) 272-60-18'),
	(6, 'ua', 4, 115, 'Держ. Фінансова Iнспекція в м. Києві', 'вул. Артема, 18, м. Київ', '04053', 'Олександр Вікторович КАРАБАНОВ', 'Начальник Держфінінспекції', '(044) 272-60-17', 'kyivkru@ukr.net', '(044) 272-60-18'),
	(7, 'ru', 1, 1, 'Прокурор г. Киева', 'ул. Предславинская, 43/9, г. Киев', '03150', '', '', '', '', ''),
	(7, 'ua', 1, 1, 'Прокурор м. Києва', 'вул. Предславиньска, 43/9, м. Київ', '03150', '', '', '', '', ''),
	(8, 'ru', 2, 2, 'УГАИ ГУМВД Украины в АР Крым', 'ул. Киевская, 152 а, г. Симферополь', '', '', '', '0652-55-01-61', '', ''),
	(8, 'ua', 2, 2, 'УДАІ ГУМВС України в АР Крим', 'вул. Київська, 152 а, м. Сімферополь', '', '', '', '0652-55-01-61', '', ''),
	(9, 'ru', 2, 4, 'УГАИ УМВД Украины в Волынской области', 'ул. Железнодорожная, 15, г. Луцк', '43000', '', '', '0332-74-22-44', '', ''),
	(9, 'ua', 2, 4, 'УДАІ УМВС України у Волинській області', 'вул. Залізнична, 15, м. Луцьк', '43000', '', '', '0332-74-22-44', '', ''),
	(10, 'ru', 2, 3, 'УГАИ УМВД Украины в Винницкой области', 'ул. Ботаническая, 23, г. Винница', '21100', '', '', '0432-59-34-34', '', ''),
	(10, 'ua', 2, 3, 'УДАІ ГУМВС України у Вінницькій області', 'вул. Ботанічна, 23, м. Вінниця', '21100', '', '', '0432-59-34-34', '', ''),
	(11, 'ru', 2, 5, 'УГАИ ГУМВД Украины в Днепропетровской области', 'ул. Ширшова, 9, г. Днепропетровск', '49000', '', '', '056-744-51-92', '', ''),
	(11, 'ua', 2, 5, 'УДАІ ГУМВС України у Дніпропетровській області', 'вул. Ширшова, 9, м. Дніпропетровськ', '49000', '', '', '056-744-51-92', '', ''),
	(12, 'ru', 2, 6, 'УГАИ ГУМВД Украины в Донецкой области', 'ул. Ходаковского, 10, г. Донецк', '83023', '', '', '062-345-23-30', '', ''),
	(12, 'ua', 2, 6, 'УДАІ ГУМВС України у Донецькій області', 'вул. Ходаковського, 10, м. Донецьк', '83023', '', '', '062-345-23-30', '', ''),
	(13, 'ru', 2, 7, 'УГАИ УМВД Украины в Житомирской области', 'ул. Щорса, 96, г. Житомир', '10031', '', '', '0412-47-39-15', '', ''),
	(13, 'ua', 2, 7, 'УДАІ УМВС України у Житомирській області', 'вул. Щорса, 96, м. Житомир', '10031', '', '', '0412-47-39-15', '', ''),
	(14, 'ru', 2, 8, 'УГАИ УМВД Украины в Закарпатской области', 'ул. Кошевого, 2, г. Ужгород', '88000', '', '', '03122-3-22-86', '', ''),
	(14, 'ua', 2, 8, 'УДАІ УМВС України в Закарпатській області', 'вул. Кошового, 2, м. Ужгород', '88000', '', '', '03122-3-22-86', '', ''),
	(15, 'ru', 2, 9, 'УГАИ ГУМВД Украины в Запорожской области', 'ул. 40 лет Советской Украине, 57а, г. Запорожье', '69035', '', '', '0612-24-30-20', '', ''),
	(15, 'ua', 2, 9, 'УДАІ ГУМВС України у Запорізькій області', 'вул. 40 років Радянській Україні, 57а, м. Запоріжжя', '69035', '', '', '0612-24-30-20', '', ''),
	(16, 'ru', 2, 10, 'УГАИ УМВД Украины в Ивано-Франковской области', 'ул. Юности, 23, г. Ивано-Франковск', '76000', '', '', '03422-30-5-73', '', ''),
	(16, 'ua', 2, 10, 'УДАІ УМВС України у Івано-Франківській області', 'вул. Юності, 23, м. Івано-Франківськ', '76000', '', '', '03422-30-5-73', '', ''),
	(17, 'ru', 2, 12, 'УГАИ УМВД Украины в Кировоградской области', 'ул. Панфиловцев, 22-Б, г. Кировоград', '25030', '', '', '0522-35-75-33', '', ''),
	(17, 'ua', 2, 12, 'УДАІ УМВС України у Кіровоградській області', 'вул. Панфиловців, 22-Б, м. Кіровоград', '25030', '', '', '0522-35-75-33', '', ''),
	(18, 'ru', 2, 13, 'УГАИ УМВД Украины в Луганской области', 'ул. Линева, 150, г. Луганск', '91008', '', '', '0642-93-57-80', '', ''),
	(18, 'ua', 2, 13, 'УДАІ УМВС України у Луганській області', 'Ул. Линева, 150, г. Луганск', '91008', '', '', '0642-93-57-80', '', ''),
	(19, 'ru', 2, 14, 'УГАИ ГУМВД Украины во Львовской области', 'ул. Перфецкого, 19, г. Львов', '79053', '', '', '0322-64-69-41', '', ''),
	(19, 'ua', 2, 14, 'УДАІ ГУМВС України у Львівській області', 'вул. Перфецького, 19, м. Львів', '79053', '', '', '0322-64-69-41', '', ''),
	(20, 'ru', 2, 15, 'УГАИ УМВД Украины в Николаевской области', 'ул. Новозаводская, 1-Б, г. Николаев', '54056', '', '', '0512-21-20-91', '', ''),
	(20, 'ua', 2, 15, 'УДАІ УМВС України у Миколаївській області', 'вул. Новозаводська, 1-Б, м. Миколаїв', '54056', '', '', '0512-21-20-91', '', ''),
	(21, 'ru', 2, 16, 'ОГАИ ГУМВД Украины в Одесской области', 'ул. Ак. Королева, 5, г. Одесса', '65114', '', '', '0482-30-17-53', '', ''),
	(21, 'ua', 2, 16, 'ВДАІ ГУМВС України у Одеській області', 'вул. Академіка Корольова, 5, м. Одеса', '65114', '', '', '0482-30-17-53', '', ''),
	(22, 'ru', 2, 17, 'УГАИ УМВД Украины в Полтавской области', 'ул. Фрунзе, 164, г. Полтава', '36008', '', '', '0532-59-07-25', '', ''),
	(22, 'ua', 2, 17, 'УДАІ УМВС України у Полтавській області', 'вул. Фрунзе, 164, м. Полтава', '36008', '', '', '0532-59-07-25', '', ''),
	(23, 'ru', 2, 18, 'УГАИ УМВД Украины в Ровенской области', 'ул. С. Бандеры, 14а, г. Ровно', '33028', '', '', '0362-63-58-21', '', ''),
	(23, 'ua', 2, 18, 'УДАІ УМВС України у Рівненській області', 'вул. С. Бандери, 14а, м. Рівне', '33028', '', '', '0362-63-58-21', '', ''),
	(24, 'ru', 2, 19, 'УГАИ УМВД Украины в Сумской области', 'ул. Белопольский путь, 18/1, г. Суммы', '40009', '', '', '0542-67-54-14', '', ''),
	(24, 'ua', 2, 19, 'УДАІ УМВС України у Сумській області', 'вул. Білопольський шлях, 18/1, м. Суми', '40009', '', '', '0542-67-54-14', '', ''),
	(25, 'ru', 2, 20, 'ОГАИ УМВД Украины в Тернопольской области', 'ул. Котляровского, 24, г. Тернополь', '46000', '', '', '0352-52-38-86', '', ''),
	(25, 'ua', 2, 20, 'ВДАІ УМВС України в Тернопольській області', 'вул. Котляревского, 24, м. Тернопіль', '46000', '', '', '0352-52-38-86', '', ''),
	(26, 'ru', 2, 21, 'УГАИ ГУМВД Украины в Харьковской области', 'ул. Шевченко, 26, г. Харьков', '61013', '', '', '057-704-15-81', '', ''),
	(26, 'ua', 2, 21, 'УДАІ ГУМВС України у Харьківській області', 'вул. Шевченка, 26, м. Харків', '61013', '', '', '057-704-15-81', '', ''),
	(27, 'ru', 2, 22, 'УГАИ УМВД Украины в Херсонской области', 'ул. Сенявина, 128, г. Херсон', '73034', '', '', '0552-43-25-36', '', ''),
	(27, 'ua', 2, 22, 'УДАІ УМВС України у Херсонській області', 'вул. Сенявина, 128, м. Херсон', '73034', '', '', '0552-43-25-36', '', ''),
	(28, 'ru', 2, 23, 'УГАИ УВМД Украины в Хмельницкой области', 'проул. Коцюбинского, 35/2, г. Хмельницкий', '29008', '', '', '0382-70-31-31', '', ''),
	(28, 'ua', 2, 23, 'УДАІ УМВС України у Хмельницькій області', 'провул. Коцюбинського, 35/2, м. Хмельницкий', '29008', '', '', '0382-70-31-31', '', ''),
	(29, 'ru', 2, 24, 'УГАИ УМВД Украины в Черкасской области', 'ул. Л.Украинки, 21, г. Черкассы', '18000', '', '', '0472-39-32-11', '', ''),
	(29, 'ua', 2, 24, 'УДАІ УМВС України у Черкаській області', 'вул. Л. Українки, 21, м. Черкаси', '18000', '', '', '0472-39-32-11', '', ''),
	(30, 'ru', 2, 25, 'ОГАИ УМВД Украины в Черниговской области', 'ул. Борисенко, 66, г. Чернигов', '14037', '', '', '04622-5-63-02', '', ''),
	(30, 'ua', 2, 25, 'ВДАІ УМВС України у Чернігівській області', 'вул. Борисенко, 66, м. Чернігів', '14037', '', '', '04622-5-63-02', '', ''),
	(31, 'ru', 2, 26, 'ОГАИ УМВД Украины в Черновицкой области', 'ул. Заводская, 22, г. Черновцы', '58007', '', '', '0372-55-05-13', '', ''),
	(31, 'ua', 2, 26, 'ВДАІ УМВС України у Чернівецькій області', 'вул. Заводська, 22, м. Чернівці', '58007', '', '', '0372-55-05-13', '', ''),
	(32, 'ru', 2, 27, 'УГАИ ГУМВД Украины в АР Крым', 'ул. Киевская, 152 а, г. Симферополь', '', '', '', '0652-55-01-61', '', ''),
	(32, 'ua', 2, 27, 'УДАІ ГУМВС України в АР Крим', 'вул. Київська, 152-А, м. Сімферополь', '', '', '', '0652-55-01-61', '', ''),
	(33, 'ru', 2, 30, 'ОГАИ Джанкойского ГО ГУМВД Украины В АР Крым', 'ул. Толстого, 5, г. Джанкой ', '96100', NULL, NULL, NULL, NULL, NULL),
	(33, 'ua', 2, 30, 'ВДАІ Джанкойского МВ ГУМВС України В АР Крим', 'вул. Толстого, 5, м. Джанкой ', '96100', NULL, NULL, NULL, NULL, NULL),
	(34, 'ua', 5, 225, 'Виконавчий комітет Васильківської міської ради', 'Київська обл., м. Васильків, вул. Соборна, 56', '08600', NULL, NULL, '2-22-59', NULL, NULL),
	(35, 'ru', 2, 1, 'МВД Украины', 'г. Киев, ул. Богомольца, 10', '', NULL, NULL, NULL, NULL, NULL),
	(35, 'ua', 2, 1, 'МВС України', 'м. Київ, вул. Богомольця, 10', '', NULL, NULL, NULL, NULL, NULL),
	(36, 'ru', 2, 186, 'ОГАИ по обслуживанию города Харькова ГУМВД Украины в Харьковской области', 'ул. Шевченко, 315-А, г. Харьков', '61033', NULL, NULL, NULL, NULL, NULL),
	(36, 'ua', 2, 186, 'ВДАІ з обслуговування міста Харків ГУМВС України в Харківській області', ' вул. Шевченка, 315-А, м. Харків', '61033', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `yii_authority` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_authority_relation
DROP TABLE IF EXISTS `yii_authority_relation`;
CREATE TABLE IF NOT EXISTS `yii_authority_relation` (
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `rel` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id1`,`id2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ukryama_ukryama.yii_authority_relation: ~11 rows (approximately)
DELETE FROM `yii_authority_relation`;
/*!40000 ALTER TABLE `yii_authority_relation` DISABLE KEYS */;
INSERT INTO `yii_authority_relation` (`id1`, `id2`, `rel`) VALUES
	(4, 1, 0),
	(4, 2, 0),
	(5, 6, 0),
	(7, 2, 0),
	(7, 4, 0),
	(8, 33, 0),
	(26, 186, 0),
	(35, 2, 0),
	(35, 3, 0),
	(35, 21, 0),
	(35, 26, 0);
/*!40000 ALTER TABLE `yii_authority_relation` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_authority_type
DROP TABLE IF EXISTS `yii_authority_type`;
CREATE TABLE IF NOT EXISTS `yii_authority_type` (
  `id` int(11) NOT NULL,
  `lang` varchar(3) CHARACTER SET latin1 NOT NULL,
  `alias` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ukryama_ukryama.yii_authority_type: ~10 rows (approximately)
DELETE FROM `yii_authority_type`;
/*!40000 ALTER TABLE `yii_authority_type` DISABLE KEYS */;
INSERT INTO `yii_authority_type` (`id`, `lang`, `alias`, `type`, `description`) VALUES
	(1, 'ru', 'prosecutor', 'Прокуратура', ''),
	(1, 'ua', 'prosecutor', 'Прокуратура', ''),
	(2, 'ru', 'gai', 'ГАИ', ''),
	(2, 'ua', 'gai', 'ДАІ', ''),
	(3, 'ru', 'sadmin', 'Районная администрация', ''),
	(3, 'ua', 'sadmin', 'Районна админiстрацiя', ''),
	(4, 'ru', 'govfinins', 'Гос. Финансовая Инспекция', ''),
	(4, 'ua', 'govfinins', 'Держ. Фінінансова Iнспекція', ''),
	(5, 'ru', 'vykon-mr', 'Исполком горсовета', NULL),
	(5, 'ua', 'vykon-mr', 'Виконком міскради', NULL);
/*!40000 ALTER TABLE `yii_authority_type` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_comment_setting
DROP TABLE IF EXISTS `yii_comment_setting`;
CREATE TABLE IF NOT EXISTS `yii_comment_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(50) NOT NULL,
  `registeredOnly` tinyint(1) NOT NULL DEFAULT '0',
  `useCaptcha` tinyint(1) NOT NULL DEFAULT '0',
  `allowSubcommenting` tinyint(1) NOT NULL DEFAULT '1',
  `premoderate` tinyint(1) NOT NULL DEFAULT '0',
  `isSuperuser` text,
  `orderComments` enum('ASC','DESC') NOT NULL DEFAULT 'ASC',
  `useGravatar` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table ukryama_ukryama.yii_comment_setting: 1 rows
DELETE FROM `yii_comment_setting`;
/*!40000 ALTER TABLE `yii_comment_setting` DISABLE KEYS */;
INSERT INTO `yii_comment_setting` (`id`, `model`, `registeredOnly`, `useCaptcha`, `allowSubcommenting`, `premoderate`, `isSuperuser`, `orderComments`, `useGravatar`) VALUES
	(1, 'default', 1, 0, 1, 0, 'Yii::app()->user->isModer', 'ASC', 0);
/*!40000 ALTER TABLE `yii_comment_setting` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_event_tree
DROP TABLE IF EXISTS `yii_event_tree`;
CREATE TABLE IF NOT EXISTS `yii_event_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `numb` varchar(255) DEFAULT NULL,
  `refer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- Dumping data for table ukryama_ukryama.yii_event_tree: 0 rows
DELETE FROM `yii_event_tree`;
/*!40000 ALTER TABLE `yii_event_tree` DISABLE KEYS */;
/*!40000 ALTER TABLE `yii_event_tree` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_event_type
DROP TABLE IF EXISTS `yii_event_type`;
CREATE TABLE IF NOT EXISTS `yii_event_type` (
  `event` int(11) NOT NULL,
  `node` int(11) NOT NULL,
  PRIMARY KEY (`event`,`node`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table ukryama_ukryama.yii_event_type: 0 rows
DELETE FROM `yii_event_type`;
/*!40000 ALTER TABLE `yii_event_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `yii_event_type` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_gibdd_heads_old
DROP TABLE IF EXISTS `yii_gibdd_heads_old`;
CREATE TABLE IF NOT EXISTS `yii_gibdd_heads_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `is_regional` int(11) NOT NULL DEFAULT '0',
  `moderated` int(11) NOT NULL DEFAULT '0',
  `post` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_dative` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fio_dative` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gibdd_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contacts` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `tel_degurn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel_dover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double(14,11) NOT NULL DEFAULT '0.00000000000',
  `lng` double(14,11) NOT NULL DEFAULT '0.00000000000',
  `created` int(10) NOT NULL,
  `modified` int(10) NOT NULL,
  `author_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ukryama_ukryama.yii_gibdd_heads_old: ~32 rows (approximately)
DELETE FROM `yii_gibdd_heads_old`;
/*!40000 ALTER TABLE `yii_gibdd_heads_old` DISABLE KEYS */;
INSERT INTO `yii_gibdd_heads_old` (`id`, `name`, `subject_id`, `is_regional`, `moderated`, `post`, `post_dative`, `fio`, `fio_dative`, `gibdd_name`, `contacts`, `address`, `tel_degurn`, `tel_dover`, `url`, `lat`, `lng`, `created`, `modified`, `author_id`) VALUES
	(1, 'АР Крым', 1, 1, 1, 'Начальник', 'Начальнику УГАИ ГУМВД Украины в АР Крым', '', '', 'УГАИ ГУМВД Украины в АР Крым', '', 'Ул.Киевская, 152 а, г.Симферополь,', '0652-55-01-61', '', 'http://ugaiark.arvo.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(2, 'Волынская область', 3, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Волынской области', '', '', 'УГАИ УМВД Украины в Волынской области', '', 'ул.Железнодорожная, 15, г.Луцк, 43000', '0332-74-22-44', '', '', 0.00000000000, 0.00000000000, 0, 0, 1),
	(3, 'Днепропетровская область', 4, 1, 1, 'Начальник', 'Начальнику УГАИ ГУМВД Украины в Днепропетровской области', '', '', 'УГАИ ГУМВД Украины в Днепропетровской области', '', 'ул.Ширшова, 9, г.Днепропетровск, 49600', '056-744-51-92', '', 'http://www.gai.dp.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(4, 'Винницкая область', 2, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Винницкой области', '', '', 'УГАИ УМВД Украины в Винницкой области', '', 'ул.Ботаническая, 23, г.Винница, 21100', '0432-59-34-34', '', 'http://www.dai.vn.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(5, 'Донецкая область', 5, 1, 1, 'Начальник', 'Начальнику УГАИ ГУМВД Украины в Донецкой области', '', '', 'УГАИ ГУМВД Украины в Донецкой области', '', 'Ул.Ходаковского, 10, г.Донецк, 83023', '062-345-23-30', '', '', 0.00000000000, 0.00000000000, 0, 0, 1),
	(6, 'Житомирская область', 6, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Житомирской области', '', '', 'УГАИ УМВД Украины в Житомирской области', '', 'ул.Щорса, 96, г.Житомир, 10031', '0412-47-39-15', '', '', 0.00000000000, 0.00000000000, 0, 0, 1),
	(7, 'Закарпатская область', 7, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Закарпатской области', '', '', 'УГАИ УМВД Украины в Закарпатской области', '', 'ул.Кошевого, 2, г.Ужгород, 88000', '03122-3-22-86', '', 'http://dai.zakarpattya.net/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(8, 'Запорожская область', 8, 1, 1, 'Начальник', 'Начальнику УГАИ ГУМВД Украины в Запорожской области', '', '', 'УГАИ ГУМВД Украины в Запорожской области', '', 'ул.40 лет Советской Украине, 57а, г.Запорожье, 69035', '0612-24-30-20', '', 'http://dai.zp.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(9, 'Ивано-Франковская область', 9, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Ивано-Франковской области', '', '', 'УГАИ УМВД Украины в Ивано-Франковской области', '', 'ул.Юности, 23, г.Ивано-Франковск, 76000', '03422-30-5-73', '', 'http://www.udai.if.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(10, 'Киевская область', 10, 1, 1, 'Начальник', 'Начальнику УДАІ ГУМВС України в м. Києві', '', '', 'Управление УДАІ ГУМВС України в м. Києві', '', 'Адрес: вул. Богдана Хмельницького, 54, 01030', '044-272-46-59', '', 'http://www.sai.gov.ua', 0.00000000000, 0.00000000000, 0, 0, 1),
	(11, 'Киевская область', 11, 1, 1, 'Начальник', 'Начальнику УДАІ ГУМВС України у Київській області', '', '', 'Управление УДАІ ГУМВС України у Київській області', '', 'Адрес: ул.Ф.Эрнста, 3, г.Киев, 03153', '044-272-46-59', '', 'http://www.sai.gov.ua', 0.00000000000, 0.00000000000, 0, 0, 1),
	(12, 'Кировоградская область', 12, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Кировоградской области', '', '', 'УГАИ УМВД Украины в Кировоградской области', '', 'ул.Панфиловцев, 22-Б, г.Кировоград, 25030', '0522-35-75-33', '', 'http://sai.kr.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(13, 'Луганская область', 13, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Луганской области', '', '', 'УГАИ УМВД Украины в Луганской области', '', 'Ул.Линева, 150, г.Луганск, 91008', '0642-93-57-80', '', 'http://www.gai.lg.gov.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(14, 'Львовская область', 14, 1, 1, 'Начальник', 'Начальнику УГАИ ГУМВД Украины во Львовской области', '', '', 'УГАИ ГУМВД Украины во Львовской области', '', 'ул. Перфецкого, 19, г.Львов, 79053', '0322-64-69-41', '', 'http://dai.lviv.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(15, 'Николаевская область', 15, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Николаевской области', '', '', 'УГАИ УМВД Украины в Николаевской области', '', 'ул.Новозавоская, 1-Б, г.Николаев, 54056', '0512-21-20-91', '', 'http://www.gai.mk.ua/ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(16, 'Одесская область', 16, 1, 1, 'Начальник', 'Начальнику ОГАИ ГУМВД Украины в Одесской области', '', '', 'ОГАИ ГУМВД Украины в Одесской области', '', 'ул.А.Королева, 5, г.Одесса, 65114', '0482-30-17-53', '', 'http://www.saiodessa.gov.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(17, 'Полтавская область', 17, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Полтавской области', '', '', 'УГАИ УМВД Украины в Полтавской области', '', 'ул.Фрунзе, 164, г.Полтава, 36008', '0532-59-07-25', '', 'http://dai.poltava.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(18, 'Ровенская область', 18, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Ровенской области', '', '', 'УГАИ УМВД Украины в Ровенской области', '', 'ул.С.Бандеры, 14а, г.Ровно, 33028', '0362-63-58-21', '', 'http://udai.rv.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(19, 'Севастополь', 19, 1, 1, 'Начальник', 'Начальнику УГАИ ГУМВД Украины в АР Крым', '', '', 'УГАИ ГУМВД Украины в АР Крым', '', 'Ул.Киевская, 152 а, г.Симферополь,', '0652-55-01-61', '', 'http://ugaiark.arvo.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(20, 'Тернопольская область', 21, 1, 1, 'Начальник', 'Начальнику ОГАИ УМВД Украины в Тернопольской области', '', '', 'ОГАИ УМВД Украины в Тернопольской области', '', 'ул. Котляровского, 24, г.Тернополь, 46000', '0352-52-38-86', '', 'http://www.dai.te.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(21, 'Харьковская область', 22, 1, 1, 'Начальник', 'Начальнику УГАИ ГУМВД Украины в Харьковской области', '', '', 'УГАИ ГУМВД Украины в Харьковской области', '', 'ул.Шевченко, 26, г.Харьков, 61013', '057-704-15-81', '', 'http://www.gai.kharkov.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(22, 'Черкасская область', 25, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Черкасской области', '', '', 'УГАИ УМВД Украины в Черкасской области', '', 'ул.Л.Украинки,21, г.Черкассы, 18000', '0472-39-32-11', '', 'http://www.udai.ck.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(23, 'Черниговская область', 26, 1, 1, 'Начальник', 'Начальнику ОГАИ УМВД Украины в Черниговской области', '', '', 'ОГАИ УМВД Украины в Черниговской области', '', 'ул.Борисенко, 66, г.Чернигов, 14037', '04622-5-63-02', '', 'http://sai.cn.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(40, 'Хмельницкая область', 24, 1, 1, 'Начальник', 'Начальнику УГАИ УВМД Украины в Хмельницкой области', '', '', 'УГАИ УВМД Украины в Хмельницкой области', '', 'проул.Коцюбинского, 35/2, г.Хмельницкий, 29008', '0382-70-31-31', '', 'http://udai.km.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(58, 'Черновицкая область', 27, 1, 1, 'Начальник', 'Начальнику ОГАИ УМВД Украины в Черновицкой области', '', '', 'ОГАИ УМВД Украины в Черновицкой области', '', 'ул.Заводская, 22, г.Черновцы, 58007', '0372-55-05-13', '', 'http://www.udai.cv.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(73, 'Херсонская область', 23, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Херсонской области', '', '', 'УГАИ УМВД Украины в Херсонской области', '', 'ул.Сенявина, 128, г.Херсон, 73034', '0552-43-25-36', '', '', 0.00000000000, 0.00000000000, 0, 0, 1),
	(82, 'Сумская область', 20, 1, 1, 'Начальник', 'Начальнику УГАИ УМВД Украины в Сумской области', '', '', 'УГАИ УМВД Украины в Сумской области', '', 'ул.Белопольский путь, 18/1, г.Суммы, 40009', '0542-67-54-14', '', 'http://gaisumy.gov.ua/', 0.00000000000, 0.00000000000, 0, 0, 1),
	(83, 'ГАИ по Симферополю', 1, 0, 0, 'Начальник', 'Начальнику ОГАИ Симферопольского ГУ', 'Зуев Анатолий Васильевич', 'Зуеву Анатолию Васильевичу', 'ОГАИ Симферопольского ГУ', '', 'Крым автономная республика, Симферополь, улица Куйбышева, 7', '(0652) 550-161', '', '', 44.96111337738, 34.11047346890, 1371627649, 0, 4556),
	(84, 'ОГАИ Бахчисарайского РО', 0, 0, 0, 'Начальник', 'Начальник ОГАИ Бахчисарайского РО', 'Мажар Юрий Борисович', 'Мажар Юрию Борисовичу', 'ОГАИ Бахчисарайского РО', '', 'автономная республика Крым, Бахчисарайский район, Бахчисарай, Кооперативная улица', ' (06554) 4-17-72', '', '', 44.74584822187, 33.85197356343, 1372194281, 1372194802, 4619),
	(85, 'ГАИ по СИМФу', 0, 0, 0, 'Начальник управления ГАИ Главного управления МВД Украины в АР Крым', 'Начальнику управления ГАИ Главного управления МВД Украины в АР Крым', 'Загинайло Владимир Николаевич', 'Загинайло Владимиру Николаевичу', 'управлене ГАИ главное управление МВД Украины в АР Крым', '', 'АР Крым, Симферополь, ул. Киевская, 158', '(0652) 550-161', '', '', 44.98336711360, 34.08338315785, 1373149652, 0, 4686),
	(87, 'ГАИ УМВД в Севастополе', 19, 0, 0, 'Начальник', 'Начальнику Управления ГАИ УМВД Украины в г. Севастополь', 'Блаживский Иван Ильич', 'Блаживскому Ивану Ильичу', 'Управление ГАИ УМВД Украины в г. Севастополь', '', '99040 Севастополь, Гагаринский район, Промышленная улица, 1', '(0692)656660', '(0692)650683', '', 44.56894021777, 33.51727660827, 1374242664, 1374242961, 4792),
	(88, 'ГАИ по Севастополю', 0, 0, 0, 'Начальник', 'Начальнику Управления ГАИ УМВД Украины в г. Севастополь', 'Блаживский Иван Ильич', 'Блаживскому Ивану Ильичу', 'Управление ГАИ УМВД Украины в г. Севастополь', '', 'ул. Промышленная, 1, г. Севастополь Украина 99040', '(0692) 65-66-60, (050) 360-45-86, (050) 360-66-11', '(0692) 65-06-83', '', 0.00000000000, 0.00000000000, 1378112155, 0, 4994);
/*!40000 ALTER TABLE `yii_gibdd_heads_old` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_messengers_items
DROP TABLE IF EXISTS `yii_messengers_items`;
CREATE TABLE IF NOT EXISTS `yii_messengers_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Довідник месенджерів';

-- Dumping data for table ukryama_ukryama.yii_messengers_items: ~9 rows (approximately)
DELETE FROM `yii_messengers_items`;
/*!40000 ALTER TABLE `yii_messengers_items` DISABLE KEYS */;
INSERT INTO `yii_messengers_items` (`id`, `name`) VALUES
	(1, 'Email'),
	(2, 'WhatsApp'),
	(3, 'Telegram'),
	(4, 'Facebook'),
	(5, 'Twitter'),
	(6, 'Viber'),
	(7, 'VK'),
	(8, 'Instagram'),
	(9, 'Phone');
/*!40000 ALTER TABLE `yii_messengers_items` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_region
DROP TABLE IF EXISTS `yii_region`;
CREATE TABLE IF NOT EXISTS `yii_region` (
  `id` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `ref_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ukryama_ukryama.yii_region: ~607 rows (approximately)
DELETE FROM `yii_region`;
/*!40000 ALTER TABLE `yii_region` DISABLE KEYS */;
INSERT INTO `yii_region` (`id`, `lang`, `ref_id`, `name`) VALUES
	(1, 'ru', 0, 'Украина'),
	(1, 'ua', 0, 'Україна'),
	(2, 'ru', 1, 'АР Крым'),
	(2, 'ua', 1, 'АР Крим'),
	(3, 'ru', 1, 'Винницкая область'),
	(3, 'ua', 1, 'Вінницька область'),
	(4, 'ru', 1, 'Волынская область'),
	(4, 'ua', 1, 'Волинська область'),
	(5, 'ru', 1, 'Днепропетровская область'),
	(5, 'ua', 1, 'Дніпропетровська область'),
	(6, 'ru', 1, 'Донецкая область'),
	(6, 'ua', 1, 'Донецька область'),
	(7, 'ru', 1, 'Житомирская область'),
	(7, 'ua', 1, 'Житомирська область'),
	(8, 'ru', 1, 'Закарпатская область'),
	(8, 'ua', 1, 'Закарпатська область'),
	(9, 'ru', 1, 'Запорожская область'),
	(9, 'ua', 1, 'Запорізька область'),
	(10, 'ru', 1, 'Ивано-Франковская область'),
	(10, 'ua', 1, 'Івано-Франківська область'),
	(11, 'ru', 1, 'Киевская область'),
	(11, 'ua', 1, 'Київська область'),
	(12, 'ru', 1, 'Кировоградская область'),
	(12, 'ua', 1, 'Кіровоградська область'),
	(13, 'ru', 1, 'Луганская область'),
	(13, 'ua', 1, 'Луганська область'),
	(14, 'ru', 1, 'Львовская область'),
	(14, 'ua', 1, 'Львівська область'),
	(15, 'ru', 1, 'Николаевская область'),
	(15, 'ua', 1, 'Миколаївська область'),
	(16, 'ru', 1, 'Одесская область'),
	(16, 'ua', 1, 'Одеська область'),
	(17, 'ru', 1, 'Полтавская область'),
	(17, 'ua', 1, 'Полтавська область'),
	(18, 'ru', 1, 'Ровенская область'),
	(18, 'ua', 1, 'Рівненська область'),
	(19, 'ru', 1, 'Сумская область'),
	(19, 'ua', 1, 'Сумська область'),
	(20, 'ru', 1, 'Тернопольская область'),
	(20, 'ua', 1, 'Тернопільська область'),
	(21, 'ru', 1, 'Харьковская область'),
	(21, 'ua', 1, 'Харківська область'),
	(22, 'ru', 1, 'Херсонская область'),
	(22, 'ua', 1, 'Херсонська область'),
	(23, 'ru', 1, 'Хмельницкая область'),
	(23, 'ua', 1, 'Хмельницька область'),
	(24, 'ru', 1, 'Черкасская область'),
	(24, 'ua', 1, 'Черкаська область'),
	(25, 'ru', 1, 'Черниговская область'),
	(25, 'ua', 1, 'Чернігівська область'),
	(26, 'ru', 1, 'Черновицкая область'),
	(26, 'ua', 1, 'Чернівецька область'),
	(27, 'ru', 1, 'Севастополь'),
	(27, 'ua', 1, 'Севастополь'),
	(28, 'ru', 2, 'Симферополь'),
	(28, 'ua', 2, 'Симферополь'),
	(29, 'ru', 2, 'Армянск'),
	(29, 'ua', 2, 'Армянськ'),
	(30, 'ru', 2, 'Джанкой'),
	(30, 'ua', 2, 'Джанкой'),
	(31, 'ru', 2, 'Евпатория'),
	(31, 'ua', 2, 'Євпаторія'),
	(32, 'ru', 2, 'Зелёный Яр'),
	(32, 'ua', 2, 'Зелений Яр'),
	(33, 'ru', 2, 'Керчь'),
	(33, 'ua', 2, 'Керч'),
	(34, 'ru', 2, 'Красноперекопск'),
	(34, 'ua', 2, 'Красноперекопськ'),
	(35, 'ru', 2, 'Красносельское'),
	(35, 'ua', 2, 'Красносільське'),
	(36, 'ru', 2, 'Новосельское'),
	(36, 'ua', 2, 'Новосільське'),
	(37, 'ru', 2, 'Партенит'),
	(37, 'ua', 2, 'Партеніт'),
	(38, 'ru', 2, 'Плодовое'),
	(38, 'ua', 2, 'Плодове'),
	(39, 'ru', 2, 'Феодосия'),
	(39, 'ua', 2, 'Феодосія'),
	(40, 'ru', 2, 'Щёлкино'),
	(40, 'ua', 2, 'Щолкіне'),
	(41, 'ru', 2, 'Ялта'),
	(41, 'ua', 2, 'Ялта'),
	(42, 'ru', 3, 'Винница'),
	(42, 'ua', 3, 'Вінниця'),
	(43, 'ru', 3, 'Балановка'),
	(43, 'ua', 3, 'Баланівка'),
	(44, 'ru', 3, 'Ладыжин'),
	(44, 'ua', 3, 'Ладижин'),
	(45, 'ru', 4, 'Луцк'),
	(45, 'ua', 4, 'Луцьк'),
	(46, 'ru', 4, 'Владимир-Волынский'),
	(46, 'ua', 4, 'Володимир-Волинський'),
	(47, 'ru', 4, 'Ковель'),
	(47, 'ua', 4, 'Ковель'),
	(48, 'ru', 4, 'Нововолынск'),
	(48, 'ua', 4, 'Нововолинськ'),
	(49, 'ru', 5, 'Днепропетровск'),
	(49, 'ua', 5, 'Дніпропетровськ'),
	(50, 'ru', 5, 'Булаховка'),
	(50, 'ua', 5, 'Булахівка'),
	(51, 'ru', 5, 'Вовниги'),
	(51, 'ua', 5, 'Вовніги'),
	(52, 'ru', 5, 'Днепродзержинск'),
	(52, 'ua', 5, 'Дніпродзержинськ'),
	(53, 'ru', 5, 'Жёлтые Воды'),
	(53, 'ua', 5, 'Жовті Води'),
	(54, 'ru', 5, 'Зеленодольск'),
	(54, 'ua', 5, 'Зеленодольськ'),
	(55, 'ru', 5, 'Каменно-Зубиловка'),
	(55, 'ua', 5, 'Кам\'яно-Зубилівка'),
	(56, 'ru', 5, 'Кривой Рог'),
	(56, 'ua', 5, 'Кривий Ріг'),
	(57, 'ru', 5, 'Кринички'),
	(57, 'ua', 5, 'Кринички'),
	(58, 'ru', 5, 'Марганец'),
	(58, 'ua', 5, 'Марганець'),
	(59, 'ru', 5, 'Никополь'),
	(59, 'ua', 5, 'Нікополь'),
	(60, 'ru', 5, 'Новомосковск'),
	(60, 'ua', 5, 'Новомосковськ'),
	(61, 'ru', 5, 'Павлоград'),
	(61, 'ua', 5, 'Павлоград'),
	(62, 'ru', 6, 'Донецк'),
	(62, 'ua', 6, 'Донецьк'),
	(63, 'ru', 6, 'Авдеевка'),
	(63, 'ua', 6, 'Авдіївка'),
	(64, 'ru', 6, 'Андреевка'),
	(64, 'ua', 6, 'Андріївка'),
	(65, 'ru', 6, 'Артёмовск'),
	(65, 'ua', 6, 'Артемівськ'),
	(66, 'ru', 6, 'Безимянное'),
	(66, 'ua', 6, 'Безіменне'),
	(67, 'ru', 6, 'Белосарайская Коса'),
	(67, 'ua', 6, 'Бересток'),
	(68, 'ru', 6, 'Бересток'),
	(68, 'ua', 6, 'Білосарайська Коса'),
	(69, 'ru', 6, 'Волноваха'),
	(69, 'ua', 6, 'Волноваха'),
	(70, 'ru', 6, 'Горловка'),
	(70, 'ua', 6, 'Горлівка'),
	(71, 'ru', 6, 'Енакиево'),
	(71, 'ua', 6, 'Єнакієве'),
	(72, 'ru', 6, 'Зугрес'),
	(72, 'ua', 6, 'Зугрес'),
	(73, 'ru', 6, 'Константиновка'),
	(73, 'ua', 6, 'Костянтинівка'),
	(74, 'ru', 6, 'Краматорск'),
	(74, 'ua', 6, 'Краматорськ'),
	(75, 'ru', 6, 'Красноармейск'),
	(75, 'ua', 6, 'Красноармійськ'),
	(76, 'ru', 6, 'Курахово'),
	(76, 'ua', 6, 'Курахове'),
	(77, 'ru', 6, 'Макеевка'),
	(77, 'ua', 6, 'Макіївка'),
	(78, 'ru', 6, 'Мариуполь'),
	(78, 'ua', 6, 'Маріуполь'),
	(79, 'ru', 6, 'Николаевка'),
	(79, 'ua', 6, 'Миколаївка'),
	(80, 'ru', 6, 'Райгородок'),
	(80, 'ua', 6, 'Райгородок'),
	(81, 'ru', 6, 'Светлодарск'),
	(81, 'ua', 6, 'Світлодарськ'),
	(82, 'ru', 6, 'Святогорск'),
	(82, 'ua', 6, 'Святогірськ'),
	(83, 'ru', 6, 'Славянск'),
	(83, 'ua', 6, 'Слов\'янськ'),
	(84, 'ru', 6, 'Снежное'),
	(84, 'ua', 6, 'Сніжне'),
	(85, 'ru', 6, 'Торез'),
	(85, 'ua', 6, 'Торез'),
	(86, 'ru', 6, 'Шахтёрск'),
	(86, 'ua', 6, 'Шахтарськ'),
	(87, 'ru', 7, 'Житомир'),
	(87, 'ua', 7, 'Житомир'),
	(88, 'ru', 7, 'Андреевка'),
	(88, 'ua', 7, 'Андріївка'),
	(89, 'ru', 7, 'Бердичев'),
	(89, 'ua', 7, 'Бердичів'),
	(90, 'ru', 7, 'Коростень'),
	(90, 'ua', 7, 'Коростень'),
	(91, 'ru', 7, 'Новоград-Волынский'),
	(91, 'ua', 7, 'Новоград-Волинський'),
	(92, 'ru', 8, 'Ужгород'),
	(92, 'ua', 7, 'Олевск'),
	(93, 'ru', 8, 'Берегово'),
	(93, 'ua', 8, 'Ужгород'),
	(94, 'ru', 8, 'Виноградов'),
	(94, 'ua', 8, 'Берегове'),
	(95, 'ru', 8, 'Иршава'),
	(95, 'ua', 8, 'Виноградів'),
	(96, 'ru', 8, 'Мукачево'),
	(96, 'ua', 8, 'Іршава'),
	(97, 'ru', 8, 'Олевск'),
	(97, 'ua', 8, 'Мукачеве'),
	(98, 'ru', 8, 'Рахов'),
	(98, 'ua', 8, 'Рахів'),
	(99, 'ru', 8, 'Свалява'),
	(99, 'ua', 8, 'Свалява'),
	(100, 'ru', 8, 'Тячев'),
	(100, 'ua', 8, 'Тячів'),
	(101, 'ru', 8, 'Хуст'),
	(101, 'ua', 8, 'Хуст'),
	(102, 'ru', 9, 'Запорожье'),
	(102, 'ua', 9, 'Запоріжжя'),
	(103, 'ru', 9, 'Бердянск'),
	(103, 'ua', 9, 'Бердянськ'),
	(104, 'ru', 9, 'Днепрорудное'),
	(104, 'ua', 9, 'Дніпрорудне'),
	(105, 'ru', 9, 'Камыш-Заря'),
	(105, 'ua', 9, 'Комиш-Зоря'),
	(106, 'ru', 9, 'Мелитополь'),
	(106, 'ua', 9, 'Мелітополь'),
	(107, 'ru', 9, 'Токмак'),
	(107, 'ua', 9, 'Орлівське'),
	(108, 'ru', 9, 'Орловское'),
	(108, 'ua', 9, 'Приморський Посад'),
	(109, 'ru', 9, 'Приморский Посад'),
	(109, 'ua', 9, 'Токмак'),
	(110, 'ru', 9, 'Энергодар'),
	(110, 'ua', 9, 'Енергодар'),
	(111, 'ru', 10, 'Ивано-Франковск'),
	(111, 'ua', 10, 'Івано-Франківськ'),
	(112, 'ru', 10, 'Бурштын'),
	(112, 'ua', 10, 'Бурштин'),
	(113, 'ru', 10, 'Калуш'),
	(113, 'ua', 10, 'Калуш'),
	(114, 'ru', 10, 'Коломыя'),
	(114, 'ua', 10, 'Коломия'),
	(115, 'ru', 1, 'Киев'),
	(115, 'ua', 1, 'Київ'),
	(116, 'ru', 11, 'Белая Церковь'),
	(116, 'ua', 11, 'Біла Церква'),
	(117, 'ru', 11, 'Борисполь'),
	(117, 'ua', 11, 'Бориспіль'),
	(118, 'ru', 11, 'Бровары'),
	(118, 'ua', 11, 'Бровари'),
	(119, 'ru', 11, 'Вышгород'),
	(119, 'ua', 11, 'Вишгород'),
	(120, 'ru', 11, 'Ирпень'),
	(120, 'ua', 11, 'Ірпінь'),
	(121, 'ru', 11, 'Петропавловская Борщаговка'),
	(121, 'ua', 11, 'Петропавлівська Борщагівка'),
	(122, 'ru', 11, 'Припять'),
	(122, 'ua', 11, 'Прип\'ять'),
	(123, 'ru', 11, 'Украинка'),
	(123, 'ua', 11, 'Українка'),
	(124, 'ru', 12, 'Кировоград'),
	(124, 'ua', 12, 'Кіровоград'),
	(125, 'ru', 12, 'Александрия'),
	(125, 'ua', 12, 'Олександрія'),
	(126, 'ru', 13, 'Луганск'),
	(126, 'ua', 13, 'Луганськ'),
	(127, 'ru', 13, 'Алчевск'),
	(127, 'ua', 13, 'Алчевськ'),
	(128, 'ru', 13, 'Антрацит'),
	(128, 'ua', 13, 'Антрацит'),
	(129, 'ru', 13, 'Белолуцк'),
	(129, 'ua', 13, 'Білолуцьк'),
	(130, 'ru', 13, 'Верхнешевыревка'),
	(130, 'ua', 13, 'Верхньошевирівка'),
	(131, 'ru', 13, 'Ирмино'),
	(131, 'ua', 13, 'Ірміно'),
	(132, 'ru', 13, 'Краснодон'),
	(132, 'ua', 13, 'Краснодон'),
	(133, 'ru', 13, 'Красный Луч'),
	(133, 'ua', 13, 'Красний Луч'),
	(134, 'ru', 13, 'Лисичанск'),
	(134, 'ua', 13, 'Лисичанськ'),
	(135, 'ru', 13, 'Ровеньки'),
	(135, 'ua', 13, 'Ровеньки'),
	(136, 'ru', 13, 'Рубежное'),
	(136, 'ua', 13, 'Рубіжне'),
	(137, 'ru', 13, 'Свердловск'),
	(137, 'ua', 13, 'Свердловськ'),
	(138, 'ru', 13, 'Северодонецк'),
	(138, 'ua', 13, 'Сіверодонецьк'),
	(139, 'ru', 13, 'Старобельск'),
	(139, 'ua', 13, 'Старобільськ'),
	(140, 'ru', 13, 'Стаханов'),
	(140, 'ua', 13, 'Стаханов'),
	(141, 'ru', 13, 'Счастье'),
	(141, 'ua', 13, 'Чорнухине'),
	(142, 'ru', 13, 'Чернухино'),
	(142, 'ua', 13, 'Щастя'),
	(143, 'ru', 14, 'Львов'),
	(143, 'ua', 14, 'Львів'),
	(144, 'ru', 14, 'Дрогобыч'),
	(144, 'ua', 14, 'Дрогобич'),
	(145, 'ru', 14, 'Красное'),
	(145, 'ua', 14, 'Красне'),
	(146, 'ru', 14, 'Стрый'),
	(146, 'ua', 14, 'Стрий'),
	(147, 'ru', 14, 'Трускавец'),
	(147, 'ua', 14, 'Трускавець'),
	(148, 'ru', 14, 'Червоноград'),
	(148, 'ua', 14, 'Червоноград'),
	(149, 'ru', 15, 'Николаев'),
	(149, 'ua', 15, 'Миколаїв'),
	(150, 'ru', 15, 'Вознесенск'),
	(150, 'ua', 15, 'Вознесенськ'),
	(151, 'ru', 15, 'Дмитровка'),
	(151, 'ua', 15, 'Дмитрівка'),
	(152, 'ru', 15, 'Луч'),
	(152, 'ua', 15, 'Луч'),
	(153, 'ru', 15, 'Очаков'),
	(153, 'ua', 15, 'Очаків'),
	(154, 'ru', 15, 'Первомайск'),
	(154, 'ua', 15, 'Первомайськ'),
	(155, 'ru', 15, 'Тузлы'),
	(155, 'ua', 15, 'Тузли'),
	(156, 'ru', 15, 'Южноукраинск'),
	(156, 'ua', 15, 'Южноукраїнськ'),
	(157, 'ru', 16, 'Одесса'),
	(157, 'ua', 16, 'Одеса'),
	(158, 'ru', 16, 'Белгород-Днестровский'),
	(158, 'ua', 16, 'Білгород-Дністровський'),
	(159, 'ru', 16, 'Вестерничаны'),
	(159, 'ua', 16, 'Вестерничаны'),
	(160, 'ru', 16, 'Жовтень'),
	(160, 'ua', 16, 'Жовтень'),
	(161, 'ru', 16, 'Измаил'),
	(161, 'ua', 16, 'Ізмаїл'),
	(162, 'ru', 16, 'Ильичевск'),
	(162, 'ua', 16, 'Іллічівськ'),
	(163, 'ru', 16, 'Каменское'),
	(163, 'ua', 16, 'Кам\'янське'),
	(164, 'ru', 16, 'Ковалёвка'),
	(164, 'ua', 16, 'Ковалівка'),
	(165, 'ru', 16, 'Новокубанка'),
	(165, 'ua', 16, 'Новокубанка'),
	(166, 'ru', 16, 'Орловка'),
	(166, 'ua', 16, 'Орлівка'),
	(167, 'ru', 16, 'Петровка'),
	(167, 'ua', 16, 'Петрівка'),
	(168, 'ru', 16, 'Южный'),
	(168, 'ua', 16, 'Южне'),
	(169, 'ru', 17, 'Полтава'),
	(169, 'ua', 17, 'Полтава'),
	(170, 'ru', 17, 'Красногоровка'),
	(170, 'ua', 17, 'Красногорівка'),
	(171, 'ru', 17, 'Кременчуг'),
	(171, 'ua', 17, 'Кременчук'),
	(172, 'ru', 17, 'Лубны'),
	(172, 'ua', 17, 'Лубни'),
	(173, 'ru', 18, 'Ровно'),
	(173, 'ua', 18, 'Рівне'),
	(174, 'ru', 18, 'Антополь'),
	(174, 'ua', 18, 'Антопіль'),
	(175, 'ru', 18, 'Кузнецовск'),
	(175, 'ua', 18, 'Кузнецовськ'),
	(176, 'ru', 19, 'Сумы'),
	(176, 'ua', 19, 'Суми'),
	(177, 'ru', 19, 'Ахтырка'),
	(177, 'ua', 19, 'Білопілля'),
	(178, 'ru', 19, 'Белополье'),
	(178, 'ua', 19, 'Конотоп'),
	(179, 'ru', 19, 'Конотоп'),
	(179, 'ua', 19, 'Кролевець'),
	(180, 'ru', 19, 'Кролевец'),
	(180, 'ua', 19, 'Охтирка'),
	(181, 'ru', 19, 'Ромны'),
	(181, 'ua', 19, 'Ромни'),
	(182, 'ru', 19, 'Тростянец'),
	(182, 'ua', 19, 'Тростянец'),
	(183, 'ru', 19, 'Шостка'),
	(183, 'ua', 19, 'Шостка'),
	(184, 'ru', 20, 'Тернополь'),
	(184, 'ua', 20, 'Тернопіль'),
	(185, 'ru', 20, 'Лозовая'),
	(185, 'ua', 20, 'Лозова'),
	(186, 'ru', 21, 'Харьков'),
	(186, 'ua', 21, 'Харків'),
	(187, 'ru', 21, 'Барвенково'),
	(187, 'ua', 21, 'Барвінкове'),
	(188, 'ru', 21, 'Балаклея'),
	(188, 'ua', 21, 'Балаклія'),
	(189, 'ru', 21, 'Змиёв'),
	(189, 'ua', 21, 'Змиїв'),
	(190, 'ru', 21, 'Изюм'),
	(190, 'ua', 21, 'Ізюм'),
	(191, 'ru', 21, 'Кегичёвка'),
	(191, 'ua', 21, 'Кегичівка'),
	(192, 'ru', 21, 'Комсомольское'),
	(192, 'ua', 21, 'Комсомольське'),
	(193, 'ru', 21, 'Мерефа'),
	(193, 'ua', 21, 'Лозова'),
	(194, 'ru', 21, 'Лозовая'),
	(194, 'ua', 21, 'Мерефа'),
	(195, 'ru', 21, 'Подворки'),
	(195, 'ua', 21, 'Подвірки'),
	(196, 'ru', 21, 'Тарановка'),
	(196, 'ua', 21, 'Таранівка'),
	(197, 'ru', 22, 'Херсон'),
	(197, 'ua', 22, 'Херсон'),
	(198, 'ru', 22, 'Васильевка'),
	(198, 'ua', 22, 'Василівка'),
	(199, 'ru', 22, 'Геническ'),
	(199, 'ua', 22, 'Генічеськ'),
	(200, 'ru', 22, 'Большая Александровка'),
	(200, 'ua', 22, 'Велика Олександрівка'),
	(201, 'ru', 22, 'Новая Каховка'),
	(201, 'ua', 22, 'Нова Каховка'),
	(202, 'ru', 22, 'Новотроицкое'),
	(202, 'ua', 22, 'Новотроїцьке'),
	(203, 'ru', 22, 'Рыбальче'),
	(203, 'ua', 22, 'Рибальче'),
	(204, 'ru', 22, 'Чаплинка'),
	(204, 'ua', 22, 'Чаплинка'),
	(205, 'ru', 23, 'Хмельницкий'),
	(205, 'ua', 23, 'Хмельницький'),
	(206, 'ru', 23, 'Волочиск'),
	(206, 'ua', 23, 'Волочиськ'),
	(207, 'ru', 23, 'Каменец-Подольский'),
	(207, 'ua', 23, 'Кам\'янець-Подільський'),
	(208, 'ru', 23, 'Кульчиевцы'),
	(208, 'ua', 23, 'Кульчіївці'),
	(209, 'ru', 23, 'Нетешин'),
	(209, 'ua', 23, 'Нетішин'),
	(210, 'ru', 24, 'Черкассы'),
	(210, 'ua', 24, 'Черкаси'),
	(211, 'ru', 24, 'Буки'),
	(211, 'ua', 24, 'Буки'),
	(212, 'ru', 24, 'Канев'),
	(212, 'ua', 24, 'Канів'),
	(213, 'ru', 24, 'Смела'),
	(213, 'ua', 24, 'Сміла'),
	(214, 'ru', 24, 'Умань'),
	(214, 'ua', 24, 'Умань'),
	(215, 'ru', 25, 'Чернигов'),
	(215, 'ua', 25, 'Чернігів'),
	(216, 'ru', 25, 'Козелец'),
	(216, 'ua', 25, 'Бахмач'),
	(217, 'ru', 25, 'Бахмач'),
	(217, 'ua', 25, 'Козелець'),
	(218, 'ru', 25, 'Круты'),
	(218, 'ua', 25, 'Крути'),
	(219, 'ru', 25, 'Нежин'),
	(219, 'ua', 25, 'Ніжин'),
	(220, 'ru', 25, 'Новгород-Северский'),
	(220, 'ua', 25, 'Новгород-Сіверський'),
	(221, 'ru', 25, 'Прилуки'),
	(221, 'ua', 25, 'Прилуки'),
	(222, 'ru', 26, 'Черновцы'),
	(222, 'ua', 26, 'Чернівці'),
	(223, 'ru', 26, 'Новоднестровск'),
	(223, 'ua', 26, 'Новодністровськ'),
	(224, 'ru', 2, 'Алушта'),
	(224, 'ua', 2, 'Алушта'),
	(225, 'ru', 11, 'Васильков'),
	(225, 'ua', 11, 'Васильків');
/*!40000 ALTER TABLE `yii_region` ENABLE KEYS */;


-- Dumping structure for table ukryama_ukryama.yii_usergroups_group
DROP TABLE IF EXISTS `yii_usergroups_group`;
CREATE TABLE IF NOT EXISTS `yii_usergroups_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(6) DEFAULT NULL,
  `home` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groupname` (`groupname`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table ukryama_ukryama.yii_usergroups_group: ~5 rows (approximately)
DELETE FROM `yii_usergroups_group`;
/*!40000 ALTER TABLE `yii_usergroups_group` DISABLE KEYS */;
INSERT INTO `yii_usergroups_group` (`id`, `groupname`, `level`, `home`) VALUES
	(1, 'root', 100, NULL),
	(2, 'user', 1, '/holes/personal/'),
	(3, 'moder', 90, '/holes/index'),
	(4, 'AdvancedUser', 51, '/holes/personal/'),
	(5, 'admin', 99, '/holes/personal/');

/*!40000 ALTER TABLE `yii_usergroups_group` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
