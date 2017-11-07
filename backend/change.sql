

ALTER TABLE `yz_category` CHANGE cate_id id BIGINT UNSIGNED;
ALTER TABLE `yz_category` CHANGE cate_name name VARCHAR(32);
ALTER TABLE `yz_category` CHANGE parent_id pid BIGINT UNSIGNED;

ALTER TABLE `yz_auth` CHANGE auth_id id SMALLINT UNSIGNED;
ALTER TABLE `yz_auth` CHANGE auth_name name VARCHAR(32);
ALTER TABLE `yz_auth` CHANGE auth_pid pid SMALLINT UNSIGNED;