<?php
return array(
//此配置项为自动生成请勿直接修改；如需改动请在后台网站设置
//*************************************网站设置****************************************
    'WEB_STATUS'                =>  '1',                           //网站状态1:开启 0:关闭
    'WEB_CLOSE_WORD'            =>  '网站正在维护，请见谅。',                           //网站关闭时提示文字
    'WEB_ICP_NUMBER'            =>  '豫123456789',                           // 网站ICP备案号
    'COPYRIGHT_INFO'            =>  'Copyright.2005-2017 cateringcms.com ALL Hights Reserved ',                           //版权信息

//*************************************优化推广****************************************
    'WEB_NAME'                  =>  '餐饮网站',                           //网站名：
    'WEB_URL'                   =>  'cateringcms.com',                           //网站地址：
    'WEB_KEYWORDS'              =>  '餐饮',                           //网站关键字
    'WEB_DESCRIPTION'           =>  '餐饮',                           //网站描述
    'WEB_AUTHOR'                =>  'yinyilun',                           //网站作者
    'WEB_NUM'                   =>  '0379-88888888',                           //网站电话
    'WEB_FAVICON'               =>  '//localhost/cateringcms/Uploads/2017-10-22/59ec136d4a1a7.png',                           //站点图标地址

//***********************************邮箱设置***********************************************
	'MAIL_SMTP'                 =>  true,                         //是否为SMTP
	'MAIL_HOST'                 =>  'smtp.163.com',         //发送服务器地址
	'MAIL_PORT'                 =>  '465',                        //服务器端口
	'MAIL_SMTPAUTH'             =>  true,                         //是否开启验证
	'MAIL_USERNAME'             =>  'vrf_email_catering@163.com',      //用户名
	'MAIL_PASSWORD'             =>  'email163',                //密码
	'MAIL_SECURE'               =>  true,                         //安全模式
	'MAIL_CHARSET'              =>  'UTF-8',                      //字符编码
	'MAIL_ISHTML'               =>  true,                         //是否为html
	'MAIL_FROMNAME'             =>  'Admin',                      //发件名
//*************************************支付信息****************************************
    'WE_PAY'                    =>  '//localhost/cateringcms/Uploads/2017-06-21/5949e1b7b8f59.png',                          //微信支付码
    'ALI_PAY'                   =>  '//localhost/cateringcms/Uploads/2017-06-21/5949e1a2ce869.png',                          //支付宝支付码
);