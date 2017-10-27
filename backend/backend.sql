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
  PRIMARY KEY(`admin_id`),
  UNIQUE yz_admin_adminuser_adminpass(`admin_user`,`admin_pass`),
  UNIQUE yz_admin_adminuser_adminemail(`admin_user`,`admin_email`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

INSERT INTO `yz_admin`(admin_user,admin_pass,admin_email,create_time) VALUES('admin',md5('yongzheng'),'admin@yongzheng.com',UNIX_TIMESTAMP());

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