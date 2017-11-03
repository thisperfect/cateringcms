<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>用户管理</title>
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
            <h2>用户管理</h2>
            <ol class="breadcrumb">
                <li>
                    <strong>用户管理</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="<?php echo U('User/user_add');?>" class="btn btn-primary">添加用户</a>
                <a href="<?php echo U('User/group');?>" class="btn btn-primary">用户组管理</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRightBig">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>用户列表</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="usermanage">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名称</th>
                                    <th>用户组</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($user)): foreach($user as $key=>$user): ?><tr class="gradeA user">
                                        <td><input type="checkbox" name="uid" value="<?php echo ($user["id"]); ?>">&nbsp;&nbsp;&nbsp;<?php echo ($user["id"]); ?></td>
                                        <td><?php echo ($user["uname"]); ?></td>
                                        <td>
                                            <?php $__FOR_START_15737__=0;$__FOR_END_15737__=$row;for($k=$__FOR_START_15737__;$k < $__FOR_END_15737__;$k+=1){ if(($user['points'] >= $group[$k]['points_a']) AND ($user['points'] <= $group[$k]['points_b'])): echo ($group[$k]['title']); endif; } ?>
                                        </td>

                                        <td>
                                            <?php if($user["checkinfo"] == 1): ?><a href="#" class="btn btn-success btn-xs">已认证</a>
                                                <?php elseif($user["checkinfo"] == 0): ?><a href="#" class="btn btn-danger btn-xs">未认证</a><?php endif; ?>
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">操作 <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo U('User/user_edit?uid='.$user['id']);?>" class="font-bold">修改</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a href="javascript:void(0)" onclick="del_user('<?php echo ($user["id"]); ?>',<?php echo ($key); ?>)">删除</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr><?php endforeach; endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名称</th>
                                    <th>用户组</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </tfoot>
                        </table>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_all_user()">全选</a>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_empty_user()">全不选</a>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_reverse_user()">反选</a>
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="multi_del_user()">删除选定</a>
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
        var del_user_url = "<?php echo U('User/user_del');?>";
        $(document).ready(function() {
            $(".dataTables-example").dataTable();
        });
    </script>
    <script src="/cateringcms/Public/admin_custom/js/user/user.js"></script>
</body>

</html>