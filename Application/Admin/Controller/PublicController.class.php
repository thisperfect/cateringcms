<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-26 14:04:59 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-24 15:37:19
 * 公共管理类
 */
namespace Admin\Controller;
use Admin\Common\Controller\BaseController;
use Think\Model;
class PublicController extends BaseController {
    // 管理员更改个人资料
    public function edit_info(){
        $aid=session('admin.uid');
        if(IS_POST){
            if(!empty($_POST)){
                $admin=D('Admin');
                $data=$admin->create($_POST,2);
                if($data){
                    $newName=trim(I('post.name'));
                    $search_name=M('admin')->where("name='$newName'")->find();
                    $search_id=M('admin')->where("id='$aid'")->find();
                    $oldName=$search_id['name'];
                    $c=($search_name?($oldName==$newName?true:false):true);
                    $newMail=trim(I('post.email'));
                    $search_mail=M('admin')->where("email='$newMail'")->find();
                    $oldMail=$search_id['email'];
                    $e=($search_mail?($oldMail==$newMail?true:false):true);
                    if($c&&$e){
                        $condition['id']=$aid;
                        $info = $admin->where($condition)->save($data);
                        if($info){$this->ajaxReturn(["editCode"=>"1"],"json");}
                        else{$this->ajaxReturn(["editCode"=>"写入数据失败"],"json");}
                    }else if(!$c && $e){$this->ajaxReturn(["editCode"=>"用户名已经存在"],"json");
                    }else if($c && !$e){$this->ajaxReturn(["editCode"=>"邮箱已经存在"],"json");} 
                }else{$error = $admin->getError();$this->ajaxReturn($error,'json');}
            }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
        }else{
            $model=M();
            $admin=$model->table('admin a,admin_group g')->field('a.name,a.nickname,a.email,g.title')->where('a.group_id=g.id And a.id='.$aid)->find();
            $this->assign('admin',$admin);
            $this->display();
        }       
    }
    // 管理员更改个人密码
    public function edit_passwd(){
        $aid=session('admin.uid');
        $name=session('admin.name');
        if(IS_POST){
            if(!empty($_POST)){
                $old_passwd=trim(I('post.old_passwd'));
                $admin=M('admin');
                $adminData=$admin->where("name='$name'")->find();
                vendor('Password.password');
                $passwd = new \Vendor\Password\Password;
                $verifyPass=$passwd->verifyPassword($old_passwd,$adminData['password']);
                if($verifyPass){
                    $chkrules = array(
                        array('password','require','密码不能为空'),
                        array('confirm_password','require','确认密码必须填写'),
                        array('confirm_password','password','两次密码保持一致',0,'confirm'),
                        array('old_passwd','require','原密码不能为空'),
                    );
                    $autorules = array(
                        array('password','trim',3,'function') , 
                        array('password','passwdSet',3,'function') , 
                    );
                    $data=$admin->validate($chkrules)->auto($autorules)->create($_POST,2);
                    if($data){
                        $condition['id']=$aid;
                        $info = $admin->where($condition)->save($data);
                        if($info){$this->ajaxReturn(["editCode"=>"1"],"json");}
                        else{$this->ajaxReturn(["editCode"=>"写入数据失败"],"json");}
                    }else{$error = $admin->getError();$this->ajaxReturn($error,'json');}
                }else{$this->ajaxReturn(['editCode'=>'原密码错误'],'json');}
            }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}