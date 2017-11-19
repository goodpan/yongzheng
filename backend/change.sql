

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
comp_name VARCHAR(20) not null COMMENT '企业名称', -- ,
comp_img VARCHAR(50) not null COMMENT '企业营业执照扫描件', -- ,
comp_comf_img VARCHAR(50) not null COMMENT '确认书扫描件', -- ,
info_name VARCHAR(20) not null COMMENT '姓名', -- ,
info_num VARCHAR(20) not null COMMENT '身份证号码', -- ,
info_img VARCHAR(50) not null COMMENT '身份证正面照', -- ,
tel VARCHAR(11) not null COMMENT '电话号码', -- ,
email VARCHAR(30) not null COMMENT '邮箱', --
status TINYINT DEFAULT 0 COMMENT '0：审核中，1：拒绝：2锁定，3：审核通过'
)