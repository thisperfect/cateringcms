<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
class ChefController extends AuthController{
    //厨师信息显示
    public function index(){
        $chef=M('chef')->select();
        $this->assign('chef',$chef);
        $this->display();
    }
    //厨师信息添加
    public function chef_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $chef=D('Chef'); //实例化chef对象
                $data=$chef->create($_POST,1); //创建实例化数据对象并自动验证、完成（提交内容，1新增2更新3全部情况）
                if($data){
                    $info=$chef->add($data); //添加数据到数据库
                    if($info){$this->ajaxReturn(["addCode"=>"1"],'json');}
                    else{$this->ajaxReturn(["addCode"=>"写入数据失败"],'json');}
                }else{$error->$chef->getError();$this->ajaxReturn($error,'json');}
            }else{$this->ajaxReturn(["addCode"=>"数据传入服务器失败"],'json');}
        }else{
            $this->display();
        }
    }
    //厨师信息修改
    public function chef_edit(){
        $cid=I('get.cid'); //获取厨师id
        if(!empty($cid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $chef=D('Chef');
                    $data=$chef->create($_POST,2);
                    if($data){
                        $info=$chef->where('id='.$cid)->save($data);
                        if($info){$this->ajaxReturn(["editCode"=>"1"],'json');}
                        else{$this->ajaxReturn(["editCode"=>"写入数据失败"],'json');}
                    }else{$error=$chef->getError();$this->ajaxReturn($error,'json');}
                }else{$this->ajaxReturn(["editCode"=>"数据传入服务器失败"],'json');}
            }else{
                $chef=M('chef')->where('id='.$cid)->find();
                $this->assign('chef',$chef);
                $this->display();
            }          
        }else{$this->ajaxReturn(["editCode"=>"参数不能为空"],'json');}       
    }
           
 
    //厨师信息删除
     public function chef_del(){
        if(IS_POST){
            $cids=I('post.cidlist');
            if(!empty($cids)){
                //for循环把获取的厨师数组id信息删除
                $succ=$fail=0;
                for($i=0;$i<count($cids);$i++){
                    $del=M('chef')->delete($cids[$i]);
                    if($del){$succ++;}else{$fail++;}
                }
                //如果成功数0删除失败，再返回删除成功几条
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('Chef/index'));}
        }elseif (IS_GET) {
            $cid=I('get.cid');
            if(!empty($cid)){
                $del=M('chef')->delete($cid);               
                    if($del){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                    else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}}
            }else{$this->error("参数不能为空！",U('Chef/index'));}
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",'index');
    }
 }
 
