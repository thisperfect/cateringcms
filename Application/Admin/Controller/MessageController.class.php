<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
class MessageController extends AuthController{
    //  留言管理
     public function index(){
        $message=M('message')->order('posttime desc')->select();
        // dump($message);
        $this->assign('message',$message);
        $this->assign('content',$message);
        $this->display();
     }
    //  留言审核
     public function message_check(){
        if(IS_POST){
            if(!empty($_POST)){
                $mid=I('post.mid');
                if(!empty($mid)){
                    $rules = array(
                        array('checkinfo',array(0,1),'审核参数不正确！',2,'in'), 
                    );
                    $oldCheckInfo=I('post.checkinfo');
                    $NewCheckInfo=($oldCheckInfo==1?0:1);
                    $message = M('message'); 
                    if (!$message->validate($rules)->create()){
                        $error=$message->getError();
                        $this->ajaxReturn($error,'json');
                    }else{
                        $condition['id']=$mid;
                        $data['checkinfo']=$NewCheckInfo;
                        $info=$message->where($condition)->save($data);
                        if($info){$this->ajaxReturn(['chkCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['chkCode'=>'写入数据失败'],'json');}
                    }
                }else{$this->ajaxReturn(['chkCode'=>'参数为空'],'json');}
            }else{$this->ajaxReturn(['chkCode'=>'传入数据为空'],'json');}             
        }
     }
    //  留言删除
    public function message_del(){
        if(IS_POST){
            $mids=I('post.midlist');
            if(!empty($mids)){
                $succ=$fail=0;
                for($i=0;$i<count($mids);$i++){
                    $del_info=M('message')->delete($mids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}                
            }else{$this->error("参数不能为空！",U('message/index'));}
        }else if(IS_GET){
            $mid=I('get.mid');
            if(!empty($mid)){
                $result=M('message')->delete($mid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('message/index'));}
        }         
     }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}
