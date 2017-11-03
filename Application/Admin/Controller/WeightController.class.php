<?php
/*
 * @Author: W.NK 
 * @Date: 2017-06-25 11:28:11 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-25 11:39:22
 * 份量管理
 */
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
class WeightController extends AuthController{
    // 口味管理类
    Public function index(){
        $weight=M('weight')->order('id asc')->select();
        $this->assign('weight',$weight);
        $this->display();      
    }
    // 口味添加
    Public function weight_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $weight=D('weight');
                $data = $weight->create($_POST,1);
                if($data){
                    $info = $weight->add($data);
                    if($info){$this->ajaxReturn(["addCode"=>"1"],"json");}
                    else{$this->ajaxReturn(["addCode"=>"写入数据失败"],"json");}
                }else{
                    $error = $weight->getError();
                    $this->ajaxReturn($error,'json');
                }
            }else{$this->ajaxReturn(['addCode'=>'数据传入服务器失败'],'json');}
        } 
    }
    // 口味编辑
    Public function weight_edit(){
        $pid=I('get.pid');
        if(IS_POST){
            if(!empty($_POST)){
                $weight=D('weight');
                $data = $weight->create($_POST,2);
                if($data){
                    $newName=trim(I('post.name'));
                    $search_name=M('weight')->where("name='$newName'")->find();
                    $search_id=M('weight')->where('id='.$pid)->find();
                    $oldName=$search_id['name'];
                    $c=($search_name?($oldName==$newName?true:false):true);
                    if($c){
                        $condition['id']=$pid;
                        $info = $weight->where($condition)->save($data);
                        if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['editCode'=>'写入数据失败'],'json');}
                    }else{$this->ajaxReturn(['editCode'=>'口味已经存在'],'json');}
                }else{$error = $weight->getError();$this->ajaxReturn($error,'json');}   
            }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
        }else{
            $weight=M('weight')->where('id='.$pid)->find();
            $this->assign('weight',$weight);
            $this->display();
        }
    }
    // 口味删除
    public function weight_del(){
        if(IS_GET){
            $pid=I('get.pid');
            if(!empty($pid)){
                $result=M('weight')->delete($pid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('weight/index'));}
        }else if(IS_POST){
            $pids=I('post.pidlist');
            if(!empty($pids)){
                $succ=$fail=0;
                for($i=0;$i<count($pids);$i++){
                    $del_info=M('weight')->delete($pids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('weight/index'));}
        }       
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}