<?php
// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

//cdn地址
define('UPLOADS_PATH', 'http://'.$_SERVER['HTTP_HOST'].'/uploads/');

// DIS目录
define('DIST', 'http://'.$_SERVER['HTTP_HOST'].'/dist/admin/');

// 缓存文件目录
define('RUNTIME_PATH','./runtime/');

// 模板目录
define('TMPL_PATH','./template/');

// 上一个地址
define('PREV_URL', isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '');

// 定义应用目录
define('APP_PATH','./web/');

//定义默认模块
define('BIND_MODULE','Admin');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
