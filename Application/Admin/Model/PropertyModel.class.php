<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-20 14:20:27 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-05-28 09:58:09
 * Property 自动验证 自动完成
 */
namespace Admin\Model;
use Think\Model;
class PropertyModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('name','require','规则不能为空'),
        array('name','','该规则已经被占用',0,'unique',self::MODEL_INSERT),
        array('keyword','require','关键词描述不能为空'),
        array('description','require','描述不能为空')
    );
    // 自动完成规则
    protected $_auto = array ( 
        array('name','trim',3,'function'),
        array('keyword','trim',3,'function'),
        array('description','trim',3,'function'),
    );
}
 
