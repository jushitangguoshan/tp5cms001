/*
SQLyog Ultimate v8.82 
MySQL - 5.5.53 : Database - dbb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `dbb`;

/*Table structure for table `take_address` */

DROP TABLE IF EXISTS `take_address`;

CREATE TABLE `take_address` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL COMMENT '收货人姓名',
  `phone` char(11) NOT NULL COMMENT '收货人手机号',
  `create_id` smallint(6) NOT NULL COMMENT '添加地址的用户id',
  `province` varchar(10) NOT NULL COMMENT '省',
  `city` varchar(10) NOT NULL COMMENT '市',
  `country` varchar(10) NOT NULL COMMENT '区',
  `status` tinyint(1) NOT NULL COMMENT '地址状态(0-已删除,1-正常)',
  `description` varchar(150) NOT NULL COMMENT '详细地址',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delect_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `take_address` */

insert  into `take_address`(`id`,`name`,`phone`,`create_id`,`province`,`city`,`country`,`status`,`description`,`create_time`,`update_time`,`delect_time`) values (1,'fan','15512341234',1,'1','11','111',1,'kkk详细地址测试',134535132,NULL,NULL),(2,'fan','18812341234',1,'1','11','111',1,'www详细地址',13435413,NULL,NULL);

/*Table structure for table `take_admin` */

DROP TABLE IF EXISTS `take_admin`;

CREATE TABLE `take_admin` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(10) NOT NULL COMMENT '管理员名称',
  `pwd` char(32) NOT NULL COMMENT '管理员密码',
  `salt` char(32) NOT NULL DEFAULT '123456' COMMENT '管理员密码(盐)',
  `email` varchar(30) NOT NULL COMMENT '管理员邮箱',
  `phone` char(11) NOT NULL COMMENT '管理员电话',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(0-已删除,1-正常)',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Data for the table `take_admin` */

insert  into `take_admin`(`id`,`name`,`pwd`,`salt`,`email`,`phone`,`status`,`create_time`,`update_time`,`delete_time`) values (1,'张三','1e191d851b3b49a248f4ea62f6b06410','123','11@qq.com','18900000002',1,2147483647,1554645711,NULL),(2,'李四','1e191d851b3b49a248f4ea62f6b06410','123','22@qq.com','13500000000',1,2147483647,1554645715,NULL),(3,'王五','1e191d851b3b49a248f4ea62f6b06410','123','33@qq.com','13300000000',1,2147483647,NULL,NULL),(4,'admin','123','','33@qq.com','13300000000',1,2147483647,NULL,NULL),(5,'xxxss','123','123','xxx@qq.com','15301002211',1,123123123,1554520675,NULL),(21,'kkk','1e191d851b3b49a248f4ea62f6b06410','123456','123@qq.com','14412341234',1,1554534144,1554534144,NULL),(23,'qqq','1e191d851b3b49a248f4ea62f6b06410','123456','123@qq.com','14412341234',1,1554534260,1554534260,NULL),(30,'fan','1e191d851b3b49a248f4ea62f6b06410','123456','222@foxmail.com','15557591235',1,1554549162,1554549162,NULL),(31,'ssss','1e191d851b3b49a248f4ea62f6b06410','123456','ss@qq.com','15500000000',1,1554555044,1554555044,NULL),(33,'qwe','ea48576f30be1669971699c09ad05c94','123456','123@qq.com','13300000000',1,1554617735,1554617735,NULL);

/*Table structure for table `take_admin_role` */

DROP TABLE IF EXISTS `take_admin_role`;

CREATE TABLE `take_admin_role` (
  `admin_id` tinyint(1) unsigned NOT NULL COMMENT '后台人员id',
  `role_id` tinyint(1) unsigned NOT NULL COMMENT '管理权限id',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `take_admin_role` */

insert  into `take_admin_role`(`admin_id`,`role_id`,`create_time`,`update_time`) values (4,1,1554378002,NULL),(3,2,1554378002,NULL),(2,2,1554378002,NULL),(21,3,1554534144,1554534144),(23,2,1554534260,1554534260),(23,3,1554534260,1554534260),(4,2,1554534260,1554534260),(30,2,1554549162,1554549162),(5,2,1554549162,1554549162),(1,3,1554554898,1554554898),(31,2,1554555044,1554555044),(33,2,1554617735,1554617735);

/*Table structure for table `take_category` */

DROP TABLE IF EXISTS `take_category`;

CREATE TABLE `take_category` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `category_name` varchar(20) CHARACTER SET utf8mb4 NOT NULL COMMENT '分类名称',
  `weight` smallint(6) NOT NULL COMMENT '权重(排序)',
  `status` tinyint(1) NOT NULL COMMENT '状态(0-已删除,1-正常)',
  `masterId` smallint(3) NOT NULL COMMENT '创建者ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `take_category` */

insert  into `take_category`(`id`,`category_name`,`weight`,`status`,`masterId`,`create_time`,`update_time`,`delete_time`) values (21,'精品特色',20,1,4,1555071329,1555071329,NULL),(22,'回味无穷',25,1,4,1555071353,1555071353,NULL),(23,'流连忘返',80,1,4,1555071366,1555071366,NULL),(24,'小吃',12,1,4,1555071375,1555071375,NULL);

/*Table structure for table `take_goods` */

DROP TABLE IF EXISTS `take_goods`;

CREATE TABLE `take_goods` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `price` decimal(10,2) DEFAULT NULL COMMENT '商品价格',
  `goods_name` varchar(20) NOT NULL COMMENT '商品名称',
  `belong_store_id` tinyint(4) NOT NULL COMMENT '所属店铺id',
  `belong_category_id` tinyint(4) NOT NULL COMMENT '商品分类id',
  `storage` int(11) NOT NULL DEFAULT '0' COMMENT '库存量',
  `image` varchar(100) NOT NULL COMMENT '商品图像路径',
  `create_host` smallint(6) NOT NULL COMMENT '创建商品用户id',
  `create_time` int(11) NOT NULL COMMENT '发布时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `take_goods` */

insert  into `take_goods`(`id`,`price`,`goods_name`,`belong_store_id`,`belong_category_id`,`storage`,`image`,`create_host`,`create_time`,`update_time`,`delete_time`) values (9,'12.00','茶123',25,21,10,'/uploads/20190412\\7186164d623f186919e3ffb50c118053.bmp',4,1555071815,1555071815,NULL),(10,'15.00','奶茶123',25,21,10,'/uploads/20190412\\6f5ad45401b9360f8e0b6f561b581570.bmp',4,1555071837,1555071837,NULL);

/*Table structure for table `take_order` */

DROP TABLE IF EXISTS `take_order`;

CREATE TABLE `take_order` (
  `order_id` char(13) NOT NULL COMMENT '订单编号',
  `shop_id` smallint(6) NOT NULL COMMENT '商铺id',
  `shop_phone` char(11) NOT NULL COMMENT '商铺电话',
  `shop_name` varchar(50) NOT NULL COMMENT '商铺name',
  `user_note` varchar(255) DEFAULT NULL COMMENT '用户备注',
  `user_name` varchar(50) NOT NULL COMMENT '创建订单用户姓名',
  `address_name` varchar(50) NOT NULL COMMENT '送货地址',
  `total_price` decimal(8,3) NOT NULL COMMENT '商品总价',
  `pay_way` tinyint(1) NOT NULL COMMENT '支付方式(0-支付宝,1-微信,2-银联)',
  `status` tinyint(4) NOT NULL COMMENT '1-已下单 、2-已接单、3-下单未支付、4-已支付未发货、5-已发货未接收、6-已接收',
  `user_phone` char(11) NOT NULL COMMENT '下单人手机号',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `take_time` int(11) DEFAULT NULL COMMENT '商家接单时间',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `take_order` */

insert  into `take_order`(`order_id`,`shop_id`,`shop_phone`,`shop_name`,`user_note`,`user_name`,`address_name`,`total_price`,`pay_way`,`status`,`user_phone`,`create_time`,`update_time`,`delete_time`,`take_time`) values ('2019041254510',2,'13704659678','贡茶','','花花','44详细地址','44.000',0,1,'12255551111',1555068371,1555068371,NULL,NULL),('2019041256639',22,'15512341234','kkk店铺','少点前','谷歌','11阿斯蒂芬撒旦地址','11.000',0,1,'15512341234',1555068830,1555068830,NULL,NULL),('2019041260161',2,'13704659678','贡茶','','花花','33详细地址','33.000',0,1,'12255551111',1555067652,1555067652,NULL,NULL),('2019041293531',22,'15512341234','kkk店铺','','谷歌','1阿斯蒂芬撒旦地址','1.000',0,1,'15512341234',1555070396,1555070396,NULL,NULL);

/*Table structure for table `take_order_goods` */

DROP TABLE IF EXISTS `take_order_goods`;

CREATE TABLE `take_order_goods` (
  `order_id` char(13) NOT NULL COMMENT '订单id',
  `goods_name` varchar(50) NOT NULL COMMENT '商品名称',
  `goods_num` smallint(6) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `goods_price` decimal(6,3) NOT NULL COMMENT '商品单价',
  `create_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `take_order_goods` */

/*Table structure for table `take_role` */

DROP TABLE IF EXISTS `take_role`;

CREATE TABLE `take_role` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `role_name` varchar(20) NOT NULL COMMENT '角色名',
  `role_rules` varchar(255) NOT NULL COMMENT '角色规则',
  `descript` varchar(255) NOT NULL COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `take_role` */

insert  into `take_role`(`id`,`role_name`,`role_rules`,`descript`,`status`) values (1,'超级管理员','至高无上','操作后台所有数据',1),(2,'客服人员','订单受理','操作订单数据',1),(3,'店铺管理员','管理店铺相关','操作店铺、商品数据',1);

/*Table structure for table `take_shop` */

DROP TABLE IF EXISTS `take_shop`;

CREATE TABLE `take_shop` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(20) NOT NULL COMMENT '商铺名称',
  `user_id` smallint(6) NOT NULL COMMENT '属于用户id',
  `shop_phone` varchar(11) NOT NULL COMMENT '商家联系电话',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(0-休息,1-营业)',
  `building` varchar(15) NOT NULL COMMENT '店铺楼宇',
  `floor` varchar(15) NOT NULL COMMENT '店铺楼层',
  `image` varchar(100) NOT NULL COMMENT '商铺图片路径',
  `notice` varchar(255) NOT NULL COMMENT '店铺公告',
  `create_time` datetime DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `address_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `take_shop` */

insert  into `take_shop`(`id`,`name`,`user_id`,`shop_phone`,`status`,`building`,`floor`,`image`,`notice`,`create_time`,`update_time`,`delete_time`,`address_id`) values (25,'贡茶',4,'13523463456',1,'北京大厦','4','uploads/20190412/c83a5ab0e773d7a2045bb2701cc95611.bmp','没有公告','2019-04-12 20:22:18',1555071738,NULL,1);

/*Table structure for table `take_title_address` */

DROP TABLE IF EXISTS `take_title_address`;

CREATE TABLE `take_title_address` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(10) NOT NULL COMMENT '地区名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `take_title_address` */

insert  into `take_title_address`(`id`,`name`) values (1,'龙华区'),(2,'福田区'),(3,'宝安区'),(4,'东城区'),(5,'大兴区'),(6,'昌平区'),(7,'通州区'),(8,'其它');

/*Table structure for table `take_user` */

DROP TABLE IF EXISTS `take_user`;

CREATE TABLE `take_user` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `nick` varchar(20) DEFAULT '老王' COMMENT '用户昵称',
  `username` varchar(8) DEFAULT 'laow' COMMENT '用户姓名',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `phone` char(11) NOT NULL COMMENT '用户下单电话',
  `status` tinyint(1) NOT NULL COMMENT '状态(0-已删除,1-正常)',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL COMMENT '性别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `take_user` */

insert  into `take_user`(`id`,`nick`,`username`,`pwd`,`phone`,`status`,`create_time`,`update_time`,`delete_time`,`sex`) values (1,'小李','sss','123','123',1,2147483647,NULL,NULL,1),(2,'小王','www','1','123',1,2147483647,NULL,NULL,1),(3,'小马','mmm','1','123',1,2147483647,NULL,NULL,0),(4,'小花','hhh','1','123',1,2147483647,NULL,NULL,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
