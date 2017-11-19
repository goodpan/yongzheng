####管理员表#####
DROP TABLE IF EXISTS `yz_admin`;
CREATE TABLE IF NOT EXISTS `yz_admin`(
  `admin_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `admin_user` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '管理员账号',
  `admin_pass` CHAR(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `admin_email` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `login_time` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录时间',
  `login_ip` BIGINT NOT NULL DEFAULT '0' COMMENT '登录ip',
  `create_time` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `is_use` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '是否启用，0-禁用，1-启用',
  `is_del` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY(`admin_id`),
  UNIQUE yz_admin_adminuser_adminpass(`admin_user`,`admin_pass`),
  UNIQUE yz_admin_adminuser_adminemail(`admin_user`,`admin_email`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

INSERT INTO `yz_admin`(admin_user,admin_pass,admin_email,create_time) VALUES('admin',md5('yongzheng'),'admin@yongzheng.com',UNIX_TIMESTAMP());

######角色表##########
DROP TABLE IF EXISTS `yz_role`;
CREATE TABLE IF NOT EXISTS `yz_role`(
  `role_id` SMALLINT  UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `role_name` VARCHAR(32) NOT NULL COMMENT '角色名称',
  `create_time` INT NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`role_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色表';

######权限表##########
DROP TABLE IF EXISTS `yz_auth`;
CREATE TABLE IF NOT EXISTS `yz_auth` (
  `auth_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `auth_name` VARCHAR(32) NOT NULL COMMENT '名称',
  `auth_m` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '模块',
  `auth_c` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `auth_a` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_path` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '全路径',
  `auth_pid` SMALLINT UNSIGNED NOT NULL COMMENT '父权限id',
  `auth_level` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '级别：0-顶级',
  `create_time` INT NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`auth_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限表';

######角色权限表#######
DROP TABLE IF EXISTS `yz_role_auth`;
CREATE TABLE IF NOT EXISTS `yz_role_auth`(
  `role_id` SMALLINT UNSIGNED NOT NULL COMMENT '角色ID',
  `auth_id` SMALLINT UNSIGNED NOT NULL COMMENT '权限ID',
  `create_time` INT NOT NULL DEFAULT '0' COMMENT '创建时间',
  KEY yz_role_auth_roleid(`role_id`),
  KEY yz_role_auth_authid(`auth_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限表';

######管理员角色表#######
DROP TABLE IF EXISTS `yz_admin_role`;
CREATE TABLE IF NOT EXISTS `yz_admin_role`(
  `admin_id` INT UNSIGNED NOT NULL COMMENT '管理员ID',
  `role_id` SMALLINT UNSIGNED NOT NULL COMMENT '角色ID',
  `create_time` INT NOT NULL DEFAULT '0' COMMENT '创建时间',
  KEY yz_admin_role_adminid(`admin_id`),
  KEY yz_admin_role_roleid(`role_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员角色表';

######会员表#######
DROP TABLE IF EXISTS `yz_user`;
CREATE TABLE IF NOT EXISTS `yz_user`(
  `user_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `user_name` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_email` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `user_phone` VARCHAR(11) NOT NULL DEFAULT '' COMMENT '用户手机号',
  `user_pass` CHAR(32)  NOT NULL DEFAULT '' COMMENT '用户密码',
  `create_time` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  UNIQUE yz_user_username_userpass(`user_name`,`user_pass`),
  UNIQUE yz_user_useremail_userpass(`user_email`,`user_pass`),
  UNIQUE yz_user_userephone_userpass(`user_phone`,`user_pass`),
  PRIMARY KEY(`user_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';

#######会员信息表######
DROP TABLE IF EXISTS `yz_profile`;
CREATE TABLE IF NOT EXISTS `yz_profile`(
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `user_id` BIGINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
  `true_name` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `nike_name` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `age` TINYINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '年龄',
  `sex` ENUM('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '性别：(0:保密,1:男,2:女,3:其他)',
  `birthday` date NOT NULL DEFAULT '2010-01-01' COMMENT '生日',
  `company` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '公司',
  `create_time` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  UNIQUE yz_profile_userid(`user_id`),
  PRIMARY KEY(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员信息表';

#######证件分类表######
DROP TABLE IF EXISTS  `yz_category`;
CREATE TABLE IF NOT EXISTS `yz_category`(
  `cate_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `cate_name` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '分类名',
  `parent_id` BIGINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '父id',
  `create_time` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`cate_id`),
  kEY yz_category_parentid(`parent_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='证件分类表';

######证件表#########
DROP TABLE IF EXISTS `yz_credentials`;
CREATE TABLE IF NOT EXISTS `yz_credentials`(
    `cred_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
    `cate_id` BIGINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类ID',
    `cred_name` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '证件名',
    `descr` TEXT COMMENT '描述',
    `condition` TEXT COMMENT '申请条件',
    `material` TEXT COMMENT '申请材料',
    `cost` TEXT COMMENT '费用',
    `locale` TEXT COMMENT '申办地点',
    `cover` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '封面图',
    `is_hot` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '是否热门',
    `is_del` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '是否删除',
    `create_time` INT NOT NULL DEFAULT '0' COMMENT '创建时间',
    PRIMARY KEY (`cred_id`),
    KEY yz_credentials_cateid(`cate_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='证件表';

######评论表########
DROP TABLE IF EXISTS `yz_comment`;
CREATE TABLE `yz_comment` (
  `com_id` BIGINT unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL COMMENT '评论的内容',
  `star` tinyint(3) unsigned NOT NULL DEFAULT '3' COMMENT '打的分',
  `add_time` int(10) unsigned NOT NULL COMMENT '评论时间',
  `user_id` BIGINT UNSIGNED NOT NULL COMMENT '会员ID',
  `cred_id` BIGINT UNSIGNED NOT NULL COMMENT '证件ID',
  `used` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '有用的数量',
  PRIMARY KEY (`com_id`),
  KEY yz_comment_credid (`cred_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';
######商家表########
CREATE TABLE yz_business(
id int UNSIGNED auto_increment PRIMARY key,
user_id INT UNSIGNED, -- 关联用户表
comp_name VARCHAR(20) not null, -- 企业名称,
comp_img VARCHAR(50) not null, -- 企业营业执照扫描件,
comp_comf_img VARCHAR(50) not null, -- 确认书扫描件,
info_name VARCHAR(20) not null, -- 姓名,
info_num VARCHAR(20) not null, -- 身份证号码,
info_img VARCHAR(50) not null, -- 身份证正面照,
tel VARCHAR(11) not null, -- 电话号码,
email VARCHAR(30) not null -- 邮箱
)
ALTER TABLE yz_business ADD STATUS TINYINT DEFAULT 0 -- 0：审核中，1：拒绝：2锁定，3：审核通过