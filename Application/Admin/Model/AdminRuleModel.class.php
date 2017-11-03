<?php
namespace Admin\Model;
use Think\Model;
class AdminRuleModel extends Model{
    protected $tableName = 'admin_rule'; 
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('title','require','规则名不能为空'),
        array('name','require','规则不能为空'),
        array('name','','该规则已经被占用',0,'unique',self::MODEL_INSERT),
        array('type',array(0,1),'附加规则选项参数错误！',2,'in'),
        array('status',array(0,1),'状态选项参数错误！',2,'in')
    );
    // 自动完成规则
    protected $_auto = array ( 
        array('title','trim',3,'function'),  
        array('name','trim',3,'function')
    );
}
 
