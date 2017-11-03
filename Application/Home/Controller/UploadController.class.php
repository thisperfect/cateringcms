<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-17 22:11:47 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-27 14:07:47
 * 上传管理类（管理上传、以及公共上传）
 */
namespace Home\Controller;
use Home\Common\Controller\CheckLogController;
use Think\Upload;
class UploadController extends CheckLogController {
    // 公共上传文件类
    public function upload_file(){
        if(IS_POST){
            if (!empty($_FILES)){
                $config = array(
                        'mimes'         =>  array(), //允许上传的文件MiMe类型
                        'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
                        'exts'          =>  array('jpg', 'gif', 'png', 'jpeg','ico'), //允许上传的文件后缀
                        'autoSub'       =>  true, //自动子目录保存文件
                        'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
                        'rootPath'      =>  './Uploads/', //保存根路径
                        'savePath'      =>  '',//保存路径
                );
                $upload = new \Think\Upload($config);// 实例化上传类
                $info   =   $upload->upload();
                if(!$info){
                    // $this->error($upload->getError());
                    $error=$upload->getError();
                    $this->ajaxReturn($error,'json');
                }else{
                    // 图片文件名
                    $data['name']=$info['file']['savename'];
                    //图片的保存路劲
                    $data['path']='Uploads/'.$info['file']['savepath'].$info['file']['savename'];
                    // 图片大小
                    $data['size']=$info['file']['size']/1024;
                    //文件类型
                    $data['type']=$info['file']['ext'];
                    //上传时间
                    $data['posttime']=time();
                    // dump($data);
                    // 信息写入数据库
                    $file=M('uploads');
                    $addInfo=$file->add($data);
                    // 返回图片链接
                    if($_SERVER['HTTP_HOST']=='localhost'){
                        $url="//".$_SERVER['HTTP_HOST']."/cateringcms/".$data['path'];
                    }else{$url="//".$_SERVER['HTTP_HOST']."/".$data['path'];}
                    // $url="http://localhost/catering/".$data['path'];
                    if($addInfo){$this->ajaxReturn(['status'=>1,'url'=>$url],'json');}//上传后返回图片链接
                }
            }
        }else{$this->ajaxReturn(['status'=>0,'msg'=>'非法访问'],'json');}
        
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/index'));
    }
}