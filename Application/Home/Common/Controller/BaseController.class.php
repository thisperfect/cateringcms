<?php
namespace Home\Common\Controller;
use Think\Controller;
class BaseController extends Controller {
    //初始化方法
    protected function _initialize(){
        header('Content-Type: text/html; charset=utf-8');
        // 判断是否关站
        if(C('WEB_STATUS')=='0'){
            $this->display('Static/close');
            exit();
        }else{
            $this->menu();
            return true;
        }
    }
    // 获取导航和友链
    protected function menu(){
        $page=M('page')->field('id,title')->select();
        $weblink=M('weblink')->field('webname,linkurl')->select();
        $this->assign('navpage',$page);
        $this->assign('weblink',$weblink);
    }
}
