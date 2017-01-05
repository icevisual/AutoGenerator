-- ----------------------------
-- Date: 2017-01-05 08:37:06
-- ----------------------------

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

