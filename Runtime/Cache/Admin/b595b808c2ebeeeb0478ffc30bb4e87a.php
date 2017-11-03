<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>主页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">
    <link href="/cateringcms/Public/admin_tpl/css/bootstrap.min-v=3.3.6.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/font-awesome.min-v=4.4.0.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/animate.min.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/style.min-v=4.1.0.css" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航-->
        <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><img alt="image" class="img-circle" height="60" width="60" src="/cateringcms/Public/admin_tpl/img/admin.png" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?php echo ($name); ?></strong></span>
                        <span class="text-muted text-xs block">个人中心<b class="caret"></b></span><?php echo ($group); ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <!--<li><a class="J_menuItem" href="#">修改头像</a>
                        </li>-->
                        <li><a class="J_menuItem" href="<?php echo U('Public/edit_info');?>">个人资料</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo U('Login/logout');?>">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">A
                </div>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="nav-label">用户管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Admin/index');?>">管理员管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('User/index');?>">会员管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span class="nav-label">网站管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Config/index');?>">网站信息配置</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Upload/index');?>">上传图片管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-tasks"></i>
                    <span class="nav-label">内容管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">
                            <span class="nav-label">菜品类别管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="<?php echo U('Category/index');?>">菜谱类别管理</a></li>
                            <li><a class="J_menuItem" href="<?php echo U('Material/index');?>">食材类别管理</a></li>
                            <li><a class="J_menuItem" href="<?php echo U('Property/index');?>">菜品属性管理</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="nav-label">口味份量管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <li><a class="J_menuItem" href="<?php echo U('Taste/index');?>">口味管理</a></li>
                            <li><a class="J_menuItem" href="<?php echo U('Weight/index');?>">份量管理</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Menu/index');?>">菜品列表管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Chef/index');?>">厨师信息管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Page/index');?>">网站单页信息管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span class="nav-label">订单管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">
                            <span class="nav-label">订单管理</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-third-level">
                            <?php if(is_array($o_status)): foreach($o_status as $key=>$o_status_v): ?><li><a class="J_menuItem" href="<?php echo U('Order/index?status_id='.$o_status_v['id']);?>"><?php echo ($o_status_v["name"]); ?>订单</a></li><?php endforeach; endif; ?>
                        </ul>
                    </li>
                    <!--<li>
                        <a class="J_menuItem" href="<?php echo U('Check/index');?>">账单统计</a>
                    </li>-->
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span class="nav-label">其他模块</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Collect/index');?>">用户收藏</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Comment/index');?>">评论管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Message/index');?>">留言板管理</a>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo U('Weblink/index');?>">友情链接模块</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="J_menuItem" href="help.html"><i class="fa fa-info-circle"></i> <span class="nav-label">帮助文档</span></a>
            </li>
        </ul>
    </div>
</nav>
        <!--页面内容主容器-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <!--顶部菜单-->
            <div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="hidden-xs">
            <a href="<?php echo U('Home/Index/index');?>" data-index="0"><i class="fa fa-desktop"></i> 查看前台</a>
            </li>
        </ul>
    </nav>
</div>
            <!--内容区-->
            <div class="row content-tabs">
    <!-- 导航 begin -->
    <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
    </button>
    <nav class="page-tabs J_menuTabs">
        <div class="page-tabs-content">
            <a href="javascript:void(0)" class="active J_menuTab" data-id="<?php echo U('Index/home');?>">首页</a>
        </div>
    </nav>
    <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
    </button>
    <!-- 导航 end -->
    <!-- 关闭操作下拉菜单 begin -->
    <div class="btn-group roll-nav roll-right">
        <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span></button>
        <ul role="menu" class="dropdown-menu dropdown-menu-right">
            <li class="J_tabShowActive"><a>定位当前选项卡</a>
            </li>
            <li class="divider"></li>
            <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
            </li>
            <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
            </li>
        </ul>
    </div> 
    <!-- 关闭操作下拉菜单 end -->
    <a href="<?php echo U('Login/logout');?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
</div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('Index/home');?>" frameborder="0" data-id="<?php echo U('Index/home');?>" seamless></iframe>
            </div>
            <!--页脚-->
            <div class="footer">
    <div class="pull-right">
        &copy; 2017 <a href="" target="_blank">IMYYL</a>
    </div>
</div>
        </div>
    </div>
    <script src="/cateringcms/Public/admin_tpl/js/jquery.min-v=2.1.4.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/bootstrap.min-v=3.3.6.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/layer/layer.min.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/hplus.min-v=4.1.0.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/contabs.min.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/pace/pace.min.js"></script>

</body>

</html>