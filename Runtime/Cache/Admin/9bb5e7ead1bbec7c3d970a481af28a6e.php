<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>网站信息管理</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="">
    <link href="/cateringcms/Public/admin_tpl/css/bootstrap.min-v=3.3.6.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/font-awesome.min-v=4.4.0.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/animate.min.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/style.min-v=4.1.0.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_custom/plugins/dropify/css/dropify.min.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>网站信息管理</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>基本信息</h3>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" method="post" action="<?php echo U('Config/index');?>">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">网站基本信息</a>
                                    </li>
                                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">邮件服务器</a>
                                    </li>
                                    <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">支付信息</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- 网站基本信息 begin -->
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">网站名称：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="WEB_NAME" name="WEB_NAME" value="<?php echo ($data["WEB_NAME"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">站点图标：</label>
                                                <div class="col-sm-8">
                                                    <?php if(!empty($data["WEB_FAVICON"])): ?><div id="f_div">
                                                            <img src="<?php echo ($data["WEB_FAVICON"]); ?>" alt="站点图标" width="64" height="64">
                                                        </div>
                                                        <div id="f_hr" class="hr-line-dashed"></div><?php endif; ?>
                                                    <input type="file" id="favicon" class="dropify" data-height="150" data-allowed-file-extensions="ico png jpg" data-max-file-size="2M" onchange="pic_upload('favicon','WEB_FAVICON');" />
                                                </div>
                                                <input type="hidden" class="form-control" id="WEB_FAVICON" name="WEB_FAVICON" value="<?php echo ($data["WEB_FAVICON"]); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">网站地址：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="WEB_URL" name="WEB_URL" value="<?php echo ($data["WEB_URL"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">网站作者：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="WEB_AUTHOR" name="WEB_AUTHOR" value="<?php echo ($data["WEB_AUTHOR"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">网站联系电话：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="WEB_NUM" name="WEB_NUM" value="<?php echo ($data["WEB_NUM"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">关键词设定：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="WEB_KEYWORDS" name="WEB_KEYWORDS" value="<?php echo ($data["WEB_KEYWORDS"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">网站描述：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="WEB_DESCRIPTION" name="WEB_DESCRIPTION" value="<?php echo ($data["WEB_DESCRIPTION"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">版权信息：</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" id="COPYRIGHT_INFO" name="COPYRIGHT_INFO"><?php echo ($data["COPYRIGHT_INFO"]); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">备案号：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="WEB_ICP_NUMBER" name="WEB_ICP_NUMBER" value="<?php echo ($data["WEB_ICP_NUMBER"]); ?>">
                                                </div>
                                            </div>
                                            <div class=" form-group">
                                                <label class="col-sm-3 control-label">启用站点：</label>
                                                <div class="col-sm-8">
                                                    <label class="radio-inline i-checks"><input type="radio" value="1" id="WEB_STATUS1" name="WEB_STATUS" <?php if(($data["WEB_STATUS"]) == "1"): ?>checked<?php endif; ?>>是</label>
                                                    <label class="radio-inline i-checks"><input type="radio" value="0" id="WEB_STATUS2" name="WEB_STATUS" <?php if(($data["WEB_STATUS"]) == "0"): ?>checked<?php endif; ?>>否</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">站点关闭说明：</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" id="WEB_CLOSE_WORD" name="WEB_CLOSE_WORD"><?php echo ($data["WEB_CLOSE_WORD"]); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-3">
                                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 网站基本信息 end -->

                                    <!-- 邮件服务器 begin -->
                                    <div id="tab-2" class="tab-pane">
                                        <div class="panel-body">

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">邮箱服务器：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="MAIL_HOST" name="MAIL_HOST" value="<?php echo ($data["MAIL_HOST"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">发件端口：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="MAIL_PORT" name="MAIL_PORT" value="<?php echo ($data["MAIL_PORT"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">用户名：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="MAIL_USERNAME" name="MAIL_USERNAME" value="<?php echo ($data["MAIL_USERNAME"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">密码：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="MAIL_PASSWORD" name="MAIL_PASSWORD" value="<?php echo ($data["MAIL_PASSWORD"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">发件名：</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="MAIL_FROMNAME" name="MAIL_FROMNAME" value="<?php echo ($data["MAIL_FROMNAME"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-3">
                                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <!-- 邮件服务器 end -->
                                      
                                    <!-- 支付信息 begin -->
                                    <div id="tab-3" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">支付宝付款码：</label>
                                                <div class="col-sm-8">
                                                    <?php if(!empty($data["ALI_PAY"])): ?><div id="a_div">
                                                            <img src="<?php echo ($data["ALI_PAY"]); ?>" alt="支付宝付款码" width="64" height="64">
                                                        </div>
                                                        <div id="a_hr" class="hr-line-dashed"></div><?php endif; ?>
                                                    <input type="file" id="alipay" class="dropify" data-max-file-size="2M" onchange="pic_upload('alipay','ALI_PAY');" />
                                                    <input type="hidden" class="form-control" id="ALI_PAY" name="ALI_PAY" value="<?php echo ($data["ALI_PAY"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">微信付款码：</label>
                                                <div class="col-sm-8">
                                                    <?php if(!empty($data["WE_PAY"])): ?><div id="w_div">
                                                            <img src="<?php echo ($data["WE_PAY"]); ?>" alt="微信付款码" width="64" height="64">
                                                        </div>
                                                        <div id="w_hr" class="hr-line-dashed"></div><?php endif; ?>
                                                    <input type="file" id="wepay" class="dropify" data-max-file-size="2M" onchange="pic_upload('wepay','WE_PAY');" />
                                                    <input type="hidden" class="form-control" id="WE_PAY" name="WE_PAY" value="<?php echo ($data["WE_PAY"]); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-3">
                                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 支付信息 end -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script src="/cateringcms/Public/admin_tpl/js/jquery.min-v=2.1.4.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/bootstrap.min-v=3.3.6.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/validate/messages_zh.min.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/cateringcms/Public/admin_custom/plugins/dropify/js/dropify.min.js"></script>
    <script>
        var uploadUrl = "<?php echo U('Upload/upload_file');?>";
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': '点击或拖拽图片到这里',
                    'replace': '点击或拖拽图片到这里来替换图片',
                    'remove': '移除',
                    'error': '对不起，你上传的图片太大了'
                }
            });
            $(".i-checks").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green",
            });
            $("input#favicon").click(function() {
                $("div#f_div,div#f_hr").remove();
            });
            $("input#wepay").click(function() {
                $("div#w_div,div#w_hr").remove();
            });
            $("input#alipay").click(function() {
                $("div#a_div,div#a_hr").remove();
            });
        });
    </script>
    <script src="/cateringcms/Public/admin_custom/plugins/dropify/upload.js"></script>
</body>

</html>