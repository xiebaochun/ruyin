<?php
return array(

    /*测试环境*/
    'DB_HOST'   => '127.0.0.1',  // 服务器地址
    'DB_NAME'   => 'ruyin',                            // 数据库名
    'DB_USER'   => 'root',                      // 用户名
    'DB_PWD'    => '',                     // 密码

    /*生产环境
    'DB_HOST'   => '',                                  // 服务器地址
    'DB_NAME'   => '',                                  // 数据库名
    'DB_USER'   => '',                                  // 用户名
    'DB_PWD'    => '',                                  // 密码
    */

    /*数据库类型*/
    'DB_TYPE'   => 'mysql',                             // 数据库类型
    'DB_PORT'   => 3306,                                // 端口
    'DB_PREFIX' => 'ry_bottle_',                        // 数据库表前缀
    'DB_CHARSET'=> 'utf8',                              // 字符集
    'DB_FIELDS_CACHE' => false,                          // 字段缓存

    /*URL模式*/
    'URL_MODEL'          => '2',                        //URL模式
    'DEFAULT_MODULE'     => 'TyRyBottleInChina',        // 默认模块
    'DEFAULT_CONTROLLER' => 'Pc',                       // 默认控制器名称
    'DEFAULT_ACTION'     => 'index',                    // 默认操作名称
    'URL_CASE_INSENSITIVE' => false,                     //URL不区分大小写

    /*SESSION设置*/
    'SESSION_AUTO_START' => true,                       //是否自动开启SESSION
    'SESSION_PREFIX'     => 'ry_bottle',                //SESSION 前缀

    /*COOKIE设置*/
    'COOKIE_PREFIX'      => 'ry_bottle_',                //COOKIE 前缀
    'COOKIE_PATH'        => '/',                        //COOKIE 路径
    //'COOKIE_DOMAIN'      => 'sinreweb.com',

    /*视图模板配置*/
    'TMPL_TEMPLATE_SUFFIX' => '.tpl',                   //模板文件后缀
    'TMPL_FILE_DEPR' => '_',                            //分隔符

    /*错误信息*/
    'SHOW_ERROR_MSG' => true,                          //显示错误信息

    /*密钥*/
    'AU_KEY' => 'PO2IUHBV@#$%^&*YKMJN1',

    /*微信配置*/
    'wechat' => array(
        'appid' => 'wx79fa44ec8495f95a',
        'appsecret' => '5c4661bedc6a217b74816b239188f473',
    ),
    
    /*上传配置*/
    'upload_maxsize' => '3145728',

);