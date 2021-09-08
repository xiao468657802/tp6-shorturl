-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-09-08 11:00:23
-- 服务器版本： 5.7.34-log
-- PHP 版本： 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `short_com`
--

-- --------------------------------------------------------

--
-- 表的结构 `ads`
--

CREATE TABLE `ads` (
                       `ad1` text NOT NULL,
                       `ad2` text NOT NULL,
                       `ad3` text NOT NULL,
                       `ad4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ads`
--

INSERT INTO `ads` (`ad1`, `ad2`, `ad3`, `ad4`) VALUES
('<h2>^..^</h2><p><img src=\"https://blog.vwlin.cn/usr/uploads/2021/02/2823788693.jpg\" alt=\"profile-pic\"><h4>^..^</h4> </p>', '<h2>哎呀 ! 页面找不到了啦 ! 404 !</h2><p> <img src=\"https://blog.vwlin.cn/usr/uploads/2021/02/2157914103.jpg\" alt=\"profile-pic\"></p>', '<h2></h2><p></p><img src=\"https://blog.vwlin.cn/usr/uploads/2021/02/2823788693.jpg\" alt=\"profile-pic\"><p></p><p>ads 300x250 recommended </p> ', '<h2></h2><p></p><img src=\"https://blog.vwlin.cn/usr/uploads/2021/02/2823788693.jpg\" alt=\"profile-pic\"> <p></p><p>ads 300x250 recommended </p> ');

-- --------------------------------------------------------

--
-- 表的结构 `links`
--

CREATE TABLE `links` (
                         `id` int(11) NOT NULL,
                         `url` varchar(800) DEFAULT NULL,
                         `link` varchar(16) NOT NULL,
                         `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `hits` int(16) NOT NULL DEFAULT '0' COMMENT '点击次数',
                         `pass` varchar(255) DEFAULT NULL,
                         `custom` int(1) NOT NULL DEFAULT '0' COMMENT '自定义',
                         `last_visit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `settings`
--

CREATE TABLE `settings` (
                            `id` int(6) NOT NULL,
                            `sitename` varchar(25) DEFAULT NULL,
                            `domain` varchar(50) DEFAULT NULL,
                            `cachetime` int(10) DEFAULT NULL,
                            `maxfile` int(6) NOT NULL,
                            `filtype` varchar(50) NOT NULL,
                            `title` varchar(100) DEFAULT NULL,
                            `keywords` varchar(50) DEFAULT NULL,
                            `descript` varchar(255) DEFAULT NULL,
                            `copyright` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `settings`
--

INSERT INTO `settings` (`id`, `sitename`, `domain`, `cachetime`, `maxfile`, `filtype`, `title`, `keywords`, `descript`, `copyright`) VALUES
(1, '小酥酥API', 'http://192.168.133.131/', 1111, 1000, 'png|jpg|js|css|jpeg|zip|rar', '小酥酥API', '小酥酥API', 'layuiAdmin 是 layui 官方出品的通用型后台模板解决方案', '© 2021 小酥酥AP MIT license');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
                         `id` int(6) NOT NULL,
                         `username` varchar(20) NOT NULL,
                         `password` varchar(60) NOT NULL,
                         `last_ip` varchar(255) DEFAULT NULL,
                         `is_admin` tinyint(4) DEFAULT '0',
                         `lastlogin_time` timestamp NOT NULL,
                         `login_count` int(11) NOT NULL,
                         `nickname` varchar(255) NOT NULL COMMENT 'nicheng',
                         `checkon` varchar(6) DEFAULT NULL COMMENT '单条url重复短链开关',
                         `sex` enum('男','女') DEFAULT NULL COMMENT 'xingbie',
                         `avatar` varchar(255) NOT NULL COMMENT 'touxiang',
                         `email` varchar(50) NOT NULL,
                         `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `last_ip`, `is_admin`, `lastlogin_time`, `login_count`, `nickname`, `checkon`, `sex`, `avatar`, `email`, `remarks`) VALUES
(1, 'admin', 'ef744145bbc6f8ecdf5e27cfdbaed823', '192.168.133.1', 1, '2021-09-01 09:17:24', 2, '小桃', 'off', '女', 'http://cdn.layui.com/avatar/168.jpg', 'susu@163.com', 'test112233');

--
-- 转储表的索引
--

--
-- 表的索引 `links`
--
ALTER TABLE `links`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `link` (`link`),
  ADD KEY `link_2` (`link`);

--
-- 表的索引 `settings`
--
ALTER TABLE `settings`
    ADD PRIMARY KEY (`id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `links`
--
ALTER TABLE `links`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `settings`
--
ALTER TABLE `settings`
    MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
    MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
