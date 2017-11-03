<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Controller\BaseController;
class UserController extends BaseController {
    // 登陆前置操作
    public function _before_login(){
         session('user',null);
         session('cart',null);
    }
    // 登陆注册验证
    public function login(){
        if(IS_POST && !empty($_POST)){
            $name=trim(I('post.uname'));
            $password=trim(I('post.password'));
            if(!empty($name) && !empty($password)){
                $userData=M('user')->where("uname='$name'")->find();
                if($userData){
                    vendor('Password.password');
                    $passwd = new \Vendor\Password\Password;
                    $verifyPass=$passwd->verifyPassword($password,$userData['password']);
                    if($verifyPass){
                        $uid=$userData['id'];
                        $head=$userData['head'];
                        $points=$userData['points'];
                        $checkinfo=$userData['checkinfo'];
                        $rows=M('user_group')->count();
                        $group=M('user_group')->select();
                        $groupName="";
                        for ($i=0; $i <$rows ; $i++) { 
                            if($userData['points'] >= $group[$i]['points_a'] && $userData['points'] <= $group[$i]['points_b']){
                                $groupName=$group[$i]['title'];
                            }
                        }
                        $data['last_login_ip']=get_client_ip();
                        $data['last_login_time']=time();
                        $_SESSION['user']=array(
                        'uid'=>$uid,
                        'name'=>$name,
                        'head'=>$head,
                        'group'=>$groupName,
                        'checkinfo'=>$checkinfo,
                        'last_login_ip'=>$data['last_login_ip'],
                        'last_login_time'=>$data['last_login_time']
                        );
                        $user = M('user')->where('id='.$uid)->save($data);
                        $this->success('登录成功，正在进入首页，请稍等！',U('Index/index'));
                    }else{$this->error('登录失败，账号或密码错误！',U('User/login'));}
                }else{$this->error('登录失败，用户不存在！',U('User/login'));}
            }else{$this->error('登录失败，帐号或密码为空！',U('User/login'));}
        }else{$this->display();}
    }
    // 登出操作
    public function logout(){
        session('user',null);
        $this->success('退出成功,前往登录页面',U('User/login'));
    }
    // 注册主页面
    public function register(){
        if(IS_POST){
            if (!empty($_POST)) {
                $verify=stripslashes(trim(I('post.verify')));
                $uname=stripslashes(trim(I('post.uname')));
                $password=stripslashes(trim(I('post.password')));
                $email=stripslashes(trim(I('post.email')));
                $chk_verify=check_verify($verify);
                if($chk_verify){
                    $user=D('User');
                    $data = $user->create($_POST,1);
                    if ($data) {
                        $info = $user->add($data);
                        if ($info) {
                            //  $this->success('注册成功!',U('User/Login'));
                            $key = passCrypt( $uname.'+'.$email); // 不可逆，验证
                            // $string中username，防止URL更改username
                            $string = base64_encode( $uname.'+'.$key ); // 加密，可解密
                            $url = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER ['HTTP_HOST'].U('User/emailcheck').'?key='.$key.'&info='.$string;
                            $sendTime = date('Y-m-d H:i');
                            $result = sendMail($email,$sendTime,$url,1);
                            if($result){
                                $this->success('系统已向您的邮箱发送了一封邮件,请登录到您的邮箱及时认账你的账号！',U('User/register'),3);
                            }else{$this->error('由于系统错误，请稍后重试！',U('User/register'));}  
                            // }else{$this->error("注册失败",U('User/register'));
                        }else{$this->error("用户信息写入错误，请稍后重试",U('User/register'));}
                    }else{
                        $error = $user->getError();
                        $str = "";
                        foreach ($error as $key => $value) {
                            $str .= $value . PHP_EOL;
                        }
                        $this->error($str,U('User/register'));
                    }
                }else{$this->error("验证码错误",U('User/register'));}
            }else{$this->error("传入数据为空",U('User/register'));}
        }else{
          $this->display();  
        }
    }
    public function emailcheck(){
        if(IS_GET){
            if(!empty($_GET)){
                $key=stripslashes(trim(I('get.key')));
                $info=stripslashes(trim(I('get.info')));
                $str = base64_decode( $info );
                $arr = explode( '+', $str );
                $user ['uname'] = $arr [0];
                $reinfo = M( 'user' )->where ( $user )->find ();
                 if (passCrypt($reinfo['uname'].'+'.$reinfo['email']) == $key){
                     $userData['checkinfo']='1';
                     $condition['uname']=$reinfo['uname'];
                     $checkuser=M('user')->where($condition)->save($userData);
                     if($checkuser){$this->success('恭喜你，审核成功',U('User/Login'));}
                     else{$this->error("数据有误，无法审核，请联系管理员",U('User/register'));}
                }else{$this->error("无效的链接",U('User/register'));}
            }else{$this->error("非法访问",U('User/register'));}
        }
    }
    // 找回密码
    public function forgetPass(){
        if(IS_POST){
            if(!empty($_POST)){   
                $verify=stripslashes(trim(I('post.verify')));
                $chk_verify=check_verify($verify);
                if($chk_verify){
                    $email=stripslashes(trim(I('post.email')));
                    $condition['email']=$email;
                    $info=M('user')->field('id,uname,password')->where($condition)->find();
                    if($info){
                        $key = passCrypt( $info ['uname'].'+'.$info ['password']); // 不可逆，验证
                        // $string中username，防止URL更改username
                        $string = base64_encode( $info['uname'].'+'.$key ); // 加密，可解密
                        $time = time();
                        $code=passCrypt('mytime'.$time);
                        $url = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER ['HTTP_HOST'].U('User/resetchk').'?key='.$key.'&info='.$string.'&time='.$time.'&code=' .$code; // code是用来检验time是否有修改过
                        $sendTime = date('Y-m-d H:i');
                        $result = sendmail($email,$sendTime,$url,0);
                        if($result){
                            $this->success('系统已向您的邮箱发送了一封邮件,请登录到您的邮箱及时重置您的密码！',U('User/login'),5);
                        }else{$this->error('由于系统错误，请稍后重试！',U('User/login'),5);}         
                    }else{$this->error('填写邮箱尚未注册！',U('User/login'),5);}
                }else{$this->error("验证码错误",U('User/login'));}
            }else{$this->error("非法访问",U('User/login'));}
        }
    }
    // 验证找回密码
    public function resetchk(){
        if(IS_GET){
            if(!empty($_GET)){
                $_SESSION ['findPassInfo'] = array (
                    'key'  => stripslashes(trim(I('get.key'))),
                    'info' => stripslashes(trim(I('get.info'))),
                    'code' => stripslashes(trim(I('get.code'))),
                    'time' => stripslashes(trim(I('get.time'))),
                );
                $this->display();  
            }else{$this->error("非法访问",U('User/login'));}
        }else if(IS_POST){
            if(!empty($_POST)){
                $str = base64_decode( session('findPassInfo.info') );
                $arr = explode( '+', $str );
                $user ['uname'] = $arr [0];
                $reinfo = M( 'user' )->where ( $user )->find ();
                // 判断是否在有效期，这里用时间戳判断，还可以用SESSION有效期判断,这里设置为30分钟
                $retime = time();
                if((session('findPassInfo.code')==passCrypt('mytime'.session('findPassInfo.time'))) && (((session('findPassInfo.time')) + (60 * 30)) >= $retime)){
                    if (passCrypt($reinfo['uname'].'+'.$reinfo['password']) == session('findPassInfo.key')){
                        $uid = $reinfo ['id'];
                        $username = $reinfo ['uname'];
                        $user=M('user');
                        $chkrules = array(
                            array('email','require','邮箱不能为空'),
                            array('password','require','密码不能为空'),
                            array('confirm_password','require','确认密码必须填写'),
                            array('confirm_password','password','两次密码保持一致',0,'confirm'),
                        );
                        $autorules = array(
                            array('password','trim',3,'function') , 
                            array('password','passwdSet',3,'function') , 
                        );
                        $data=$user->validate($chkrules)->auto($autorules)->create($_POST,2);
                        if($data){
                            $condition['id']=$uid;
                            $condition['uname']=$username;
                            $info = $user->where($condition)->save($data);
                        if($info){session('findPassInfo',null);$this->success('密码重置成功，请登陆！',U('User/login'));}
                        else{$this->error('写入数据失败',U('User/login'));}
                    }else{$error = $user->getError();$this->error($error,U('User/login'));}
                }else{session('findPassInfo',null);$this->error("无效的链接",U('User/login'));}
            }else{$this->error("该链接已过期",U('User/login'));}
        }else{$this->error("非法访问",U('User/login'));}
    }
}
    // 生成验证码
    public function showVerify(){
        show_verify();
    }
    // 空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
}