<?php
return array(
//*********************************附加设置***********************************
    'SHOW_PAGE_TRACE'       =>  true,                        //关闭Trace信息
    'LOAD_EXT_CONFIG'       =>  'db,webconfig',               //加载网站设置文件
    'TMPL_PARSE_STRING'=>array(
		'ADMIN_TPL_CSS'     =>__ROOT__.'/Public/admin_tpl/css',
		'ADMIN_TPL_FONTS'   =>__ROOT__.'/Public/admin_tpl/fonts',
		'ADMIN_TPL_IMG'     =>__ROOT__.'/Public/admin_tpl/img',
		'ADMIN_TPL_JS'      =>__ROOT__.'/Public/admin_tpl/js',
		'ADMIN_TPL_PLUG'    =>__ROOT__.'/Public/admin_tpl/plugins',
		'ADMIN_CUS_CSS'     =>__ROOT__.'/Public/admin_custom/css',
		'ADMIN_CUS_JS'      =>__ROOT__.'/Public/admin_custom/js',
		'ADMIN_CUS_IMG'     =>__ROOT__.'/Public/admin_custom/img',
		'ADMIN_CUS_PLUG'    =>__ROOT__.'/Public/admin_custom/plugins',
		'HOME_TPL_CSS'      =>__ROOT__.'/Public/home_tpl/css',
		'HOME_TPL_FONTS'    =>__ROOT__.'/Public/home_tpl/fonts',
		'HOME_TPL_IMG'      =>__ROOT__.'/Public/home_tpl/images',
		'HOME_TPL_JS'       =>__ROOT__.'/Public/home_tpl/js',
		'HOME_TPL_PLUG'     =>__ROOT__.'/Public/home_tpl/plugins',
		'HOME_CUS_JS'       =>__ROOT__.'/Public/home_custom/js',
	),
//***********************************SESSION设置*****************************
    'SESSION_OPTIONS'       =>  array(
        'name'              =>  'WNKSESSION',                 //设置session名
        'expire'            =>  24*3600*15,                   //SESSION保存15天
        'use_trans_sid'     =>  1,                            //跨页传递
        'use_only_cookies'  =>  0,                            //是否只开启基于cookies的session的会话方式
    ),
//***********************************URL设置*********************************
    'MODULE_ALLOW_LIST'     =>  array('Home','Admin'),               //允许访问列表
//***********************************URL*************************************
    'URL_MODEL'             =>  1,                            // 为了兼容性更好而设置成1 如果确认服务器开启了mod_rewrite 请设置为 2
    'URL_CASE_INSENSITIVE'  =>  false,                        // 区分url大小写
//***********************************其他设置*********************************
);
