<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-20 14:20:27 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-05-20 15:52:33
 * Admin_group 自动验证 自动完成
 */
namespace Admin\Model;
use Think\Model;
class AdminGroupModel extends Model{
    protected $tableName = 'admin_group'; 
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('title','require','管理组名不能为空'),
        array('title','','该管理组名已经被占用',0,'unique',self::MODEL_INSERT),
        array('status','require','启用状态不能为空'),
        array('status',array(0,1),'启用状态参数不正确！',2,'in'),
        array('rules','require','请至少选择一项权限'),
    );
    // 自动完成规则
    protected $_auto = array ( 
         array('title','trim',3,'function')
    );
}
 
