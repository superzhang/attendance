-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015-05-23 16:16:33
-- 服务器版本: 5.5.41-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `WeCheck`
--

-- --------------------------------------------------------

--
-- 表的结构 `CheckList`
--

CREATE TABLE IF NOT EXISTS `CheckList` (
  `CheckListID` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `ClassID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `ReasonID` int(2) NOT NULL,
  `Lenth` int(8) NOT NULL,
  PRIMARY KEY (`CheckListID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3330 ;

-- --------------------------------------------------------

--
-- 表的结构 `Classes`
--

CREATE TABLE IF NOT EXISTS `Classes` (
  `ClassID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `Grade` int(8) NOT NULL COMMENT '年级',
  `ClassName` varchar(255) NOT NULL COMMENT '班级名称',
  `Peoples` int(4) NOT NULL COMMENT '人数',
  PRIMARY KEY (`ClassID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- 表的结构 `Course`
--

CREATE TABLE IF NOT EXISTS `Course` (
  `CourseID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseName` varchar(255) NOT NULL,
  `CourseLenth` int(8) NOT NULL DEFAULT '0' COMMENT '周课时',
  `delete` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=226 ;

-- --------------------------------------------------------

--
-- 表的结构 `py`
--

CREATE TABLE IF NOT EXISTS `py` (
  `pinyin` varchar(1) CHARACTER SET utf8mb4 NOT NULL COMMENT '拼音首字母',
  `hanzi` varchar(800) CHARACTER SET utf8mb4 NOT NULL COMMENT '汉字'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Reason`
--

CREATE TABLE IF NOT EXISTS `Reason` (
  `ReasonID` int(11) NOT NULL,
  `ReasonName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `ClassID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `StudentName` varchar(20) NOT NULL,
  `PY` varchar(20) NOT NULL COMMENT '拼音首字母',
  PRIMARY KEY (`StudentID`),
  KEY `ClassID` (`ClassID`),
  KEY `ClassID_2` (`ClassID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Syllabus`
--

CREATE TABLE IF NOT EXISTS `Syllabus` (
  `SyllabusID` int(11) NOT NULL AUTO_INCREMENT,
  `ClassID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Time` int(11) NOT NULL COMMENT '1周一2周二',
  `CourseInfo` varchar(255) NOT NULL,
  PRIMARY KEY (`SyllabusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=408 ;

-- --------------------------------------------------------

--
-- 表的结构 `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `UserPWD` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
