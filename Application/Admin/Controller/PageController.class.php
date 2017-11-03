<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
class PageController extends AuthController{
    // 单页管理
    public function index(){
        $page=M('page')->order('posttime')->select();
        $this->assign('page',$page);
        $this->display();
    }
    // 单页添加
    public function page_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $page=D('Page');
                $data=$page->create($_POST,1);
                if($data){
                    $info=$page->add($data);
                    if($info){$this->ajaxReturn(['addCode'=>'1'],'json');}
                    else{$this->ajaxReturn(['addCode'=>'数据写入服务器错误'],'json');}
                }else{$error=$page->getError();$this->ajaxReturn($error,'json');}
            }else{$this->ajaxReturn(['addCode'=>'数据传入服务器错误'],'json');}
        }else{
            $this->display();
        }
    }
    public function page_edit(){
        $pid=I('get.pid');
        if(!empty($pid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $page=D('Page');
                    $data=$page->create($_POST,2);
                    if($data){
                        $info=$page->where('id='.$pid)->save($data);
                        if($info){$this->ajaxReturn(["editCode"=>"1"],'json');}
                        else{$this->ajaxReturn(["editCode"=>"写入数据失败"],'json');}
                    }else{$error=$page->getError();$this->ajaxReturn($error,'json');}
                }else{$this->ajaxReturn(["editCode"=>"数据传入服务器失败"],'json');}
            }else{
                $page=M('page')->where('id='.$pid)->find();
                $this->assign('page',$page);
                $this->display();
            }          
        }else{$this->ajaxReturn(["editCode"=>"参数不能为空"],'json');}  
    }
    //  友情链接删除
    public function page_del(){
        if(IS_POST){
            $pids=I('post.pidlist');
            if(!empty($pids)){
                $succ=$fail=0;
                for($i=0;$i<count($pids);$i++){
                    $del_info=M('page')->delete($pids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}                
            }else{$this->error("参数不能为空！",U('page/index'));}
        }else if(IS_GET){
            $pid=I('get.pid');
            if(!empty($pid)){
                $result=M('page')->delete($pid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('page/index'));}
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}