<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-23 21:53:59 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-05-27 14:12:57
 * 友链数据表
 */
namespace Admin\Model;
use Think\Model;
class WeblinkModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('webname','require','网站名称不能为空'),
        array('webnote','require','网站描述不能为空'),
        array('picurl','require','缩略图不能为空'),
        array('linkurl','require','跳转链接不能为空'),
        array('checkinfo',array(0,1),'选项参数有误',2,'in')
    );
    // 自动完成规则
    protected $_auto = array ( 
        array('webname','trim',3,'function'),
        array('webnote','trim',3,'function'),
        array('posttime','time',3,'function') , 
    );
}