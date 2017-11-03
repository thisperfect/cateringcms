<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-24 20:02:24 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-24 15:37:50
 * 友情链接管理类
 */
 namespace Admin\Controller;
 use Think\Controller;
 use Admin\Common\Controller\AuthController;
 class WeblinkController extends AuthController{
    //  友情链接管理类
     public function index(){
        $weblink=M('weblink')->order('posttime desc')->select();
        $this->assign('weblink',$weblink);
        $this->display();
     }
    //  友情链接添加
    public function weblink_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $weblink=D('Weblink'); //实例化weblink
                $data=$weblink->create($_POST,1); //create方法
                if($data){
                    $info=$weblink->add($data);
                    if($info){$this->ajaxReturn(["addCode"=>"1"],'json');}
                    else{$this->ajaxReturn(["addCode"=>"写入数据失败"],'json');}
                }else{$error->$weblink->getError();$this->ajaxReturn($error,'json');}
            }else{$this->ajaxReturn(["addCode"=>"数据传入服务器失败"],'json');}
        }else{
            $this->display();
        }
    }
    //  友情链接编辑
    public function weblink_edit(){
        $wid=I('get.wid');
        if(!empty($wid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $weblink=D('Weblink');
                    $data=$weblink->create($_POST,2);
                    if($data){
                        $info=$weblink->where('id='.$wid)->save($data);
                        if($info){$this->ajaxReturn(["editCode"=>"1"],'json');}
                        else{$this->ajaxReturn(["editCode"=>"写入数据失败"],'json');}
                    }else{$error=$weblink->getError();$this->ajaxReturn($error,'json');}
                }else{$this->ajaxReturn(["editCode"=>"数据传入服务器失败"],'json');}
            }else{
                $weblink=M('weblink')->where('id='.$wid)->find();
                $this->assign('weblink',$weblink);
                $this->display();
            }          
        }else{$this->ajaxReturn(["editCode"=>"参数不能为空"],'json');}       
    }
    //  友情链接删除
    public function weblink_del(){
        if(IS_POST){
            $wids=I('post.widlist');
            if(!empty($wids)){
                $succ=$fail=0;
                for($i=0;$i<count($wids);$i++){
                    $del_info=M('weblink')->delete($wids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}                
            }else{$this->error("参数不能为空！",U('Weblink/index'));}
        }else if(IS_GET){
            $wid=I('get.wid');
            if(!empty($wid)){
                $result=M('weblink')->delete($wid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Weblink/index'));}
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
 }

