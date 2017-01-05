/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : automation

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2017-01-05 16:38:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for op_attrs
-- ----------------------------
DROP TABLE IF EXISTS `op_attrs`;
CREATE TABLE `op_attrs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(80) NOT NULL COMMENT '属性名字',
  `attr_name_cn` varchar(255) NOT NULL DEFAULT '' COMMENT '显示中文名',
  `attr_type` varchar(80) NOT NULL COMMENT '属性类别',
  `form_type` varchar(80) NOT NULL COMMENT '表单控件类别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='组件属性表';

-- ----------------------------
-- Records of op_attrs
-- ----------------------------
INSERT INTO `op_attrs` VALUES ('6', 'name', '名称', 'string', 'input');
INSERT INTO `op_attrs` VALUES ('7', 'type', '类型', 'array', 'select');
INSERT INTO `op_attrs` VALUES ('8', 'charLength', '字符长度', 'integer', 'input');
INSERT INTO `op_attrs` VALUES ('9', 'require', '是否必填', 'boolean', 'checkbox');
INSERT INTO `op_attrs` VALUES ('10', 'width', '宽度', 'integer', 'input');
INSERT INTO `op_attrs` VALUES ('15', 'height', '高度', 'integer', 'input');
INSERT INTO `op_attrs` VALUES ('19', 'keyOrValue', '值', 'array', 'keyOrValue');

-- ----------------------------
-- Table structure for op_component
-- ----------------------------
DROP TABLE IF EXISTS `op_component`;
CREATE TABLE `op_component` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `component_name` varchar(80) NOT NULL COMMENT '组件名称',
  `component_desc` varchar(255) NOT NULL COMMENT '组件描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='组件表';

-- ----------------------------
-- Records of op_component
-- ----------------------------
INSERT INTO `op_component` VALUES ('12', 'text', 'text文本框,password（密码框）,time（时间选择器）,number（数值框）,email（邮箱）,phone number（电话号码）,file(上传文件)');
INSERT INTO `op_component` VALUES ('13', 'button', '按钮');
INSERT INTO `op_component` VALUES ('14', 'checkbox', '复选框');
INSERT INTO `op_component` VALUES ('15', 'radio', '单选框');
INSERT INTO `op_component` VALUES ('16', 'select', '下拉框');
INSERT INTO `op_component` VALUES ('17', 'textarea', '多行文本框');
INSERT INTO `op_component` VALUES ('18', 'hidden', '隐藏域');

-- ----------------------------
-- Table structure for op_component_attrs
-- ----------------------------
DROP TABLE IF EXISTS `op_component_attrs`;
CREATE TABLE `op_component_attrs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL COMMENT '组件ID',
  `attr_id` int(11) NOT NULL COMMENT '属性ID',
  `default_value` varchar(80) DEFAULT NULL COMMENT '属性默认值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COMMENT='组件属性表';

-- ----------------------------
-- Records of op_component_attrs
-- ----------------------------
INSERT INTO `op_component_attrs` VALUES ('126', '16', '6', '');
INSERT INTO `op_component_attrs` VALUES ('127', '16', '10', '200');
INSERT INTO `op_component_attrs` VALUES ('128', '16', '15', '36');
INSERT INTO `op_component_attrs` VALUES ('132', '17', '10', '300');
INSERT INTO `op_component_attrs` VALUES ('133', '17', '15', '400');
INSERT INTO `op_component_attrs` VALUES ('134', '17', '6', '');
INSERT INTO `op_component_attrs` VALUES ('135', '18', '6', '');
INSERT INTO `op_component_attrs` VALUES ('136', '18', '10', '200');
INSERT INTO `op_component_attrs` VALUES ('137', '18', '15', '36');
INSERT INTO `op_component_attrs` VALUES ('142', '15', '10', '13');
INSERT INTO `op_component_attrs` VALUES ('143', '15', '15', '13');
INSERT INTO `op_component_attrs` VALUES ('144', '15', '6', '');
INSERT INTO `op_component_attrs` VALUES ('145', '15', '19', '{\"单选框1\":\"\"},{\"单选框2\":\"\"},{\"单选框3\":\"\"}');
INSERT INTO `op_component_attrs` VALUES ('146', '14', '10', '13');
INSERT INTO `op_component_attrs` VALUES ('147', '14', '15', '13');
INSERT INTO `op_component_attrs` VALUES ('148', '14', '6', '{\"复选框1\":\"\"},{\"复选框2\":\"\"},{\"复选框3\":\"\"}');
INSERT INTO `op_component_attrs` VALUES ('149', '12', '6', '');
INSERT INTO `op_component_attrs` VALUES ('150', '12', '7', 'text,password,time,number,email,phone number,file');
INSERT INTO `op_component_attrs` VALUES ('151', '12', '8', '');
INSERT INTO `op_component_attrs` VALUES ('152', '12', '9', '');
INSERT INTO `op_component_attrs` VALUES ('153', '12', '10', '200');
INSERT INTO `op_component_attrs` VALUES ('154', '12', '15', '36');
INSERT INTO `op_component_attrs` VALUES ('155', '13', '10', '62');
INSERT INTO `op_component_attrs` VALUES ('156', '13', '15', '36');
INSERT INTO `op_component_attrs` VALUES ('157', '13', '6', '');

-- ----------------------------
-- Table structure for op_form
-- ----------------------------
DROP TABLE IF EXISTS `op_form`;
CREATE TABLE `op_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL COMMENT '表单名称',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='表单表';

-- ----------------------------
-- Records of op_form
-- ----------------------------
INSERT INTO `op_form` VALUES ('1', 'ddddd', '2017-01-05 06:56:13', '2017-01-05 06:56:13');
INSERT INTO `op_form` VALUES ('2', '666', '2017-01-05 07:04:21', '2017-01-05 07:04:21');

-- ----------------------------
-- Table structure for op_form_component
-- ----------------------------
DROP TABLE IF EXISTS `op_form_component`;
CREATE TABLE `op_form_component` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL COMMENT '表单ID',
  `component_id` int(11) NOT NULL COMMENT '组件ID',
  `attr_id` varchar(80) NOT NULL COMMENT '属性ID',
  `attr_value` varchar(80) NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='组件实例表';

-- ----------------------------
-- Records of op_form_component
-- ----------------------------
INSERT INTO `op_form_component` VALUES ('12', '2', '12', '8', '');
INSERT INTO `op_form_component` VALUES ('13', '2', '12', '7', 'text,password,time,number,email,phone number,file');
INSERT INTO `op_form_component` VALUES ('14', '2', '12', '15', '36');
INSERT INTO `op_form_component` VALUES ('15', '2', '12', '6', '111');
INSERT INTO `op_form_component` VALUES ('16', '2', '12', '10', '200');
INSERT INTO `op_form_component` VALUES ('17', '2', '12', '9', '');

-- ----------------------------
-- Table structure for op_request_log
-- ----------------------------
DROP TABLE IF EXISTS `op_request_log`;
CREATE TABLE `op_request_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL COMMENT 'IP',
  `uri` varchar(100) DEFAULT NULL COMMENT '路由',
  `method` varchar(30) NOT NULL COMMENT 'method',
  `params` varchar(255) DEFAULT NULL COMMENT '参数',
  `http_status` smallint(5) DEFAULT NULL COMMENT 'HTTP 状态码',
  `return` text COMMENT '返回',
  `sha1` varchar(100) DEFAULT NULL COMMENT 'SHA1 of uri & params & return ',
  `time_usage` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '时间使用量S',
  `memory_usage` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '内存使用量MB',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4275 DEFAULT CHARSET=utf8 COMMENT='请求日志';

-- ----------------------------
-- Records of op_request_log
-- ----------------------------
INSERT INTO `op_request_log` VALUES ('4272', '127.0.0.1', 'api/external/form/save', 'POST', '{\"name\":\"ddddd\",\"components\":[{\"id\":\"12\",\"attrs\":[{\"attrId\":\"132\",\"defaultValue\":\"ad\"},{\"attrId\":\"123\",\"defaultValue\":\"\"}]}]}', '200', '{\"code\":9003,\"msg\":\"\\u8868\\u5355\\u540d\\u5b57 \\u5df2\\u7ecf\\u5b58\\u5728\\u3002\",\"data\":[]}', '3a447cc801f2632fecb72d9a6c33668e08975482', '0.0490', '1.4510', '2017-01-05 07:25:42');
INSERT INTO `op_request_log` VALUES ('4273', '127.0.0.1', 'api/external/form/query', 'GET', '[]', '200', '{\"code\":1,\"msg\":\"OK\",\"data\":[{\"id\":1,\"name\":\"ddddd\"},{\"id\":2,\"name\":\"666\"}]}', 'b45387c613be7789f91310732c9922f2eefa0127', '0.0110', '0.1704', '2017-01-05 07:25:42');
INSERT INTO `op_request_log` VALUES ('4274', '127.0.0.1', 'api/external/form/detail', 'GET', '{\"id\":\"2\"}', '200', '{\"code\":1,\"msg\":\"OK\",\"data\":{\"form\":{\"id\":2,\"name\":\"666\",\"createdAt\":\"2017-01-05 07:04:21\",\"updatedAt\":\"2017-01-05 07:04:21\"},\"components\":[{\"id\":12,\"componentName\":\"text\",\"componentDesc\":\"text\\u6587\\u672c\\u6846,password\\uff08\\u5bc6\\u7801\\u6846\\uff09,time\\uff08\\u65f6\\u95f4\\u9009\\u62e9\\u5668\\uff09,number\\uff08\\u6570\\u503c\\u6846\\uff09,email\\uff08\\u90ae\\u7bb1\\uff09,phone number\\uff08\\u7535\\u8bdd\\u53f7\\u7801\\uff09,file(\\u4e0a\\u4f20\\u6587\\u4ef6)\",\"attrs\":{\"charLength\":{\"attrId\":\"8\",\"attrName\":\"charLength\",\"attrNameCn\":\"\\u5b57\\u7b26\\u957f\\u5ea6\",\"defaultValue\":\"\",\"attrType\":\"integer\",\"formType\":\"input\"},\"width\":{\"attrId\":\"10\",\"attrName\":\"width\",\"attrNameCn\":\"\\u5bbd\\u5ea6\",\"defaultValue\":\"200\",\"attrType\":\"integer\",\"formType\":\"input\"},\"name\":{\"attrId\":\"6\",\"attrName\":\"name\",\"attrNameCn\":\"\\u540d\\u79f0\",\"defaultValue\":\"111\",\"attrType\":\"string\",\"formType\":\"input\"},\"height\":{\"attrId\":\"15\",\"attrName\":\"height\",\"attrNameCn\":\"\\u9ad8\\u5ea6\",\"defaultValue\":\"36\",\"attrType\":\"integer\",\"formType\":\"input\"},\"type\":{\"attrId\":\"7\",\"attrName\":\"type\",\"attrNameCn\":\"\\u7c7b\\u578b\",\"defaultValue\":\"text,password,time,number,email,phone number,file\",\"attrType\":\"array\",\"formType\":\"select\"},\"require\":{\"attrId\":\"9\",\"attrName\":\"require\",\"attrNameCn\":\"\\u662f\\u5426\\u5fc5\\u586b\",\"defaultValue\":\"\",\"attrType\":\"boolean\",\"formType\":\"checkbox\"}}}]}}', 'ff1dd14627cd0cd8af0a4541a09ca5cc059bfcc2', '0.0150', '0.0647', '2017-01-05 07:25:42');

-- ----------------------------
-- Table structure for op_request_params
-- ----------------------------
DROP TABLE IF EXISTS `op_request_params`;
CREATE TABLE `op_request_params` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(100) NOT NULL COMMENT '英文名',
  `name_zh` varchar(255) DEFAULT NULL COMMENT '中文名',
  `default` varchar(255) DEFAULT NULL COMMENT '默认值',
  `type` varchar(50) DEFAULT NULL COMMENT '类别',
  `sha1` varchar(255) DEFAULT NULL COMMENT 'SHA1',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='请求参数日志';

-- ----------------------------
-- Records of op_request_params
-- ----------------------------
INSERT INTO `op_request_params` VALUES ('1', 'pathname', 'unknown', null, 'String', '491f53', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('2', 'id', '属性名称-中文', '0', 'String', 'bdeef7', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('3', 'attr_name_cn', '属性名称-中文', null, 'String', '67ad5f', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('4', 'attr_name_en', '属性名称-英文', null, 'String', '3f7c91', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('5', 'attr_type', '属性数据类型', null, 'String', '297bd6', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('6', 'p', '页数', '1', 'String', 'ed3e59', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('7', 'n', '每页条数', '10', 'String', 'c9b6dd', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('8', 'component_name', '控件名称', null, 'String', 'a02ed4', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('9', 'component_desc', '控件描述', null, 'String', '5a98aa', '2016-12-29 10:50:33');
INSERT INTO `op_request_params` VALUES ('18', 'attrs', '属性数据类型', null, 'String', '297bd6', '2016-12-30 09:06:20');
INSERT INTO `op_request_params` VALUES ('19', 'attr_name', '属性名称', null, 'String', 'e2325f', '2017-01-03 03:12:49');
INSERT INTO `op_request_params` VALUES ('20', 'attr_value', '属性值', null, 'String', '03e158', '2017-01-03 03:12:49');
INSERT INTO `op_request_params` VALUES ('21', 'form_type', 'unknown', null, 'String', '491f53', '2017-01-03 03:12:49');
INSERT INTO `op_request_params` VALUES ('22', 'id', 'id', null, 'String', 'df881f', '2017-01-03 03:12:49');
INSERT INTO `op_request_params` VALUES ('23', 'attr_name_cn', '显示中文名', null, 'String', '403b53', '2017-01-03 10:00:28');
INSERT INTO `op_request_params` VALUES ('24', 'n', '每页条数', '10000', 'String', 'a1f659', '2017-01-03 10:00:28');
INSERT INTO `op_request_params` VALUES ('27', 'components', 'json {\"components\":[{\"id\":\"12\",\"attrs\":[{\"attrId\":\"132\",\"defaultValue\":\"ad\"},{\"attrId\":\"123\",\"defaultValue\":\"\"}]}]}', null, 'String', '6c84dc', '2017-01-04 09:28:46');
