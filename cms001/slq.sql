/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.5.53 : Database - thinkphp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`thinkphp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `thinkphp`;

/*Table structure for table `article_admin_user` */

DROP TABLE IF EXISTS `article_admin_user`;

CREATE TABLE `article_admin_user` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(20) NOT NULL COMMENT '用户name',
  `user_pwd` char(32) NOT NULL COMMENT '用户密码',
  `user_root` int(100) unsigned NOT NULL DEFAULT '1' COMMENT '用户权限(0没有权限表示已经删除)',
  `last_time` int(255) NOT NULL COMMENT '最后登录时间',
  `alt_time` int(255) NOT NULL COMMENT '修改时间',
  `user_email` varchar(100) NOT NULL COMMENT '用户邮箱',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `article_admin_user` */

insert  into `article_admin_user`(`id`,`user_name`,`user_pwd`,`user_root`,`last_time`,`alt_time`,`user_email`) values (1,'123','202cb962ac59075b964b07152d234b70',1,1551604288,1551604288,'123@qq.com'),(2,'111','698d51a19d8a121ce581499d7b701668',100,1551604288,1551604288,'123@qq.com'),(3,'test1','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(4,'test2','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(5,'test3','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(6,'test4','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(7,'test5','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(8,'test6','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(9,'test7','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(10,'test8','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(11,'test9','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(12,'test10','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(13,'test11','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(14,'test12','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(15,'test13','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(16,'test14','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(17,'test15','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(18,'test16','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(19,'test17','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(20,'test18','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com'),(21,'test19','098f6bcd4621d373cade4e832627b4f6',1,1551604288,1551604288,'123@qq.com');

/*Table structure for table `article_column` */

DROP TABLE IF EXISTS `article_column`;

CREATE TABLE `article_column` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `col_name` varchar(20) NOT NULL COMMENT '栏目名称',
  `col_status` int(10) NOT NULL COMMENT '栏目状态',
  `col_order` int(11) NOT NULL COMMENT '栏目顺序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `article_column` */

insert  into `article_column`(`id`,`col_name`,`col_status`,`col_order`) values (1,'新闻',1,1),(2,'娱乐',1,2),(3,'财经',1,3),(4,'大学',1,4),(5,'教育',1,5),(6,'金融',1,6),(7,'计算机',1,7),(8,'互联网',1,8),(9,'体育',1,9),(10,'美文',1,10),(11,'时尚',1,11);

/*Table structure for table `article_content` */

DROP TABLE IF EXISTS `article_content`;

CREATE TABLE `article_content` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `art_content` text NOT NULL COMMENT '文章内容',
  `art_id` int(255) NOT NULL COMMENT '文章id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

/*Data for the table `article_content` */

insert  into `article_content`(`id`,`art_content`,`art_id`) values (1,'这是111文章内容',54),(2,'这是111文章内容',53),(3,'这是111文章内容',52),(4,'这是111文章内容',51),(5,'这是111文章内容',50),(6,'这是111文章内容',44),(7,'这是111文章内容',45),(8,'这是111文章内容',46),(9,'这是111文章内容',47),(10,'这是111文章内容',48),(11,'这是111文章内容',49),(12,'这是111文章内容',56),(13,'这是111文章内容',57),(14,'这是111文章内容',58),(15,'这是111文章内容',59),(16,'这是123文章内容',60),(17,'这是123文章内容',61),(18,'这是123文章内容',62),(19,'这是123文章内容',63),(55,'<p>123333333333333333333333333</p>\n',90);

/*Table structure for table `article_main` */

DROP TABLE IF EXISTS `article_main`;

CREATE TABLE `article_main` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `art_title` varchar(50) NOT NULL COMMENT '文章标题',
  `art_author_id` varchar(20) NOT NULL COMMENT '文章作者',
  `art_keywords` varchar(50) NOT NULL COMMENT '文章关键词',
  `art_classId` varchar(200) NOT NULL COMMENT '所属栏目id(可多个栏目)',
  `art_abs` varchar(100) NOT NULL COMMENT '文章摘要',
  `art_addtime` int(255) NOT NULL COMMENT '发布时间',
  `art_img` varchar(200) NOT NULL COMMENT '封面图片路劲',
  `arr_number` int(255) unsigned zerofill DEFAULT NULL COMMENT '浏览次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

/*Data for the table `article_main` */

insert  into `article_main`(`id`,`art_title`,`art_author_id`,`art_keywords`,`art_classId`,`art_abs`,`art_addtime`,`art_img`,`arr_number`) values (54,'这是123作者的文章','1','123、123','2','这是123的描述摘要',0,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(53,'这是修改测试作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(51,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(52,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(50,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(49,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(47,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(48,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(46,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(45,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(44,'这是111作者的文章','2','111、111','1','这是111的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(55,'这是123作者的文章','1','123、123','2','这是123的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(56,'这是123作者的文章','1','123、123','2','这是123的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(57,'这是123作者的文章','1','123、123','2','这是123的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(58,'这是123作者的文章','1','123、123','2','这是123的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(59,'这是123作者的文章','1','123、123','2','这是123的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(60,'这是123作者的文章','1','123、123','2','这是123的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(61,'这是123作者的文章','1','123、123','2','这是123的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(62,'这是123作者的文章','1','123、123','2','这是123的描述摘要',1551604288,'20190304/70de54d927648406478a7f72a6a9ced4.jpg',NULL),(90,'123333333333333333','4','33333333333333333','3','333333333333333333333333333333',1551704990,'\\public\\static\\admin\\uploads\\20190304\\a8d10f07c7642e772c5305c6be65a6d9.jpg',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
