<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
use Think\Model;
class AdminController extends AuthController {
    //管理员管理
    public function index(){
        $model=M();
        $admin=$model->table('admin a,admin_group g')->field('a.id,a.name,g.title,a.checkinfo,a.loginip,a.logintime')->where('a.group_id=g.id')->order('a.id asc')->select();
        $admingroup=M('admin_group')->order('id asc')->select();
        $this->assign('admin',$admin);
        $this->assign('admingroup',$admingroup);
        $this->display();
    }
    
    // 管理员添加
    public function admin_add(){
        if(IS_POST){
            if (!empty($_POST)) {
                $admin=D('Admin'); //实例化Admin
                $data = $admin->create($_POST,1); //验证自动完成
                if ($data) { 
                    $group_id=I('post.group_id');
                    $chk_gid=M('admin_group')->where("id=$group_id")->find();
                    if($chk_gid){
                        $info = $admin->add($data);
                        if ($info) {
                            $name=I('post.name');
                            $select_admin=M('admin')->where("name='$name'")->find();
                            $access['uid']=$select_admin['id'];
                            $access['group_id']=$group_id;
                            // 添加权限
                            $add_access=M('admin_group_access')->data($access)->add();
                            if($add_access){$this->ajaxReturn(["addCode"=>"1"],"json");}
                            else{$this->ajaxReturn(["addCode"=>"权限信息添加失败"],"json");}
                        }else{$this->ajaxReturn(["addCode"=>"写入数据失败"],"json");}
                    }else{$this->ajaxReturn(['addCode'=>'管理组参数非法'],'json');}
                }else{
                    $error = $admin->getError();
                    $this->ajaxReturn($error,'json');
                }
            }else{$this->ajaxReturn(['addCode'=>'未传入数据'],'json');}
        }else{
            $group=M('admin_group')->select();
            $this->assign('group',$group);
            $this->display();
        }
    }
    // 管理员信息修改
    public function admin_edit(){
        $aid=I('get.aid');
        if(!empty($aid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $select_group=M('admin')->where('id='.$aid)->find();
                    $old_group_id=$select_group['group_id'];
                    $new_group_id=I('post.group_id');
                    $admin=D('Admin');
                    $data = $admin->create($_POST,2);
                    if($data){
                        $newName=trim(I('post.name'));
                        $search_name=M('admin')->where("name='$newName'")->find();
                        $search_id=M('admin')->where("id='$aid'")->find();
                        $oldName=$search_id['name'];
                        $newMail=trim(I('post.email'));
                        $search_mail=M('admin')->where("email='$newMail'")->find();
                        $oldMail=$search_id['email'];
                        $e=($search_mail?($oldMail==$newMail?true:false):true);
                        $c=($search_name?($oldName==$newName?true:false):true);
                        if($c&&$e){
                            $condition['id']=$aid;
                            $info = $admin->where($condition)->save($data);
                            if($info){
                                if($old_group_id!=$new_group_id){
                                    $groupAccess['uid']=$aid;
                                    $groupAccess['group_id']=$new_group_id;
                                    $condition['uid']=$aid;
                                    $condition['group_id']=$old_group_id;
                                    $edit_access=M('admin_group_access')->where($condition)->save($groupAccess);
                                    if($edit_access){$this->ajaxReturn(["editCode"=>"1"],"json");}
                                    else{$this->ajaxReturn(["editCode"=>"修改权限失败"],"json");}
                                }else{$this->ajaxReturn(["editCode"=>"1"],"json");}
                            }else{$this->ajaxReturn(["editCode"=>"写入数据失败"],"json");}
                        }else if(!$c&&$e){$this->ajaxReturn(['editCode'=>'用户名已被占用！'],'json');
                        }else if($c&&!$e){$this->ajaxReturn(['editCode'=>'邮箱已被占用！'],'json');}
                    }else{$error = $admin->getError();$this->ajaxReturn($error,'json');}
                }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
            }else{
                $admin=M('admin')->where("id='$aid'")->find();
                $admingroup=M('admin_group')->select();
                $this->assign('admin',$admin);
                $this->assign('group',$admingroup);
                $this->display();
            }
        }else{$this->error("参数不能为空！",U('Admin/index'));}
    }
    // 管理员删除
    public function admin_del(){
        if(IS_POST){
            $aids=I('post.aidlist');
            if(!empty($aids)){
                $succ=$fail=0;
                for($i=0;$i<count($aids);$i++){
                    $select_group=M('admin')->where('id='.$aids[$i])->find();
                    $group=$select_group['group_id'];
                    $condition['uid']=$aids[$i];
                    $condition['group_id']=$group;
                    $del_access=M('admin_group_access')->where($condition)->delete();
                    $del_info=M('admin')->delete($aids[$i]);
                    if($del_access&&$del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('Admin/index'));}
        }elseif (IS_GET) {
            $aid=I('get.aid');
            if(!empty($aid)){
                $select_group=M('admin')->where('id='.$aid)->find();
                $group=$select_group['group_id'];
                $condition['uid']=$aid;
                $condition['group_id']=$group;
                $del_access=M('admin_group_access')->where($condition)->delete();
                if($del_access){
                    $del_info=M('admin')->delete($aid);
                    if($del_info){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                    else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Admin/index'));}
        }
    }
    // 管理组管理
    public function group(){
        $admingroup=M('admin_group')->order('id asc')->select();
        $this->assign('admingroup',$admingroup);
        $this->display();
    }
    // 管理组添加
    public function group_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $group=D('AdminGroup');
                $data = $group->create($_POST,1);
                if($data){
                    $rules=I('post.rules');
                    $rulesInfo=explode(",", $rules);
                    $num=0;
                    foreach ($rulesInfo as $k=>$v){
                        $chk_rules=M('admin_rule')->where("id=$v")->find();
                        if($chk_rules){$num++;}
                    }
                    if($num==count($rulesInfo)){
                        $info = $group->add($data);
                        if($info){$this->ajaxReturn(["addCode"=>"1"],"json");}
                        else{$this->ajaxReturn(["addCode"=>"写入数据失败"],"json");}
                    }else{$this->ajaxReturn(["addCode"=>"权限规则数据有误"],"json");}
                }else{
                    $error = $group->getError();
                    $this->ajaxReturn($error,'json');
                }
            }else{$this->ajaxReturn(['addCode'=>'数据传入服务器失败'],'json');}
        }else{
            $rules=M('admin_rule')->order('id asc')->select();
            $this->assign('rule',$rules);
            $this->display();
        }
    }
    // 管理组编辑
    public function group_edit(){
        $gid=I('get.gid');
        if(!empty($gid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $group=D('AdminGroup');
                    $data = $group->create($_POST,2);
                    if ($data) {
                        $newTitle=trim(I('post.title'));
                        $search_title=M('admin_group')->where("title='$newTitle'")->find();
                        $search_id=M('admin_group')->where("id='$gid'")->find();
                        $oldTitle=$search_id['title'];
                        $c=($search_title?($oldTitle==$newTitle?true:false):true);
                        if($c){
                            $condition['id']=$gid;
                            $info = $group->where($condition)->save($data);
                            if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                            else{$this->ajaxReturn(['editCode'=>'写入数据失败'],'json');}
                        }else{$this->ajaxReturn(['editCode'=>'管理组名已被占用'],'json');}
                    }else{$error = $group->getError();$this->ajaxReturn($error,'json');}
                }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
            }else{
                $group=M('admin_group')->where("id='$gid'")->find();
                $grules=explode(",",$group['rules']);
                $rule=M('admin_rule')->order('id asc')->select();
                $this->assign('group',$group);
                $this->assign('grules',$grules);
                $this->assign('rule',$rule);
                $this->display();
            }
        }
    }
    // 管理组删除
    public function group_del(){
        if(IS_GET){
            $gid=I('get.gid');
            if(!empty($gid)){
                $result=M('admin_group')->delete($gid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Admin/group'));}
        }else if(IS_POST){
            $gids=I('post.gidlist');
            if(!empty($gids)){
                $succ=$fail=0;
                for($i=0;$i<count($gids);$i++){
                    $del_info=M('admin_group')->delete($gids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('Admin/group'));}
        }
    }
    // 权限规则管理
    Public function rule(){
        $rule=M('admin_rule')->order('id asc')->select();
        $this->assign('rule',$rule);
        $this->display();      
    }
    // 规则添加
    Public function rule_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $rule=D('AdminRule');
                $data = $rule->create($_POST,1);
                if($data){
                    $info = $rule->add($data);
                    if($info){$this->ajaxReturn(["addCode"=>"1"],"json");}
                    else{$this->ajaxReturn(["addCode"=>"写入数据失败"],"json");}
                }else{
                    $error = $rule->getError();
                    $this->ajaxReturn($error,'json');
                }
            }else{$this->ajaxReturn(['addCode'=>'数据传入服务器失败'],'json');}
        } 
    }
    // 规则编辑
    Public function rule_edit(){
        $rid=I('get.rid');
        if(IS_POST){
            if(!empty($_POST)){
                $rule=D('AdminRule');
                $data = $rule->create($_POST,2);
                if($data){
                    $newName=trim(I('post.name'));
                    $search_name=M('admin_rule')->where("name='$newName'")->find();
                    $search_id=M('admin_rule')->where('id='.$rid)->find();
                    $oldName=$search_id['name'];
                    $c=($search_name?($oldName==$newName?true:false):true);
                    if($c){
                        $condition['id']=$rid;
                        $info = $rule->where($condition)->save($data);
                        if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['editCode'=>'写入数据失败'],'json');}
                    }else{$this->ajaxReturn(['editCode'=>'规则已经存在'],'json');}
                }else{$error = $rule->getError();$this->ajaxReturn($error,'json');}   
            }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
        }else{
            $rule=M('admin_rule')->where('id='.$rid)->find();
            $this->assign('rule',$rule);
            $this->display();
        }
    }
    //规则删除
    public function rule_del(){
        if(IS_GET){
            $rid=I('get.rid');
            if(!empty($rid)){
                $result=M('admin_rule')->delete($rid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Admin/group'));}
        }else if(IS_POST){
            $rids=I('post.ridlist');
            if(!empty($rids)){
                $succ=$fail=0;
                for($i=0;$i<count($rids);$i++){
                    $del_info=M('admin_rule')->delete($rids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->error("删除失败！",U('Admin/rule'));}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('Admin/rule'));}
        }       
    }
   
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}