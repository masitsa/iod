/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : iod

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-04-19 18:23:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) NOT NULL,
  `category_price` int(11) DEFAULT NULL,
  `category_status` int(11) NOT NULL DEFAULT '1',
  `category_image_name` varchar(50) NOT NULL,
  `category_preffix` varchar(11) NOT NULL,
  `category_parent` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Clothing', null, '1', '6ee90f74366f11c3cf1c1f590659a50c.png', 'CLT', '0', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('2', 'Household', null, '1', '71010921a8f1cd8417f052a8980440b2.png', 'HSH', '0', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('3', 'Face Towel', '15', '1', 'f17d508b2a5bd9cd1d9c894816004412.png', 'FT', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('4', 'Undergarment', '25', '0', '', 'UG', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('5', 'Socks', '25', '1', 'd9b050bbb1fd14a0b06823890ee18eb5.png', 'SNH', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('6', 'Blouse', '30', '1', 'e6d9dcac2d5f686f38f25d59a02dcfea.png', 'BLS', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('7', 'Petticoat', '30', '1', 'd159b49cf79a6e7185588223df29be9c.png', 'PTC', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('8', 'Shorts', '30', '1', 'ffcfd063b2f2d8d1b25f7827cc072bf4.png', 'SHT', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('9', 'Towel (large)', '30', '1', 'e9777931a688c60103d2d92675a9b855.png', 'TWL', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('10', 'Shirt', '40', '1', 'd5b335f38b87e753f165ba3d092ac933.png', 'SHR', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('11', 'Tshirt', '40', '1', '4f2fdab73a1de76451ec6d5744aa4687.png', 'TSH', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('12', 'Top', '40', '1', 'ab8d046fa90f59ced41c443e877f8d70.png', 'TOP', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('13', 'Skirt (small)', '40', '1', '6dc9baef8efcb17d9f7308ca312df854.png', 'SKT', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('14', 'Trouser', '45', '1', '14517538b2b8e410b8035c50fb0d25c8.png', 'TRS', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('15', 'Pyjama (set)', '45', '1', '6d0ab24a7210a9f5e3162c2c50a601ee.png', 'PJM', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('16', 'Jeans', '55', '1', '127d4b28a9a5f55614b13372776b6276.png', 'JNS', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('17', 'Skirt (large)', '55', '1', '81cabe9c7ecf36a25d53fa08a771bb5a.png', 'SKT', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('18', 'Bathrobe', '65', '1', 'cb6afd9b1b2d85f5c52cff2a00cd8242.png', 'BTH', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('19', 'Pillow Cover', '20', '1', 'f2a6c9b435cb8c5b2bcb7592643c681a.png', 'PLC', '2', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('20', 'Curtain Small', '50', '1', 'fcc2ffcef5ba722a8e1ca58c0cc2a905.png', 'CSM', '2', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('21', 'Bed Sheet/cover (sin', '65', '1', 'de1f14c26ccc87b7a1daa687b760cf37.png', 'BSC', '2', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('22', 'Bed Sheet/cover (dou', '70', '1', '26a64e85f87136720ee85975c241ec70.png', 'BSD', '2', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('23', 'Curtain Large', '80', '1', '181bbf1f0ded6a4d6262b35960237a69.png', 'CNL', '2', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('24', 'Curtain Xlarge', '110', '1', 'bb92bbce3ef245ebc35e40875cf4450d.png', 'CNX', '2', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('25', 'Blanket/quilt (singl', '320', '1', '4703423d779f303ddc1dba15caa209a8.png', 'BLN', '2', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');
INSERT INTO `category` VALUES ('26', 'Blanket/quilt (doubl', '400', '1', '071a396b37e1e27d0a2687269cfda07c.png', 'BND', '2', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8');

-- ----------------------------
-- Table structure for `contacts`
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `contacts_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `post_code` varchar(100) DEFAULT NULL,
  `building` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `motto` varchar(200) NOT NULL,
  `pintrest` varchar(200) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `floor` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `working_weekday` varchar(100) DEFAULT NULL,
  `working_weekend` varchar(100) DEFAULT NULL,
  `mission` text,
  `vision` text,
  `thumb` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `about` text,
  `objectives` text,
  `core_values` text,
  `site_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`contacts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES ('1', 'info@dobi.co.ke', '+25426200331', '70922', '00400', '', 'https://www.facebook.com/dobi', 'Dobi', 'b3ec4dde746b09c165e21e41b708b809.png', '0', '', 'Nairobi', '', '', '', '', 'We aim to create an online market place where buyers of spare parts can easily find their needs, compare products and get a quick link to the seller of the spare parts they require<br>', 'Our vision is to have an e Commerce platform for vehicle spare parts<br>', 'thumbnail_b3ec4dde746b09c165e21e41b708b809.png', '', '<span >An online marketplace that links buyers and sellers of automotive parts. Sellers can post parts and buyers can search/filter parts which they are seeking.</span>', '<br>', '<br>', 'Autospares.co.ke');

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer_postal_code` varchar(255) DEFAULT NULL,
  `customer_postal_address` varchar(255) DEFAULT NULL,
  `customer_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer_activated` tinyint(1) NOT NULL DEFAULT '1',
  `customer_first_name` varchar(100) NOT NULL,
  `customer_surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_phone` varchar(50) NOT NULL,
  `neighbourhood_id` int(11) DEFAULT NULL,
  `customer_status` tinyint(1) NOT NULL DEFAULT '1',
  `registration_method_id` int(11) DEFAULT NULL,
  `customer_title` varchar(5) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `company_physical_address` varchar(255) DEFAULT NULL,
  `company_postal_address` varchar(255) DEFAULT NULL,
  `company_post_code` varchar(255) DEFAULT NULL,
  `company_town` varchar(255) DEFAULT NULL,
  `company_phone` varchar(255) DEFAULT NULL,
  `company_facsimile` varchar(255) DEFAULT NULL,
  `company_cell_phone` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_activity` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'jsnabangi@gmail.com', '1', 'James', 'Sudi', '2016-04-15 11:39:34', '2016-04-14 17:55:00', '2016-04-15 12:39:34', '0726149351', null, '1', '1', 'Mr', '0000-00-00', 'Kenyan', 'Bsc. Business and Information Technology', 'Manager', 'IOD', 'Westlands', '70922', '00400', 'Nairobi', '0205789547', '0123456', '0774834466', 'info@iod.com', 'IT');

-- ----------------------------
-- Table structure for `dobi`
-- ----------------------------
DROP TABLE IF EXISTS `dobi`;
CREATE TABLE `dobi` (
  `dobi_id` int(11) NOT NULL AUTO_INCREMENT,
  `dobi_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dobi_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dobi_activated` tinyint(1) NOT NULL DEFAULT '1',
  `dobi_first_name` varchar(100) NOT NULL,
  `dobi_surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dobi_phone` varchar(50) NOT NULL,
  `neighbourhood_id` int(11) DEFAULT NULL,
  `dobi_status` tinyint(1) NOT NULL DEFAULT '1',
  `registration_method_id` int(11) DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT NULL,
  `bank_name` varchar(20) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `mpesa_number` varchar(20) DEFAULT NULL,
  `fold` tinyint(4) NOT NULL DEFAULT '0',
  `iron` tinyint(4) NOT NULL DEFAULT '0',
  `deliver` tinyint(4) NOT NULL DEFAULT '0',
  `availability` tinyint(1) NOT NULL DEFAULT '0',
  `fold_cost` float NOT NULL DEFAULT '0',
  `iron_cost` float NOT NULL DEFAULT '0',
  `delivery_cost` float NOT NULL DEFAULT '0',
  `location` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `estate` varchar(100) DEFAULT NULL,
  `house` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dobi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dobi
-- ----------------------------
INSERT INTO `dobi` VALUES ('2', 'e10adc3949ba59abbe56e057f20f883e', 'alvaromasitsa104@gmail.com', '1', 'Alvaro', 'Masitsa', '2015-10-08 10:04:12', '2015-07-25 11:25:58', '2015-10-08 11:04:12', '0726149351', '48', '1', '1', '2', 'Chase Bank', 'Alvaro Masitsa', '123456789', null, '0', '1', '0', '1', '0', '200', '0', 'adf', 'asdf', 'asdfg', 'adsfd', '-1.32906', '36.80147299999999');
INSERT INTO `dobi` VALUES ('5', 'e10adc3949ba59abbe56e057f20f883e', 'tkaruga7@gmail.com', '1', 'Terry', 'Karuga', '2015-10-08 09:35:11', '2015-09-04 07:13:00', '2015-10-08 10:36:15', '0707775588', '45', '0', '1', '1', null, null, null, '0726149351', '0', '0', '0', '1', '0', '0', '0', null, null, null, null, '-1.3234549937191467', '36.82243369737546');
INSERT INTO `dobi` VALUES ('6', 'e10adc3949ba59abbe56e057f20f883e', 'shirowainaina@gmail.com', '1', 'Ivy', 'Wainaina', null, '2015-09-07 16:44:24', '2015-11-05 18:10:39', '0705815915', '95', '1', '1', '1', null, null, null, '0726149351', '0', '0', '0', '0', '0', '0', '0', 'Galana Road Kilimani', 'free', 'free', '12', null, null);
INSERT INTO `dobi` VALUES ('7', 'e10adc3949ba59abbe56e057f20f883e', 'alvaro@serenityservices.co.ke', '1', 'Alvaro', 'Masitsa', null, '2015-10-07 09:49:32', '2015-10-07 10:49:32', '0726149351', null, '0', '1', null, null, null, null, null, '0', '0', '0', '0', '0', '0', '0', null, null, null, null, null, null);
INSERT INTO `dobi` VALUES ('8', 'e10adc3949ba59abbe56e057f20f883e', 'tkaruga78@gmail.com', '1', 'Alvaro', 'Masitsa', '2015-10-07 15:27:45', '2015-10-07 10:06:50', '2015-10-07 16:34:41', '0707775588', null, '0', '1', '1', null, null, null, '0726149351', '0', '0', '0', '1', '0', '0', '0', null, null, null, null, '-1.3259766540063636', '36.78137952380371');

-- ----------------------------
-- Table structure for `document_upload`
-- ----------------------------
DROP TABLE IF EXISTS `document_upload`;
CREATE TABLE `document_upload` (
  `document_upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(255) DEFAULT NULL,
  `document_upload_name` varchar(255) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `document_status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`document_upload_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of document_upload
-- ----------------------------
INSERT INTO `document_upload` VALUES ('6', 'CV', '2ed18acc944362f4bf69fd2aaa6d92bb.png', '1', '1', '1', '2016-04-15 12:18:26', '1', null);

-- ----------------------------
-- Table structure for `email`
-- ----------------------------
DROP TABLE IF EXISTS `email`;
CREATE TABLE `email` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_content` text,
  `email_status` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of email
-- ----------------------------

-- ----------------------------
-- Table structure for `email_category`
-- ----------------------------
DROP TABLE IF EXISTS `email_category`;
CREATE TABLE `email_category` (
  `email_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`email_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of email_category
-- ----------------------------

-- ----------------------------
-- Table structure for `invoice`
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_date` date DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `invoice_status` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_number` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of invoice
-- ----------------------------
INSERT INTO `invoice` VALUES ('1', '2016-04-14', '1', '2016-04-14 17:55:00', '0', 'IOD/INV/16-000001');
INSERT INTO `invoice` VALUES ('2', '2016-04-19', '7', '2016-04-19 16:12:37', '0', 'IOD/INV/16-000002');

-- ----------------------------
-- Table structure for `invoice_item`
-- ----------------------------
DROP TABLE IF EXISTS `invoice_item`;
CREATE TABLE `invoice_item` (
  `invoice_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_item_amount` double DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `invoice_item_description` text,
  PRIMARY KEY (`invoice_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of invoice_item
-- ----------------------------
INSERT INTO `invoice_item` VALUES ('1', '3000', '1', 'Entrance Fee');
INSERT INTO `invoice_item` VALUES ('2', '12000', '1', 'Annual subscription');
INSERT INTO `invoice_item` VALUES ('3', '3000', '2', 'Entrance Fee');
INSERT INTO `invoice_item` VALUES ('4', '12000', '2', 'Annual subscription');
INSERT INTO `invoice_item` VALUES ('5', '3000', '3', 'Entrance Fee');
INSERT INTO `invoice_item` VALUES ('6', '12000', '3', 'Annual subscription');

-- ----------------------------
-- Table structure for `invoice_status`
-- ----------------------------
DROP TABLE IF EXISTS `invoice_status`;
CREATE TABLE `invoice_status` (
  `invoice_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_status_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`invoice_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of invoice_status
-- ----------------------------
INSERT INTO `invoice_status` VALUES ('1', 'Completed');
INSERT INTO `invoice_status` VALUES ('2', 'Cancelled');
INSERT INTO `invoice_status` VALUES ('3', 'Disabled');
INSERT INTO `invoice_status` VALUES ('8', 'Paid');
INSERT INTO `invoice_status` VALUES ('4', 'Saved');
INSERT INTO `invoice_status` VALUES ('6', 'Cancel request');
INSERT INTO `invoice_status` VALUES ('0', 'Unpaid');

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `member_postal_code` varchar(255) DEFAULT NULL,
  `member_postal_address` varchar(255) DEFAULT NULL,
  `member_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `member_activated` tinyint(1) NOT NULL DEFAULT '1',
  `member_first_name` varchar(100) NOT NULL,
  `member_surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `member_phone` varchar(50) NOT NULL,
  `neighbourhood_id` int(11) DEFAULT NULL,
  `member_status` tinyint(1) NOT NULL DEFAULT '1',
  `registration_method_id` int(11) DEFAULT NULL,
  `member_title` varchar(5) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `company_physical_address` varchar(255) DEFAULT NULL,
  `company_postal_address` varchar(255) DEFAULT NULL,
  `company_post_code` varchar(255) DEFAULT NULL,
  `company_town` varchar(255) DEFAULT NULL,
  `company_phone` varchar(255) DEFAULT NULL,
  `company_facsimile` varchar(255) DEFAULT NULL,
  `company_cell_phone` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_activity` varchar(255) DEFAULT NULL,
  `member_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'jsnabangi@gmail.com', '1', 'James', 'Sudi', '2016-04-15 11:39:34', '2016-04-14 17:55:00', '2016-04-15 12:39:34', '0726149351', null, '1', '1', 'Mr', '0000-00-00', 'Kenyan', 'Bsc. Business and Information Technology', 'Manager', 'IOD', 'Westlands', '70922', '00400', 'Nairobi', '0205789547', '0123456', '0774834466', 'info@iod.com', 'IT', null);
INSERT INTO `member` VALUES ('2', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'laura.kaisha@gmail.com', '1', 'Laura', 'Kaisha', null, '2016-04-19 15:41:11', '2016-04-19 17:36:00', '123', null, '1', null, 'New', '1990-10-20', 'Kenyan', 'Bsc', 'Director', 'Quadrant', 'Kilimani', '1', '5', 'Nrb', '1', '5', '1', 'info@1.com', 'Marketing', 'MIoD001');
INSERT INTO `member` VALUES ('3', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'puritymonje@gmail.com', '1', 'Purity', 'Monje', null, '2016-04-19 15:41:11', '2016-04-19 17:36:07', '456', null, '1', null, 'Old', '1992-10-20', 'Tanzanian', 'MH', 'MD', 'Omnis', 'Westlands', '2', '6', 'Wst', '2', '6', '2', 'info@2.com', 'Manufacture', 'MIoD002');
INSERT INTO `member` VALUES ('4', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'marttkip@gmail.com', '1', 'Martin ', 'Tarus', null, '2016-04-19 15:41:12', '2016-04-19 17:36:10', '789', null, '1', null, 'Aged', '1989-10-21', 'Rwandese', 'ds', 'Manager', '1809', 'Nairobi', '3', '7', 'Kia', '3', '7', '3', 'info@3.com', 'Service', 'MIoD003');
INSERT INTO `member` VALUES ('5', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'alvaromasitsa104@gmail.com', '1', 'Alvaro ', 'Masitsa', null, '2016-04-19 15:41:12', '2016-04-19 17:36:17', '101', null, '1', null, 'Sense', '1989-10-20', 'Morocoan', 'as', 'Intern', 'BLAK', 'Naivasha', '4', '8', 'High', '4', '8', '4', 'info@4.com', 'Entertainment', 'MIoD004');
INSERT INTO `member` VALUES ('8', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'hillary@gmail.com', '1', 'Hillary', 'Olach', '2016-04-19 17:21:15', '2016-04-19 16:22:59', '2016-04-19 18:21:15', '0726589756', null, '1', '1', 'Finan', '0000-00-00', 'Kenyan', 'BA. Bcom', 'Finance D', 'IMC', 'Westlands', '70922', '00400', 'Nairobi', '0205789547', '0123456', '0774834466', 'info@iod.com', 'IT', 'MIoD000');

-- ----------------------------
-- Table structure for `module`
-- ----------------------------
DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) DEFAULT NULL,
  `module_status` tinyint(1) NOT NULL DEFAULT '1',
  `module_parent` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `module_user` tinyint(4) DEFAULT '1',
  `module_icon` varchar(20) DEFAULT NULL,
  `module_position` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of module
-- ----------------------------
INSERT INTO `module` VALUES ('1', 'Users', '1', '0', '2015-07-28 11:19:00', '2015-07-28 13:43:12', '8', '8', '1', 'user', '2');
INSERT INTO `module` VALUES ('2', 'Company profile', '1', '0', '2015-07-28 11:19:00', '2015-07-28 13:43:14', '8', '8', '1', null, '3');
INSERT INTO `module` VALUES ('3', 'Website content', '1', '0', '2015-07-28 11:19:00', '2015-07-28 13:43:23', '8', '8', '1', null, '4');
INSERT INTO `module` VALUES ('4', 'Gallery', '1', '3', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('5', 'Slideshow', '1', '3', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('6', 'Blog', '1', '0', '2015-07-28 11:19:00', '2015-07-28 13:43:34', '8', '8', '1', null, '6');
INSERT INTO `module` VALUES ('7', 'Posts', '1', '6', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('8', 'Categories', '1', '6', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('9', 'Comments', '1', '6', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('10', 'Administrators', '1', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('11', 'Dobis', '1', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('12', 'Customers', '1', '1', '2015-07-28 11:19:00', '2015-07-28 11:19:00', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('13', 'Orders', '1', '0', '2015-07-28 11:19:00', '2015-07-28 13:43:37', '8', '8', '1', null, '6');
INSERT INTO `module` VALUES ('14', 'Dashboard', '1', '0', '2015-07-28 11:19:00', '2015-07-28 13:43:10', '8', '8', '1', 'home', '1');
INSERT INTO `module` VALUES ('15', 'Categories', '1', '3', '2015-07-28 14:28:49', '2015-07-28 14:29:08', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('16', 'Administration', '1', '0', '2015-08-20 08:24:47', '2015-08-20 16:55:40', '8', '8', '1', 'user', '1');
INSERT INTO `module` VALUES ('17', 'Sections', '1', '16', '2015-08-20 09:24:34', '2015-08-20 16:56:21', '8', '8', '1', null, null);
INSERT INTO `module` VALUES ('18', 'Accounts', '1', '0', '2015-08-20 16:04:37', '2015-08-20 17:07:15', '0', '0', '1', 'money', '3');
INSERT INTO `module` VALUES ('19', 'Accounts Receivable', '1', '18', '2015-08-20 16:07:45', '2015-08-20 17:07:45', '0', '0', '1', '', '1');
INSERT INTO `module` VALUES ('20', 'Accounts Payable', '1', '18', '2015-08-20 16:07:59', '2015-08-20 17:07:59', '0', '0', '1', '', '2');
INSERT INTO `module` VALUES ('21', 'Receipts', '1', '18', '2015-08-20 18:33:02', '2015-08-20 19:33:02', '0', '0', '1', '', '3');

-- ----------------------------
-- Table structure for `mpesa_code`
-- ----------------------------
DROP TABLE IF EXISTS `mpesa_code`;
CREATE TABLE `mpesa_code` (
  `mpesa_code_id` int(11) NOT NULL AUTO_INCREMENT,
  `mpesa_code_status` tinyint(4) NOT NULL DEFAULT '0',
  `transaction_timestamp` varchar(100) NOT NULL,
  `transaction_type` varchar(50) NOT NULL,
  `transaction_reference` varchar(50) NOT NULL,
  `sender_phone` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`mpesa_code_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mpesa_code
-- ----------------------------
INSERT INTO `mpesa_code` VALUES ('1', '1', '', '', '111111', '', '', '', '', '', '', null);

-- ----------------------------
-- Table structure for `neighbourhood`
-- ----------------------------
DROP TABLE IF EXISTS `neighbourhood`;
CREATE TABLE `neighbourhood` (
  `neighbourhood_id` int(11) NOT NULL AUTO_INCREMENT,
  `neighbourhood_name` varchar(30) NOT NULL,
  `neighbourhood_status` tinyint(1) NOT NULL DEFAULT '1',
  `neighbourhood_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`neighbourhood_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of neighbourhood
-- ----------------------------
INSERT INTO `neighbourhood` VALUES ('1', 'Westlands', '1', null);
INSERT INTO `neighbourhood` VALUES ('2', 'Dagoretti North', '1', null);
INSERT INTO `neighbourhood` VALUES ('3', 'Dagoretti South', '1', null);
INSERT INTO `neighbourhood` VALUES ('4', 'Langata', '1', null);
INSERT INTO `neighbourhood` VALUES ('5', 'Kibera', '1', null);
INSERT INTO `neighbourhood` VALUES ('6', 'Roysambu', '1', null);
INSERT INTO `neighbourhood` VALUES ('7', 'Kasarani', '1', null);
INSERT INTO `neighbourhood` VALUES ('8', 'Ruaraka', '1', null);
INSERT INTO `neighbourhood` VALUES ('9', 'Embakasi South', '1', null);
INSERT INTO `neighbourhood` VALUES ('10', 'Embakasi North', '1', null);
INSERT INTO `neighbourhood` VALUES ('11', 'Embakasi Central', '1', null);
INSERT INTO `neighbourhood` VALUES ('12', 'Embakasi East', '1', null);
INSERT INTO `neighbourhood` VALUES ('13', 'Embakasi West', '1', null);
INSERT INTO `neighbourhood` VALUES ('14', 'Makadara', '1', null);
INSERT INTO `neighbourhood` VALUES ('15', 'Kamukunji', '1', null);
INSERT INTO `neighbourhood` VALUES ('16', 'Starehe', '1', null);
INSERT INTO `neighbourhood` VALUES ('17', 'Mathare', '1', null);
INSERT INTO `neighbourhood` VALUES ('18', 'Kitusuru', '1', '1');
INSERT INTO `neighbourhood` VALUES ('19', 'Parklands/Highridge', '1', '1');
INSERT INTO `neighbourhood` VALUES ('20', 'Karura', '1', '1');
INSERT INTO `neighbourhood` VALUES ('21', 'Kangemi', '1', '1');
INSERT INTO `neighbourhood` VALUES ('22', 'Mountain View', '1', '2');
INSERT INTO `neighbourhood` VALUES ('23', 'Kilimani', '1', '2');
INSERT INTO `neighbourhood` VALUES ('24', 'Kawangware', '1', '2');
INSERT INTO `neighbourhood` VALUES ('25', 'Gatina', '1', '2');
INSERT INTO `neighbourhood` VALUES ('26', 'Kileleshwa', '1', '2');
INSERT INTO `neighbourhood` VALUES ('27', 'Kabiro', '1', '2');
INSERT INTO `neighbourhood` VALUES ('28', 'Mutuini', '1', '3');
INSERT INTO `neighbourhood` VALUES ('29', 'Ngando', '1', '3');
INSERT INTO `neighbourhood` VALUES ('30', 'Riruta', '1', '3');
INSERT INTO `neighbourhood` VALUES ('31', 'Uthiru', '1', '3');
INSERT INTO `neighbourhood` VALUES ('32', 'Waithaka', '1', '3');
INSERT INTO `neighbourhood` VALUES ('33', 'Karen', '1', '4');
INSERT INTO `neighbourhood` VALUES ('34', 'Nairobi West', '1', '4');
INSERT INTO `neighbourhood` VALUES ('35', 'Mugumoini', '1', '4');
INSERT INTO `neighbourhood` VALUES ('36', 'South C', '1', '4');
INSERT INTO `neighbourhood` VALUES ('37', 'Nyayo Highrise', '1', '4');
INSERT INTO `neighbourhood` VALUES ('38', 'Laini Saba', '1', '5');
INSERT INTO `neighbourhood` VALUES ('39', 'Lindi', '1', '5');
INSERT INTO `neighbourhood` VALUES ('40', 'Makina', '1', '5');
INSERT INTO `neighbourhood` VALUES ('41', 'Kenyatta Golf Course ', '1', '5');
INSERT INTO `neighbourhood` VALUES ('42', 'Sarang\'ombe', '1', '5');
INSERT INTO `neighbourhood` VALUES ('43', 'Githurai', '1', '6');
INSERT INTO `neighbourhood` VALUES ('44', 'Kahawa West', '1', '6');
INSERT INTO `neighbourhood` VALUES ('45', 'Zimmermann', '1', '6');
INSERT INTO `neighbourhood` VALUES ('46', 'Roysambu Ward', '1', '6');
INSERT INTO `neighbourhood` VALUES ('47', 'Kahawa', '1', '6');
INSERT INTO `neighbourhood` VALUES ('48', 'Clay City', '1', '7');
INSERT INTO `neighbourhood` VALUES ('49', 'Mwiki', '1', '7');
INSERT INTO `neighbourhood` VALUES ('50', 'Kasarani Ward', '1', '7');
INSERT INTO `neighbourhood` VALUES ('51', 'Njiru', '1', '7');
INSERT INTO `neighbourhood` VALUES ('52', 'Ruai', '1', '7');
INSERT INTO `neighbourhood` VALUES ('53', 'Babadogo', '1', '8');
INSERT INTO `neighbourhood` VALUES ('54', 'Utalii', '1', '8');
INSERT INTO `neighbourhood` VALUES ('55', 'Mathare North', '1', '8');
INSERT INTO `neighbourhood` VALUES ('56', 'Lucky Summer', '1', '8');
INSERT INTO `neighbourhood` VALUES ('57', 'Korogocho', '1', '8');
INSERT INTO `neighbourhood` VALUES ('58', 'Imara Daima', '1', '9');
INSERT INTO `neighbourhood` VALUES ('59', 'Kwa Njenga', '1', '9');
INSERT INTO `neighbourhood` VALUES ('60', 'Kwa Reuben', '1', '9');
INSERT INTO `neighbourhood` VALUES ('61', 'Pipeline', '1', '9');
INSERT INTO `neighbourhood` VALUES ('62', 'Kware', '1', '9');
INSERT INTO `neighbourhood` VALUES ('63', 'Kariobangi North', '1', '10');
INSERT INTO `neighbourhood` VALUES ('64', 'Dandora Area I', '1', '10');
INSERT INTO `neighbourhood` VALUES ('65', 'Dandora Area II', '1', '10');
INSERT INTO `neighbourhood` VALUES ('66', 'Dandora Area III', '1', '10');
INSERT INTO `neighbourhood` VALUES ('67', 'Dandora Area IV', '1', '10');
INSERT INTO `neighbourhood` VALUES ('68', 'Kayole North', '1', '11');
INSERT INTO `neighbourhood` VALUES ('69', 'Kayole NorthCentral', '1', '11');
INSERT INTO `neighbourhood` VALUES ('70', 'Kayole South', '1', '11');
INSERT INTO `neighbourhood` VALUES ('71', 'Komarock', '1', '11');
INSERT INTO `neighbourhood` VALUES ('72', 'Matopeni', '1', '11');
INSERT INTO `neighbourhood` VALUES ('73', 'Upper Savanna', '1', '12');
INSERT INTO `neighbourhood` VALUES ('74', 'Lower Savanna ', '1', '12');
INSERT INTO `neighbourhood` VALUES ('75', 'Embakasi', '1', '12');
INSERT INTO `neighbourhood` VALUES ('76', 'Utawala', '1', '12');
INSERT INTO `neighbourhood` VALUES ('77', 'Mihang\'o', '1', '12');
INSERT INTO `neighbourhood` VALUES ('78', 'Umoja I', '1', '13');
INSERT INTO `neighbourhood` VALUES ('79', 'Umoja II', '1', '13');
INSERT INTO `neighbourhood` VALUES ('80', 'Mowlem', '1', '13');
INSERT INTO `neighbourhood` VALUES ('81', 'Kariobangi South ', '1', '13');
INSERT INTO `neighbourhood` VALUES ('82', 'Maringo', '1', '14');
INSERT INTO `neighbourhood` VALUES ('83', 'Viwandani', '1', '14');
INSERT INTO `neighbourhood` VALUES ('84', 'Harambee', '1', '14');
INSERT INTO `neighbourhood` VALUES ('85', 'Makongeni', '1', '14');
INSERT INTO `neighbourhood` VALUES ('86', 'Pumwani', '1', '15');
INSERT INTO `neighbourhood` VALUES ('87', 'Eastleigh North', '1', '15');
INSERT INTO `neighbourhood` VALUES ('88', 'Eastleigh South', '1', '15');
INSERT INTO `neighbourhood` VALUES ('89', 'Airbase', '1', '15');
INSERT INTO `neighbourhood` VALUES ('90', 'California', '1', '15');
INSERT INTO `neighbourhood` VALUES ('91', 'Nairobi', '1', '16');
INSERT INTO `neighbourhood` VALUES ('92', 'Ngara', '1', '16');
INSERT INTO `neighbourhood` VALUES ('93', 'Pangani', '1', '16');
INSERT INTO `neighbourhood` VALUES ('94', 'Kariokor', '1', '16');
INSERT INTO `neighbourhood` VALUES ('95', 'Landimawe', '1', '16');
INSERT INTO `neighbourhood` VALUES ('96', 'Nairobi South', '1', '16');
INSERT INTO `neighbourhood` VALUES ('97', 'Hospital', '1', '17');
INSERT INTO `neighbourhood` VALUES ('98', 'Mabatini', '1', '17');
INSERT INTO `neighbourhood` VALUES ('99', 'Huruma', '1', '17');
INSERT INTO `neighbourhood` VALUES ('100', 'Ngei', '1', '17');
INSERT INTO `neighbourhood` VALUES ('101', 'Mlango Kubwa', '1', '17');
INSERT INTO `neighbourhood` VALUES ('102', 'Kiamaiko', '1', '17');

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_created` datetime DEFAULT NULL,
  `order_last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_id` int(11) DEFAULT NULL,
  `order_status_id` int(11) DEFAULT '0',
  `order_number` varchar(20) NOT NULL,
  `order_instructions` text NOT NULL,
  `payment_method_id` int(11) NOT NULL DEFAULT '1',
  `dobi_id` int(11) DEFAULT NULL,
  `fold` tinyint(4) DEFAULT NULL,
  `fold_cost` float DEFAULT NULL,
  `iron` tinyint(4) DEFAULT NULL,
  `iron_cost` float DEFAULT NULL,
  `deliver` tinyint(4) DEFAULT NULL,
  `delivery_cost` float DEFAULT NULL,
  `transaction_tracking_id` varchar(100) DEFAULT NULL,
  `transaction_timestamp` varchar(30) DEFAULT NULL,
  `transaction_type` varchar(20) DEFAULT NULL,
  `sender_phone` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `payment_status` tinyint(4) NOT NULL DEFAULT '1',
  `mpesa_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '2015-09-01 12:48:20', '2015-09-01 13:48:31', '1', '7', 'ORD15-000001', '0', '1', '2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', '123456');
INSERT INTO `orders` VALUES ('2', '2015-09-01 12:51:11', '2015-09-07 19:24:31', '1', '0', 'ORD15-000002', '0', '1', '2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '4', '111111');
INSERT INTO `orders` VALUES ('3', '2015-09-04 07:19:41', '2015-09-04 08:19:41', '1', '4', 'ORD15-000003', 'lkdsjflasdfja', '1', '5', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', null);
INSERT INTO `orders` VALUES ('4', '2015-09-07 08:04:08', '2015-09-07 09:04:23', '1', '7', 'ORD15-000004', '0', '1', '2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', 'LLOOLLLL');
INSERT INTO `orders` VALUES ('5', '2015-09-07 18:15:53', '2015-09-07 19:15:53', '1', '4', 'ORD15-000005', '0', '1', '2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', null);

-- ----------------------------
-- Table structure for `order_item`
-- ----------------------------
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `order_item_quantity` int(11) DEFAULT NULL,
  `order_item_price` float DEFAULT NULL,
  `order_item_status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`order_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_item
-- ----------------------------
INSERT INTO `order_item` VALUES ('1', '1', '22', '1', '70', '1');
INSERT INTO `order_item` VALUES ('2', '2', '26', '1', '400', '1');
INSERT INTO `order_item` VALUES ('3', '3', '22', '1', '70', '1');
INSERT INTO `order_item` VALUES ('4', '4', '26', '2', '400', '1');
INSERT INTO `order_item` VALUES ('5', '4', '25', '1', '320', '1');
INSERT INTO `order_item` VALUES ('6', '4', '24', '1', '110', '1');
INSERT INTO `order_item` VALUES ('7', '5', '26', '1', '400', '1');

-- ----------------------------
-- Table structure for `order_status`
-- ----------------------------
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_status
-- ----------------------------
INSERT INTO `order_status` VALUES ('1', 'Completed');
INSERT INTO `order_status` VALUES ('2', 'Cancelled');
INSERT INTO `order_status` VALUES ('3', 'Disabled');
INSERT INTO `order_status` VALUES ('8', 'Paid');
INSERT INTO `order_status` VALUES ('4', 'Saved');
INSERT INTO `order_status` VALUES ('6', 'Cancel request');
INSERT INTO `order_status` VALUES ('7', 'Pending payment confirmation');

-- ----------------------------
-- Table structure for `payment_method`
-- ----------------------------
DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(20) NOT NULL,
  `payment_method_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_method
-- ----------------------------
INSERT INTO `payment_method` VALUES ('1', 'Mpesa', '1');
INSERT INTO `payment_method` VALUES ('2', 'Pesapal', '1');

-- ----------------------------
-- Table structure for `payment_type`
-- ----------------------------
DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(20) NOT NULL,
  `payment_type_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_type
-- ----------------------------
INSERT INTO `payment_type` VALUES ('1', 'Mpesa', '1');
INSERT INTO `payment_type` VALUES ('2', 'Bank', '1');

-- ----------------------------
-- Table structure for `registration_method`
-- ----------------------------
DROP TABLE IF EXISTS `registration_method`;
CREATE TABLE `registration_method` (
  `registration_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_method_name` varchar(20) NOT NULL,
  PRIMARY KEY (`registration_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of registration_method
-- ----------------------------
INSERT INTO `registration_method` VALUES ('1', 'Website email');
INSERT INTO `registration_method` VALUES ('2', 'Website Facebook');
INSERT INTO `registration_method` VALUES ('3', 'Phone email');
INSERT INTO `registration_method` VALUES ('4', 'Phone Facebook');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `other_names` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_level_id` int(11) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `post_code` varchar(50) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `country_id` (`country_id`),
  KEY `user_level_id` (`user_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('8', 'e10adc3949ba59abbe56e057f20f883e', 'amasitsa@live.com', '1', 'Masitsa', '2', '2016-04-19 16:29:22', '2014-08-22 17:56:04', '2016-04-19 17:29:22', '0726149351', '', '', null, '', 'Alvaro');

-- ----------------------------
-- Table structure for `user_status`
-- ----------------------------
DROP TABLE IF EXISTS `user_status`;
CREATE TABLE `user_status` (
  `user_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_status_name` varchar(20) NOT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_status
-- ----------------------------
INSERT INTO `user_status` VALUES ('1', 'Active');
INSERT INTO `user_status` VALUES ('2', 'Disabled');
