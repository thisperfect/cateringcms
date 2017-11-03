<?php
/*
 * @Author: W.NK 
 * @Date: 2017-06-22 08:11:56 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-26 08:00:00
 * 用户中心操作类
 */
namespace Home\Controller;
use Home\Common\Controller\CheckLogController;
class ClientCenterController extends CheckLogController{
    // 用户中心首页
    public function index(){
        $condition['id']=session('user.uid');
        $user=M('user')->where($condition)->find();
        $this->assign('user',$user);
        $this->display();
    }
    // 上传更改头像类
    public function head(){
        $uid=session('user.uid');
        if(IS_POST){
            if (!empty($_POST)){
                $headUrl=I('post.picurl');
                if(!empty($headUrl)){
                    $head=M('user')->where('id='.$uid)->setField('head',$headUrl);
                    if($head){$this->success('上传成功',U('ClientCenter/index'));}
                    else{$this->error('上传失败',U('ClientCenter/index'));}
                }else{$this->error('未接收到图像信息,上传失败',U('ClientCenter/index'));}
            }
        }else{
            $condition['id']=$uid;
            $head=M('user')->where($condition)->getField('head');
            $this->assign('head',$head);
            $this->display();
        }
    }
    // 修改用户资料
    public function editData(){
        $uid=I('get.uid');
        if(IS_POST){
            if (!empty($_POST)) {
                $user=D('User');
                $data = $user->create($_POST,2);
                if($data){
                    $newName=trim(I('post.uname'));
                    $search_name=M('user')->where("uname='$newName'")->find();
                    $search_id=M('user')->where('id='.$uid)->find();
                    $oldName=$search_id['uname'];
                    $newMail=trim(I('post.email'));
                    $search_mail=M('user')->where("email='$newMail'")->find();
                    $oldMail=$search_id['email'];
                    $e=($search_mail?($oldMail==$newMail?true:false):true);
                    $c=($search_name?($oldName==$newName?true:false):true);
                    if($c&&$e){
                        $condition['id']=$uid;
                        $info = $user->where($condition)->save($data);
                        if($info){$this->success('修改成功',U('ClientCenter/index'));}
                        else{$this->error('写入数据失败',U('ClientCenter/index'));}
                    }else if(!$c&&$e){$this->error('用户已经存在',U('ClientCenter/index'));}
                    else if($c&&!$e){$this->error('邮箱已经存在',U('ClientCenter/index'));}
                }else{$error = $user->getError();$this->error($error,U('ClientCenter/index'));}   
            }else{$this-error("传入数据为空",U('ClientCenter/index'));}
        }
    }
    // 重置密码类
    public function resetPass(){
        $uid=session('user.uid');
        $name=session('user.name');
        if(IS_POST){
            if(!empty($_POST)){
                $verify=stripslashes(trim(I('post.verify')));
                $chk_verify=check_verify($verify);
                if($chk_verify){
                    $old_passwd=trim(I('post.old_password'));
                    $user=M('user');
                    $userData=$user->where("name='$name'")->find();
                    vendor('Password.password');
                    $passwd = new \Vendor\Password\Password;
                    $verifyPass=$passwd->verifyPassword($old_passwd,$userData['password']);
                    if($verifyPass){
                        $chkrules = array(
                            array('password','require','密码不能为空'),
                            array('confirm_password','require','确认密码必须填写'),
                            array('confirm_password','password','两次密码保持一致',0,'confirm'),
                            array('old_password','require','原密码不能为空'),
                        );
                        $autorules = array(
                            array('password','trim',3,'function') , 
                            array('password','passwdSet',3,'function') , 
                        );
                        $data=$user->validate($chkrules)->auto($autorules)->create($_POST,2);
                        if($data){
                            $condition['id']=$uid;
                            $info = $user->where($condition)->save($data);
                            if($info){session('[destroy]');$this->success("密码重置成功,请重新登陆",U('User/login'));}
                            else{$this->error("数据写入失败",U('ClientCenter/index'));}
                        }else{$error = $user->getError();$this->error($error,U('ClientCenter/index'));}
                    }else{$this->error("原密码错误",U('ClientCenter/index'));}
                }else{$this->error("验证码错误",U('ClientCenter/index'));}    
            }else{$this->error("数据传入失败",U('ClientCenter/index'));}
        }
    }
    
    // 个人订单
    public function order(){
        $uid=session('user.uid');
        $order=M('order')->where('uid='.$uid.' AND status=1')->select();
        $status=M('order_status')->select();
        $rows=M('order_status')->count();
        $this->assign('order',$order);
        $this->assign('status',$status);
        $this->assign('rows',$rows);
        // dump($order);
        $this->display();
    }
    // 个人收藏
    public function collect(){
        $uid=session('user.uid');
        $model=M();
        $collect_all=$model->table('collect c,menu m')->field('c.id cid,c.uid,c.menu_id,m.id mid,m.name,m.picurl,m.price ')->where('c.menu_id = m.id AND uid='.$uid)->select();
        $this->assign('data',$collect_all);
        $this->display();
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
}
