

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

 */
 //更改证件分类表主键字段（id）为自动递增
 alter table yz_category CHANGE id id int UNSIGNED auto_increment;
