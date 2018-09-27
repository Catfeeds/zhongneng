/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : huaju

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 08/08/2018 01:04:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hl_nav
-- ----------------------------
DROP TABLE IF EXISTS `hl_nav`;
CREATE TABLE `hl_nav`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '导航',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT '上级id',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `order` int(11) NULL DEFAULT 0 COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'url',
  `is_blank` tinyint(1) NULL DEFAULT 0 COMMENT '是否新窗口 0-否，1-是',
  `type` int(11) NULL DEFAULT 1 COMMENT '类型，1-头部，2-尾部,3-banner,4-底部',
  `ico` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图标',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 171 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hl_nav
-- ----------------------------
INSERT INTO `hl_nav` VALUES (154, 147, '金融', 17, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (153, 147, '保险', 18, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (152, 147, '制造', 19, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (151, 146, '企业', 1, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (150, 151, '客户数据管理', 1, NULL, '2018-08-03 03:31:57', '/category/420', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (149, 151, '数据精准营销', 2, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (148, 151, '数据风控合规', 3, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (147, 146, '行业', 2, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (146, 0, '方案', 15, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (145, 134, '高可用容错平台', 4, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (144, 134, '系统应用监控', 5, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (143, 135, '数据诊所', 7, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (142, 135, '数据共享平台', 8, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (141, 136, '元数据管理', 10, NULL, '2018-08-03 03:31:57', '/category/411', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (140, 136, '数据质量管理', 11, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (139, 136, '数据集成', 12, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (138, 136, '分布式数据库', 13, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (137, 136, '数据可视化分析', 14, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (136, 133, '技术层', 3, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (135, 133, '应用层', 6, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (134, 133, '基础架构', 9, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (133, 0, '产品', 2, NULL, '2018-08-03 03:31:57', '', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (132, 0, '首页', 1, NULL, '2018-08-03 03:31:57', '/', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (155, 147, '电力', 20, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (156, 147, '商贸', 21, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (157, 147, '医疗', 22, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (158, 0, '服务', 27, NULL, '2018-08-03 03:31:57', '/category/428', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (165, 162, '活动', 1, NULL, NULL, '/activity', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (162, 0, '资源中心', 31, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (170, 0, '下载记录', 34, NULL, NULL, '/download-list', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (164, 0, '关于我们', 33, NULL, '2018-08-03 03:31:57', NULL, 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (166, 162, '成功案例', 2, NULL, NULL, '/category/475', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (167, 164, '华矩简介', 0, NULL, NULL, '/category/459', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (168, 164, '人才发展', 0, NULL, NULL, '/category/469', 0, 1, NULL);
INSERT INTO `hl_nav` VALUES (169, 164, '新闻资讯', 0, NULL, NULL, '/category/432', 0, 1, NULL);

SET FOREIGN_KEY_CHECKS = 1;
