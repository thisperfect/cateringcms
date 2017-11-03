<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-26 10:39:08 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-16 15:24:56
 * 用户管理类
 */
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('uname','require','用户名不能为空'),
        array('uname','','该用户名已经被占用',0,'unique',self::MODEL_INSERT),
        array('password','require','密码不能为空'),
        array('confirm_password','require','确认密码必须填写'),
        array('confirm_password','password','两次密码保持一致',0,'confirm'),
        // 其它规则在这
        array('email','require','电子邮件不能为空'),
        array('email','','该邮箱已经被占用',0,'unique',self::MODEL_INSERT),
        array('checkinfo',array(0,1),'值的范围不正确！',2,'in')
    );
    // 自动完成规则
    protected $_auto = array ( 
         array('uname','trim',3,'function'),  
         array('password','trim',1,'function') , 
         array('password','passwdSet',1,'function') , 
         array('email','trim',3,'function'), 
         array('create_time','time',3,'function')
    );
}
