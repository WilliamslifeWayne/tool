--user.sql
CREATE TABLE `user` IF NOT EXISTS (
	`uid` int(11) PRIMARY KEY auto_increment NOT NULL,
	`username` varchar(30) NOT NULL DEFAULT "" COMMENT "用户名",
	`password` varchar(50) NOT NULL DEFAULT "" COMMENT "密码，mcrypt方式加密",
	`tel` varchar(11) NOT NULL DEFAULT "" COMMENT "用户手机号",
	`join_time` int(11) NOT NULL DEFAULT 0 COMMENT "加入网站的时间",
	`if_use` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT "当前账号是否可用，0为可用",
	`group` tinyint UNSIGNED NOT NULL DEFAULT 0 COMMENT "账号所属的组别"
)