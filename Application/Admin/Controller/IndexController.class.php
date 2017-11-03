<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
class IndexController extends AuthController {
    // 后台首页
    public function index(){
        $name=session('admin.name');
        $group=session('admin.group');
        $order_status=M('order_status')->field('id,name')->select();
        $this->assign('name',$name);
        $this->assign('group',$group);
        $this->assign('o_status',$order_status);
        $this->display();
    }
    public function home(){
        $os = explode(" ", php_uname()); 
        if('/'==DIRECTORY_SEPARATOR){$v=$os[2];}else{$v=$os[1];}
        $server= $os[0].'&nbsp;'.$v;
        $web_server=$_SERVER['SERVER_SOFTWARE'];
        $php_v= PHP_VERSION;
        $conn=mysqli_connect('localhost','root','root');
        $query = mysqli_query($conn,'SELECT VERSION()');
        $data=mysqli_fetch_array($query);
        mysqli_close();
        $this->assign('os',$server);
        $this->assign('webserver',$web_server);
        $this->assign('php_v',$php_v);
        $this->assign('mysql_v',$data[0]);
        $this->display();
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}