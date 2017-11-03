<?php
/*
 * @Author: W.NK 
 * @Date: 2017-06-22 08:11:56 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-27 09:52:30
 * 购买收藏操作类
 */
namespace Home\Controller;
use Think\Controller;
use Home\Common\Controller\CheckLogController;
class GoodController extends CheckLogController{
    // 添加收藏
    public function addCollect(){
        if(IS_POST){
            if(!empty($_POST)){
                $uid=I('post.uid');
                $mid=I('post.menu_id');
                $condition['uid']=$uid;
                $condition['menu_id']=$mid;
                $is_collected=M('collect')->where($condition)->find();
                if(!$is_collected){
                    $autorules = array( 
                        array('posttime','time',3,'function')
                    );
                    $collect=M('collect');
                    $data=$collect->auto($autorules)->create($_POST,1);
                    if($data){
                        $info=$collect->add($data);
                        if($info){$this->ajaxReturn(['code'=>'1'],'json');}
                        else{$this->ajaxReturn(['code'=>'不好意思出错了，请稍后再试'],'json');}
                    }else{$this->ajaxReturn(['code'=>'不好意思出错了，请稍后再试'],'json');}
                }else{$this->ajaxReturn(['code'=>'对不起，已经收藏过了'],'json');}
            }else{$this->ajaxReturn(['code'=>'不好意思出错了，请稍后再试'],'json');}
        }else{$this->error('非法访问',U('Index/index'));}
    }
    // 删除收藏
    public function delCollect(){
        if(IS_POST){
            $cids=I('post.cidlist');
            if(!empty($cids)){
                $succ=$fail=0;
                for($i=0;$i<count($cids);$i++){
                    $data['status']="0";
                    $del_info=M('collect')->where('id='.$cids[$i])->save($data);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}                
            }else{$this->error("参数不能为空！",U('ClientCenter/collect'));}
        }else if(IS_GET){
            $cid=I('get.cid');
            if(!empty($cid)){
                $data['status']="0";
                $result=M('order')->where('id='.$cid)->save($data);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('ClientCenter/collect'));}
        }else{$this->error('非法访问',U('ClientCenter/collect'));}
    }
    // 删除用户订单
    public function delOrder(){
        if(IS_POST){
            $oids=I('post.oidlist');
            if(!empty($oids)){
                $succ=$fail=0;
                for($i=0;$i<count($oids);$i++){
                    $data['status']="0";
                    $del_info=M('order')->where('id='.$oids[$i])->save($data);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}                
            }else{$this->error("参数不能为空！",U('ClientCenter/order'));}
        }else if(IS_GET){
            $oid=I('get.oid');
            if(!empty($oid)){
                $data['status']="0";
                $result=M('order')->where('id='.$oid)->save($data);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('ClientCenter/collect'));}
        }else{$this->error('非法访问',U('ClientCenter/order'));}
    }
    // 购物车页
    public function cart(){
        $cart=session('cart');
        // $uid=session('user');
        $token=md5(session('user.name'));
        $action=md5('sendOrder');
        $this->assign('cart',$cart);
        $this->assign('token',$token);
        $this->assign('action',$action);
        $this->display();
    }
    // 订单页面
    public function order(){
        // dump(session('cart'));
        if(IS_GET){
            if(session('cart')!=null){
                if(!isset($_SESSION['order_token']) || $_SESSION['order_token']=='') {
                    $this->set_token();
                }
                $action=I('get.action');
                $token=I('get.token');
                if(!empty($action)&&!empty($token)){
                    $token1=md5(session('user.name'));
                    $action1=md5('sendOrder');
                    $a=($action==$action1?true:false);
                    $t=($token==$token1?true:false);
                    if($a&&$t){
                        // 订单号
                        $year_code = array('A','B','C','D','E','F','G','H','I','J');
                        $order_sn = $year_code[intval(date('Y'))-2010].strtoupper(dechex(date('m'))).date('d').substr(time(),-5).substr(microtime(),2,5).sprintf('d',rand(0,99));
                        $cart_detal=session('cart');
                        vendor('Cart.Cart');
                        $cart = new \Vendor\Cart\Cart; //实例化购物车
                        $total=$cart->getPrice();
                        $this->assign('cart',$cart_detal);
                        $this->assign('total',$total);
                        $this->assign('order_sn',$order_sn);
                        $this->display();
                    }else{$this->error('非法访问',U('Index/index'));}
                }else{$this->error('非法访问',U('Index/index'));}
            }else{$this->error('您没有订单需要提交',U('Index/index'));}

        }
    }
    // 提交订单
    public function pay(){
        if(IS_POST){
            if(!empty($_POST)){
                if(!$this->valid_token()){
                    $this->error('请不要重复提交！',U('Index/index'));
                }
                // 写入订单信息
                $order_good_info=session('cart');
                $orderinfo=[];
                $orderinfo['order_num']=I('post.order_sn');
                $orderinfo['uid']=session('user.uid');
                $orderinfo['name']=session('user.name');
                $orderinfo['shopping_name']=I('post.shopping_name');
                $orderinfo['shopping_tel']=I('post.shopping_tel');
                $orderinfo['shopping_address']=I('post.shopping_address'); 
                $orderinfo['comment']=I('post.comment');   
                $orderinfo['total']=I('post.total');
                $orderinfo['points']=I('post.points');
                $orderinfo['pay_code']=I('post.pay_code');
                $paytype=I('post.pay_type');
                $order=M('order');
                $chkrules = array(
                    array('shopping_name','require','收货人不能为空'),
                    array('shopping_tel','require','电话必须填写'),
                    array('shopping_address','require','地址不能为空'),
                    array('pay_code','require','付款方式不能为空'),
                    array('pay_code',array(0,1),'付款方式参数不正确！',2,'in'),
                );
                $autorules = array(
                    array('shopping_name','trim',3,'function') , 
                    array('shopping_tel','trim',3,'function') , 
                    array('shopping_address','trim',3,'function'), 
                    array('posttime','time',3,'function') , 
                );
                $data=$order->validate($chkrules)->auto($autorules)->create($orderinfo,1);
                if(!$data){
                    $error = $order->getError();$this->error($error,'json');
                }else{
                    $info = $order->add($data);
                    // 商品信息
                    $succ=$fail=0;
                    $menus=[];
                    foreach ($order_good_info as $key => $value) {
                        $detail['order_id']=$orderinfo['order_num'];
                        $detail['menu_id']=$value['id'];
                        $detail['name']=$value['name'];
                        array_push($menus,$value['name']);
                        $detail['taste']=$value['taste'];
                        $detail['weight']=$value['weight'];
                        $detail['quentity']=$value['num'];
                        $detail['price']=$value['price'];
                        $addData=M('order_info')->add($detail);
                    }
                    if($info && $addData){
                        // 付款途径
                        if($orderinfo['pay_code']==0){
                            if(isset($paytype)){
                                if($paytype==0){
                                    $payImg=C('ALI_PAY');
                                    $desc=$menus;
                                    $order_num=$orderinfo['order_num'];
                                    $total=$orderinfo['total'];
                                    $paytype='支付宝';
                                    $this->assign('order_num',$order_num);
                                    $this->assign('desc',$desc);
                                    $this->assign('total',$total);
                                    $this->assign('paytype',$paytype);
                                    $this->assign('payimg',$payImg);
                                    $this->display();    
                                    session('cart',null);                 
                                }else{
                                    $payImg=C('WE_PAY');
                                    $desc=$menus;
                                    $order_num=$orderinfo['order_num'];
                                    $total=$orderinfo['total'];
                                    $paytype='微信';
                                    $this->assign('order_num',$order_num);
                                    $this->assign('desc',$desc);
                                    $this->assign('total',$total);
                                    $this->assign('paytype',$paytype);
                                    $this->assign('payimg',$payImg);
                                    session('cart',null);
                                    $this->display();
                                       
                                }
                            }else{$this->error('请选择正确的支付方式',U('Good/cart'));}
                        }else{session('cart',null); $this->success('提交订单成功，请等待送餐',U('Index/index'));} 
                    }else{$this->error('订单已失效',U('Good/cart'));}
                }
            }else{$this->error('参数有误非法访问',U('Index/index'));}
        }
    }
    protected function set_token() {
        $_SESSION['order_token'] = md5(microtime(true));
    }
    protected function valid_token() {
        $return = ($_REQUEST['token'] == $_SESSION['order_token'] ? true : false);
        $this->set_token();
        return $return;
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
}