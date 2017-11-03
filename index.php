<?php
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
// 定义应用目录
define('APP_PATH','./Application/');
// 关闭目录安全文件的生成
define('BUILD_DIR_SECURE',false);
//定义Home模块
// define('BIND_MODULE', 'Home');
// 定义缓存目录
define('RUNTIME_PATH','./Runtime/');
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';