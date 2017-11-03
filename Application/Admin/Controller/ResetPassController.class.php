<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class ResetPassController extends Controller {
   // 密码找回验证
   public function index(){
    if(IS_POST){
        if(!empty($_POST)){   
            $verify=stripslashes(trim(I('post.verify')));
            $chk_verify=check_verify($verify);
            if($chk_verify){
                $email=stripslashes(trim(I('post.email')));
                $condition['email']=$email;
                $info=M('admin')->field('id,name,password')->where($condition)->find();
                if($info){
                    $key = passCrypt( $info ['name'].'+'.$info ['password']); // 不可逆，验证
                    // $string中username，防止URL更改username
                    $string = base64_encode( $info['name'].'+'.$key ); // 加密，可解密
                    $time = time();
                    $code=passCrypt('mytime'.$time);
                    $url = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER ['HTTP_HOST'].U('ResetPass/resetchk').'?key='.$key.'&info='.$string.'&time='.$time.'&code=' .$code; // code是用来检验time是否有修改过
                    $sendTime = date('Y-m-d H:i');
                    $result = sendMail($email,$sendTime,$url);
                    if($result){
                        $this->success('系统已向您的邮箱发送了一封邮件,请登录到您的邮箱及时重置您的密码！',U('Login/index'),5);
                    }else{$this->error('由于系统错误，请稍后重试！',U('Login/index'),5);}         
                }else{$this->error('填写邮箱尚未注册！',U('Login/index'),5);}
            }else{$this->error("验证码错误",U('Login/index'));}
        }else{$this->error("非法访问",U('Login/index'));}
    }
}
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
            }else{$this->error("非法访问",U('Login/index'));}
        }else if(IS_POST){
            if(!empty($_POST)){
                $str = base64_decode( session('findPassInfo.info') );
                $arr = explode( '+', $str );
                $user ['name'] = $arr [0];
                $reinfo = M( 'admin' )->where ( $user )->find ();
                // 判断是否在有效期，这里用时间戳判断，还可以用SESSION有效期判断,这里设置为30分钟
                $retime = time();
                if((session('findPassInfo.code')==passCrypt('mytime'.session('findPassInfo.time'))) && (((session('findPassInfo.time')) + (60 * 30)) >= $retime)){
                    if (passCrypt($reinfo['name'].'+'.$reinfo['password']) == session('findPassInfo.key')){
                        $uid = $reinfo ['id'];
                        $username = $reinfo ['name'];
                        $admin=M('admin');
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
                        $data=$admin->validate($chkrules)->auto($autorules)->create($_POST,2);
                        if($data){
                            $condition['id']=$uid;
                            $condition['name']=$username;
                            $info = $admin->where($condition)->save($data);
                        if($info){session('findPassInfo',null);$this->success('密码重置成功，请登陆！',U('Login/index'));}
                        else{$this->error('写入数据失败',U('Login/index'));}
                        }
                    }else{$error = $admin->getError();$this->error($error,U('Login/index'));}
                }else{session('findPassInfo',null);$this->error("无效的链接",U('Login/index'));}
            }else{$this->error("该链接已过期",U('Login/index'));}
        }else{$this->error("非法访问",U('Login/index'));}
    }
    public function _empty(){
        $this->error("非法操作",U('Login/index'));
    }
}