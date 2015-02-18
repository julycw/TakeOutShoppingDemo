<?php
return array(
	//数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'takeout', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'endville!', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    //加载common
    'LOAD_EXT_FILE'=>'extends_cls', //公共函数
    'LAYOUT_ON'=>true,
    'LAYOUT_NAME'=>'layout',
);
?>