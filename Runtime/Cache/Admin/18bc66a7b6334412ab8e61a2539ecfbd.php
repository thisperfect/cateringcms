<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title><?php echo ($order_status_name); ?>订单管理</title>
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
            <h2><?php echo ($order_status_name); ?>订单管理</h2>
        </div>
        <!--<div class="col-sm-8">
            <div class="title-action">
                <a href="<?php echo U('Order/check');?>" class="btn btn-primary">账单管理</a>
            </div>
        </div>-->
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><?php echo ($order_status_name); ?>订单列表</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables" id="ordermanage">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户ID</th>
                                    <th>订单编号</th>
                                    <th>联系人/电话/地址</th>
                                    <th>金额</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($order)): foreach($order as $key=>$order): ?><tr class="gradeA order">
                                        <td><input type="checkbox" name="oid" value="<?php echo ($order["id"]); ?>">&nbsp;&nbsp;&nbsp;<?php echo ($order["id"]); ?></td>
                                        <td><?php echo ($order["uid"]); ?></td>
                                        <td><?php echo ($order["order_num"]); ?></td>
                                        <td><?php echo ($order["shopping_name"]); ?>/<?php echo ($order["shopping_tel"]); ?></td>
                                        <td><?php echo ($order["total"]); ?></td>
                                        <td><?php echo (date('Y-m-d H:i:s',$order["posttime"])); ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">操作 <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo U('Order/order_edit?oid='.$order['id']);?>" class="font-bold">查看/修改</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a href="javascript:void(0)" onclick="del_order('<?php echo ($order["id"]); ?>',<?php echo ($key); ?>)">删除</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr><?php endforeach; endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>用户ID</th>
                                    <th>订单编号</th>
                                    <th>联系人/电话/地址</th>
                                    <th>金额</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                            </tfoot>
                        </table>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_all_order()">全选</a>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_empty_order()">全不选</a>
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="select_reverse_order()">反选</a>
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="multi_del_order()">删除选定</a>
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
        var del_order_url = "<?php echo U('Order/order_del');?>";
        $(document).ready(function() {
            $(".dataTables").dataTable();
        });
    </script>
    <script src="/cateringcms/Public/admin_custom/js/order.js"></script>
</body>

</html>