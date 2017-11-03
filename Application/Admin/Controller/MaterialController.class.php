<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-18 08:56:14 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-24 15:36:58
 * 内容管理类(食材管理)
 */
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
use Think\Model;
class MaterialController extends AuthController{
	public function index(){
        $material=M('material')->select();
        $this->assign('material',$material);
		$this->display();
	}

    //食材类别添加
	public function material_add(){
        if(IS_POST){
            if (!empty($_POST)) {
                $material=D('material');
                $data = $material->create($_POST,1);
                if($data){
                    $info = $material->add($data);
                    if($info) {
                        $this->ajaxReturn(["addCode"=>"1"],"json"); 
                    }else{$this->ajaxReturn(["addCode"=>"写入数据失败"],"json");}
                }else{$error=$material->getError();$this->ajaxReturn($error,"json");}
            }else{$this->ajaxReturn(['addCode'=>'未传入数据'],'json');}
        }else{
            $material=M('material')->select();
            $this->assign('material',$material);
            $this->display();
        }           
    }
 
		 // 食材信息编辑
    public function material_edit(){
        $mid=I('get.mid');
        if (!empty($mid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $material=D('material');
                    $data = $material->create($_POST,2);
                    if($data){
                        $newName=trim(I('post.title'));
                        $search_name=M('material')->where("title='$newName'")->find();
                        $search_id=M('material')->where("id='$mid'")->find();
                        $oldName=$search_id['title'];
                        $c=($search_name?($oldName==$newName?true:false):true);
                        if($c){
                            $condition['id']=$mid;
                            $info = $material->where($condition)->save($data);
                            if($info){
                                $this->ajaxReturn(["editCode"=>"1"],"json");
                            }else{$this->ajaxReturn(["editCode"=>"写入数据失败"],"json");}
                        }else{$this->ajaxReturn(['editCode'=>'食材类别名已被占用！'],'json');}
                    }else{$error = $material->getError();$this->ajaxReturn($error,'json');}
                }   else{$this->ajaxReturn(["editCode"=>"传入数据失败"],"json");}            
            }else{
                $material=M('material')->where("id='$mid'")->find();
                $this->assign('material',$material);
                $this->display();
            }
        }else{$this->error("参数不能为空！",U('Material/index'));}
    }

    // 食材类别删除
     public function material_del(){
        if(IS_GET){
            $mid=I('get.mid');
            if(!empty($mid)){
                $result=M('material')->delete($mid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Material/index'));}
        }else if(IS_POST){
            $mids=I('post.midlist');
            if(!empty($mids)){
                $succ=$fail=0;
                for($i=0;$i<count($mids);$i++){
                    $del_info=M('material')->delete($mids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('Material/index'));}
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",'index');
    }
}










