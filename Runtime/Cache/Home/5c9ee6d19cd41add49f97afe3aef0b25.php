<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>登陆</title>
    <meta name="keywords" content="<?php echo C('WEB_KEYWORDS');?>">
    <meta name="description" content="<?php echo C('WEB_DESCRIPTION');?>">
    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/header.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/login.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/buttom.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/top.css">
    <link href="/cateringcms/Public/admin_tpl/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/validationEngine.jquery.css">


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
    <section>
        <div class="welcome">
            <div class="container clearfix">

                <div class="welcomelanding">
                    <div class="welcomelanding-padding center-block">
                        <h3>欢迎登陆</h3>
                        <hr>
                        <form class="center-block" action="?" method="post" id="loginForm">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control validate[required]" name="uname" id="uname" placeholder="请输入账号">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control validate[required]" name="password" id="password" placeholder="请输入密码">
                            </div>
                            <button class="btn btn-primary btn-block center-block" type="submit">登 陆</button>
                        </form>
                        <hr>
                        <div align="right"><a href="#forgetPassModal" data-toggle="modal" data-target="#forgetPassModal">忘记密码？</a></div>
                    </div>
                </div>
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
    <div id="forgetPassModal" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>输入您注册的电子邮箱，找回密码：</h5>
                        </div>
                        <div class="ibox-content">
                            <form role="form" action="<?php echo U('User/forgetPass');?>" method="post" id="findPass">
                                <div class="form-group">
                                    <label class="control-label">邮箱：</label>
                                    <input type="email" id="email" name="email" class="form-control validate[required,custom[email]]" placeholder="请输入邮箱">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">点击刷新：</label>
                                    <img id="verifyimg" src="<?php echo U('User/showVerify');?>" width="150px" height="60px">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">验证码：</label>
                                    <input type="text" id="verify" name="verify" class="form-control validate[required]" placeholder="请输入验证码">
                                </div>
                                <div class="form-group">
                                    <label class="control-label"></label>
                                    <button type="submit" class="btn btn-sm btn-primary pull-right m-t-n-xs">提交</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--返回顶部按钮-->
    <a id="gotop" href="JavaScript:void(0)" class="text-center"><img src="/cateringcms/Public/home_tpl/images/returntop.png" alt=""></a>
    <script src="/cateringcms/Public/home_tpl/js/jquery.min.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/bootstrap.min.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/top.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/jquery.validationEngine-zh_CN.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/jquery.validationEngine.js"></script>
    <script>
        $(document).ready(function () {
            $("#verifyimg").click(function () {
                var verifyURL = "<?php echo U('User/showVerify', '', '');?>";
                var time = new Date().getTime();
                $(this).attr({
                    "src": verifyURL + "/" + time
                });
            });
            $('#loginForm').validationEngine('attach', {
                promptPosition: 'centerRight: -50, -10',
            });
            $('#findPass').validationEngine('attach', {
                promptPosition: 'centerRight: -50, -10',
            });

        });
    </script>
</body>

</html>