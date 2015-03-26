<?php
return array(

     // 模块相关配置 
    'DEFAULT_MODULE'     => 'Home',
    'MODULE_DENY_LIST'   => array('Admin'),

    // URL地址不区分大小写
    'URL_CASE_INSENSITIVE' => true,

    // 数据库配置 
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'qiu_v1', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'qiu_', // 数据库表前缀


    // 用户密码盐
    'PASSWORD_SALT' => 'pPbzw4F,8fs1Cr_-o~LmY|u/cSG?ny`9lq]Qh[iU',
);