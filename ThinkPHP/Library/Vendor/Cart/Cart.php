<?php
namespace Vendor\Cart;

class Cart{
    public function Cart() {
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
    }
 
    /*
    添加商品
    param int $id 商品主键
    string $name 商品名称
    int $taste 商品口味
    int $weight 商品份量
    float $price 商品价格
    int $num 商品数量
    string $img 商品图片
    */
    public  function addItem($id,$name,$taste=0,$weight=0,$price,$num=1,$img) {
        //如果该商品已存在则直接加其数量
        if (isset($_SESSION['cart'][$id])) {
            $this->incNum($id,$num);
            return true;
        }
        $item = array();
        $item['id'] = $id;
        $item['name'] = $name;
        $item['taste'] = $taste;
        $item['weight'] = $weight;
        $item['price'] = $price;
        $item['num'] = $num;
        $item['img'] = $img;
        $_SESSION['cart'][$id] = $item;
        return true;
    }
 
    /*
    修改购物车中的商品数量
    int $id 商品主键
    int $num 某商品修改后的数量，即直接把某商品
    的数量改为$num
    */
    public function modNum($id,$num=1) {
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        }
        $_SESSION['cart'][$id]['num'] = $num;
        return true;
    }
 
    /*
    商品数量+1
    */
    public function incNum($id,$num=1) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['num'] += $num;
        }
        return true;
    }
 
    /*
    商品数量-1
    */
    public function decNum($id,$num=1) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['num'] -= $num;
        }
 
        //如果减少后，数量为0，则把这个商品删掉
        if ($_SESSION['cart'][$id]['num'] <1) {
            $this->delItem($id);
        }
        return true;
    }
 
    /*
    删除商品
    */
    public function delItem($id) {
        unset($_SESSION['cart'][$id]);
        return true;
    }
     
    /*
    获取单个商品
    */
    public function getItem($id) {
        return $_SESSION['cart'][$id];
    }
 
    /*
    查询购物车中商品的种类
    */
    public function getCnt() {
        return count($_SESSION['cart']);
    }
     
    /*
    查询购物车中商品的个数
    */
    public function getNum(){
        if ($this->getCnt() == 0) {
            //种数为0，个数也为0
            return 0;
        }
 
        $sum = 0;
        $data = $_SESSION['cart'];
        foreach ($data as $item) {
            $sum += $item['num'];
        }
        return $sum;
    }
 
    /*
    购物车中商品的总金额
    */
    public function getPrice() {
        //数量为0，价钱为0
        if ($this->getCnt() == 0) {
            return 0;
        }
        $price = 0.00;
        $data = $_SESSION['cart'];
        foreach ($data as $item) {
            $price += $item['num'] * $item['price'];
        }
        return sprintf("%01.2f", $price);
    }
 
    /*
    清空购物车
    */
    public function clear() {
        $_SESSION['cart'] = array();
        return true;
    }
}