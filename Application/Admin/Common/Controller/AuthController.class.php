<?php
namespace Admin\Common\Controller;
use Admin\Common\Controller\BaseController;
use Think\Auth;
class AuthController extends BaseController {
    protected function _initialize(){
        parent::_initialize();
        $sess_auth = session('admin'); 
        $auth = new Auth();
        if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$sess_auth['uid'])){
            $this->error("您没有该操作访问权限！",U('Admin/Login/index'));
        }else{
            return true;
        }
    }
}