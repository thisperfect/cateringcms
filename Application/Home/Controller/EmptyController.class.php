<?php
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller {
    public function index(){
        $this->display('../View/Static/404');
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
}