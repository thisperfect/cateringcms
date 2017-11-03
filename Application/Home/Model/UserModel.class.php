<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('uname','require','用户名不能为空'),
        array('uname','','该用户名已经被占用',0,'unique',self::MODEL_INSERT),
        array('password','require','密码不能为空'),
        array('confirm_password','require','确认密码必须填写'),
        array('confirm_password','password','两次密码保持一致',0,'confirm'),
        array('email','require','邮箱不能为空'),
        array('email','','该邮箱已经被占用',0,'unique',self::MODEL_INSERT),
    );
    // 自动完成规则
    protected $_auto = array ( 
         array('uname','trim',3,'function'),  
         array('password','trim',1,'function') , 
         array('password','passwdSet',1,'function') , 
         array('email','trim',3,'function'), 
         array('birth','strtotime',3,'function'), 
         array('create_time','time',3,'function'), 
    );
}
