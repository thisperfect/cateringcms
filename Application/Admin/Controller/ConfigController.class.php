<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
class ConfigController extends AuthController {
    // 定义数据表
    private $db;
    // 站点信息管理
    public function index(){
        $this->db=D('Config');
        if(IS_POST){   
            // $data=I('post.'); 
            // dump($data);   
            if($this->db->editData()){
                $this->success('修改成功',U('Admin/Config/index'));
            }else{
                $this->error('修改失败');
            }
        }else{
            $data=$this->db->getAllData();
            $this->assign('data',$data);
            
            $this->display();       
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}