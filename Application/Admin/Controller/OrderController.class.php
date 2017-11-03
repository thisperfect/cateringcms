<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-18 08:43:46 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-24 15:37:08
 * 订单管理类
 */
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
use Think\Model;
class OrderController extends AuthController {
    // 订单管理
    public function index(){
        $status_id=I('get.status_id');
        if(!empty($status_id)){
            $order_status_name=M('order_status')->where('id='.$status_id)->getField('name');
            $condition['order_status_id']=$status_id;
            $order=M('order')->field('id,order_num,uid,shopping_name,shopping_tel,shopping_address,total,order_status_id,posttime')->where($condition)->select();
            $this->assign('order_status_name',$order_status_name);
            $this->assign('order',$order);
            $this->display();
        }else{$this->error("获取参数失败，请稍后重试",U('Index/home'));}
    }
    // 订单修改
    public function order_edit(){
        $oid=I('get.oid');
        if(!empty($oid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $order=D('order');
                    $data=$order->create($_POST,2);
                    if($data){
                        $order_status_id=I('post.order_status_id');
                        $chk_osid=M('order_status')->where('id='.$order_status_id)->find();
                        if($chk_osid){
                            $info=$order->where('id='.$oid)->save($data);
                            if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                            else{$this->ajaxReturn(['editCode'=>'写入数据库失败'],'json');}
                        }else{$this->ajaxReturn(['editCode'=>'订单参数有误'],'json');}                   
                    }else{$error = $order->getError();$this->ajaxReturn($error,'json');}                  
                }
            }else{
                $order=M('order')->where('id='.$oid)->find();
                $order_status=M('order_status')->field('id,name')->select();
                $order_info=M('order_info')->field('order_id,menu_id,name,taste,weight,quentity,price')->where('order_id="'.$order['order_num'].'"')->select();
                $trows=M("taste")->count();
                $taste=M("taste")->select();
                $wrows=M("weight")->count();
                $weight=M("weight")->select();
                $this->assign('trows',$trows);
                $this->assign('taste',$taste);
                $this->assign('wrows',$wrows);
                $this->assign('weight',$weight);
                $this->assign('order',$order);
                $this->assign('order_status',$order_status);
                $this->assign('order_info',$order_info);
                $this->display();
            }
        }else{$this->error("获取参数失败，请稍后重试",U('Index/home'));}
    }
    // 订单删除
    public function order_del(){
        if(IS_GET){
            $oid=I('get.oid');
            if(!empty($oid)){
                $result=M('order')->delete($oid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('order/index'));}
        }else if(IS_POST){
            $oids=I('post.oidlist');
            if(!empty($oids)){
                $succ=$fail=0;
                for($i=0;$i<count($oids);$i++){
                    $del_info=M('order')->delete($oids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('order/index'));}
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}