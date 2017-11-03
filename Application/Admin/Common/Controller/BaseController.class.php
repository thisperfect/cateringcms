<?php
namespace Admin\Common\Controller;
use Think\Controller;
class BaseController extends Controller {
    //初始化方法
    protected function _initialize(){
        header('Content-Type: text/html; charset=utf-8');
        //判断是否登录     
        if(!session('admin')){
            $this->error('非法访问！正在跳转到登录页！',U('Login/index'));
        }else{
            if(session('admin.checkinfo')!=1){
                $this->error("您审核未通过！",U('Home/Index/index'));
            }else{
                $this->checkAdminSession();
            }
        }
    }
    public function checkAdminSession() {
        //设置超时为1小时
        $nowtime = time();
        $s_time = $_SESSION['admin']['logintime'];
        if (($nowtime - $s_time) > 3600) {
            unset($_SESSION['admin']);
            $this->error('当前用户未登录或登录超时，请重新登录', U('Login/index'));
        } else {
            $_SESSION['admin']['logintime'] = $nowtime;
        }
    }
}
