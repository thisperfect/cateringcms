<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-18 09:14:11 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-05-28 09:57:59
 * Category自动验证、自动完成
 */
namespace Category\Model;
use Think\Model;
class CategoryModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('name','require','菜谱类别不能为空'),
        array('name','','该菜谱类别已经被占用',0,'unique',self::MODEL_INSERT),
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
