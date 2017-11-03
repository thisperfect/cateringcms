<?php
/*购物车基类*/
namespace Home\Controller;
use Think\Controller;
use Home\Common\Controller\CheckLogController;
class CartController extends CheckLogController{
    // 加入购物车
    public function addCart(){
        if(IS_POST&&!empty($_POST)){
            $id=I('post.id');
            $name=I('post.name');
            $taste=I('post.taste',0);
            $weight=I('post.weight',0);
            $price=I('post.price');
            $num=I('post.num',1);
            $img=I('post.img');
            vendor('Cart.Cart');
            $cart = new \Vendor\Cart\Cart; //实例化购物车
            $add=$cart->addItem($id,$name,$taste,$weight,$price,$num,$img);
            if($add){$this->ajaxReturn(['code'=>'1'],'json');}
            else{$this->ajaxReturn(['code'=>'添加失败'],'json');}
        }else{$this->error('非法访问',U('Index/index'));}
        
    }
    // 添加数量
    public function incNum(){
        if(IS_POST&&!empty($_POST)){
            vendor('Cart.Cart');
            $cart = new \Vendor\Cart\Cart; //实例化购物车
            $id=I('post.id');
            $incNum=$cart->incNum($id);
            if($incNum){$this->ajaxReturn(['code'=>'1'],'json');}
            else{$this->ajaxReturn(['code'=>'0'],'json');}
        }else{$this->error('非法访问',U('Index/index'));}
    }
    // 减少数量
    public function decNum(){
        if(IS_POST&&!empty($_POST)){
            vendor('Cart.Cart');
            $cart = new \Vendor\Cart\Cart; //实例化购物车
            $id=I('post.id');
            $decNum=$cart->decNum($id);
            if($decNum){$this->ajaxReturn(['code'=>'1'],'json');}
            else{$this->ajaxReturn(['code'=>'0'],'json');}
        }else{$this->error('非法访问',U('Index/index'));}
    }
    // 删除单个
    public function delItem(){
        if(IS_POST&&!empty($_POST)){
            vendor('Cart.Cart');
            $cart = new \Vendor\Cart\Cart; //实例化购物车
            $id=I('post.id');
            $delItem=$cart->delItem($id);
            if($delItem){$this->ajaxReturn(['code'=>'1'],'json');}
            else{$this->ajaxReturn(['code'=>'0'],'json');} 
        }else{$this->error('非法访问',U('Index/index'));}
    }
    // 获取购物车数量
    public function getNum(){
    if(IS_POST&&!empty($_POST)){
            vendor('Cart.Cart');
            $cart = new \Vendor\Cart\Cart; //实例化购物车
            $getNum=$cart->getNum();
            $this->ajaxReturn(['code'=>'1','goodsNum'=>''.$getNum.''],'json');
        }
    }
    // 清空购物车
    public function clearCart(){
        if(IS_POST&&!empty($_POST)){
            $action=I('post.action');
            if($action='clear'){
                vendor('Cart.Cart');
                $cart = new \Vendor\Cart\Cart; //实例化购物车
                $clearCart=$cart->clear();
                if($clearCart){$this->ajaxReturn(['code'=>'1'],'json');}
                else{$this->ajaxReturn(['code'=>'0'],'json');}
            }
        }else{$this->error('非法访问',U('Index/index'));}
    }
    // 空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
}