<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>文件管理</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">
    <link href="/cateringcms/Public/admin_tpl/css/bootstrap.min-v=3.3.6.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/font-awesome.min-v=4.4.0.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/animate.min.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/style.min-v=4.1.0.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/plugins/webuploader/webuploader.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_custom/plugins/webuploader/webuploader.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_custom/plugins/lightbox/css/jquery.lighter.css" rel="stylesheet" />
</head>

<body class="gray-bg">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>上传文件管理</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h3>文件上传管理</h3>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="fileManage">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>缩略图</th>
                            <th>图片大小</th>
                            <th>图片路径</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($file)): foreach($file as $key=>$file): ?><tr class="gradeA file">
                                <td><input type="checkbox" name="fid" value="<?php echo ($file["id"]); ?>">&nbsp;&nbsp;&nbsp;<?php echo ($file["id"]); ?></td>
                                <td>
                                    <a href="<?php echo ($url); echo ($file["path"]); ?>" data-lighter><img src="<?php echo ($url); echo ($file["path"]); ?>" alt="<?php echo ($file["name"]); ?>" width="32" height="32"></a>
                                </td>
                                <td><?php echo ($file["size"]); ?>&nbsp;KB</td>
                                <td><?php echo ($file["path"]); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">操作 <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="font-bold">预览</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0)" onclick="del_file('<?php echo ($file["id"]); ?>',<?php echo ($key); ?>)">删除</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr><?php endforeach; endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>缩略图</th>
                            <th>图片大小</th>
                            <th>图片路径</th>
                            <th>操作</th>
                        </tr>
                    </tfoot>
                </table>
                <a href="javascript:void(0)" class="btn btn-primary" onclick="select_all_file()">全选</a>
                <a href="javascript:void(0)" class="btn btn-primary" onclick="select_empty_file()">全不选</a>
                <a href="javascript:void(0)" class="btn btn-primary" onclick="select_reverse_file()">反选</a>
                <a href="javascript:void(0)" class="btn btn-danger" onclick="multi_del_file()">删除选定</a>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>文件上传</h5>
            </div>
            <div class="ibox-content">
                <div id="uploader">
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
            </div>
        </div>
    </div>
    <script src="/cateringcms/Public/admin_tpl/js/jquery.min-v=2.1.4.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/bootstrap.min-v=3.3.6.js"></script>

    <script src="/cateringcms/Public/admin_tpl/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/webuploader/webuploader.min.js"></script>
    <script src="/cateringcms/Public/admin_custom/plugins/lightbox/js/jquery.lighter.js"></script>

    <script>
        var uploadUrl = "<?php echo U('Upload/upload_file');?>";
        var del_file_url = "<?php echo U('Upload/del_file');?>"
        $(document).ready(function () {
            $(".dataTables-example").dataTable();
        });
    </script>
    <script src="/cateringcms/Public/admin_custom/plugins/webuploader/webuploader.js"></script>
    <script src="/cateringcms/Public/admin_custom/js/upload.js"></script>
</body>

</html>