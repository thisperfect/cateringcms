<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>美食杰</title>
    <meta name="keywords" content="<?php echo C('WEB_KEYWORDS');?>">
    <meta name="description" content="<?php echo C('WEB_DESCRIPTION');?>">
    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/index.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/buttom.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/top.css">
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
    <section class="search">
        <div class="container">
            <div class="logo">
                <img class="" src="/cateringcms/Public/home_tpl/images/top-logo.png">
            </div>
            <form method="get" action="<?php echo U('Menu/search');?>" id="searchM">
                <div class="find-area">
                    <div class="find-area center-block clearfix">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control input-lg" placeholder="请输入关键词"><span class="input-group-addon btn btn-warning"
                                id="search">搜索</span>
                        </div>
                    </div>
                </div>
            </form>
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
    <section>
        <!-- 菜品大图轮播 -->
        <div id="carousel-example-generic" class="carousel slide banner1 clearfix" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php if(is_array($bigPic)): foreach($bigPic as $k=>$bp): ?><div class="item <?php if(($k) == "0"): ?>active<?php endif; ?>">
                        <a href="<?php echo U('Menu/detail?mid='.$bp[id]);?>"><img src="<?php echo ((isset($bp["picurl"]) && ($bp["picurl"] !== ""))?($bp["picurl"]):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($bp["name"]); ?>"></a>
                        <div class="carousel-caption">
                            <h3><?php echo ($bp["name"]); ?></h3>
                            <p><?php echo ($bp["description"]); ?></p>
                        </div>
                    </div><?php endforeach; endif; ?>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <section>
        <div class="bg2">
            <div class="container clearfix">
                <div class="banner2 clearfix">
                    <!--侧边菜单栏-->
                    <div class="banner2-left">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?php if(is_array($navAll)): foreach($navAll as $key=>$nav): ?><div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading<?php echo ($key); ?>">
                                        <h4 class="panel-title">
                                            <?php if(($key) == "0"): ?><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($key); ?>"
                                                    aria-expanded="true" aria-controls="collapse<?php echo ($key); ?>">热卖<?php echo ($nav["title"]); ?>&nbsp;<span class="glyphicon glyphicon-menu-down"></span></a>
                                                <?php else: ?><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapse<?php echo ($key); ?>" aria-expanded="false" aria-controls="collapse<?php echo ($key); ?>">热卖<?php echo ($nav["title"]); ?>&nbsp;<span class="glyphicon glyphicon-menu-down"></span></a><?php endif; ?>
                                        </h4>
                                    </div>
                                    <div id="collapse<?php echo ($key); ?>" <?php if(($key) == "0"): ?>class="panel-collapse collapse in"
                                        <?php else: ?>class="panel-collapse collapse"<?php endif; ?> role="tabpanel" aria-labelledby="heading<?php echo ($key); ?>">
                                        <div class="panel-body">
                                            <ul>
                                                <?php if(is_array($nav['nav'])): foreach($nav['nav'] as $nvk=>$nv): ?><li <?php if($nvk > 5): ?>class="list-up-(<?php echo ($nvk); ?>-4)"<?php endif; ?> ><a href="<?php echo U('Menu/detail?mid='.$nv[id]);?>"><span class="glyphicon glyphicon-triangle-right"></span><?php echo ($nv["name"]); ?></a></li><?php endforeach; endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div><?php endforeach; endif; ?>
                        </div>
                    </div>
                    <!-- 每日热荐小轮播 -->
                    <div class="banner2-right">
                        <div class="banner2-right-bg">
                            <img class="center-block" src="/cateringcms/Public/home_tpl/images/banner2-left-text.png" alt="">
                        </div>
                        <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="carousel-caption-left">
                                        <a href="<?php echo U('Menu/detail?mid='.$pic1[0][id]);?>"><img src="<?php echo ((isset($pic1['0']['picurl']) && ($pic1['0']['picurl'] !== ""))?($pic1['0']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic1['0']['name']); ?>"></a>
                                        <a href="<?php echo U('Menu/detail?mid='.$pic1[0][id]);?>">
                                            <div class="bg-up1">
                                                <h2><?php echo ($pic1['0']['name']); ?></h2>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="carousel-caption-right clearfix">
                                        <div class="clearfix">
                                            <a href="<?php echo U('Menu/detail?mid='.$pic1[1][id]);?>"><img src="<?php echo ((isset($pic1['1']['picurl']) && ($pic1['1']['picurl'] !== ""))?($pic1['1']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic1['1']['name']); ?>"></a>
                                            <a href="<?php echo U('Menu/detail?mid='.$pic1[1][id]);?>">
                                                <div class="bg-up2">
                                                    <h3><?php echo ($pic1['1']['name']); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="clearfix">
                                            <a href="<?php echo U('Menu/detail?mid='.$pic1[2][id]);?>"><img src="<?php echo ((isset($pic1['2']['picurl']) && ($pic1['2']['picurl'] !== ""))?($pic1['2']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic1['2']['name']); ?>"></a>
                                            <a href="<?php echo U('Menu/detail?mid='.$pic1[2][id]);?>">
                                                <div class="bg-up3">
                                                    <h3><?php echo ($pic1['2']['name']); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carousel-caption-left">
                                        <a href="<?php echo U('Menu/detail?mid='.$pic2[0][id]);?>"><img src="<?php echo ((isset($pic2['0']['picurl']) && ($pic2['0']['picurl'] !== ""))?($pic2['0']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic2['0']['name']); ?>"></a>
                                        <a href="<?php echo U('Menu/detail?mid='.$pic2[0][id]);?>">
                                            <div class="bg-up1">
                                                <h2><?php echo ($pic2['0']['name']); ?></h2>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="carousel-caption-right clearfix">
                                        <div class="clearfix">
                                            <a href="<?php echo U('Menu/detail?mid='.$pic2[1][id]);?>"><img src="<?php echo ((isset($pic2['1']['picurl']) && ($pic2['1']['picurl'] !== ""))?($pic2['1']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic2['1']['name']); ?>"></a>
                                            <a href="<?php echo U('Menu/detail?mid='.$pic2[1][id]);?>">
                                                <div class="bg-up2">
                                                    <h3><?php echo ($pic2['1']['name']); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="clearfix">
                                            <a href="<?php echo U('Menu/detail?mid='.$pic2[2][id]);?>"><img src="<?php echo ((isset($pic2['2']['picurl']) && ($pic2['2']['picurl'] !== ""))?($pic2['2']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic2['2']['name']); ?>"></a>
                                            <a href="<?php echo U('Menu/detail?mid='.$pic2[2][id]);?>">
                                                <div class="bg-up3">
                                                    <h3><?php echo ($pic2['2']['name']); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="carousel-caption-left">
                                        <a href="<?php echo U('Menu/detail?mid='.$pic3[0][id]);?>"><img src="<?php echo ((isset($pic3['0']['picurl']) && ($pic3['0']['picurl'] !== ""))?($pic3['0']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic3['0']['name']); ?>"></a>
                                        <a href="<?php echo U('Menu/detail?mid='.$pic3[0][id]);?>">
                                            <div class="bg-up1">
                                                <h2><?php echo ($pic3['0']['name']); ?></h2>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="carousel-caption-right clearfix">
                                        <div class="clearfix">
                                            <a href="<?php echo U('Menu/detail?mid='.$pic3[1][id]);?>"><img src="<?php echo ((isset($pic3['1']['picurl']) && ($pic3['1']['picurl'] !== ""))?($pic3['1']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic3['1']['name']); ?>"></a>
                                            <a href="<?php echo U('Menu/detail?mid='.$pic3[1][id]);?>">
                                                <div class="bg-up2">
                                                    <h3><?php echo ($pic3['1']['name']); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="clearfix">
                                            <a href="<?php echo U('Menu/detail?mid='.$pic3[2][id]);?>"><img src="<?php echo ((isset($pic3['2']['picurl']) && ($pic3['2']['picurl'] !== ""))?($pic3['2']['picurl']):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt="<?php echo ($pic3['2']['name']); ?>"></a>
                                            <a href="<?php echo U('Menu/detail?mid='.$pic3[2][id]);?>">
                                                <div class="bg-up3">
                                                    <h3><?php echo ($pic3['2']['name']); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                                <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--展示区 -->
            <section>
                <div class="display-area">
                    <div class="container">
                        <div class="display-area-list">
                            <!--全部菜品轮播-->
                            <div class="display-area-list-top">
                                <h3>全部菜品</h3><span><a href="<?php echo U('Menu/index');?>">更多>></a></span></div>
                            <div class="display-area-food">
                                <div id="carousel-example-generid" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <ul class="clearfix">
                                                <?php if(is_array($menuAll1)): foreach($menuAll1 as $key=>$vo): ?><li>
                                                        <a href="<?php echo U('Menu/detail?mid='.$vo[id]);?>"><img src="<?php echo ((isset($vo["picurl"]) && ($vo["picurl"] !== ""))?($vo["picurl"]):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt=""></a>
                                                        <h3><?php echo ($vo["name"]); ?></h3>
                                                    </li><?php endforeach; endif; ?>
                                            </ul>
                                        </div>
                                        <div class="item">
                                            <ul class="clearfix">
                                                <?php if(is_array($menuAll2)): foreach($menuAll2 as $key=>$vo2): ?><li>
                                                        <a href="<?php echo U('Menu/detail?mid='.$vo2[id]);?>"><img src="<?php echo ((isset($vo2["picurl"]) && ($vo2["picurl"] !== ""))?($vo2["picurl"]):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt=""></a>
                                                        <h3><?php echo ($vo["name"]); ?></h3>
                                                    </li><?php endforeach; endif; ?>
                                            </ul>
                                        </div>
                                        <div class="item">
                                            <ul class="clearfix">
                                                <?php if(is_array($menuAll3)): foreach($menuAll3 as $key=>$vo3): ?><li>
                                                        <a href="<?php echo U('Menu/detail?mid='.$vo3[id]);?>"><img src="<?php echo ((isset($vo3["picurl"]) && ($vo3["picurl"] !== ""))?($vo3["picurl"]):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt=""></a>
                                                        <h3><?php echo ($vo["name"]); ?></h3>
                                                    </li><?php endforeach; endif; ?>
                                            </ul>
                                        </div>

                                    </div>

                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-example-generid" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                    <a class="right carousel-control" href="#carousel-example-generid" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                </div>
                            </div>
                            <!--特价菜品-->
                            <div class="display-area-list-top">
                                <h3>今日特价</h3><span><a href="<?php echo U('Menu/index');?>">更多>></a></span></div>
                            <div class="display-area-food">
                                <ul class="clearfix">
                                    <?php if(is_array($discount)): foreach($discount as $key=>$dv): ?><li>
                                            <a href="<?php echo U('Menu/detail?mid='.$dv[id]);?>"><img src="<?php echo ((isset($dv["picurl"]) && ($dv["picurl"] !== ""))?($dv["picurl"]):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt=""></a>
                                            <h3><?php echo ($dv["name"]); ?></h3>
                                        </li><?php endforeach; endif; ?>
                                </ul>
                            </div>
                            <!--季节菜品-->
                            <div class="display-area-list-top">
                                <h3>好时令</h3><span><a href="<?php echo U('Menu/index');?>">更多>></a></span></div>
                            <div class="display-area-food">
                                <ul class="clearfix">
                                    <?php if(is_array($weather)): foreach($weather as $key=>$wv): ?><li>
                                            <a href="<?php echo U('Menu/detail?mid='.$wv[id]);?>"><img src="<?php echo ((isset($wv["picurl"]) && ($wv["picurl"] !== ""))?($wv["picurl"]):'/cateringcms/Public/home_tpl/images/noimg.jpg'); ?>" alt=""></a>
                                            <h3><?php echo ($wv["name"]); ?></h3>
                                        </li><?php endforeach; endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
    <script>
        $(document).ready(function () {
            $('#carousel-example-generic').carousel({
                interval: 3000
            });
            $('#search').click(function () {
                $('#searchM').submit();
            });
        });
    </script>
</body>

</html>