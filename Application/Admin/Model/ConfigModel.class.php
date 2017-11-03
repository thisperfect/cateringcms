<?php
namespace Admin\Model;
use Think\Model;
class ConfigModel extends Model{
    // // 自动验证规则
    // protected $patchValidate = true; 
    // protected $_validate = array(
    //     array('WEB_NAME','require','网站名不能为空'),
    //     array('WEB_URL','require','网站地址不能为空'),
    //     array('WEB_FAVICON','require','网站图标不能为空'),
    //     array('WEB_AUTHOR','require','网站作者不能为空'),
    //     array('WEB_KEYWORDS','require','网站关键词不能为空'),
    //     array('WEB_DESCRIPTION','require','网站描述不能为空'),
    //     array('COPYRIGHT_INFO','require','版权信息不能为空'),
    //     array('WEB_ICP_NUMBER','require','备案号不能为空'),
    //     array('WEB_CLOSE_WORD','require','关站选项不能为空'),
    //     array('WEB_STATUS',array(0,1),'关站选项参数错误！',2,'in'),
    // );
    // // 自动完成规则
    // protected $_auto = array ( 
    //     array('WEB_NAME','trim',3,'function'),  
    //     array('WEB_URL','trim',3,'function') , 
    //     array('WEB_AUTHOR','trim',3,'function'),  
    //     array('WEB_KEYWORDS','trim',3,'function'), 
    //     array('WEB_DESCRIPTION','trim',3,'function'), 
    //     array('WEB_ICP_NUMBER','trim',3,'function') , 
    // );

    // 修改数据
    public function editData(){
        $data=I('post.');
        foreach ($data as $k => $v) {
            $this->where(array('name'=>$k))->setField('value',$v);
            $data[$k]=htmlspecialchars_decode($v);
        }
        $str=<<<php
<?php
return array(
//此配置项为自动生成请勿直接修改；如需改动请在后台网站设置
//*************************************网站设置****************************************
    'WEB_STATUS'                =>  '{$data['WEB_STATUS']}',                           //网站状态1:开启 0:关闭
    'WEB_CLOSE_WORD'            =>  '{$data['WEB_CLOSE_WORD']}',                           //网站关闭时提示文字
    'WEB_ICP_NUMBER'            =>  '{$data['WEB_ICP_NUMBER']}',                           // 网站ICP备案号
    'COPYRIGHT_INFO'            =>  '{$data['COPYRIGHT_INFO']}',                           //版权信息

//*************************************优化推广****************************************
    'WEB_NAME'                  =>  '{$data['WEB_NAME']}',                           //网站名：
    'WEB_URL'                   =>  '{$data['WEB_URL']}',                           //网站地址：
    'WEB_KEYWORDS'              =>  '{$data['WEB_KEYWORDS']}',                           //网站关键字
    'WEB_DESCRIPTION'           =>  '{$data['WEB_DESCRIPTION']}',                           //网站描述
    'WEB_AUTHOR'                =>  '{$data['WEB_AUTHOR']}',                           //网站作者
    'WEB_NUM'                   =>  '{$data['WEB_NUM']}',                           //网站电话
    'WEB_FAVICON'               =>  '{$data['WEB_FAVICON']}',                           //站点图标地址

//***********************************邮箱设置***********************************************
	'MAIL_SMTP'                 =>  true,                         //是否为SMTP
	'MAIL_HOST'                 =>  '{$data['MAIL_HOST']}',         //发送服务器地址
	'MAIL_PORT'                 =>  '{$data['MAIL_PORT']}',                        //服务器端口
	'MAIL_SMTPAUTH'             =>  true,                         //是否开启验证
	'MAIL_USERNAME'             =>  '{$data['MAIL_USERNAME']}',      //用户名
	'MAIL_PASSWORD'             =>  '{$data['MAIL_PASSWORD']}',                //密码
	'MAIL_SECURE'               =>  true,                         //安全模式
	'MAIL_CHARSET'              =>  'UTF-8',                      //字符编码
	'MAIL_ISHTML'               =>  true,                         //是否为html
	'MAIL_FROMNAME'             =>  '{$data['MAIL_FROMNAME']}',                      //发件名
//*************************************支付信息****************************************
    'WE_PAY'                    =>  '{$data['WE_PAY']}',                          //微信支付码
    'ALI_PAY'                   =>  '{$data['ALI_PAY']}',                          //支付宝支付码
);
php;
        file_put_contents('./Application/Common/Conf/webconfig.php', $str);
        return true;
    }
    // 获取全部数据
    public function getAllData(){
        return $this->getField('name,value');
    }
}


