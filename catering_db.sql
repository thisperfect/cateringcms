
#
# Structure for table "admin"
#

CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `group_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理组id',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员名',
  `password` varchar(60) NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `loginip` varchar(20) NOT NULL DEFAULT '' COMMENT '登录IP',
  `logintime` int(10) unsigned NOT NULL COMMENT '登录时间',
  `checkinfo` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员';

#
# Data for table "admin"
#

INSERT INTO `admin` VALUES (1,1,'admin','$2y$11$KEFO34Z0llKIFjj8jbLjp.x89V0HbWQys6yQtMEiQuLbJIr3uDfgm','admin','1655586865@qq.com','0.0.0.0',1498523849,1),(2,1,'superadmin','$2y$11$RXCyyEBrIPUGDsdwDn5kg.qapMk./dUeXJAsT8iLaTo7hxJMaoMjm','测试账号','admin@imwnk.cn','0.0.0.0',1497711008,1);

#
# Structure for table "admin_group"
#

CREATE TABLE `admin_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理组';

#
# Data for table "admin_group"
#

INSERT INTO `admin_group` VALUES (1,'超级管理员',1,'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52');

#
# Structure for table "admin_group_access"
#

CREATE TABLE `admin_group_access` (
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `group_id` (`group_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='管理组—用户';

#
# Data for table "admin_group_access"
#

INSERT INTO `admin_group_access` VALUES (1,1),(2,1);

#
# Structure for table "admin_rule"
#

CREATE TABLE `admin_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='管理组规则';

#
# Data for table "admin_rule"
#

INSERT INTO `admin_rule` VALUES (1,'Admin/Index/index','后台首页',1,1,''),(2,'Admin/Index/home','后台Home',1,1,''),(3,'Admin/Admin/index','管理员管理',1,1,''),(4,'Admin/Admin/admin_add','管理员添加/注册',1,1,''),(5,'Admin/Admin/admin_edit','管理员编辑',1,1,''),(6,'Admin/Admin/admin_del','管理员删除',1,1,''),(7,'Admin/Admin/group','管理组管理',1,1,''),(8,'Admin/Admin/group_add','管理组添加',1,1,''),(9,'Admin/Admin/group_edit','管理组编辑',1,1,''),(10,'Admin/Admin/group_del','管理组删除',1,1,''),(11,'Admin/Admin/rule','权限规则管理',1,1,''),(12,'Admin/Admin/rule_add','权限规则添加',1,1,''),(13,'Admin/Admin/rule_edit','权限规则修改',1,1,''),(14,'Admin/Config/index','站点信息管理',1,1,''),(15,'Admin/Upload/upload_file','上传文件',1,1,''),(16,'Admin/Upload/index','上传文件管理',1,1,''),(17,'Admin/Upload/del_file','删除上传文件',1,1,''),(18,'Admin/Category/index','菜谱类别管理',1,1,''),(19,'Admin/Category/category_add','菜谱类添加',1,1,''),(20,'Admin/Category/category_edit','菜谱类编辑',1,1,''),(21,'Admin/Category/category_del','菜谱类删除',1,1,''),(22,'Admin/Material/index','食材类别管理',1,1,''),(23,'Admin/Material/material_add','食材类别添加',1,1,''),(24,'Admin/Material/material_edit','食材类别编辑',1,1,''),(25,'Admin/Material/material_del','食材类别删除',1,1,''),(26,'Admin/Property/index','菜品属性管理',1,1,''),(27,'Admin/Property/property_add','菜品属性添加',1,1,''),(28,'Admin/Property/property_edit','菜品属性编辑',1,1,''),(29,'Admin/Property/property_del','菜品属性删除',1,1,''),(30,'Admin/Menu/index','菜品列表管理',1,1,''),(31,'Admin/Menu/menu_add','菜品添加',1,1,''),(32,'Admin/Menu/menu_edit','菜品编辑',1,1,''),(33,'Admin/Menu/menu_del','菜品删除',1,1,''),(34,'Admin/Chef/index','厨师列表管理',1,1,''),(35,'Admin/Chef/chef_add','厨师信息添加',1,1,''),(36,'Admin/Chef/chef_edit','厨师信息编辑',1,1,''),(37,'Admin/Chef/chef_del','厨师信息删除',1,1,''),(38,'Admin/Page/index','单页信息管理',1,1,''),(39,'Admin/Page/page_add','单页信息添加',1,1,''),(40,'Admin/Page/page_edit','单页信息编辑',1,1,''),(41,'Admin/Page/page_del','单页信息删除',1,1,''),(42,'Admin/Taste/index','口味管理',1,1,''),(43,'Admin/Taste/taste_add','口味添加',1,1,''),(44,'Admin/Taste/taste_edit','口味编辑',1,1,''),(45,'Admin/Taste/taste_del','口味删除',1,1,''),(46,'Admin/Weight/index','份量管理',1,1,''),(47,'Admin/Weight/weight_add','份量添加',1,1,''),(48,'Admin/Weight/weight_edit','份量编辑',1,1,''),(49,'Admin/Weight/weight_del','份量删除',1,1,''),(50,'Admin/Order/index','订单管理',1,1,''),(51,'Admin/Order/order_edit','订单编辑',1,1,''),(52,'Admin/Order/order_del','订单删除',1,1,''),(53,'Admin/User/index','会员管理',1,1,''),(54,'Admin/User/user_add','会员添加',1,1,''),(55,'Admin/User/user_edit','会员编辑',1,1,''),(56,'Admin/User/user_del','会员删除',1,1,''),(57,'Admin/Collect/index','会员收藏管理',1,1,''),(58,'Admin/Collect/collect_del','会员收藏删除',1,1,''),(59,'Admin/Comment/index','会员评论管理',1,1,''),(60,'Admin/Comment/comment_check','会员评论审核',1,1,''),(61,'Admin/Comment/comment_del','会员评论删除',1,1,''),(62,'Admin/Message/index','会员留言管理',1,1,''),(63,'Admin/Message/message_check','会员留言审核',1,1,''),(64,'Admin/Message/message_del','会员留言删除',1,1,''),(65,'Admin/Weblink/index','友链管理',1,1,''),(66,'Admin/Weblink/weblink_add','友链添加',1,1,''),(67,'Admin/Weblink/weblink_edit','友链编辑',1,1,''),(68,'Admin/Weblink/weblink_del','友链删除',1,1,'');

#
# Structure for table "category"
#

CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜谱类别ID',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '菜谱类别名称',
  `keyword` varchar(50) NOT NULL COMMENT '关键词',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='菜谱类别';

#
# Data for table "category"
#

INSERT INTO `category` VALUES (1,'早餐','早餐','早餐'),(2,'午餐','午餐','午餐'),(3,'晚餐','晚餐','晚餐'),(4,'甜点','甜点','甜点');

#
# Structure for table "chef"
#

CREATE TABLE `chef` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '厨师ID',
  `name` varchar(30) NOT NULL COMMENT '厨师名称',
  `picurl` varchar(200) NOT NULL DEFAULT '' COMMENT '介绍图片',
  `keyword` varchar(50) NOT NULL COMMENT '关键词',
  `description` varchar(100) NOT NULL COMMENT '描述',
  `content` varchar(200) NOT NULL COMMENT '详细介绍',
  `checkinfo` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核（是否显示）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='厨师';

#
# Data for table "chef"
#

INSERT INTO `chef` VALUES (2,'厨师1','//localhost/cateringcms/Uploads/2017-06-21/594a35f7c097f.jpg','厨师1','厨师1','厨师1',1),(3,'厨师2','//localhost/cateringcms/Uploads/2017-06-21/594a33bdab77c.jpg','厨师2','厨师2','厨师2',1);

#
# Structure for table "collect"
#

CREATE TABLE `collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '收藏ID',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `menu_id` int(11) NOT NULL COMMENT '菜谱ID',
  `status` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态0删除1保留',
  `posttime` int(10) NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_menu_id` (`uid`,`menu_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='收藏';

#
# Data for table "collect"
#

INSERT INTO `collect` VALUES (4,1,10,0,1498378545),(5,1,9,0,1498379163),(6,1,6,0,1498432371),(7,1,11,0,1498433929);

#
# Structure for table "comment"
#

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级评论',
  `is_vip` tinyint(1) unsigned DEFAULT '0' COMMENT '是否会员',
  `uid` int(11) unsigned DEFAULT '0' COMMENT '会员id',
  `menu_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属菜单ID',
  `name` varchar(50) NOT NULL DEFAULT '0' COMMENT '昵称',
  `head` text COMMENT '头像',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `posttime` int(10) NOT NULL COMMENT '发布时间',
  `ip` varchar(30) NOT NULL COMMENT 'ip地址',
  `checkinfo` tinyint(1) unsigned NOT NULL COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论';

#
# Data for table "comment"
#


#
# Structure for table "config"
#

CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '配置项键名',
  `value` text COMMENT '配置项键值 1表示开启 0 关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='网站配置';

#
# Data for table "config"
#

INSERT INTO `config` VALUES (1,'WEB_STATUS','1'),(2,'WEB_CLOSE_WORD','网站正在维护，请见谅。'),(3,'WEB_ICP_NUMBER','豫123456789'),(4,'COPYRIGHT_INFO','Copyright.2005-2017 cateringcms.com ALL Hights Reserved '),(5,'WEB_NAME','餐饮网站'),(6,'WEB_URL','demo.imwnk.cn'),(7,'WEB_KEYWORDS','餐饮'),(8,'WEB_DESCRIPTION','餐饮'),(9,'WEB_AUTHOR','wangningkai'),(10,'WEB_FAVICON','//localhost/cateringcms/Uploads/2017-06-22/594aa0afe0010.png'),(11,'MAIL_HOST','smtp.exmail.qq.com'),(12,'MAIL_PORT','465'),(13,'MAIL_USERNAME','verification@imwnk.cn'),(14,'MAIL_PASSWORD','Captcha.123'),(15,'MAIL_FROMNAME','Admin'),(16,'WE_PAY','//localhost/cateringcms/Uploads/2017-06-21/5949e1b7b8f59.png'),(17,'ALI_PAY','//localhost/cateringcms/Uploads/2017-06-21/5949e1a2ce869.png'),(18,'WEB_NUM','0379-88888888');

#
# Structure for table "material"
#

CREATE TABLE `material` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '食材类别ID',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '食材类别名称',
  `keyword` varchar(50) NOT NULL COMMENT '关键词',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='食材分类';

#
# Data for table "material"
#

INSERT INTO `material` VALUES (1,'猪肉','猪肉','猪肉'),(2,'牛肉','牛肉','牛肉'),(3,'羊肉','羊肉','羊肉'),(4,'蔬菜','蔬菜','蔬菜'),(5,'禽类','禽类','禽类'),(6,'鱼类','鱼类','鱼类');

#
# Structure for table "menu"
#

CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜品ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '菜品名称',
  `keyword` varchar(50) NOT NULL COMMENT '关键词',
  `description` varchar(100) NOT NULL COMMENT '描述',
  `property` text COMMENT '属性',
  `category_id` int(11) unsigned NOT NULL COMMENT '菜品类别ID',
  `material_id` int(11) unsigned NOT NULL COMMENT '食材类别ID',
  `taste` text COMMENT '口味属性',
  `weight` text COMMENT '份量属性',
  `content` varchar(200) NOT NULL COMMENT '详细介绍',
  `picurl` varchar(200) NOT NULL COMMENT '特色介绍图片',
  `price` float unsigned NOT NULL DEFAULT '0' COMMENT '单价',
  `posttime` int(10) unsigned NOT NULL COMMENT '发布时间',
  `checkinfo` tinyint(1) unsigned NOT NULL COMMENT '发布状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='菜单';

#
# Data for table "menu"
#

INSERT INTO `menu` VALUES (3,'特色小牛排','特色小牛排','特色小牛排','1',3,2,'4','1,2,3','<p style=\"text-align: center; \"><b><font size=\"5\">特色小牛排</font></b></p><p><br></p>','//localhost/cateringcms/Uploads/2017-06-24/594dbd65ec6d6.jpg',198,1498433751,1),(4,'爆炒豆角','爆炒豆角','爆炒豆角','1',3,4,'4','1','<p style=\"text-align: center; \"><b><font size=\"5\">爆炒豆角</font></b></p><p><br></p>','//localhost/cateringcms/Uploads/2017-06-24/594dbde730e7c.jpg',25,1498433777,1),(5,'美味蟹','美味蟹','美味蟹','1,3',2,6,'1,2,3','1','<p style=\"text-align: center; \">美味蟹</p><p><br></p>','//localhost/cateringcms/Uploads/2017-06-24/594dbe24b2aa4.jpg',158,1498433804,1),(6,'糖醋里脊','糖醋里脊','糖醋里脊','5,6',2,5,'4','1','<p style=\"text-align: center; \"><font size=\"5\">糖醋里脊</font></p><p>糖醋里脊是经典汉族名菜之一。在浙江菜、鲁菜、川菜、粤菜和淮菜里都有此菜，以鲁菜的糖醋里脊最负盛名。糖醋里脊以猪里脊肉为主材，配以面粉，淀粉，醋等作料，酸甜可口，让人食欲大开</p><p><br></p>','//localhost/cateringcms/Uploads/2017-06-24/594df6a5cdb36.jpg',35,1498433827,1),(7,'培根蛋汤','培根蛋汤','培根蛋汤','5,7',3,1,'4','1,2,3','<p style=\"text-align: center; \"><b><font size=\"5\">培根蛋汤</font></b></p><p><br></p>','//localhost/cateringcms/Uploads/2017-06-24/594df7115d61a.jpg',50,1498433845,1),(8,'汤圆荟萃','汤圆荟萃','汤圆荟萃','5',4,4,'4,5,6','1','<p style=\"text-align: center; \"><font size=\"5\">汤圆荟萃</font></p><p><br></p>','//localhost/cateringcms/Uploads/2017-06-24/594df75553665.jpg',10,1498433893,1),(9,'排骨面','排骨面','排骨面','2,4',1,1,'4','1,3','<p style=\"text-align: center; \"><font size=\"5\">排骨面</font></p><p><br></p>','//localhost/cateringcms/Uploads/2017-06-24/594df78e8f380.jpg',10,1498433870,1),(10,'炸猪块','炸猪块','炸猪块','2,3',3,1,'1,2,3','1,2,3','<p style=\"text-align: center; \"><b><font size=\"5\">炸猪块</font></b></p><p><br></p>','//localhost\\/cateringcms\\/Uploads/2017-06-24/594e26b93941c.jpg',40,1498364178,1),(11,'肉夹馍','肉夹馍','肉夹馍','2,4',1,1,'4','1','<p style=\"text-align: center; \"><b><font size=\"6\">肉夹馍</font></b></p><p><br></p>','//localhost\\/cateringcms\\/Uploads/2017-06-24/594e274943f1a.jpg',10,1498433657,1),(12,'蒜爆牛肉','蒜爆牛肉','蒜爆牛肉','1,2',2,2,'4','1','<p style=\"text-align: center; \"><font size=\"4\">蒜爆牛肉</font></p><p><br></p>','//localhost\\/cateringcms\\/Uploads/2017-06-26/59504b4ce53ae.jpg',58,1498434389,1),(13,'特色卤肉饭','特色卤肉饭','特色卤肉饭','3,6',2,1,'4','1,3','<p style=\"text-align: center; \"><span style=\"color: inherit;\"><font size=\"5\">特色卤肉饭</font></span><br></p><p><br></p>','//localhost\\/cateringcms\\/Uploads/2017-06-26/59504d34d98db.jpg',15,1498434873,1),(14,'糯米糍','糯米糍','糯米糍','3,5',4,4,'4','1','<p style=\"text-align: center; \"><font size=\"5\">糯米糍</font></p><p><br></p>','//localhost\\/cateringcms\\/Uploads/2017-06-26/5950515235293.jpg',25,1498435926,1),(15,'绝味牛肉面','绝味牛肉面','绝味牛肉面','5,6,7',2,2,'1,2,3,4','1','<p style=\"text-align: center; \"><font size=\"5\">绝味牛肉面</font></p><p><br></p>','//localhost\\/cateringcms\\/Uploads/2017-06-26/595052250a613.jpg',15,1498436136,1);

#
# Structure for table "message"
#

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '留言ID',
  `is_vip` tinyint(1) unsigned DEFAULT '0' COMMENT '是否会员',
  `uid` int(11) unsigned DEFAULT '0' COMMENT '会员id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `head` text COMMENT '头像',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `posttime` int(10) NOT NULL COMMENT '发布时间',
  `ip` varchar(30) NOT NULL COMMENT 'ip地址',
  `checkinfo` tinyint(1) unsigned NOT NULL COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言';

#
# Data for table "message"
#


#
# Structure for table "order"
#

CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `order_num` varchar(50) NOT NULL DEFAULT '' COMMENT '订单编号',
  `uid` int(11) NOT NULL COMMENT '会员ID',
  `name` varchar(96) NOT NULL DEFAULT '' COMMENT '会员名',
  `shopping_name` varchar(32) NOT NULL COMMENT '收货人姓名',
  `shopping_tel` varchar(20) NOT NULL COMMENT '收货人电话',
  `shopping_address` varchar(100) NOT NULL COMMENT '收货人地址',
  `pay_code` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付方式（0为在线1为线下货到付款）',
  `comment` text NOT NULL COMMENT '备注',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '总价',
  `points` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所获积分',
  `order_status_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '订单状态',
  `status` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态0删除1保留',
  `posttime` int(10) NOT NULL COMMENT '订单生成时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单';

#
# Data for table "order"
#


#
# Structure for table "order_info"
#

CREATE TABLE `order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单商品ID',
  `order_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `menu_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `name` varchar(50) NOT NULL COMMENT '商品名称',
  `quentity` varchar(50) NOT NULL COMMENT '购买数量',
  `taste` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '口味属性',
  `weight` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '份量属性',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '单价',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单详情';

#
# Data for table "order_info"
#


#
# Structure for table "order_status"
#

CREATE TABLE `order_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单状态ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '付款状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='订单状态';

#
# Data for table "order_status"
#

INSERT INTO `order_status` VALUES (1,'已提交'),(2,'已付款'),(3,'已发货'),(4,'未发货'),(5,'已完成');

#
# Structure for table "page"
#

CREATE TABLE `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '单页id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者',
  `content` mediumtext NOT NULL COMMENT '内容',
  `posttime` int(10) unsigned NOT NULL COMMENT '更新时间',
  `checkinfo` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='网站单页';

#
# Data for table "page"
#

INSERT INTO `page` VALUES (1,'关于站点','admin','<p style=\"text-align: center; \"><b><font size=\"5\">关于站点</font></b></p><p><br></p>',1496457464,1),(2,'联系我们','admin','<h1>联系我们</h1><p><b><font size=\"4\">地址：中国北京市东长安街33号\r\n</font></b></p><p><b><font size=\"4\">电话：（86-10）65137766\r\n</font></b></p><p><b><font size=\"4\">传真：（86-10）65137307\r\n</font></b></p><p><b><font size=\"4\">邮箱：business@chinabeijinghotel.com.cn</font></b></p><h1>餐饮预订</h1><p><font size=\"4\"><b>地址：中国北京市东长安街33号</b></font></p><p><font size=\"4\"><b>电话：（86-10）65137766</b></font></p><p><font size=\"4\"><b>传真：（86-10）65137307</b></font></p><p></p><p><font size=\"4\"><b>邮箱：business@chinabeijinghotel.com.cn</b></font></p><p><br></p><p><br></p>',1498439104,1);

#
# Structure for table "property"
#

CREATE TABLE `property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `name` varchar(30) NOT NULL COMMENT '属性名称',
  `keyword` varchar(50) NOT NULL COMMENT '关键词',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='菜单属性';

#
# Data for table "property"
#

INSERT INTO `property` VALUES (1,'精品菜系','大图轮播展示','大图轮播展示'),(2,'特价菜系','特价菜系','特价菜系'),(3,'时令菜系','时令菜系','时令菜系'),(4,'本周特荐','本周特荐','本周特荐'),(5,'地方美味','地方美味','地方美味'),(6,'今日热键','今日热键','今日热键'),(7,'新品上市','新品上市','新品上市');

#
# Structure for table "taste"
#

CREATE TABLE `taste` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '口味ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '口味名称',
  `keyword` varchar(50) NOT NULL COMMENT '关键词',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='口味';

#
# Data for table "taste"
#

INSERT INTO `taste` VALUES (1,'不辣','',''),(2,'微辣','',''),(3,'辣','',''),(4,'默认','',''),(5,'微甜','微甜','微甜'),(6,'甜','甜','甜');

#
# Structure for table "uploads"
#

CREATE TABLE `uploads` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '上传信息id',
  `name` varchar(30) NOT NULL COMMENT '文件名称',
  `path` varchar(100) NOT NULL COMMENT '文件路径',
  `size` int(10) NOT NULL COMMENT '文件大小',
  `type` varchar(30) NOT NULL COMMENT '文件类型',
  `posttime` int(10) NOT NULL COMMENT '上传日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='上传信息';

#
# Data for table "uploads"
#

INSERT INTO `uploads` VALUES (2,'5949e1a2ce869.png','Uploads/2017-06-21/5949e1a2ce869.png',35,'png',1498014114),(3,'5949e1a5f07c8.png','Uploads/2017-06-21/5949e1a5f07c8.png',19,'png',1498014117),(4,'5949e1b7b8f59.png','Uploads/2017-06-21/5949e1b7b8f59.png',19,'png',1498014135),(5,'594a33bdab77c.jpg','Uploads/2017-06-21/594a33bdab77c.jpg',20,'jpg',1498035133),(6,'594a35f7c097f.jpg','Uploads/2017-06-21/594a35f7c097f.jpg',17,'jpg',1498035703),(7,'594a42088518e.png','Uploads/2017-06-21/594a42088518e.png',47,'png',1498038792),(9,'594aa0afe0010.png','Uploads/2017-06-22/594aa0afe0010.png',47,'png',1498063023),(10,'594ced221a398.jpg','Uploads/2017-06-23/594ced221a398.jpg',10,'jpg',1498213666),(14,'594cee976bcb2.jpg','Uploads/2017-06-23/594cee976bcb2.jpg',10,'jpg',1498214039),(15,'594cef2c6cb77.jpg','Uploads/2017-06-23/594cef2c6cb77.jpg',10,'jpg',1498214188),(16,'594cef98eee4a.jpg','Uploads/2017-06-23/594cef98eee4a.jpg',10,'jpg',1498214296),(18,'594cf01dbe4b3.jpg','Uploads/2017-06-23/594cf01dbe4b3.jpg',10,'jpg',1498214429),(19,'594dbd09e443b.jpg','Uploads/2017-06-24/594dbd09e443b.jpg',474,'jpg',1498266889),(20,'594dbd65ec6d6.jpg','Uploads/2017-06-24/594dbd65ec6d6.jpg',474,'jpg',1498266981),(21,'594dbde730e7c.jpg','Uploads/2017-06-24/594dbde730e7c.jpg',395,'jpg',1498267111),(22,'594dbe24b2aa4.jpg','Uploads/2017-06-24/594dbe24b2aa4.jpg',376,'jpg',1498267172),(23,'594df6a5cdb36.jpg','Uploads/2017-06-24/594df6a5cdb36.jpg',92,'jpg',1498281637),(24,'594df7115d61a.jpg','Uploads/2017-06-24/594df7115d61a.jpg',61,'jpg',1498281745),(25,'594df75553665.jpg','Uploads/2017-06-24/594df75553665.jpg',72,'jpg',1498281813),(26,'594df78e8f380.jpg','Uploads/2017-06-24/594df78e8f380.jpg',65,'jpg',1498281870),(27,'594e26b93941c.jpg','Uploads/2017-06-24/594e26b93941c.jpg',65,'jpg',1498293945),(28,'594e274943f1a.jpg','Uploads/2017-06-24/594e274943f1a.jpg',157,'jpg',1498294089),(31,'59504b4ce53ae.jpg','Uploads/2017-06-26/59504b4ce53ae.jpg',556,'jpg',1498434380),(32,'59504d34d98db.jpg','Uploads/2017-06-26/59504d34d98db.jpg',84,'jpg',1498434868),(33,'5950515235293.jpg','Uploads/2017-06-26/5950515235293.jpg',115,'jpg',1498435922),(34,'595052250a613.jpg','Uploads/2017-06-26/595052250a613.jpg',263,'jpg',1498436133),(35,'5951f6e1f1b80.jpg','Uploads/2017-06-27/5951f6e1f1b80.jpg',16,'jpg',1498543841);

#
# Structure for table "user"
#

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL COMMENT '用户名',
  `head` text NOT NULL COMMENT '头像',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '电子邮件',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birth` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生日',
  `password` varchar(60) NOT NULL DEFAULT '' COMMENT '密码',
  `telephone` varchar(32) NOT NULL DEFAULT '' COMMENT '电话',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '用户收货地址',
  `address_detail` text NOT NULL COMMENT '详细地址',
  `points` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `last_login_ip` varchar(40) NOT NULL DEFAULT '' COMMENT '最后登陆IP',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `checkinfo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户';

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'wangningkai','//localhost/cateringcms/Uploads/2017-06-27/5951f6e1f1b80.jpg','1655586865@qq.com','王宁凯',1,834681600,'$2y$11$nZyIpEm182szRMsWusAkGesPFNoAj0WmUPcvyxubQoMwIHMscHvzS','18437950050','','',0,'0.0.0.0',1498543868,1498543541,1);

#
# Structure for table "user_group"
#

CREATE TABLE `user_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `points_a` int(11) NOT NULL COMMENT '用户组经验介于a',
  `points_b` int(11) NOT NULL COMMENT '用户组经验介于b',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户组';

#
# Data for table "user_group"
#

INSERT INTO `user_group` VALUES (1,'初级会员',0,100,1),(2,'中级会员',101,300,1),(3,'高级会员',301,500,1);

#
# Structure for table "weblink"
#

CREATE TABLE `weblink` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接id',
  `webname` varchar(30) NOT NULL COMMENT '网站名称',
  `webnote` varchar(200) NOT NULL COMMENT '网站描述',
  `picurl` varchar(100) NOT NULL COMMENT '缩略图片',
  `linkurl` varchar(255) NOT NULL COMMENT '跳转链接',
  `posttime` int(10) unsigned NOT NULL COMMENT '更新时间',
  `checkinfo` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='友情链接';

#
# Data for table "weblink"
#

INSERT INTO `weblink` VALUES (1,'美食1','catering.com','','catering.com',1,1),(5,'美食2','catering.com','','catering.com',0,0),(6,'美食3','catering.com','','catering.com',0,0);

#
# Structure for table "weight"
#

CREATE TABLE `weight` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '份量ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '份量名称',
  `keyword` varchar(50) NOT NULL COMMENT '关键词',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='份量';

#
# Data for table "weight"
#

INSERT INTO `weight` VALUES (1,'标准','标准','标准'),(2,'小份','小份','小份'),(3,'大份','大份','大份');
