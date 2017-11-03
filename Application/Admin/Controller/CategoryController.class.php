<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-18 08:56:14 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-05-28 16:33:31
 * 内容管理类(菜谱管理)
 */
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
use Think\Model;
class CategoryController extends AuthController{
	public function index(){
        $category=M('category')->select();
        $this->assign('category',$category);
		$this->display();
	}

    //菜谱类别添加
	public function category_add(){
        if(IS_POST){
            if (!empty($_POST)) {
                $category=D('category');
                $data = $category->create($_POST,1);
                if($data){
                    $info = $category->add($data);
                    if($info) {
                        $this->ajaxReturn(["addCode"=>"1"],"json"); 
                    }else{$this->ajaxReturn(["addCode"=>"写入数据失败"],"json");}
                }else{$error=$category->getError();$this->ajaxReturn($error,"json");}
            }else{$this->ajaxReturn(['addCode'=>'未传入数据'],'json');}
        }else{
            $category=M('category')->select();
            $this->assign('category',$category);
            $this->display();
        }           
    }
 
		 // 菜谱信息编辑
    public function category_edit(){
        $cid=I('get.cid');
        if (!empty($cid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $category=D('category');
                    $data = $category->create($_POST,2);
                    if($data){
                        $newName=trim(I('post.title'));
                        $search_name=M('category')->where("title='$newName'")->find();
                        $search_id=M('category')->where("id='$cid'")->find();
                        $oldName=$search_id['title'];
                        $c=($search_name?($oldName==$newName?true:false):true);
                        if($c){
                            $condition['id']=$cid;
                            $info = $category->where($condition)->save($data);
                            if($info){
                                $this->ajaxReturn(["editCode"=>"1"],"json");
                            }else{$this->ajaxReturn(["editCode"=>"写入数据失败"],"json");}
                        }else{$this->ajaxReturn(['editCode'=>'菜谱类别名已被占用！'],'json');}
                    }else{$error = $category->getError();$this->ajaxReturn($error,'json');}
                }   else{$this->ajaxReturn(["editCode"=>"传入数据失败"],"json");}            
            }else{
                $category=M('category')->where("id='$cid'")->find();
                $this->assign('category',$category);
                $this->display();
            }
        }else{$this->error("参数不能为空！",U('Category/index'));}
    }

    // 菜谱类别删除
     public function category_del(){
        if(IS_GET){
            $cid=I('get.cid');
            if(!empty($cid)){
                $result=M('category')->delete($cid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Category/section'));}
        }else if(IS_POST){
            $cids=I('post.cidlist');
            if(!empty($cids)){
                $succ=$fail=0;
                for($i=0;$i<count($cids);$i++){
                    $del_info=M('category')->delete($cids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('Category/section'));}
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",'index');
    }
}