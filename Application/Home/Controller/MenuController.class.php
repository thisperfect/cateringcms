<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Controller\BaseController;
class MenuController extends BaseController {
    public function _before_show(){
        // 实例化购物车
        vendor('Cart.Cart');
        $cart = new \Vendor\Cart\Cart; 
        $getNum=$cart->getNum();
        $property=M('property')->limit(2,3)->select();
        $category=M('category')->limit(4)->select();
        $this->assign('property',$property);
        $this->assign('category',$category);
        $this->assign('cartNum',$getNum);
    }
    // 菜品展示页面首页
    public function show(){
        if(IS_GET){
            if(!empty($_GET)){
                $flag=I('get.flag');
                $id=I('get.id');
                // dump($flag);
                if($flag=='0'){
                    $Menu=M('menu');
                    $count=M('menu')->count();
                    $Page = new \Think\Page($count,16);
                    $show = $Page->show();// 分页显示输出
                    $list = $Menu->order('posttime')->limit($Page->firstRow.','.$Page->listRows)->select();
                    if($list&&$show){      
                        // dump($list);
                        $this->assign('id',$id);
                        $this->assign('flag',$flag);
                        $this->assign('count',$count);
                        $this->assign('list',$list);// 赋值数据集
                        $this->assign('page',$show);// 赋值分页输出
                        // dump($page);
                        $this->display();
                    }else{$this->error('未找到相关内容',U('Index/index'));}
                }else if($flag==1){
                    $ids=[];
                    $Menu=M('menu');
                    $select=$Menu->field('id,property')->select();
                    foreach ($select as $key => $value) {
                        $property_arr= explode(',',$value['property']);
                        $menu_detail=['id'=>$value['id'],'property'=>$property_arr];
                        if(in_array($id,$menu_detail['property'])){
                            array_push($ids,$menu_detail['id']);
                        }
                    }
                    $condition['id']=array('in',$ids);
                    $count=M('menu')->where($condition)->count();
                    $Page = new \Think\Page($count,16);
                    $show = $Page->show();// 分页显示输出
                    $list = $Menu->where($condition)->order('posttime')->limit($Page->firstRow.','.$Page->listRows)->select();
                    if($list&&$show){      
                        // dump($list);
                        $this->assign('id',$id);
                        $this->assign('flag',$flag);
                        $this->assign('count',$count);
                        $this->assign('list',$list);// 赋值数据集
                        $this->assign('page',$show);// 赋值分页输出
                        // dump($page);
                        $this->display();
                    }else{$this->error('未找到相关内容',U('Index/index'));}
                }else if($flag==2){
                    $Menu=M('menu');
                    $condition['category_id']=$id;
                    $count=M('menu')->where($condition)->count();
                    $Page = new \Think\Page($count,16);
                    $show = $Page->show();// 分页显示输出
                    $list = $Menu->where($condition)->order('posttime')->limit($Page->firstRow.','.$Page->listRows)->select();
                    if($list&&$show){      
                        // dump($condition);
                        $this->assign('id',$id);
                        $this->assign('flag',$flag);
                        $this->assign('count',$count);
                        $this->assign('list',$list);// 赋值数据集
                        $this->assign('page',$show);// 赋值分页输出
                        // dump($page);
                        $this->display();
                    }else{$this->error('未找到相关内容',U('Index/index'));}
                }
            }
        }

    }
    public function _before_todayRec(){
        // 实例化购物车
        vendor('Cart.Cart');
        $cart = new \Vendor\Cart\Cart; 
        $getNum=$cart->getNum();
    }
    // 今日热荐
    public function todayRec(){
        $id='6';
        $ids=[];
        $Menu=M('menu');
        $select=$Menu->field('id,property')->select();
        foreach ($select as $key => $value) {
            $property_arr= explode(',',$value['property']);
            $menu_detail=['id'=>$value['id'],'property'=>$property_arr];
            if(in_array($id,$menu_detail['property'])){
                array_push($ids,$menu_detail['id']);
            }
        }
        $condition['id']=array('in',$ids);
        $count=M('menu')->where($condition)->count();
        $Page = new \Think\Page($count,16);
        $show = $Page->show();// 分页显示输出
        $list = $Menu->where($condition)->order('posttime')->limit($Page->firstRow.','.$Page->listRows)->select();
        if($list&&$show){      
            // dump($list);
            $this->assign('id',$id);
            $this->assign('flag',$flag);
            $this->assign('count',$count);
            $this->assign('list',$list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出
            // dump($page);
            $this->display();
        }else{$this->error('未找到相关内容',U('Index/index'));}
    }
    public function _before_newSale(){
        // 实例化购物车
        vendor('Cart.Cart');
        $cart = new \Vendor\Cart\Cart; 
        $getNum=$cart->getNum();
    }
    // 新品推出
    public function newSale(){
        $id='7';
        $ids=[];
        $Menu=M('menu');
        $select=$Menu->field('id,property')->select();
        foreach ($select as $key => $value) {
            $property_arr= explode(',',$value['property']);
            $menu_detail=['id'=>$value['id'],'property'=>$property_arr];
            if(in_array($id,$menu_detail['property'])){
                array_push($ids,$menu_detail['id']);
            }
        }
        $condition['id']=array('in',$ids);
        $count=M('menu')->where($condition)->count();
        $Page = new \Think\Page($count,16);
        $show = $Page->show();// 分页显示输出
        $list = $Menu->where($condition)->order('posttime')->limit($Page->firstRow.','.$Page->listRows)->select();
        if($list&&$show){      
            // dump($list);
            $this->assign('id',$id);
            $this->assign('flag',$flag);
            $this->assign('count',$count);
            $this->assign('list',$list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出
            // dump($page);
            $this->display();
        }else{$this->error('未找到相关内容',U('Index/index'));}
    }
    // 菜品搜索
    public function search(){
        if(IS_GET){
            if(!empty($_GET)){
                $keyword=I('get.keyword');
                if(empty($keyword)){
                    $this->error('未找到相关内容',U('Menu/show?flag=0'));
                }else{
                    cookie('search_keyword',$keyword,3600); 
                    $where['name']=array('like','%'.$keyword.'%');
                    $Menu=M('menu');
                    $count=M('menu')->where($where)->count();
                    $Page = new \Think\Page($count,16);
                    $show = $Page->show();// 分页显示输出
                    $list = $Menu->where($where)->order('posttime')->limit($Page->firstRow.','.$Page->listRows)->select();
                    // $searchMenu=M('menu')->where($where)->select();
                    if($list&&$show){      
                        $this->assign('count',$count);
                        $this->assign('list',$list);// 赋值数据集
                        $this->assign('page',$show);// 赋值分页输出
                        // dump($page);
                        $this->display();
                    }else{$this->error('未找到相关内容',U('Menu/show?flag=0'));}}
            }else{$this->error('未找到相关内容',U('Menu/show?flag=0'));}    
        }else{$this->error('非法访问',U('Menu/show?flag=0'));}  
        
    }
    // 菜品详情页
    public function detail(){
        // dump(session('cart'));
        if(IS_GET&&!empty($_GET['mid'])){
            //菜品相关
            $mid=I('get.mid');
            $condition['id']=$mid;

            $menu_detail=M('menu')->where($condition)->find();
            $taste_ids=explode(",",$menu_detail['taste']);
            $weight_ids=explode(",",$menu_detail['weight']);
            // $this->assign('taste_ids',$taste_ids);
            // $this->assign('weight_ids',$weight_ids);
            $this->assign('menu',$menu_detail);
            $taste_map['id']=array('in',$taste_ids);
            $weight_map['id']=array('in',$weight_ids);
            $taste=M('taste')->where($taste_map)->select();
            $weight=M('weight')->where($weight_map)->select();
            $this->assign('taste',$taste);
            $this->assign('weight',$weight);
            //评论相关
            // $menu_comment=M('comment')->where($map)->select();
            $num =  M('comment')->count(); //获取评论总数
            $this->assign('num',$num);
            $data=array();
            $data=$this->getCommlist('',$mid);//获取评论列表
            $this->assign("comment",$data);
            // 显示
            $this->display();
        }else{$this->error('参数有误，请检查地址',U('Index/index'));}
    }
    // 获取留言目录
    protected function getCommlist($parent_id = 0,$mid,&$result = array()){       
        $arr = M('comment')->where("parent_id = '".$parent_id."'AND checkinfo=1 AND menu_id=".$mid)->order("posttime desc")->select();   
        if(empty($arr)){
            return array();
        }
        foreach ($arr as $cm) {  
            $thisArr=&$result[];
            $cm["children"] = $this->getCommlist($cm["id"],$cm["menu_id"],$thisArr);    
            $thisArr = $cm;                                    
        }
        return $result;
   }
    // 菜品留言
    public function comment(){
        if(IS_POST){
            if(!empty($_POST)){
                $is_vip=session('?user');
                $mid=I('post.menu_id');
                $pid=I('post.parent_id');
                if(!$is_vip){
                    $chkrules = array(
                                array('name','require','昵称不能为空'),
                                array('email','require','邮箱必须填写'),
                                array('content','require','留言内容不能为空'),
                    );
                    $autorules = array(
                        array('name','trim',3,'function') , 
                        array('email','trim',3,'function') , 
                        array('content','trim',3,'function') , 
                        array('posttime','time',3,'function') ,
                        array('ip','get_client_ip',3,'function')
                    );
                    $comment=M('comment');
                    $createData['name']=I('post.name');
                    $createData['email']=I('post.email');
                    $createData['menu_id']=$mid;
                    $createData['parent_id']=$pid;
                    $createData['content']=I('post.content');
                    $data=$comment->validate($chkrules)->auto($autorules)->create($createData,1);
                    if($data){
                        $info=$comment->add($data);
                        if($info){$this->success('评论成功，请等待审核',U('Menu/detail?mid='.$mid));}
                        else{$this->error("数据写入失败",U('Menu/detail?mid='.$mid));}
                    }else{$error = $comment->getError();$this->error($error,U('Menu/detail?mid='.$mid));}
                }else{
                    $chkrules = array(
                                array('content','require','留言内容不能为空'),
                    );
                    $autorules = array(
                        array('content','trim',3,'function') , 
                        array('posttime','time',3,'function') ,
                        array('ip','get_client_ip',3,'function')
                    );
                    $comment=M('comment');
                    $createData['is_vip']=1;
                    $createData['uid']=session('user.uid');
                    $createData['name']=session('user.name');
                    $createData['head']=session('user.head');
                    $createData['menu_id']=$mid;
                    $createData['parent_id']=$pid;
                    $createData['content']=I('post.content');
                    $data=$comment->validate($chkrules)->auto($autorules)->create($createData,1);
                    if($data){
                        $info=$comment->add($data);
                        if($info){$this->success('评论成功，请等待审核',U('Menu/detail?mid='.$mid));}
                        else{$this->error("数据写入失败",U('Menu/detail?mid='.$mid));}
                    }else{$error = $comment->getError();$this->error($error,U('Menu/detail?mid='.$mid));}
                }
            }else{$this->error("数据传入失败",U('Menu/detail?mid='.$mid));}
        }
        
    }
    // 空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
    
}