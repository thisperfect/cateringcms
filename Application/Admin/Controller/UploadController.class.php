<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\AuthController;
use Think\Upload;
class UploadController extends AuthController {
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
                        $url="//".$_SERVER['HTTP_HOST']."/".cateringcms."/".$data['path'];
                    }else{$url="https://".$_SERVER['HTTP_HOST']."/".$data['path'];}
                    if($addInfo){$this->ajaxReturn(['status'=>1,'url'=>$url],'json');}//上传后返回图片链接
                }
            }
        }else{$this->error("非法访问",U('Upload/index'));}
        
    }
    // 文件管理页
    public function index(){
        if($_SERVER['HTTP_HOST']=='localhost'){
            $url="//".$_SERVER['HTTP_HOST']."/cateringcms/";
        }else{$url="//".$_SERVER['HTTP_HOST']."/";}
        $select_file=M('uploads')->order('id asc')->select();
        $this->assign('file',$select_file);
        $this->assign('url',$url);
        $this->display();
    }
    // 删除文件
    public function del_file(){
        if(IS_GET){
            $fid=I('get.fid');
            if(!empty($fid)){
                $list=M('uploads')->where('id='.$fid)->find();
                if(empty($list)){$this->ajaxReturn(["deleteCode"=>"2"],"json");}
                else{
                    $del=M('uploads')->delete($fid);
                    $path=$list['path'];
                    $res=unlink($path);
                    if($del && $res){$this->ajaxReturn(["deleteCode"=>"1"],"json");}
                    else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}}
            }else{$this->error("参数不能为空！",U('Upload/index'));}
        }elseif (IS_POST) {
            $fidlist=I('post.fidlist');
            if(!empty($fidlist)){
                if(is_array($fidlist)){$where = 'id in('.implode(',',$fidlist).')';  
                }else{$where = 'id='.$fidlist;}
                $list=M('uploads')->where($where)->select();
                if(empty($list)){$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                else{
                    $del=M('uploads')->where($where)->delete();
                    $succ = $fail = 0;
                    foreach ($list as $key => $value) {
                        if(unlink($value['path'])){$succ++;}
                        else{$fail++;}
                    }
                    // $res=unlink($path);
                    if($del){$this->ajaxReturn(["deleteCode"=>"1","success"=>$succ,"fail"=>$fail],"json");}
                    else{$this->ajaxReturn(["deleteCode"=>"0"],"json");}
                }
            }
        }
    }
    //空操作
    public function _empty(){
        $this->error("非法操作",U('Index/home'));
    }
}