/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : cake

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-05-01 11:22:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodId` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `count` varchar(255) DEFAULT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `checked` int(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('1', '5', '百花翻糖蛋糕', 'img/goods/3.png', '5', '1', '78.00', '0');
INSERT INTO `cart` VALUES ('2', '6', '抹茶冻芝士蛋糕', 'img/goods/4.png', '3', '1', '98.00', '0');
INSERT INTO `cart` VALUES ('3', '4', '芒果千层蛋糕', 'img/goods/2.png', '1', '1', '108.00', '0');
INSERT INTO `cart` VALUES ('36', '2', '草莓白色奶油蛋糕水果蛋糕', 'img/promote2.png', '3', '9', '88.00', '1');
INSERT INTO `cart` VALUES ('37', '1', '芭比·草莓巧克力蛋糕', 'img/promote1.png', '3', '9', '16.00', '1');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `subtitle-1` varchar(255) DEFAULT NULL,
  `subtitle-2` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `price-old` varchar(255) DEFAULT NULL,
  `sold` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `img-1` varchar(255) DEFAULT NULL,
  `img-2` varchar(255) DEFAULT NULL,
  `img-3` varchar(255) DEFAULT NULL,
  `img-4` varchar(255) DEFAULT NULL,
  `hot` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '芭比·草莓巧克力蛋糕', 'Strawberry Chocolate Cake', '寻找记忆里的味觉初体现', '16.00', '35', '23', 'img/promote1.png', '', null, null, null, '1');
INSERT INTO `goods` VALUES ('2', '草莓白色奶油蛋糕水果蛋糕', 'Strawberry cream cake', '荷尔蒙 精心的午夜巴黎之旅', '88.00', '98', '25', 'img/promote2.png', null, null, null, null, '1');
INSERT INTO `goods` VALUES ('3', '特浓巧克力蛋糕', null, null, '88.00', '90', '56', 'img/goods/1.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('4', '芒果千层蛋糕', null, null, '108.00', '120', '2', 'img/goods/2.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('5', '百花翻糖蛋糕', null, null, '78.00', '110', '21', 'img/goods/3.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('6', '抹茶冻芝士蛋糕', null, null, '98.00', '120', '12', 'img/goods/4.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('7', '粉粉公主蛋糕杯', null, null, '8.00', '10', '120', 'img/goods/5.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('8', '巧克力泡芙', null, null, '6.00', '10', '40', 'img/goods/6.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('9', '原味甜甜圈', null, null, '5.00', '12', '34', 'img/goods/7.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('10', '马卡龙', null, null, '36.00', '42', '32', 'img/goods/8.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('11', '马卡龙泡芙塔', null, null, '12.00', '21', '75', 'img/goods/9.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('12', '特抹茶巧克力冰激凌', null, null, '18.00', '22', '14', 'img/goods/10.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('13', '芒果冰激凌鸡蛋仔', null, null, '25.00', '30', '42', 'img/goods/11.png', null, null, null, null, '0');
INSERT INTO `goods` VALUES ('14', '草莓蛋糕皇后', null, null, '13.00', '30', '75', 'img/goods/12.png', null, null, null, null, '0');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(255) DEFAULT NULL,
  `goodId` varchar(255) DEFAULT NULL,
  `goodImg` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('30', '9', '2', 'img/promote2.png', '草莓白色奶油蛋糕水果蛋糕', '2', '88.00', null, '2017-05-01 11:01:51');
INSERT INTO `orders` VALUES ('31', '9', '1', 'img/promote1.png', '芭比·草莓巧克力蛋糕', '2', '16.00', null, '2017-05-01 11:01:51');

-- ----------------------------
-- Table structure for userdata
-- ----------------------------
DROP TABLE IF EXISTS `userdata`;
CREATE TABLE `userdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userdata
-- ----------------------------
INSERT INTO `userdata` VALUES ('5', 'jack', '562145c26e65188fb44bb7e92487beaa', 'Jack_Chen', 'chen86860@126.com', '18814183822', '陈龙 广东 江门市 蓬江区 城区五邑大学 188****3822');
INSERT INTO `userdata` VALUES ('9', 'cici', 'dd67c21a53f1522aae924956388b9d72', 'æ¢è¯—å©·', 'cici@126.com', '18814182583', '梁诗婷 广东 江门市 蓬江区 城区五邑大学 188****2583');
