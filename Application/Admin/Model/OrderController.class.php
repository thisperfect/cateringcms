<?php
/*
 * @Author: W.NK 
 * @Date: 2017-06-02 22:27:40 
 * @Last Modified by: W.NK
 * @Last Modified time: 2017-06-03 09:53:16
 * 订单操作验证
 */
namespace Admin\Model;
use Think\Model;
class OrderModel extends Model{
    // 自动验证规则
    protected $patchValidate = true; 
    protected $_validate = array(
        array('shopping_name','require','收货人不能为空'),
        array('shopping_tel','require','收货人电话不能为空'),
        array('shopping_address','require','收货人地址不能为空'),
        array('total','require','金额不能为空'),
        array('pay_code','require','支付方式不能为空'),
        array('pay_code',array(0,1),'支付选项参数有误',2,'in') ,
        array('order_status_id','require','订单状态不能为空')               
    );
    // 自动完成规则
    protected $_auto = array ( 
        array('shopping_name','trim',3,'function'),
        array('shopping_tel','trim',3,'function'),
        array('shopping_address','trim',3,'function'),
    );
}