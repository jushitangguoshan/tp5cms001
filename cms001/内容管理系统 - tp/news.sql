/*
SQLyog Ultimate v8.82 
MySQL - 5.6.17 : Database - tpcms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tpcms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tpcms`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '内容标题',
  `author_id` smallint(5) unsigned NOT NULL COMMENT '作者id',
  `category_id` smallint(5) unsigned NOT NULL COMMENT '栏目id',
  `description` varchar(200) DEFAULT NULL COMMENT '描述',
  `thumb_url` varchar(200) DEFAULT NULL COMMENT '封面图片地址',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态 0-草稿 1-发布',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `article` */

insert  into `article`(`id`,`title`,`author_id`,`category_id`,`description`,`thumb_url`,`status`,`create_time`,`update_time`,`delete_time`) values (2,'测试的文章',2,13,'dfsdfsdf',NULL,1,'0000-00-00 00:00:00',NULL,NULL),(3,'测试的文章2',2,1,'dfdfd',NULL,1,'0000-00-00 00:00:00',NULL,NULL);

/*Table structure for table `article_info` */

DROP TABLE IF EXISTS `article_info`;

CREATE TABLE `article_info` (
  `aid` int(10) unsigned NOT NULL,
  `content` text,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `article_info` */

insert  into `article_info`(`aid`,`content`) values (2,'<p>dsfdsfdsfds</p>\r\n'),(3,'<p>dffgcvxzczxc</p>\r\n');

/*Table structure for table `article_keyword_relation` */

DROP TABLE IF EXISTS `article_keyword_relation`;

CREATE TABLE `article_keyword_relation` (
  `article_id` int(10) unsigned NOT NULL,
  `keyword_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `article_keyword_relation` */

insert  into `article_keyword_relation`(`article_id`,`keyword_id`) values (2,1),(2,2),(2,3),(3,1),(3,2),(3,3),(3,4);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL COMMENT '栏目名',
  `parent_id` smallint(6) NOT NULL COMMENT '父类id',
  `total_rows` int(11) NOT NULL DEFAULT '0' COMMENT '文章总数',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `category` */

insert  into `category`(`id`,`category_name`,`parent_id`,`total_rows`,`create_time`,`update_time`,`delete_time`) values (1,'测试',0,1,NULL,NULL,NULL);

/*Table structure for table `keywords` */

DROP TABLE IF EXISTS `keywords`;

CREATE TABLE `keywords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) NOT NULL COMMENT '关键字',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `keywords` */

insert  into `keywords`(`id`,`keyword`,`create_time`,`delete_time`) values (1,'linux',NULL,NULL),(2,'php',NULL,NULL),(3,'mysql',NULL,NULL),(4,'java',NULL,NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `salt` char(6) NOT NULL COMMENT '随机盐',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 0-禁用',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '编辑时间',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
