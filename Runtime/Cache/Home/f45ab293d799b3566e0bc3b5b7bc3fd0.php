<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>购物车</title>
    <meta name="keywords" content="<?php echo C('WEB_KEYWORDS');?>">
    <meta name="description" content="<?php echo C('WEB_DESCRIPTION');?>">
    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/header.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/buttom.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/cart1.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/top.css">
    <link href="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
</head>

<body>
    <!--头部-->
    <section>
    <div class="top-bg clearfix" id="top">
        <div class="container clearfix">
            <div class="tel">
                <img src="/cateringcms/Public/home_tpl/images/tel.png" alt="">&nbsp;
                <span><?php echo C('WEB_NUM');?></span>
            </div>
            <?php if(empty($_SESSION['user'])): ?><!--登录注册个人中心-->
                <div class="login clearfix">
                    <ul>
                        <li><a target="blank" href="<?php echo U('User/login');?>">登录</a></li>
                        <li><a target="blank" href="<?php echo U('User/register');?>">注册</a></li>
                        <li><a target="style=" color:white; ""="blank" href="<?php echo U('Good/cart');?>">我的购物车</a></li>
                    </ul>
                </div>
                <?php else: ?>
                <div class="login clearfix">
                    <ul>
                        <li><a target="blank" href="<?php echo U('ClientCenter/index');?>"><?php echo ($_SESSION['user']['name']); ?></a></li>
                        <li><a target="blank" href="<?php echo U('User/Logout');?>">退出</a></li>
                        <li><a target="style=" color:white; ""="blank" href="<?php echo U('Good/cart');?>">我的购物车</a></li>
                    </ul>
                </div><?php endif; ?>
        </div>
    </div>
</section>
    <!--首页导航栏-->
    <section>
    <!--首页导航栏-->
    <div class="main-nav">
        <div class="container" class="clearfix">
            <div class="leading-row clearfix">
                <ul class="clearfix text-center">
                    <li><a href="<?php echo U('Index/index');?>">首页</a></li>
                    <li><a href="<?php echo U('Menu/show?flag=0');?>">菜肴展示</a></li>
                    <li><a href="<?php echo U('Menu/todayRec');?>">今日热荐</a></li>
                    <li><a href="<?php echo U('Menu/newSale');?>">新品上市</a></li>
                    <li><a href="<?php echo U('Page/chef');?>">厨师介绍</a></li>
                    <li><a target="blank" href="javascript:void(0)">关于我们</a>&nbsp;<span class="glyphicon glyphicon-triangle-bottom"></span>
                        <ul class="clearfix">
                            <?php if(is_array($navpage)): foreach($navpage as $key=>$p): ?><li><a href="<?php echo U('Page/index?id='.$p['id']);?>"><?php echo ($p["title"]); ?></a></li><?php endforeach; endif; ?>
                        </ul>

                    </li>
                    <li><a href="<?php echo U('Page/message');?>">站点留言</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

    <!--  -->
    <section>
        <div class="container clearfix">
            <div id="content">
                <table id="shopping">
                    <form action="" method="post" name="myform">
                        <tr>
                            <td class="title_1"><input id="allCheckBox" type="checkbox" value="" onclick="selectAll()" />全选</td>
                            <td class="title_2" colspan="2">美味宝贝</td>
                            <td class="title_3">获积分</td>
                            <td class="title_4">单价(元)</td>
                            <td class="title_5">数量</td>
                            <td class="title_6">小计(元)</td>
                            <td class="title_7">操作</td>
                        </tr>
                        <tr>
                            <td colspan="8" class="line"></td>
                        </tr>
                        <tr>

                            <?php if(is_array($cart)): foreach($cart as $k=>$data): ?><tr></tr>
                                <tr id="product<?php echo ($k+1); ?>" class="cartDiv">
                                    <td class="cart_td_1"><input name="cartCheckBox" type="checkbox" value="product<?php echo ($k+1); ?>" onclick="selectSingle()"
                                        /><input type="hidden" name="cart_id" value="<?php echo ($data["id"]); ?>"></td>
                                    <td class="cart_td_2"><img src="<?php echo ($data["img"]); ?>" alt="shopping" width="64px" height="64px" /></td>
                                    <td class="cart_td_3"><a href="#"><?php echo ($data["name"]); ?></a></td>
                                    <td class="cart_td_4"></td>
                                    <td class="cart_td_5"><?php echo ($data["price"]); ?></td>
                                    <td class="cart_td_6"><img src="/cateringcms/Public/home_tpl/images/shangpinxiangqing/jian.png" alt="minus" onclick="changeNum('<?php echo ($data["id"]); ?>','num_<?php echo ($k+1); ?>','minus')"
                                            class="hand" /><input id="num_<?php echo ($k+1); ?>" type="text" value="<?php echo ($data["num"]); ?>" class="num_input"
                                            readonly="readonly" /><img src="/cateringcms/Public/home_tpl/images/shangpinxiangqing/jia.png" alt="add"
                                            onclick="changeNum('<?php echo ($data["id"]); ?>','num_<?php echo ($k+1); ?>','add')" class="hand" /></td>
                                    <td class="cart_td_7"></td>
                                    <td class="cart_td_8"><a href="javascript:deleteRow('<?php echo ($data["id"]); ?>','product<?php echo ($k+1); ?>');">删除</a></td>
                                </tr><?php endforeach; endif; ?>
                            <tr class="tr-1">
                                <td colspan="3">
                                    <a class="btn btn-danger" href="javascript:deleteSelectRow()">删除</a>
                                </td>
                                <td colspan="5" class="shopend">商品总价（不含运费）：<label id="total" class="yellow"></label> 元<br /> 可获积分 <label class="yellow" id="integral"></label>                                    点<br />
                                    <a class="btn btn-primary" href="<?php echo U('Good/order?action='.$action.'&token='.$token);?>">提交订单</a>
                                    <a class="btn btn-danger" href="javascript:clearCart()">清空购物车</a>
                                </td>
                            </tr>
                    </form>
                </table>
            </div>
        </div>
    </section>

    <!--底部区-->
    <!-- 底部区 -->
<section class="footer">
    <div class="container">
        <div class="foot-logo-area clearfix">
            <div class="clearfix"><img class="foot-logo" src="/cateringcms/Public/home_tpl/images/foot-logo.png" alt=""></div>
            <div class="clearfix">
                <ul>
                    <li class="text-center"><a href=""><span>多</span>份量多,菜品全</a></li>
                    <li><a href=""><span>快</span>做的快,上菜快</a></li>
                    <li><a href=""><span>好</span>环境好,服务好</a></li>
                </ul>
            </div class="clearfix">
            <div class="pr-m">
                <img src="/cateringcms/Public/home_tpl/images/pr-m.png" alt="">
            </div>
        </div>
        <ul class="about clearfix">
            <?php if(is_array($weblink)): foreach($weblink as $key=>$v): ?><li><a href="//<?php echo ($v["linkurl"]); ?>" taget="_blank"><?php echo ($v["webname"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
        <div class="Copyright text-center">
            <p><?php echo C('COPYRIGHT_INFO');?></p>
            <p><?php echo C('WEB_ICP_NUMBER');?></p>
        </div>
    </div>
</section>
    <!--返回顶部按钮-->
    <a id="gotop" href="JavaScript:void(0)" class="text-center"><img src="/cateringcms/Public/home_tpl/images/returntop.png" alt=""></a>
    <script src="/cateringcms/Public/home_tpl/js/jquery.min.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/bootstrap.min.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/top.js"></script>
    <script src="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        var inc_num_url = "<?php echo U('Cart/incNum');?>";
        var dec_num_url = "<?php echo U('Cart/decNum');?>";
        var del_item_url = "<?php echo U('Cart/delItem');?>";
        var clear_cart_url = "<?php echo U('Cart/clearCart');?>";
    </script>
    <script src="/cateringcms/Public/home_tpl/js/cart.js"></script>

</body>

</html>