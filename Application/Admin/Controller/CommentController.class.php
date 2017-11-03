<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
use Admin\Common\Controller\AuthController;
class CommentController extends AuthController{
    //  评论管理
     public function index(){
        $m=M(); 
        $comment=$m->table('menu m,comment c')->field("c.id,m.name,c.name uname,c.content,c.posttime,c.ip,c.checkinfo")->where('m.id=c.menu_id')->order('c.posttime desc')->select();
        $this->assign('comment',$comment);
        $this->assign('content',$comment);
        $this->display();
     }
    //  评论审核
     public function comment_check(){
        if(IS_POST){
            if(!empty($_POST)){
                $cid=I('post.cid');
                if(!empty($cid)){
                    $rules = array(
                        array('checkinfo',array(0,1),'审核参数不正确！',2,'in'), 
                    );
                    $oldCheckInfo=I('post.checkinfo');
                    $NewCheckInfo=($oldCheckInfo==1?0:1);
                    $comment = M('comment'); 
                    if (!$comment->validate($rules)->create()){
                        $error=$comment->getError();
                        $this->ajaxReturn($error,'json');
                    }else{
                        $condition['id']=$cid;
                        $data['checkinfo']=$NewCheckInfo;
                        $info=$comment->where($condition)->save($data);
                        if($info){$this->ajaxReturn(['chkCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['chkCode'=>'写入数据失败'],'json');}
                    }
                }else{$this->ajaxReturn(['chkCode'=>'参数为空'],'json');}
            }else{$this->ajaxReturn(['chkCode'=>'传入数据为空'],'json');}             
        }
     }
    //  评论删除
    public function comment_del(){
        if(IS_POST){
            $cids=I('post.cidlist');
            if(!empty($cids)){
                $succ=$fail=0;
                for($i=0;$i<count($cids);$i++){
                    $del_info=M('comment')->delete($cids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}                
            }else{$this->error("参数不能为空！",U('Comment/index'));}
        }else if(IS_GET){
            $cid=I('get.cid');
            if(!empty($cid)){
                $result=M('comment')->delete($cid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Comment/index'));}
        }         
     }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}
