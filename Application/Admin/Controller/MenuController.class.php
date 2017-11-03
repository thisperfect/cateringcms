<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
use Think\Upload;
class MenuController extends AuthController {
    // 菜品目录
    public function index(){
        $model=M();
        $menu=$model->table('menu m,category c')->field('m.id,m.name,m.picurl,m.checkinfo,c.title')->order('id')->where('m.category_id=c.id')->select();
        $category=M('category')->order('id asc')->select(); 
        $this->assign('menu',$menu);
        $this->assign('category',$category);
        $this->display();
    }
    public function editor(){
        $this->display();
    }
    // 菜品添加
    public function menu_add(){
        if(IS_POST){
            if(!empty($_POST)){
                $menu=D('Menu');
                $data = $menu->create($_POST,1);
                if($data){
                    // 属性判断
                    $property=I('post.property');
                    $property_ids=explode(",",$property);
                    $succ=$fail=0;
                    for($i=0;$i<count($property_ids);$i++){
                        $condition['id']=$property_ids[$i];
                        
                        $select_p=M('property')->where($condition)->find();
                        $select_p==true?$succ++:$fail++;
                    }
                    $chk_p=($fail==0?true:false);
                    //口味判断
                    $taste=I('post.taste');
                    $taste_ids=explode(",",$taste);
                    $succ1=$fail1=0;
                    for($j=0;$j<count($taste_ids);$j++){
                        $condition1['id']=$taste_ids[$j];
                        $select_t=M('taste')->where($condition1)->find();
                        $select_t==true?$succ1++:$fail1++;
                    }
                    $chk_t=($fail1==0?true:false);
                    //份量判断
                    $weight=I('post.weight');
                    $weight_ids=explode(",",$weight);
                    $succ2=$fail2=0;
                    for($k=0;$k<count($weight_ids);$k++){
                        $condition2['id']=$weight_ids[$k];
                        $select_w=M('weight')->where($condition2)->find();
                        $select_w==true?$succ2++:$fail2++;
                    }
                    $chk_w=($fail2==0?true:false);
                    // 其他属性判断
                    $category_id=I('post.category_id');
               
                    $select_c=M('category')->where('id='.$category_id)->select();
                    $chk_c=($select_c?true:false);
                    $material_id=I('post.material_id');
                    $select_m=M('material')->where('id='.$material_id)->select();
                    $chk_m=($select_m?true:false);
                    if($chk_p&&$chk_t&&$chk_w&&$chk_c&&$chk_m){
                        $info=$menu->add($data);
                        if($info){$this->ajaxReturn(['addCode'=>'1'],'json');}
                        else{$this->ajaxReturn(['addCode'=>'数据写入数据库失败'],'json');}
                    }else if(!$chk_p&&$chk_c&&$chk_m){$this->ajaxReturn(['addCode'=>'属性参数有误'],'json');}
                    else if($chk_p&&!$chk_c&&$chk_m){$this->ajaxReturn(['addCode'=>'菜谱类别参数有误'],'json');}
                    else if($chk_p&&$chk_c&&!$chk_m){$this->ajaxReturn(['addCode'=>'食材参数有误'],'json');} 
                    else if($chk_p&&!$chk_t&&$chk_w&&$chk_c&&$chk_m){$this->ajaxReturn(['addCode'=>'口味参数有误'],'json');}
                    else if($chk_p&&$chk_t&&!$chk_w&&$chk_c&&$chk_m){$this->ajaxReturn(['addCode'=>'份量参数有误'],'json');}                           
                }else{$error = $menu->getError();$this->ajaxReturn($error,'json');}
            }else{$this->ajaxReturn(['addCode'=>'数据传入服务器失败'],'json');}
        }else{
            $category=M('category')->select();
            $material=M('material')->select();
            $property=M('property')->select();
            $taste=M('taste')->select();
            $weight=M('weight')->select();
            $this->assign('property',$property);
            $this->assign('taste',$taste);
            $this->assign('weight',$weight);
            $this->assign('category',$category);
            $this->assign('material',$material);
            $this->display();
        }
    }
    // 菜品编辑
    public function menu_edit(){
        $mid=I('get.mid');
        if(!empty($mid)){
            if(IS_POST){
                if(!empty($_POST)){
                    $menu=D('Menu');
                    $data = $menu->create($_POST,2);
                        if($data){
                        // 属性判断
                        $property=I('post.property');
                        $property_ids=explode(",",$property);
                        $succ=$fail=0;
                        for($i=0;$i<count($property_ids);$i++){
                            $condition['id']=$property_ids[$i];
                            $select_p=M('property')->where($condition)->find();
                            $select_p==true?$succ++:$fail++;
                        }
                        $chk_p=($fail==0?true:false);
                        //口味判断
                        $taste=I('post.taste');
                        $taste_ids=explode(",",$taste);
                        $succ1=$fail1=0;
                        for($j=0;$j<count($taste_ids);$j++){
                            $condition1['id']=$taste_ids[$j];
                            $select_t=M('taste')->where($condition1)->find();
                            $select_t==true?$succ1++:$fail1++;
                        }
                        $chk_t=($fail1==0?true:false);
                        //份量判断
                        $weight=I('post.weight');
                        $weight_ids=explode(",",$weight);
                        $succ2=$fail2=0;
                        for($k=0;$k<count($weight_ids);$k++){
                            $condition2['id']=$weight_ids[$k];
                            $select_w=M('weight')->where($condition2)->find();
                            $select_w==true?$succ2++:$fail2++;
                        }
                        $chk_w=($fail2==0?true:false);
                        // 其他属性判断
                        $category_id=I('post.category_id');
                        $select_c=M('category')->where('id='.$category_id)->select();
                        $chk_c=($select_c?true:false);
                        $material_id=I('post.material_id');
                        $select_m=M('material')->where('id='.$material_id)->select();
                        $chk_m=($select_m?true:false);
                        if($chk_p&&$chk_t&&$chk_w&&$chk_c&&$chk_m){
                            $newName=trim(I('post.name'));
                            $search_name=M('menu')->where("name='$newName'")->find();
                            $search_id=M('menu')->where("id='$mid'")->find();
                            $oldName=$search_id['name'];
                            $c=($search_name?($oldName==$newName?true:false):false);
                            if($c){
                                $condition['id']=$mid;
                                $info = $menu->where($condition)->save($data);
                                if($info){$this->ajaxReturn(['editCode'=>'1'],'json');}
                                else{$this->ajaxReturn(['editCode'=>'写入数据失败'],'json');}
                            }else{$this->ajaxReturn(['editCode'=>'菜品名已被占用'],'json');}    
                        }else if(!$chk_p&&$chk_c&&$chk_m){$this->ajaxReturn(['editCode'=>'属性参数有误'],'json');}
                        else if($chk_p&&!$chk_c&&$chk_m){$this->ajaxReturn(['editCode'=>'菜谱类别参数有误'],'json');}
                        else if($chk_p&&$chk_c&&!$chk_m){$this->ajaxReturn(['editCode'=>'食材参数有误'],'json');} 
                        else if($chk_p&&!$chk_t&&$chk_w&&$chk_c&&$chk_m){$this->ajaxReturn(['editCode'=>'口味参数有误'],'json');}
                        else if($chk_p&&$chk_t&&!$chk_w&&$chk_c&&$chk_m){$this->ajaxReturn(['editCode'=>'份量参数有误'],'json');}                               
                        }else{$error = $menu->getError();$this->ajaxReturn($error,'json');}
                }else{$this->ajaxReturn(['editCode'=>'数据传入服务器失败'],'json');}
            }else{
                $menu=M('menu')->where("id='$mid'")->find();
                $property_ids=explode(",",$menu['property']);
                $taste_ids=explode(",",$menu['taste']);
                $weight_ids=explode(",",$menu['weight']);
                $category=M('category')->select();
                $material=M('material')->select();
                $property=M('property')->select();
                $taste=M('taste')->select();
                $weight=M('weight')->select();
                $this->assign('property_ids',$property_ids);
                $this->assign('taste_ids',$taste_ids);
                $this->assign('weight_ids',$weight_ids);
                $this->assign('menu',$menu);
                $this->assign('category',$category);
                $this->assign('material',$material);
                $this->assign('property',$property);
                $this->assign('taste',$taste);
                $this->assign('weight',$weight);
                $this->display();
            }           
        }else{$this->error("参数不能为空！",U('Menu/index'));}
    }
    // 菜品删除
    public function menu_del(){
        if(IS_GET){
            $mid=I('get.mid');
            if(!empty($mid)){
                $result=M('menu')->delete($mid);
                if($result){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
            }else{$this->error("参数不能为空！",U('Menu/index'));}
        }else if(IS_POST){
            $mids=I('post.midlist');
            if(!empty($mids)){
                $succ=$fail=0;
                for($i=0;$i<count($mids);$i++){
                    $del_info=M('menu')->delete($mids[$i]);
                    if($del_info){$succ++;}else{$fail++;}
                }
                if($succ==0){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
            }else{$this->error("参数不能为空！",U('Menu/index'));}
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}