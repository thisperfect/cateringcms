<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-30 20:13:05 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-03 10:50:17
 * 收藏管理
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
use Admin\Common\Controller\AuthController;
class CollectController extends AuthController{
    //  收藏管理
    public function index(){
        $m=M();
        $collect=$m->table('menu m,user u,collect c')->field("c.id,m.name,u.uname,c.posttime")->where('m.id=c.menu_id AND u.id=c.uid')->order('c.posttime desc')->select();
        // dump($collect);
        $this->assign('collect',$collect);
        $this->display();
    }
    
    //  收藏删除
    public function collect_del(){
        if(IS_POST){
            $cids=I('post.cidlist');
            if(!empty($cids)){
                $succ=$fail=0;
                for($i=0;$i<count($cids);$i++){
                    $del_info=M('collect')->delete($cids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}                
            }else{$this->error("参数不能为空！",U('collect/index'));}
        }else if(IS_GET){
            $cid=I('get.cid');
            if(!empty($cid)){
                $result=M('collect')->delete($cid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('collect/index'));}
        }         
     }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}
