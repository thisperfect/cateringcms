<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class LoginController extends Controller {
    // 登陆主页面
    public function index(){
        $this->display();
    }
    // 登陆验证
    public function loginchk(){
        if(IS_POST && !empty($_POST)){
            $name=trim(I('post.adminname'));
            $password=trim(I('post.password'));
            if(!empty($name) && !empty($password)){
                $adminData=M('admin')->where("name='$name'")->find();
                if($adminData){
                    vendor('Password.password');
                    $passwd = new \Vendor\Password\Password;
                    $verifyPass=$passwd->verifyPassword($password,$adminData['password']);
                    if($verifyPass){
                        $uid=$adminData['id'];
                        $agid=$adminData['group_id'];
                        $checkinfo=$adminData['checkinfo'];
                        $groupData=M('admin_group')->where("id='$agid'")->find();
                        $group=$groupData['title'];
                        $data['loginip']=get_client_ip();
                        $data['logintime']=time();
                        $_SESSION['admin']=array(
                        'uid'=>$uid,
                        'name'=>$name,
                        'group'=>$group,
                        'checkinfo'=>$checkinfo,
                        'loginip'=>$data['loginip'],
                        'logintime'=>$data['logintime']
                        );
                        $admin = M('admin')->where('id='.$uid)->save($data);
                        $this->success('登录成功，正在进入主页，请稍等！',U('Index/index'));
                    }else{$this->error('登录失败，账号或密码错误！',U('Login/index'));}
                }else{$this->error('登录失败，用户不存在！',U('Login/index'));}
            }else{$this->error('登录失败，帐号或密码为空！',U('Login/index'));}
        }
    }
    
    // 登出操作
    public function logout(){
        session('admin',null);
        $this->success('退出成功,前往登录页面','index');
    }
    // 生成验证码
    public function showVerify(){
        show_verify();
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}