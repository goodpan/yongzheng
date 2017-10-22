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
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `yz_admin`(admin_user,admin_pass,admin_email,create_time) VALUES('admin',md5('yongzheng'),'admin@yongzheng.com',UNIX_TIMESTAMP());