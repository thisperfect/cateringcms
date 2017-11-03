<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Controller\BaseController;
class IndexController extends BaseController {
    // 前台首页
    public function index(){
        //首页大图轮播
        $ids=[];
        $discount_ids=[];
        $weather_ids=[];
        $menu=M('menu')->field('id,property')->select();
        foreach ($menu as $key => $value) {
            $property_arr= explode(',',$value['property']);
            $menu_detail=['id'=>$value['id'],'property'=>$property_arr];
            if(in_array('1',$menu_detail['property'])){
                array_push($ids,$menu_detail['id']);
            }
            if(in_array('2',$menu_detail['property'])){
                array_push($discount_ids,$menu_detail['id']);
            }
            if(in_array('3',$menu_detail['property'])){
                array_push($weather_ids,$menu_detail['id']);
            }
        }
        $condition['id']=array('in',$ids);
        $BigPic=M('menu')->field('id,name,description,picurl')->limit(3)->where($condition)->order('posttime desc')->select();
        // 每周推荐小轮播
        $getId=M('menu')->field('id')->select();
        $rand=[];
        foreach ($getId as $key => $value) {            
            array_push($rand,$value['id']);
        }
        $arr1=[];
        $arr2=[];
        $arr3=[];
        for ($i=0; $i < 3 ; $i++) { 
            shuffle($rand);
            $a=$rand['0'];
            $b=$rand['1'];
            $c=$rand['2'];
            array_push($arr1,$a); 
            array_push($arr2,$b);           
            array_push($arr3,$c);
        }            
        $condition1['id']=array('in',$arr1);
        $condition2['id']=array('in',$arr2);
        $condition3['id']=array('in',$arr3);
        $SmallPic1=M('menu')->field('id,name,picurl')->where($condition1)->select();
        $SmallPic2=M('menu')->field('id,name,picurl')->where($condition2)->select();
        $SmallPic3=M('menu')->field('id,name,picurl')->where($condition3)->select();
        // 侧边栏
        $category=M('category')->field('id,title')->select();
        $navTitle=[];
        $navAll=[];
        foreach ($category as $key => $value) {
            $nav_menu=M('menu')->field('id,name,picurl')->where('category_id='.$value['id'])->limit(9)->order('posttime desc')->select();
            array_push($navTitle,$value['title']);
            $navOne=['id'=>$value['id'],'title'=>$value['title'],'nav'=>$nav_menu];
            array_push($navAll,$navOne);
            
        }
        //全部菜品小轮播
        $allMenu=M();
        $menuAll1=$allMenu->table('material m,menu u')->field('m.id,m.title,u.id,u.name,u.picurl')->where('m.id=u.category_id')->limit(3)->order('rand()')->group('m.id')->select();
        $menuAll2=$allMenu->table('material m,menu u')->field('m.id,m.title,u.id,u.name,u.picurl')->where('m.id=u.category_id')->limit(3)->order('rand()')->group('m.id')->select();
        $menuAll3=$allMenu->table('material m,menu u')->field('m.id,m.title,u.id,u.name,u.picurl')->where('m.id=u.category_id')->limit(3)->order('rand()')->group('m.id')->select();
        // dump($menuAll);
        // $material=M('material')->field('id')->limit(3)->select();
        // $menuAll=[];
        // foreach ($material as $key => $value) {
        //     $ma=M('menu')->field('id,name,picurl')->where('material_id='.$value['id'])->order()->limit(3)->order('posttime desc')->select();
        //     array_push($menuAll,$ma);
        // }
        // 特价菜展示随机显示
        $where['id']=array('in',$discount_ids);
        $discount=M('menu')->field('id,name,description,picurl')->limit(3)->order('posttime desc')->where($where)->select();
        // 时节令菜展示随机显示
        $map['id']=array('in',$weather_ids);
        $weather=M('menu')->field('id,name,description,picurl')->limit(3)->order('posttime desc')->where($map)->select();
        // dump($navAll);
        // $sql="
        // SELECT *
        // FROM `menu` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `menu`)-(SELECT MIN(id) FROM `menu`))+(SELECT MIN(id) FROM `menu`)) AS id) AS t2
        // WHERE t1.id >= t2.id
        // ORDER BY t1.id LIMIT 3";
        // $Model = new \Think\Model() ;
        // $round=$Model->query($sql);
        // dump($discount);
        // parent::menu('index');
        $this->assign('pic1',$SmallPic1);
        $this->assign('pic2',$SmallPic2);
        $this->assign('pic3',$SmallPic3);
        $this->assign('bigPic',$BigPic);
        $this->assign('menuAll1',$menuAll1);
        $this->assign('menuAll2',$menuAll2);
        $this->assign('menuAll3',$menuAll3);
        $this->assign('navAll',$navAll);
        $this->assign('discount',$discount);
        $this->assign('weather',$weather);
        $this->display();
    }

    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
}