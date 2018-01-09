

ALTER TABLE `yz_category` CHANGE cate_id id BIGINT UNSIGNED;
ALTER TABLE `yz_category` CHANGE cate_name name VARCHAR(32);
ALTER TABLE `yz_category` CHANGE parent_id pid BIGINT UNSIGNED;

ALTER TABLE `yz_auth` CHANGE auth_id id SMALLINT UNSIGNED;
ALTER TABLE `yz_auth` CHANGE auth_name name VARCHAR(32);
ALTER TABLE `yz_auth` CHANGE auth_pid pid SMALLINT UNSIGNED;
######商家表########
CREATE TABLE yz_business(
id int UNSIGNED auto_increment PRIMARY key,
user_id INT UNSIGNED COMMENT '关联用户表',
comp_name VARCHAR(20) not null COMMENT '企业名称',
comp_img VARCHAR(50) not null COMMENT '企业营业执照扫描件',
comp_comf_img VARCHAR(50) not null COMMENT '确认书扫描件',
info_name VARCHAR(20) not null COMMENT '姓名', -- ,
info_num VARCHAR(20) not null COMMENT '身份证号码',
info_img VARCHAR(50) not null COMMENT '身份证正面照',
tel VARCHAR(11) not null COMMENT '电话号码',
email VARCHAR(30) not null COMMENT '邮箱',
status TINYINT DEFAULT 0 COMMENT '0：审核中，1：拒绝：2锁定，3：审核通过'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家表';

/**
lmk 2017年12月2日20:51:36
ALTER TABLE yz_user add nickname varchar(30) not null default 0 comment '昵称';
ALTER TABLE yz_user add update_time int(11) not null default 0 comment '更新时间';
ALTER TABLE yz_user add profile varchar(50) not null default '' comment '简介';
ALTER TABLE yz_user add birthday int not null default 0 comment '生日';
ALTER TABLE yz_user add sex varchar(10) not null default '男' comment '性别';
ALTER TABLE yz_user add detailaddress varchar(50) not null default '' comment '详细地址';
ALTER TABLE yz_user add pca varchar(30) not null default '' comment '所在地省市区';
ALTER TABLE yz_user add  immobilize_phone  varchar(30) not null default '' comment '固定电话';
ALTER TABLE yz_user add  qq  varchar(30) not null default '' comment 'qq';


ALTER TABLE yz_business add  provance  varchar(30) not null default '' comment '省';
ALTER TABLE yz_business add  city  varchar(30) not null default '' comment '市';
ALTER TABLE yz_business add  area  varchar(30) not null default '' comment '区';


ALTER TABLE yz_credentials add  provance  varchar(30) not null default '' comment '省';
ALTER TABLE yz_credentials add  city  varchar(30) not null default '' comment '市';
ALTER TABLE yz_credentials add  area  varchar(30) not null default '' comment '区';

######用户需求表#########
DROP TABLE IF EXISTS `yz_requirements`;
CREATE TABLE IF NOT EXISTS `yz_requirements`(
    `requ_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
    `sName` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '需求标题',
    `sContent` TEXT COMMENT '需求描述',
    `type` tinyint(4)  NOT NULL DEFAULT '1' COMMENT '委托类型 1 企业 2 个人 3 其他',
    `sBudget` INT NOT NULL DEFAULT '0' COMMENT '预算金额',
    `sPhone` VARCHAR(11) NOT NULL DEFAULT '0' COMMENT '手机号码',
    `is_hot` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '是否热门',
    `is_del` ENUM('0','1') NOT NULL DEFAULT '0' COMMENT '是否删除',
    `create_time` INT NOT NULL DEFAULT '0' COMMENT '创建时间',
    `update_time` INT NOT NULL DEFAULT '0' COMMENT '更新时间',
    `dDeliverDate` INT NOT NULL DEFAULT '0' COMMENT '需求完成时间',
    PRIMARY KEY (`requ_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户需求表';
ALTER TABLE `yz_requirements` add  `user_id` BIGINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',

alter table yz_requirements add `status` tinyint(4) not null default '1' comment '需求状态 1 需求发布 2 需求已被认领 3.需求已完成',
alter table yz_requirements add `grade` tinyint(4) not null default '5' comment '评分 最高5星 最低1星',

alter table `yz_requirements` change type TypeID  tinyint(4)  NOT NULL DEFAULT '1' COMMENT '委托类型 1 企业 2 个人 3 其他',
 */
 //更改证件分类表主键字段（id）为自动递增
 alter table yz_category CHANGE id id int UNSIGNED auto_increment;
 //分类表增加字段
 ALTER TABLE yz_category add (
is_hot bit default 0 COMMENT '是否热门',
degree int(3) not null DEFAULT 0 COMMENT '等级'
)
