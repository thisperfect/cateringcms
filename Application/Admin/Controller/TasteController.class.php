<?php
/*
 * @Author: W.NK 
 * @Date: 2017-06-25 11:28:11 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-25 11:30:32
 * 口味管理
 */
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
class TasteController extends AuthController{
    // 口味管理类
    Public function index(){
        $taste=M('taste')->order('id asc')->select();
        $this->assign('taste',$taste);
        $this->display();      
    }
    // 口味添加
    Public function taste_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $taste=D('taste');
                $data = $taste->create($_POST,1);
                if($data){
                    $info = $taste->add($data);
                    if($info){$this->ajaxReturn(["addCode"=>"1"],"json");}
                    else{$this->ajaxReturn(["addCode"=>"写入数据失败"],"json");}
                }else{
                    $error = $taste->getError();
                    $this->ajaxReturn($error,'json');
                }
            }else{$this->ajaxReturn(['addCode'=>'数据传入服务器失败'],'json');}
        } 
    }
    // 口味编辑
    Public function taste_edit(){
        $tid=I('get.tid');
        if(IS_POST){
            if(!empty($_POST)){
                $taste=D('taste');
                $data = $taste->create($_POST,2);
                if($data){
                    $newName=trim(I('post.name'));
                    $search_name=M('taste')->where("name='$newName'")->find();
                    $search_id=M('taste')->where('id='.$tid)->find();
                    $oldName=$search_id['name'];
                    $c=($search_name?($oldName==$newName?true:false):true);
                    if($c){
                        $condition['id']=$tid;
                        $info = $taste->where($condition)->save($data);
                        if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['editCode'=>'写入数据失败'],'json');}
                    }else{$this->ajaxReturn(['editCode'=>'口味已经存在'],'json');}
                }else{$error = $taste->getError();$this->ajaxReturn($error,'json');}   
            }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
        }else{
            $taste=M('taste')->where('id='.$tid)->find();
            $this->assign('taste',$taste);
            $this->display();
        }
    }
    // 口味删除
    public function taste_del(){
        if(IS_GET){
            $tid=I('get.tid');
            if(!empty($tid)){
                $result=M('taste')->delete($tid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('taste/index'));}
        }else if(IS_POST){
            $tids=I('post.tidlist');
            if(!empty($tids)){
                $succ=$fail=0;
                for($i=0;$i<count($tids);$i++){
                    $del_info=M('taste')->delete($tids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('taste/index'));}
        }       
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}