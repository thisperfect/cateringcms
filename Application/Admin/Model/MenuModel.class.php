<?php
namespace Admin\Model;
use Think\Model;
class MenuModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('name','require','菜名不能为空'),
        array('name','','该菜名已经被占用',0,'unique',self::MODEL_INSERT),
        array('keyword','require','关键词不能为空'),
        array('description','require','描述不能为空'),
        array('property','require','属性不能为空'),
        array('category_id','require','菜品类别不能为空'),
        array('material_id','require','食材类别不能为空'),
        array('content','require','内容不能为空'),
        array('picurl','require','特色图片不能为空'),
        array('price','require','单价不能为空'),
        array('checkinfo','require','上架状态不能为空'),
        array('checkinfo',array(0,1),'选项参数有误',2,'in')
    );
    // 自动完成规则
    protected $_auto = array ( 
        array('name','trim',3,'function'),
        array('keyword','trim',3,'function'), 
        array('description','trim',3,'function'), 
        array('property','trim',3,'function'),
        array('content','trim',3,'function'), 
        array('price','trim',3,'function'), 
        array('posttime','time',3,'function') , 
    );
}