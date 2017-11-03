<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; //批量验证
    protected $_validate = array(
        array('name','require','用户名不能为空'),
        array('name','','该用户名已经被占用',0,'unique',1),
        array('password','require','密码不能为空'),
        array('confirm_password','require','确认密码必须填写'),
        array('confirm_password','password','两次密码保持一致',0,'confirm'),
        array('email','require','邮箱不能为空'),
        array('email','','该邮箱已经被占用',0,'unique',self::MODEL_INSERT),
        array('group_id','require','用户组不能为空'),
        array('checkinfo','require','审核状态不能为空'),
        array('checkinfo',array(0,1),'值的范围不正确！',2,'in'),
    );
    // 自动完成规则
    protected $_auto = array ( 
         array('name','trim',3,'function'),  
         array('password','trim',1,'function') , 
         array('password','passwdSet',1,'function') , 
         array('email','trim',3,'function'), 
    );
}
