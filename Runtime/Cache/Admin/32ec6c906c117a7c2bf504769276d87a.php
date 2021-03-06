<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>管理员登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">
    <link href="/cateringcms/Public/admin_tpl/css/bootstrap.min-v=3.3.6.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/font-awesome.min-v=4.4.0.css" rel="stylesheet">

    <link href="/cateringcms/Public/admin_tpl/css/animate.min.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/style.min-v=4.1.0.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated rotateIn">
        <div>
            <div>
                <h1 class="logo-name">A</h1>
            </div>
            <h3>管理员登录</h3>
            <form class="m-t" role="form" action="<?php echo U('Login/loginchk');?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="adminname" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="密码" required="">
                </div>
                <button class="btn btn-primary block full-width m-b" id="submitBtn">登 录</button>
            </form>
            <a data-toggle="modal" href="#modal-form">忘记密码？</a>
            <br/>
            <a href="<?php echo U('Home/Index/index');?>"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;返回首页</a>
        </div>
    </div>
    <div id="modal-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">找回密码</h3>
                            <p><strong>输入您注册的电子邮箱，找回密码：</strong></p>
                            <form role="form" action="<?php echo U('ResetPass/index');?>" method="post">
                                <div class="form-group">
                                    <label class="control-label">邮箱：</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">点击刷新：</label>
                                    <img id="verifyimg" src="<?php echo U('Login/showVerify');?>" width="150px" height="60px">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">验证码：</label>
                                    <input type="text" id="verify" name="verify" class="form-control">
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" id="sub_btn"><strong>提交</strong>
                                </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/cateringcms/Public/admin_tpl/js/jquery.min-v=2.1.4.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/bootstrap.min-v=3.3.6.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sub_btn").click(function() {
                var email = $("#email").val();
                var verify = $("#verify").val();
                var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email
                if (email == '' || !preg.test(email) || verify == '') {
                    swal("错误", "请核实所填写的信息！", "error");
                    return false
                } else {
                    return true;
                }
            });
            $("#verifyimg").click(function() {
                var verifyURL = "<?php echo U('Login/showVerify', '', '');?>";
                var time = new Date().getTime();
                $(this).attr({
                    "src": verifyURL + "/" + time
                });
            });
        });
    </script>
</body>

</html>