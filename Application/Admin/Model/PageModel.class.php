<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-27 14:11:43 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-05-27 15:26:59
 * 单页信息Model自动验证
 */
 namespace Admin\Model;
 use Think\Model;
 class PageModel extends Model{
     // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('title','require','标题不能为空'),
        array('author','require','作者不能为空'),
        array('content','require','内容不能为空'),
        array('checkinfo','require','审核不能为空'),
        array('checkinfo',array(0,1),'选项参数有误',2,'in')
    );
    // 自动完成规则
    protected $_auto = array ( 
        array('title','trim',3,'function'),
        array('author','trim',3,'function'),
        array('posttime','time',3,'function') , 
    );
 }
