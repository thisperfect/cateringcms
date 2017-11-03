<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Conmpatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo ($menu["name"]); ?></title>
    <meta name="keywords" content="<?php echo C('WEB_KEYWORDS');?>">
    <meta name="description" content="<?php echo C('WEB_DESCRIPTION');?>">
    <link rel="shortcut icon" href="<?php echo C('WEB_FAVICON');?>">
    <link rel="stylesheet" type="text/css" href="/cateringcms/Public/home_tpl/css/bootstrap.min.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/header.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/shopping.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/buttom.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/top.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/icheck.css">
    <link rel="stylesheet" href="/cateringcms/Public/home_tpl/css/zui.min.css">
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
    <!--商品展示-->
    <section class="price-area clearfix">
        <div class="container clearfix">
            <div class="dizhi">
                <h1><?php echo ($menu["name"]); ?></h1>
            </div>
            <hr>
            <div class="picture-area clearfix">
                <div class="picture-area-left clearfix">
                    <img class="clearfix" src="<?php echo ($menu["picurl"]); ?>" alt="">
                </div>
                <div class="picture-area-right clearfix">
                    <p>秒杀价：<span>￥</span> <span class="price"><?php echo ($menu["price"]); ?></span></p>
                    <p> 已售：<span class="sales">1388</span>份&nbsp;&nbsp;&nbsp;评分：<span class="grade">4.2</span>分</p>
                    <p> 口味：
                        <?php if(is_array($taste)): foreach($taste as $k=>$taste_v): ?><label class="radio-inline"><input type="radio" value="<?php echo ($taste_v["id"]); ?>" id="taste<?php echo ($taste_v["id"]); ?>" name="taste" <?php if($k == 0): ?>checked<?php endif; ?>><?php echo ($taste_v["name"]); ?></label>&nbsp;<?php endforeach; endif; ?>
                    </p>
                    <p> 份量：
                        <?php if(is_array($weight)): foreach($weight as $k=>$weight_v): ?><label class="radio-inline"><input type="radio" value="<?php echo ($weight_v["id"]); ?>" id="weight<?php echo ($weight_v["id"]); ?>" name="weight"<?php if($k == 0): ?>checked<?php endif; ?>><?php echo ($weight_v["name"]); ?></label>&nbsp;<?php endforeach; endif; ?>
                    </p>
                    <div class="number">
                        <span>数量：</span><span><img   src="/cateringcms/Public/home_tpl/images/shangpinxiangqing/jia.png" id="jia"><input class="input"form="longer" type="text" value="1" id="num" disabled><img src="/cateringcms/Public/home_tpl/images/shangpinxiangqing/jian.png" id="jian">  </span>
                    </div>
                    <p><button class="btn btn-danger" onclick="collectMeanu('<?php echo ($_SESSION['user']['uid']); ?>','<?php echo ($menu["id"]); ?>')"><span class="glyphicon glyphicon-star"></span>&nbsp;收藏</button></p>
                    <button class="btn btn-warning" onclick="turnToCart('<?php echo ($menu["id"]); ?>','<?php echo ($menu["name"]); ?>','<?php echo ($menu["price"]); ?>','<?php echo ($menu["picurl"]); ?>')"><span class="glyphicon glyphicon-ok"></span>&nbsp;立即购买</button>
                    <button class="btn btn-success" onclick="addCart('<?php echo ($menu["id"]); ?>','<?php echo ($menu["name"]); ?>','<?php echo ($menu["price"]); ?>','<?php echo ($menu["picurl"]); ?>')"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;加入购物车</button>

                </div>

            </div>
        </div>
    </section>
    <!--详情-->
    <section class="details">
        <div class="container">

            <div class="xcontent">
                <div class="clearfix">
                    <h3>购买须知</h3>
                    <hr>
                    <dl>
                        <dt>有效期</dt>
                        <dd>2013.12.25至2017.6.13(周末、法定假日通用)</dd>
                        <dt>使用时间</dt>
                        <dd>11:00-次日02:00</dd>
                        <dt>预约提醒</dt>
                        <dd>无需预约</dd>
                        <dt>限购限用提醒</dt>
                        <dd>每张券建议1人使用</dd>
                        <dt>其他费用</dt>
                        <dd>方案不含餐巾纸，需到店另付0.5元/份</dd>
                        <dt>包间</dt>
                        <dd>店内无包间</dd>
                        <dt>堂食外带</dt>
                        <dd>堂食外带均可，可免费打包</dd>
                        <dt>温馨提示</dt>
                        <dd>团购用户不可同时享受商家其他优惠</dd>

                    </dl>
                </div>
                <div>
                    <h3>
                        本单详情
                    </h3>
                    <hr>
                    <table>

                        <tbody>
                            <tr>
                                <th class="center">套餐内容</th>
                                <th class="center">单价</th>
                                <th class="center">数量/规格</th>
                                <th class="center">小计</th>
                            </tr>
                            <tr>
                                <td><?php echo ($menu["name"]); ?></td>
                                <td>￥<?php echo ($menu["price"]); ?></td>
                                <td>1份</td>
                                <td>￥<?php echo ($menu["price"]); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="clearfix details2">
                        <?php echo ($menu["content"]); ?>
                    </div>
                </div>
                <div>
                    <hr>
                    <div class="comments">
                        <header>
                            <div class="pull-right"><a href="#commentReplyForm" class="btn btn-danger"><i class="icon-comment-alt"></i> 发表评论</a></div>
                            <h3>消费评价</h3>
                        </header>
                        <section class="comments-list">
                            <?php if(is_array($comment)): foreach($comment as $key=>$data): ?><div class="comment">
                                    <a href="javascript:void(0)" class="avatar">
                            <img src="<?php echo ((isset($data["head"]) && ($data["head"] !== ""))?($data["head"]):'/cateringcms/Public/home_tpl/images/default.jpg'); ?>" alt=""></a>
                                    <!--一级评论-->
                                    <div class="content">
                                        <div class="pull-right text-muted"><?php echo (date('Y-m-d',$data["posttime"])); ?></div>
                                        <div><a href="javascript:void(0)" style="color:#000;"><strong><?php echo ($data["name"]); ?></strong></a></div>
                                        <div class="text"><?php echo ($data["content"]); ?></div>
                                        <div class="actions">
                                            <a href="#commentReplyForm" onclick="replay('<?php echo ($data["id"]); ?>','<?php echo ($data["name"]); ?>')">回复</a>
                                        </div>
                                        <div class="comments-list">
                                            <?php if(is_array($data["children"])): foreach($data["children"] as $key=>$child): ?><div class="comment">
                                                    <a href="javascript:void(0)" class="avatar">
                                            <img src="<?php echo ((isset($child["head"]) && ($child["head"] !== ""))?($child["head"]):'/cateringcms/Public/home_tpl/images/default.jpg'); ?>" alt=""></a>
                                                    <div class="content">
                                                        <div class="pull-right text-muted"><?php echo (date('Y-m-d',$child["posttime"])); ?></div>
                                                        <div><a href="javascript:void(0)" style="color:#000;"><strong><?php echo ($child["name"]); ?></strong></a>
                                                            <span class="text-muted">回复</span> <a href="javascript:void(0)"
                                                                style="color:#000;"><?php echo ($data["name"]); ?></a></div>
                                                        <div class="text"><?php echo ($child["content"]); ?></div>
                                                        <div class="actions">
                                                            <a href="#commentReplyForm" onclick="replay('<?php echo ($child["id"]); ?>','<?php echo ($child["name"]); ?>')">回复</a>
                                                        </div>
                                                    </div>
                                                    <!--三级评论-->
                                                    <div class="comments-list">
                                                        <?php if(is_array($child["children"])): foreach($child["children"] as $key=>$grandson): ?><div class="comment">
                                                                <a href="javascript:void(0)" class="avatar">
                                                        <img src="<?php echo ((isset($grandson["head"]) && ($grandson["head"] !== ""))?($grandson["head"]):'/cateringcms/Public/home_tpl/images/default.jpg'); ?>" alt=""></a>
                                                                <div class="content">
                                                                    <div class="pull-right text-muted"><?php echo (date('Y-m-d',$grandson["posttime"])); ?></div>
                                                                    <div><a href="javascript:void(0)" style="color:#000;"><strong><?php echo ($grandson["name"]); ?></strong></a>
                                                                        <span class="text-muted">回复</span> <a href="javascript:void(0)"
                                                                            style="color:#000;"><?php echo ($child["name"]); ?></a></div>
                                                                    <div class="text"><?php echo ($child["content"]); ?></div>
                                                                </div>
                                                            </div><?php endforeach; endif; ?>
                                                    </div>
                                                </div><?php endforeach; endif; ?>
                                        </div>
                                    </div>
                                </div><?php endforeach; endif; ?>
                        </section>
                        <!--回复页脚-->
                        <footer>
    <?php if(empty($_SESSION['user'])): ?><div class="reply-form" id="commentReplyForm">
            <a href="javascript:void(0)" class="avatar"><img src="/cateringcms/Public/home_tpl/images/default.jpg" alt=""></a>
            <form class="form" action="<?php echo U('Menu/comment');?>" method="post" id="commentForm">
                <div class="form-group">
                    <textarea class="form-control new-comment-text validate[required,minSize[4],maxSize[200]]" rows="2" placeholder="撰写评论..."
                        id="content" name="content"></textarea>
                </div>
                <div class="form-group comment-user">
                    <div class="row">
                        <div class="col-md-3">
                            <span class="pull-right">或者</span>
                            <a href="<?php echo U('User/login');?>" class="btn btn-danger">登录</a> &nbsp;<a href="<?php echo U('User/register');?>"
                                class="btn btn-danger">注册</a>
                        </div>
                        <div class="col-md-7">
                            <div class=" form-group">
                                <input type="text" class="form-control validate[required,minSize[4],maxSize[20]]" id="nameInputEmail1" placeholder="输入评论显示名称"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control validate[required,custom[email]]" id="exampleInputEmail1" placeholder="输入电子邮件（不会在评论显示）"
                                    name="email">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="menu_id" value="<?php echo ($menu["id"]); ?>">
                            <input type="hidden" name="parent_id" value="0"><button type="submit" class="btn btn-block btn-danger"><i class="icon-ok"></i>&nbsp;发布</button></div>
                    </div>
                </div>
            </form>
        </div>
        <?php else: ?>
        <div class="reply-form" id="commentReplyForm">
            <a href="javascript:void(0)" class="avatar"><img src="<?php echo ((isset($_SESSION['user']['head']) && ($_SESSION['user']['head'] !== ""))?($_SESSION['user']['head']):'/cateringcms/Public/home_tpl/images/default.jpg'); ?>" alt="<?php echo ($_SESSION['user']['name']); ?>"></a>
            <form class="form" action="<?php echo U('Menu/comment');?>" method="post" id="commentForm">
                <div class="form-group">
                    <textarea class="form-control new-comment-text validate[required,minSize[4],maxSize[200]]" rows="2" placeholder="撰写评论..."
                        id="content" name="content" required></textarea>
                </div>
                <div class="form-group comment-user">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="menu_id" value="<?php echo ($menu["id"]); ?>">
                            <input type="hidden" name="parent_id" value="0">
                            <button type="submit" class="btn btn-block btn-danger"><i class="icon-ok"></i>&nbsp;发布</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><?php endif; ?>
</footer>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 评论 -->
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
    <script src="/cateringcms/Public/home_tpl/js/zui.min.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/icheck.js"></script>
    <script src="/cateringcms/Public/admin_tpl/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/jquery.validationEngine-zh_CN.js"></script>
    <script src="/cateringcms/Public/home_tpl/js/jquery.validationEngine.js"></script>
    <script>
        $(document).ready(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red',
                increaseArea: '20%' // optional
            });
            $('#commentForm').validationEngine('attach', {
                promptPosition: 'topLeft:60,10',
            });

            var count = 1;
            $('#num').val(count);
            $('#jia').click(function () {
                count = count + 1;
                $('#num').val(count);
            });
            $('#jian').click(function () {
                count = count - 1;
                if (count <= 0) {
                    swal('错误', '数量最小为1', 'error')
                } else($('#num').val(count));
            });
        });

        function replay(pid, toName) {
            $("textarea[name='content']").attr("placeholder", "@" + toName);
            $("input[name='parent_id']").val(pid);
        }

        function collectMeanu(uid, mid) {
            $.ajax({
                type: "post",
                url: "<?php echo U('Good/addCollect');?>",
                data: {
                    'uid': uid,
                    'menu_id': mid,
                },
                dataType: "json",
                success: function (response) {
                    if (response['code'] == 1) {
                        swal('添加收藏成功', '更多信息请查看收藏夹', 'success');
                    } else {
                        var str = "";
                        for (var i in response) {
                            str += response[i] + "\n";
                        }
                        swal("添加收藏失败", str, "error");
                    }
                }
            });
        }

        function addCart(id, name, price, img) {
            num = $('#num').val();
            taste = $("input[name='taste']:checked").val();
            weight = $("input[name='weight']:checked").val();
            $.ajax({
                type: "post",
                url: "<?php echo U('Cart/addCart');?>",
                data: {
                    "id": id,
                    "name": name,
                    "taste": taste,
                    "weight": weight,
                    "price": price,
                    "num": num,
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

        function turnToCart(id, name, price, img) {

            addCart(id, name, price, img);
            window.location.href = "<?php echo U('Good/cart');?>";
        }
    </script>
</body>

</html>