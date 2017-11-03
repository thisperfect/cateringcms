<?php
/*
 * @Author: W.NK
 * @Date: 2017-06-13 20:58:21 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-27 13:51:05
 * 单页信息显示
 */
namespace Home\Controller;
use Think\Controller;
use Home\Common\Controller\BaseController;
class PageController extends BaseController {
    // 其他单页
    public function index(){
        if(IS_GET){
            $pid=I('get.id');
            if(!empty($pid)){
                $page_detail=M('page')->where('id='.$pid)->find();
                if($page_detail){
                    $this->assign('detail',$page_detail);
                    // dump($page_detail);
                    $this->display();
                }else{$this->error("未找页面",U('Index/index'));}
            }
        }else{$this->error("未找页面",U('Index/index'));} 
    }
    // 厨师首页
    public function chef(){
        $chef=M('chef')->select();
        $this->assign('chef',$chef);
        $this->display();
    }
    // 留言页面
    public function message(){
        if(IS_POST){
            if(!empty($_POST)){
                $is_vip=session('?user');
                if(!$is_vip){
                    $chkrules = array(
                                array('name','require','昵称不能为空'),
                                array('email','require','邮箱必须填写'),
                                array('content','require','留言内容不能为空'),
                    );
                    $autorules = array(
                        array('name','trim',3,'function') , 
                        array('email','trim',3,'function') , 
                        array('content','trim',3,'function') , 
                        array('posttime','time',3,'function') ,
                        array('ip','get_client_ip',3,'function')
                    );
                    $message=M('message');
                    $data=$message->validate($chkrules)->auto($autorules)->create($_POST,1);
                    if($data){
                        $info=$message->add($data);
                        if($info){$this->success('留言成功',U('Page/message'));}
                        else{$this->error("数据写入失败",U('Page/message'));}
                    }else{$error = $message->getError();$this->error($error,U('Page/message'));}
                }else{
                    $chkrules = array(
                                array('content','require','留言内容不能为空'),
                    );
                    $autorules = array(
                        array('content','trim',3,'function') , 
                        array('posttime','time',3,'function') ,
                        array('ip','get_client_ip',3,'function')
                    );
                    $message=M('message');
                    $createData['is_vip']=1;
                    $createData['uid']=session('user.uid');
                    $createData['name']=session('user.name');
                    $createData['head']=session('user.head');
                    $createData['content']=I('post.content');
                    $data=$message->validate($chkrules)->auto($autorules)->create($createData,1);
                    if($data){
                        $info=$message->add($data);
                        if($info){$this->success('留言成功，请等待审核',U('Page/message'));}
                        else{$this->error("数据写入失败",U('Page/message'));}
                    }else{$error = $message->getError();$this->error($error,U('Page/message'));}
                }

            }else{$this->error("数据传入失败",U('Page/message'));}
        }else{
            $message=M('message')->field('is_vip,head,name,content,posttime')->where('checkinfo=1')->select();
            $this->assign('message',$message);
            $this->display();
        }
        
    }
    // 空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
}