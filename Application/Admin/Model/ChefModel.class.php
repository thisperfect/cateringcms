<?php
namespace Admin\Model;
use Think\Model;
class ChefModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('name','require','厨师姓名不能为空'),
        array('picurl','require','厨师图片不能为空'),
        array('keyword','require','厨师关键词描述不能为空'),
        array('description','require','厨师描述不能为空'),
        array('content','require','详细介绍不能为空'),
        array('checkinfo','require','审核不能为空'),
        array('checkinfo',array(0,1),'选项参数有误',2,'in')
    );
    // 自动完成规则
    protected $_auto = array ( 
        array('name','trim',3,'function'),
        array('keyword','trim',3,'function'),
        array('description','trim',3,'function'), 
        array('content','trim',3,'function')
    );
}
