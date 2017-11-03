<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>管理员管理</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">
    <link href="/cateringcms/Public/admin_tpl/css/bootstrap.min-v=3.3.6.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/font-awesome.min-v=4.4.0.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/animate.min.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/style.min-v=4.1.0.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/cateringcms/Public/admin_tpl/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>管理员管理</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="<?php echo U('Admin/admin_add');?>" class="btn btn-primary">添加管理员</a>
                <a href="<?php echo U('Admin/group');?>" class="btn btn-primary">管理组管理</a>
                <a href="<?php echo U('Admin/rule');?>" class="btn btn-primary">权限管理</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>管理员列表</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="adminmanage">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>管理员名称</th>
                                    <th>管理组</th>
                                    <th>登录时间/登陆IP</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($admin)): foreach($admin as $key=>$admin): ?><tr class="gradeA admin">
                                        <td><input type="checkbox" name="aid" value="<?php echo ($admin["id"]); ?>">&nbsp;&nbsp;&nbsp;<?php echo ($key+1); ?></td>
                                        <td><?php echo ($admin["name"]); ?></td>
                                        <td><?php echo ($admin["title"]); ?></td>
                                        <td><?php echo (date('Y-m-d H:i:s',$admin["logintime"])); ?>/<?php echo ($admin["loginip"]); ?></td>
                                        <td>
                                            <?php if($admin["checkinfo"] == 1): ?><a href="#" class="btn btn-success btn-xs">已审核</a>
                                                <?php elseif($admin["checkinfo"] == 0): ?><a href="#" class="btn btn-danger btn-xs">未审核</a><?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">操作 <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo U('Admin/admin_edit?aid='.$admin['id']);?>" class="font-bold">修改</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a href="javascript:void(0)" onclick="del_admin('<?php echo ($admin["id"]); ?>',<?php echo ($key); ?>)">删除</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr><?php endforeach; endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>管理员名称</th>
                                    <th>管理组</th>
                                    <th>登录时间/登陆IP</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </tfoot>
                        </table>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_all_admin()">全选</a>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_empty_admin()">全不选</a>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_reverse_admin()">反选</a>
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="multi_del_admin()">删除选定</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/cateringcms/Public/admin_tpl/js/jquery.min-v=2.1.4.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/bootstrap.min-v=3.3.6.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        var del_admin_url = "<?php echo U('Admin/admin_del');?>";
        $(document).ready(function() {
            $(".dataTables-example").dataTable();
        });
    </script>
    <script src="/cateringcms/Public/admin_custom/js/admin/admin.js"></script>
</body>

</html>