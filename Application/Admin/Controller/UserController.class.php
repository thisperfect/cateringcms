<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-18 09:06:52 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-24 15:37:47
 * 用户管理类
 */
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
use Think\Model;
class UserController extends AuthController {
    // 用户管理
    public function index(){
        $user=M('user')->field('id,uname,points,checkinfo')->order('id asc')->select();
        $rows=M('user_group')->count();
        $group=M('user_group')->select();
        $this->assign('user',$user);
        $this->assign('row',$rows);
        $this->assign('group',$group);
        $this->display();
    }
    // 用户添加
    public function user_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $user=D('User');
                $data=$user->create($_POST,1);
                if($data){
                    $info=$user->add($data);
                    if($info){$this->ajaxReturn(["addCode"=>"1"],'json');}
                    else{$this->ajaxReturn(["addCode"=>"写入数据失败"],'json');}
                }else{$error->$user->getError();$this->ajaxReturn($error,'json');}
            }else{$this->ajaxReturn(["addCode"=>"数据传入服务器失败"],'json');}
        }else{
            $this->display();
        }
    }
    // 用户编辑
    Public function user_edit(){
        $uid=I('get.uid');
        if(IS_POST){
            if(!empty($_POST)){
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
                        if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['editCode'=>'写入数据失败'],'json');}
                    }else if(!$c&&$e){$this->ajaxReturn(['editCode'=>'用户已经存在'],'json');}
                    else if($c&&!$e){$this->ajaxReturn(['editCode'=>'邮箱已经存在'],'json');}
                }else{$error = $user->getError();$this->ajaxReturn($error,'json');}   
            }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
        }else{
            $user=M('user')->where('id='.$uid)->find();
            $this->assign('user',$user);
            $this->display();
        }
    }
    // 用户删除
    public function user_del(){
        if(IS_GET){
            $uid=I('get.uid');
            if(!empty($uid)){
                $result=M('user')->delete($uid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('User/index'));}
        }else if(IS_POST){
            $uids=I('post.uidlist');
            if(!empty($uids)){
                $succ=$fail=0;
                for($i=0;$i<count($uids);$i++){
                    $del_info=M('user')->delete($uids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('User/index'));}
        }       
    }
    // 用户组管理
    public function group(){
        $group=M('user_group')->order('id asc')->select();
        $this->assign('group',$group);
        $this->display();
    }
    // 用户组添加
    public function group_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $group=D('UserGroup');
                $data=$group->create($_POST,1);
                if($data){
                    $info=$group->add($data);
                    if($info){$this->ajaxReturn(["addCode"=>"1"],'json');}
                    else{$this->ajaxReturn(["addCode"=>"写入数据失败"],'json');}
                }else{$error->$group->getError();$this->ajaxReturn($error,'json');}
            }else{$this->ajaxReturn(["addCode"=>"数据传入服务器失败"],'json');}
        }else{
            $this->display();
        }
    }
    // 用户组编辑
    public function group_edit(){
        $gid=I('get.gid');
        if(IS_POST){
            if(!empty($_POST)){
                $group=D('UserGroup');
                $data = $group->create($_POST,2);
                if($data){
                    $newName=trim(I('post.title'));
                    $search_name=M('user_group')->where("title='$newName'")->find();
                    $search_id=M('user_group')->where('id='.$gid)->find();
                    $oldName=$search_id['title'];
                    $c=($search_name?($oldName==$newName?true:false):false);
                    if($c){
                        $condition['id']=$gid;
                        $info = $group->where($condition)->save($data);
                        if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['editCode'=>'写入数据失败'],'json');}
                    }else{$this->ajaxReturn(['editCode'=>'用户组已经存在'],'json');}
                }else{$error = $group->getError();$this->ajaxReturn($error,'json');}   
            }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
        }else{
            $group=M('user_group')->where('id='.$gid)->find();
            $this->assign('group',$group);
            $this->display();
        }
    }
    // 用户组删除
    public function group_del(){
        if(IS_GET){
            $gid=I('get.gid');
            if(!empty($gid)){
                $result=M('user_group')->delete($gid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('User/group'));}
        }else if(IS_POST){
            $gids=I('post.gidlist');
            if(!empty($gids)){
                $succ=$fail=0;
                for($i=0;$i<count($gids);$i++){
                    $del_info=M('user_group')->delete($gids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('User/group'));}
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}


