<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-28 09:33:33 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-24 15:37:13
 */
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
class PropertyController extends AuthController{
    // 属性管理类
    Public function index(){
        $property=M('property')->order('id asc')->select();
        $this->assign('property',$property);
        $this->display();      
    }
    // 属性添加
    Public function property_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $property=D('Property');
                $data = $property->create($_POST,1);
                if($data){
                    $info = $property->add($data);
                    if($info){$this->ajaxReturn(["addCode"=>"1"],"json");}
                    else{$this->ajaxReturn(["addCode"=>"写入数据失败"],"json");}
                }else{
                    $error = $property->getError();
                    $this->ajaxReturn($error,'json');
                }
            }else{$this->ajaxReturn(['addCode'=>'数据传入服务器失败'],'json');}
        } 
    }
    // 属性编辑
    Public function property_edit(){
        $pid=I('get.pid');
        if(IS_POST){
            if(!empty($_POST)){
                $property=D('Property');
                $data = $property->create($_POST,2);
                if($data){
                    $newName=trim(I('post.name'));
                    $search_name=M('property')->where("name='$newName'")->find();
                    $search_id=M('property')->where('id='.$pid)->find();
                    $oldName=$search_id['name'];
                    $c=($search_name?($oldName==$newName?true:false):true);
                    if($c){
                        $condition['id']=$pid;
                        $info = $property->where($condition)->save($data);
                        if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['editCode'=>'写入数据失败'],'json');}
                    }else{$this->ajaxReturn(['editCode'=>'属性已经存在'],'json');}
                }else{$error = $property->getError();$this->ajaxReturn($error,'json');}   
            }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
        }else{
            $property=M('property')->where('id='.$pid)->find();
            $this->assign('property',$property);
            $this->display();
        }
    }
    // 属性删除
    public function property_del(){
        if(IS_GET){
            $pid=I('get.pid');
            if(!empty($pid)){
                $result=M('property')->delete($pid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Property/index'));}
        }else if(IS_POST){
            $pids=I('post.pidlist');
            if(!empty($pids)){
                $succ=$fail=0;
                for($i=0;$i<count($pids);$i++){
                    $del_info=M('property')->delete($pids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('Property/index'));}
        }       
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}