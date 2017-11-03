<?php
namespace Home\Common\Controller;
use Home\Common\Controller\BaseController;
class CheckLogController extends BaseController {
    //初始化方法
    protected function _initialize(){
        parent::_initialize();        
        // 判断是否登录   
        if(!session('?user')){
            $this->error('对不起，您未登陆无法操作！',U('Home/User/login'));
        }else{
            if(session('user.checkinfo')!=1){
                $this->error("对不起，您未认证，无法操作！",U('Home/Index/index'));
            }else{
                $this->checkAdminSession();
            }
        }   
    }
    // 判断是否登陆超时
    public function checkAdminSession() {
        //设置超时为60分
        $nowtime = time();
        $s_time = $_SESSION['user']['last_login_time'];
        if (($nowtime - $s_time) > 3600) {
            unset($_SESSION['user']);
            $this->error('当前用户未登录或登录超时，请重新登录', U('User/login'));
        } else {
            $_SESSION['last_login_time'] = $nowtime;
        }
    }
}

         