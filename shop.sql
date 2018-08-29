/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2018-06-26 09:48:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for detail
-- ----------------------------
DROP TABLE IF EXISTS `detail`;
CREATE TABLE `detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `price` double(8,2) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of detail
-- ----------------------------

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(50) NOT NULL,
  `descr` text NOT NULL,
  `pic` char(37) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `store` smallint(6) NOT NULL DEFAULT '0',
  `num` int(11) NOT NULL DEFAULT '0',
  `clicknum` int(11) NOT NULL DEFAULT '1',
  `price` double(8,2) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `huishou` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('4', '21', '360手机 N6', '360公司生产厂', '【音乐套装】360手机 N6 全网通 4GB+64GB 燧石黑色 移动联通电信4G手机 双卡双待<div>【音乐套装】360手机 N6 全网通 4GB+64GB 燧石黑色 移动联通电信4G手机 双卡双待</div><div>【音乐套装】360手机 N6 全网通 4GB+64GB 燧石黑色 移动联通电信4G手机 双卡双待</div><div>【音乐套装】360手机 N6 全网通 4GB+64GB 燧石黑色 移动联通电信4G手机 双卡双待</div>', 'db5681c43cd47e8504ec64fb3e3c7716.jpg', '1', '999', '0', '3', '1199.00', '1529747602', '0');
INSERT INTO `goods` VALUES ('5', '21', '360手机 N6 全网通 6GB+64GB 璀璨金色', '360公司生产厂', '【碎屏险套装】360手机 N6 全网通 6GB+64GB 璀璨金色 移动联通电信4G手机 双卡双待【碎屏险套装】360手机 N6 全网通 6GB+64GB 璀璨金色 移动联通电信4G手机 双卡双待【碎屏险套装】360手机 N6 全网通 6GB+64GB 璀璨金色 移动联通电信4G手机 双卡双待【碎屏险套装】360手机 N6 全网通 6GB+64GB 璀璨金色 移动联通电信4G手机 双卡双待【碎屏险套装】360手机 N6 全网通 6GB+64GB 璀璨金色 移动联通电信4G手机 双卡双待', 'b7bffc81e9cc9ab8a71464134ffd5bfb.jpg', '0', '22', '0', '10', '1349.00', '1529749449', '0');
INSERT INTO `goods` VALUES ('6', '21', '360手机 N6 Pro 全网通 6GB+64GB 深海蓝色 ', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">360手机 N6 Pro 全网通 6GB+64GB 深海蓝色 移动联通电信4G手机 双卡双待 全面屏 游戏手机360手机 N6 Pro 全网通 6GB+64GB 深海蓝色 移动联通电信4G手机 双卡双待 全面屏 游戏手机</span>', '341659ef785517f4fb825982b9db2bb8.jpg', '0', '222', '0', '9', '1599.00', '1529749534', '0');
INSERT INTO `goods` VALUES ('7', '21', '360手机 N7 全网通 4GB+32GB 石墨黑色', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">360手机 N7 全网通 4GB+32GB 石墨黑色 移通电信4G手动联机 双卡双待 全面屏 游戏手机</span>', '8d0a4806257aa5445a88b88c87c65844.jpg', '1', '666', '0', '1', '1299.00', '1529749601', '0');
INSERT INTO `goods` VALUES ('9', '22', 'Apple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">Apple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机Apple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机Apple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机</span>', '95a14932ad3094bfedf7c3aa59c0087c.jpg', '0', '999', '0', '1', '1099.00', '1529750194', '0');
INSERT INTO `goods` VALUES ('10', '22', '绿联 MFi认证 苹果数据线 X/8/7/6/5s手机快充', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">绿联 MFi认证 苹果数据线 X/8/7/6/5s手机快充充电器线USB电源线 支持iphone5/6s/7Plus/ipad pro 1米20728白绿联 MFi认证 苹果数据线 X/8/7/6/5s手机快充充电器线USB电源线 支持iphone5/6s/7Plus/ipad pro 1米20728白绿联 MFi认证 苹果数据线 X/8/7/6/5s手机快充充电器线USB电源线 支持iphone5/6s/7Plus/ipad pro 1米20728白</span>', '711050bc05e99bbd316da9f4468aa502.jpg', '0', '999', '0', '9', '122.00', '1529750368', '0');
INSERT INTO `goods` VALUES ('11', '22', '罗马仕（ROMOSS）sense6Plus 移动电源', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">罗马仕（ROMOSS）sense6Plus 移动电源/充电宝20000毫安 苹果/安卓手机/平板通用 数显屏 聚合物电芯 白色罗马仕（ROMOSS）sense6Plus 移动电源/充电宝20000毫安 苹果/安卓手机/平板通用 数显屏 聚合物电芯 白色</span>', '9bd7c33b270188f1ccaae387049160d6.jpg', '0', '999', '0', '2', '1199.00', '1529750414', '0');
INSERT INTO `goods` VALUES ('12', '22', '倍思（Baseus）苹果/Type-c/安卓数据线三合一', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">倍思（Baseus）苹果/Type-c/安卓数据线三合一快充手机充电线 iPhoneX/7/8plus 小米6华为p10电源线 1.2米 红色倍思（Baseus）苹果/Type-c/安卓数据线三合一快充手机充电线 iPhoneX/7/8plus 小米6华为p10电源线 1.2米 红色</span>', 'fcfa8c4f4a6fa46b7abdaf8955ba41a5.jpg', '0', '999', '0', '8', '1199.00', '1529750476', '0');
INSERT INTO `goods` VALUES ('13', '22', '蜂翼 苹果6/6S/7数据线 1米白色 手机充电器线', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">蜂翼 苹果6/6S/7数据线 1米白色 手机充电器线电源线 支持iphone5/5s/7P/SE/ipad air mini蜂翼 苹果6/6S/7数据线 1米白色 手机充电器线电源线 支持iphone5/5s/7P/SE/ipad air mini</span>', '293e9495e40eb395ff2e36f62ce8aa20.jpg', '0', '999', '0', '1', '1199.00', '1529752468', '0');
INSERT INTO `goods` VALUES ('14', '27', '360儿童手表X1 智能儿童电话手表 ', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">360儿童手表X1 智能儿童电话手表 运动防水拍照快充 儿童定位故事问答 360儿童电话手表W702 樱花粉360儿童手表X1 智能儿童电话手表 运动防水拍照快充 儿童定位故事问答 360儿童电话手表W702 樱花粉</span>', '6be2f8cdc2b61aa6e2e7f5f28b02a9c7.jpg', '0', '999', '0', '1', '1199.00', '1529752573', '0');
INSERT INTO `goods` VALUES ('15', '30', '360安全路由器P3 无线路由器 千兆宽带1200M高速双频wifi信号放大别墅级穿墙 智能（光纤大宽带版）', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">360安全路由器P3 无线路由器 千兆宽带1200M高速双频wifi信号放大别墅级穿墙 智能（光纤大宽带版）360安全路由器P3 无线路由器 千兆宽带1200M高速双频wifi信号放大别墅级穿墙 智能（光纤大宽带版）360安全路由器P3 无线路由器 千兆宽带1200M高速双频wifi信号放大别墅级穿墙 智能（光纤大宽带版）</span>', '9200d7f4733b7a2550e6a642e1c427f2.jpg', '0', '999', '0', '1', '1199.00', '1529753048', '0');
INSERT INTO `goods` VALUES ('23', '37', '得力（deli）72365 多功能可调课桌挂袋 学生书本收纳袋/挂架/挂书袋 黑色', '360公司生产厂2', '360行车记录仪 高清流媒体智能后视镜 S800 语音操控 ADAS高级驾驶辅助 停车监控 行车轨迹 云电子狗360行车记录仪 高清流媒体智能后视镜 S800 语音操控 ADAS高级驾驶辅助 停车监控 行车轨迹 云电子狗', 'a3a23a197c7161ebaf1399cf39aa66a3.jpg', '0', '999', '0', '1', '998.00', '1529920621', '0');
INSERT INTO `goods` VALUES ('17', '32', '【送16G卡】360 智能摄像机 悬浮1080P版 网络wifi家用监控摄像头 高清夜视 双向通话 白色', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">【送16G卡】360 智能摄像机 悬浮1080P版 网络wifi家用监控摄像头 高清夜视 双向通话 白色【送16G卡】360 智能摄像机 悬浮1080P版 网络wifi家用监控摄像头 高清夜视 双向通话 白色</span>', '2b55456d989df4af17cc1e985fb8fc39.jpg', '0', '999', '0', '1', '1199.00', '1529753120', '0');
INSERT INTO `goods` VALUES ('18', '33', '360扫地机器人 智能家用全自动规划式静音扫地拖地 扫拖一体机 S6白色', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">360扫地机器人 智能家用全自动规划式静音扫地拖地 扫拖一体机 S6白色360扫地机器人 智能家用全自动规划式静音扫地拖地 扫拖一体机 S6白色</span>', '36d4bf5e218b854a7d30a24bb5d34fca.jpg', '0', '999', '0', '1', '1199.00', '1529753155', '0');
INSERT INTO `goods` VALUES ('19', '31', ' 360安全插线板 3USB快充接口+3插孔 8重安全防护插座/插排/排插/接线板/拖线板 白色', '360公司生产厂', '<div class=\"sInfo\" style=\"margin:0px;color:#666666;font-size:14px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\"><a name=\"sInfo\"></a><div class=\"tr nobdr bespeaked\" style=\"border:0px;\"><span style=\"color:#0e0e0e;font-size:28px;\">360安全插线板 3USB快充接口+3插孔 8重安全防护插座/插排/排插/接线板/拖线板 白色360安全插线板 3USB快充接口+3插孔 8重安全防护插座/插排/排插/接线板/拖线板 白色</span></div></div>', '9b785634c01d93007e60a2156c0819d3.jpg', '0', '999', '0', '1', '1199.00', '1529753203', '0');
INSERT INTO `goods` VALUES ('20', '34', 'Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色</span>', '9683f2350dc305fb9c7246f1652a16ed.jpg', '0', '999', '0', '4', '1199.00', '1529753274', '0');
INSERT INTO `goods` VALUES ('22', '43', '360行车记录仪 高清流媒体智能后视镜 S800 语音操控 ADAS高级驾驶辅助 停车监控 行车轨迹 云电子狗', '360公司生产厂', '<span style=\"color:#0e0e0e;background-color:#ffffff;font-size:28px;font-family:\"Helvetica Neue\", Helvetica, Arial, \"Microsoft Yahei\", \"Hiragino Sans GB\", \"Heiti SC\", \"WenQuanYi Micro Hei\", sans-serif;\">360行车记录仪 高清流媒体智能后视镜 S800 语音操控 ADAS高级驾驶辅助 停车监控 行车轨迹 云电子狗360行车记录仪 高清流媒体智能后视镜 S800 语音操控 ADAS高级驾驶辅助 停车监控 行车轨迹 云电子狗360行车记录仪 高清流媒体智能后视镜 S800 语音操控 ADAS高级驾驶辅助 停车监控 行车轨迹 云电子狗360行车记录仪 高清流媒体智能后视镜 S800 语音操控 ADAS高级驾驶辅助 停车监控 行车轨迹 云电子狗</span>', '4aae8b004796c477d5ac695b8e0f0ec1.jpg', '0', '999', '0', '1', '1199.00', '1529919740', '0');

-- ----------------------------
-- Table structure for loginlog
-- ----------------------------
DROP TABLE IF EXISTS `loginlog`;
CREATE TABLE `loginlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(18) NOT NULL,
  `logintime` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of loginlog
-- ----------------------------
INSERT INTO `loginlog` VALUES ('27', 'admin', '1529920043', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('32', 'admin', '1529976340', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('3', 'admin', '1529729044', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('4', 'admin', '1529729049', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('5', 'admin', '1529729083', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('6', 'admin', '1529729096', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('11', 'admin', '1529737787', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('8', 'admin', '1529729244', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('10', 'admin', '1529730558', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('12', 'admin', '1529738620', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('13', 'wangwu', '1529738817', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('14', 'admin', '1529743966', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('15', 'admin', '1529747975', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('16', 'admin', '1529749747', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('17', 'admin', '1529749874', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('18', 'zhangsan', '1529749939', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('19', 'admin', '1529808457', '118.112.53.6');
INSERT INTO `loginlog` VALUES ('20', 'admin', '1529808460', '171.221.40.22');
INSERT INTO `loginlog` VALUES ('21', 'admin', '1529836854', '171.221.40.22');
INSERT INTO `loginlog` VALUES ('22', 'admin', '1529836903', '118.112.53.6');
INSERT INTO `loginlog` VALUES ('23', 'admin', '1529837036', '171.221.40.22');
INSERT INTO `loginlog` VALUES ('24', 'admin', '1529845170', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('25', 'admin', '1529889098', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('26', 'admin', '1529901715', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('28', 'admin', '1529922194', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('29', 'admin', '1529928607', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('30', 'zhangsansan', '1529972465', '127.0.0.1');
INSERT INTO `loginlog` VALUES ('31', 'admin', '1529973606', '127.0.0.1');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `linkman` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `code` char(6) NOT NULL,
  `phone` char(11) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `total` double(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `goodsid` int(22) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `num` int(11) NOT NULL,
  `is_ping` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('18', '4', '但敏杰', '四川省眉山市仁寿县', '620500', '13550515067', '1529914606', '1199.00', '3', '20', 'Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色', '1199.00', '1', '1');
INSERT INTO `orders` VALUES ('19', '4', '张三', '啊啊啊啊啊阿斯顿撒多所多哇多无', '620500', '13550515067', '1529914595', '1099.00', '3', '9', 'Apple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机', '1099.00', '1', '1');
INSERT INTO `orders` VALUES ('20', '4', '但敏杰', '四川省眉山市仁寿县', '620500', '13550515067', '1529914578', '1199.00', '3', '4', '360手机 N6', '1199.00', '1', '1');
INSERT INTO `orders` VALUES ('21', '1', '但敏杰', '四川省成都市金牛区', '620500', '13550515067', '1529920261', '244.00', '0', '10', '绿联 MFi认证 苹果数据线 X/8/7/6/5s手机快充', '122.00', '2', '0');
INSERT INTO `orders` VALUES ('22', '1', '但敏杰', '四川省眉山市仁寿县', '620500', '13550515067', '1529920378', '1199.00', '3', '12', '倍思（Baseus）苹果/Type-c/安卓数据线三合一', '1199.00', '1', '1');
INSERT INTO `orders` VALUES ('23', '22', '但敏杰', '四川省成都市这里', '620500', '13550515067', '1529975857', '2698.00', '3', '5', '360手机 N6 全网通 6GB+64GB 璀璨金色', '1349.00', '2', '1');

-- ----------------------------
-- Table structure for pingjia
-- ----------------------------
DROP TABLE IF EXISTS `pingjia`;
CREATE TABLE `pingjia` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `goodsname` varchar(255) NOT NULL,
  `dafen` tinyint(4) NOT NULL,
  `content` varchar(255) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pingjia
-- ----------------------------
INSERT INTO `pingjia` VALUES ('18', '4', '20', '18', 'Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色', '5', 'Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色', '1529914606');
INSERT INTO `pingjia` VALUES ('20', '4', '4', '20', '360手机 N6', '5', '360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6360手机 N6', '1529914578');
INSERT INTO `pingjia` VALUES ('19', '4', '9', '19', 'Apple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机', '5', 'Apple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机Apple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机vApple AirPods 蓝牙无线耳机 适用于iPhone7/8/X手机耳机', '1529914595');
INSERT INTO `pingjia` VALUES ('22', '1', '12', '22', '倍思（Baseus）苹果/Type-c/安卓数据线三合一', '4', '55555555555555555', '1529920378');
INSERT INTO `pingjia` VALUES ('23', '22', '5', '23', '360手机 N6 全网通 6GB+64GB 璀璨金色', '2', '差评不好差评不好差评不好差评不好差评不好！！！', '1529975857');

-- ----------------------------
-- Table structure for system
-- ----------------------------
DROP TABLE IF EXISTS `system`;
CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `phone` char(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `huandeng` char(37) NOT NULL,
  `hengfu` char(37) NOT NULL,
  `gonggao` varchar(255) NOT NULL,
  `banquan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system
-- ----------------------------
INSERT INTO `system` VALUES ('1', '13550515069', '578760087@qq.com', 'ead144948c24c79d21d8f668fbb914f8.jpg', 'e70e57e207a78dad360a42f994695c7e.jpg', '这里是公告信息，如果需要更改公告信息，请在左侧导航系统管理，系统设置中修改公告信息，同时可以修改电话，邮箱，首页幻灯，首页横幅，版权等信息。。。<div>这里是公告信息，如果需要更改公告信息，请在左侧导航系统管理，系统设置中修改公告信息，同时可以修改电话，邮箱，首页幻灯，首页横幅，版权等信息。。。22</div>', '牛逼商城©2018-2019 兄弟连CDsy1804版权所有 ');

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `pid` int(11) NOT NULL,
  `path` varchar(255) NOT NULL DEFAULT '0,',
  `ord` tinyint(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('1', '手机/配件', '0', '0,', '2');
INSERT INTO `type` VALUES ('4', '数码', '0', '0,', '1');
INSERT INTO `type` VALUES ('29', '智能摄像机', '4', '0,4,', '0');
INSERT INTO `type` VALUES ('28', '行车记录仪', '4', '0,4,', '0');
INSERT INTO `type` VALUES ('27', '儿童手表', '4', '0,4,', '0');
INSERT INTO `type` VALUES ('24', '单反相机', '4', '0,4,', '0');
INSERT INTO `type` VALUES ('22', '手机配件', '1', '0,1,', '2');
INSERT INTO `type` VALUES ('15', '电脑周边', '0', '0,', '3');
INSERT INTO `type` VALUES ('16', '移动存储', '0', '0,', '4');
INSERT INTO `type` VALUES ('17', '汽车用品', '0', '0,', '5');
INSERT INTO `type` VALUES ('41', '家用电器', '0', '0,', '6');
INSERT INTO `type` VALUES ('20', '教育文具', '0', '0,', '8');
INSERT INTO `type` VALUES ('21', '手机通讯', '1', '0,1,', '1');
INSERT INTO `type` VALUES ('30', '路由器', '4', '0,4,', '0');
INSERT INTO `type` VALUES ('31', '插线板', '4', '0,4,', '0');
INSERT INTO `type` VALUES ('32', '智能家居', '4', '0,4,', '0');
INSERT INTO `type` VALUES ('33', '扫地机器人', '4', '0,4,', '0');
INSERT INTO `type` VALUES ('34', '平板电脑', '15', '0,15,', '0');
INSERT INTO `type` VALUES ('35', '鼠标', '15', '0,15,', '0');
INSERT INTO `type` VALUES ('36', '键盘', '15', '0,15,', '0');
INSERT INTO `type` VALUES ('37', '套装', '15', '0,15,', '0');
INSERT INTO `type` VALUES ('38', '游戏耳机', '15', '0,15,', '0');
INSERT INTO `type` VALUES ('39', '铅笔钢笔', '20', '0,20,', '0');
INSERT INTO `type` VALUES ('40', '毛笔粉笔', '20', '0,20,', '0');
INSERT INTO `type` VALUES ('42', '户外运动', '0', '0,', '7');
INSERT INTO `type` VALUES ('43', '行车记录仪', '17', '0,17,', '0');

-- ----------------------------
-- Table structure for type2222
-- ----------------------------
DROP TABLE IF EXISTS `type2222`;
CREATE TABLE `type2222` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `pid` int(11) NOT NULL,
  `ord` tinyint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type2222
-- ----------------------------
INSERT INTO `type2222` VALUES ('1', '服装', '0', '3');
INSERT INTO `type2222` VALUES ('2', '男装', '1', '2');
INSERT INTO `type2222` VALUES ('3', '女装', '1', '1');
INSERT INTO `type2222` VALUES ('4', '数码', '0', '4');
INSERT INTO `type2222` VALUES ('5', '童装', '1', '0');
INSERT INTO `type2222` VALUES ('6', '相机', '4', '2');
INSERT INTO `type2222` VALUES ('7', '手机', '4', '1');
INSERT INTO `type2222` VALUES ('8', '大裤衩', '2', '0');
INSERT INTO `type2222` VALUES ('9', 'Iphone', '7', '0');
INSERT INTO `type2222` VALUES ('10', '情趣用品1111', '0', '1');
INSERT INTO `type2222` VALUES ('11', '牛逼111', '0', '2');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(18) NOT NULL,
  `pwd` char(32) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL,
  `huishou` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '3', '1529391474', '0');
INSERT INTO `user` VALUES ('2', 'zhangsanaaa', '202cb962ac59075b964b07152d234b70', '0', '1529392455', '0');
INSERT INTO `user` VALUES ('3', 'hehed', '202cb962ac59075b964b07152d234b70', '1', '1529394260', '0');
INSERT INTO `user` VALUES ('4', 'wangwu', '81dc9bdb52d04dc20036dbd8313ed055', '0', '1529394753', '0');
INSERT INTO `user` VALUES ('5', 'zhaoliu', '202cb962ac59075b964b07152d234b70', '2', '1529394763', '0');
INSERT INTO `user` VALUES ('6', 'zhangsan', '202cb962ac59075b964b07152d234b70', '3', '1529395574', '0');
INSERT INTO `user` VALUES ('7', 'zhangsaner', '202cb962ac59075b964b07152d234b70', '1', '1529395584', '0');
INSERT INTO `user` VALUES ('8', 'zhangsansan', '202cb962ac59075b964b07152d234b70', '3', '1529395592', '0');
INSERT INTO `user` VALUES ('9', 'zhangsanwu', '202cb962ac59075b964b07152d234b70', '1', '1529395634', '0');
INSERT INTO `user` VALUES ('10', 'zhangsansi', '202cb962ac59075b964b07152d234b70', '1', '1529395643', '0');
INSERT INTO `user` VALUES ('12', 'zhangsanba', '202cb962ac59075b964b07152d234b70', '3', '1529395643', '0');
INSERT INTO `user` VALUES ('13', 'zhangsanshi', '202cb962ac59075b964b07152d234b70', '3', '1529395643', '0');
INSERT INTO `user` VALUES ('16', 'kadixiaodan', 'e10df082e702a9600c65f430a8bf8fed', '0', '1529836380', '0');
INSERT INTO `user` VALUES ('17', 'jingruilin', '202cb962ac59075b964b07152d234b70', '0', '1529836428', '0');
INSERT INTO `user` VALUES ('18', 'xuxiaoxiong', '202cb962ac59075b964b07152d234b70', '1', '1529844097', '0');
INSERT INTO `user` VALUES ('19', 'gaoluofeng', '202cb962ac59075b964b07152d234b70', '0', '1529844223', '1');
INSERT INTO `user` VALUES ('20', 'ergouzi', '202cb962ac59075b964b07152d234b70', '0', '1529921315', '0');
INSERT INTO `user` VALUES ('21', 'cangjingkongg', '202cb962ac59075b964b07152d234b70', '0', '1529973870', '0');
INSERT INTO `user` VALUES ('22', 'yanlaoshi', '202cb962ac59075b964b07152d234b70', '0', '1529975605', '0');

-- ----------------------------
-- Table structure for user_hangye
-- ----------------------------
DROP TABLE IF EXISTS `user_hangye`;
CREATE TABLE `user_hangye` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `hname` varchar(200) NOT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_hangye
-- ----------------------------
INSERT INTO `user_hangye` VALUES ('1', '张三');
INSERT INTO `user_hangye` VALUES ('2', 'IT');
INSERT INTO `user_hangye` VALUES ('3', '美食');
INSERT INTO `user_hangye` VALUES ('4', '住宿');
INSERT INTO `user_hangye` VALUES ('5', '西餐');
INSERT INTO `user_hangye` VALUES ('6', '保姆');
INSERT INTO `user_hangye` VALUES ('7', 'ITA');
INSERT INTO `user_hangye` VALUES ('8', '老师');

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `age` tinyint(4) NOT NULL,
  `code` char(18) NOT NULL,
  `phone` char(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `hobby` varchar(255) NOT NULL,
  `ysr` tinyint(4) NOT NULL,
  `xueli` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL,
  `hunfou` tinyint(4) NOT NULL DEFAULT '0',
  `pic` char(37) NOT NULL,
  `hangyeid` tinyint(4) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES ('1', '但敏杰', '1', '26', '11111111222222', '13550515067', '四川省眉山市仁寿县书院街1', '0,1,2,3,6', '1', '1', '578760087@qq.com', '1', '336bcb8e748d709800c6ab974cfad3c8.jpg', '6');
INSERT INTO `user_info` VALUES ('4', '王五', '1', '15', '123123123123', '13550515067', '四川省眉山市仁寿县花牌坊街', '1,2,3,4', '0', '0', 'a@diannaocheng.com', '0', 'ecd979ba3abf52cc0c9a116212ee686e.jpg', '2');
INSERT INTO `user_info` VALUES ('7', '111', '1', '16', '123123', '13550515067', 'aa', '1', '0', '0', 'a@diannaocheng.com', '0', '690c4181eb19d3a8603f8e005ecfe017.jpg', '2');
INSERT INTO `user_info` VALUES ('22', '闫英杰1', '1', '18', '123123123123', '13550515067', '四川', '5', '3', '2', 'a@diannaocheng.com', '0', '2f7557f2e843906c38dd1615e7c2c76f.jpg', '2');
