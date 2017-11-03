<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="ch-zn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>今日热荐</title>
    <meta name="keywords" content="<?php echo C('WEB_KEYWORDS');?>">
    <meta name="description" content="<?php echo C('WEB_DESCRIPTION');?>">
    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">

    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/header.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/display.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/buttom.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/top.css">
    <link rel="stylesheet" href="/cateringcms/Public/admin_tpl/css/plugins/sweetalert/sweetalert.css">

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
    <section class="search">
        <div class="container">
            <!--购物车特效-->
            <div class="xbody-top clearfix">
                <div class="xbody-top-center">
                    <div class="xmenu">
                        <ul class="xmenu-ul">
                            <a href="<?php echo U('Good/cart');?>">
                                <li class="xmenu-li"><span class="xmenu-a"><span class="glyphicon glyphicon-shopping-cart"></span>(<span id="num"
                                        style="color: red;"><?php echo ($cartNum); ?></span>)</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="logo">
                <img class="" src="/cateringcms/Public/home_tpl/images/top-logo.png">
            </div>
            <!-- 搜索框 -->
            <form method="get" action="<?php echo U('Menu/search');?>" id="searchM">
                <div class="find-area center-block clearfix">
                    <div class="input-group">
                        <input type="text" class="form-control input-lg" placeholder="请输入关键词" name="keyword"><span class="input-group-addon btn btn-warning"
                            id="search">搜索</span>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <!-- 内容 -->
    <section>
        <div class="container">
            <div class="row">
                <?php if(is_array($list)): foreach($list as $key=>$menu): ?><div class="menu-1 col-md-3 col-sm-4 col-xs-6 text-center">
                        <img class="img-responsive" src="<?php echo ($menu["picurl"]); ?>" alt="">
                        <div class="caption">
                            <h4><?php echo ($menu["name"]); ?></h4>
                            <p>￥&nbsp;<span><?php echo ($menu["price"]); ?>.00</span></p>
                            <button class="btn btn-default"><a href="<?php echo U('Menu/detail?mid='.$menu[id]);?>">详情</a></button>
                            <button class="btn btn-danger carts" type="button" onclick="addCart('<?php echo ($menu["id"]); ?>','<?php echo ($menu["name"]); ?>','<?php echo ($menu["price"]); ?>','<?php echo ($menu["picurl"]); ?>')">加入购物车</button>
                        </div>
                    </div><?php endforeach; endif; ?>
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li><?php echo ($page); ?></li>
                </ul>
            </nav>
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
    <script src="/cateringcms/Public/home_tpl/js/jquery-addShopping.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/top.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#search').click(function () {
                $('#searchM').submit();
            });
            $('.carts').shoping({
                endElement: ".xmenu-a",
                iconCSS: "",
                iconImg: "/cateringcms/Public/home_tpl/images/cart.png",
                endFunction: function (element) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo U('Cart/getNum');?>",
                        data: {
                            'action': 'getNum'
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response['code'] = '1') {
                                $("#num").html(response['goodsNum']);
                                return false;
                            }
                        }
                    });
                }
            });
        });

        function addCart(id, name, price, img) {
            $.ajax({
                type: "post",
                url: "<?php echo U('Cart/addCart');?>",
                data: {
                    "id": id,
                    "name": name,
                    "price": price,
                    "img": img
                },
                dataType: "json",
                success: function (response) {
                    if (response['code'] == 1) {
                        swal('成功', '更多信息请查看购物车', 'success');
                    } else {
                        var str = "";
                        for (var i in response) {
                            str += response[i] + "\n";
                        }
                        swal("失败", str, "error");
                    }
                }
            });

        }
    </script>
</body>

</html>

</html>