<?php

namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    //初始化方法
    protected function _initialize(){
        //判断是否登录
        $sess_auth = session('admin');      
        if(!session('?admin')){
            $this->error('非法访问！正在跳转到登录页！',U('Login/index'));
        }else{
            if(session('admin.checkinfo')!=1){
                $this->error("您审核未通过！",U('Home/Index/index'));
            }
        }

    }
}