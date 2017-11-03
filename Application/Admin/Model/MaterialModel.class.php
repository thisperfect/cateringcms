<?php
/*
 * @Author: W.NK 
 * @Date: 2017-05-18 09:14:11 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-05-28 09:57:59
 * Material自动验证、自动完成
 */
namespace Material\Model;
use Think\Model;
class MaterialModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('title','require','食材类别不能为空'),
        array('title','','该食材类别已经被占用',0,'unique',self::MODEL_INSERT),
        array('keyword','require','关键词不能为空'),
        array('description','require','描述不能为空')
    );
    // 自动完成规则
    protected $_auto = array ( 
         array('title','trim',3,'function'), 
        array('keyword','trim',3,'function'),
        array('description','trim',3,'function'),
    );
}
