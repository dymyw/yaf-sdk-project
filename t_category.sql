/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table t_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `t_category`;

CREATE TABLE `t_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(16) NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级分类id',
  `weight` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权重',
  `depth` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '深度，从1递增',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类型 1=地址',
  `row_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 -1=无效 1=显示 2=隐藏',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 08:00:00' COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `idxc_category_type_pid` (`type`,`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='分类表';

LOCK TABLES `t_category` WRITE;
/*!40000 ALTER TABLE `t_category` DISABLE KEYS */;

INSERT INTO `t_category` (`id`, `name`, `pid`, `weight`, `depth`, `type`, `row_status`, `created_at`, `updated_at`)
VALUES
	(1,'北京市',0,10,1,1,1,'2019-01-21 15:28:18','2019-05-08 10:28:47'),
	(2,'上海市',0,21,1,1,1,'1970-01-01 08:00:00','2019-05-08 10:28:48'),
	(3,'浙江省',0,57,1,1,1,'1970-01-01 08:00:00','2019-05-08 10:28:51');

/*!40000 ALTER TABLE `t_category` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
