
function add_menu() {
    name = $('input[name=name]').val();
    keyword = $('input[name=keyword]').val();
    description = $('input[name=description]').val();
    arr = new Array();
    $("input[name='property']:checked").each(function () {
        arr.push($(this).val());
    });
    property = arr.toString();
    arr1 = new Array();
    $("input[name='taste']:checked").each(function () {
        arr1.push($(this).val());
    });
    taste = arr1.toString();
    arr2 = new Array();
    $("input[name='weight']:checked").each(function () {
        arr2.push($(this).val());
    });
    weight = arr2.toString();
    category_id = $('#category_id').val();
    material_id = $('#material_id').val();
    content = $('#content').val();
    picurl = $('input[name=picurl]').val();
    price = $('input[name=price]').val();
    checkinfo = $('input[name=checkinfo]:checked').val();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: add_menu_url,
            data: {
                'name': name,
                'keyword': keyword,
                'description': description,
                'property': property,
                'taste': taste,
                'weight': weight,
                'category_id': category_id,
                'material_id': material_id,
                'content': content,
                'picurl': picurl,
                'price': price,
                'checkinfo': checkinfo
            },
            dataType: "json",
            success: function (response) {
                if (response['addCode'] == 1) {
                    swal("添加成功", "列表信息添加成功！", "success");
                    self.location.href = manageMenu;
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("添加失败", str, "error");
                }
            }
        });
    }
}

function edit_menu() {
    name = $('input[name=name]').val();
    keyword = $('input[name=keyword]').val();
    description = $('input[name=description]').val();
    arr = new Array();
    $("input[name='property']:checked").each(function () {
        arr.push($(this).val());
    });
    property = arr.toString();
    arr1 = new Array();
    $("input[name='taste']:checked").each(function () {
        arr1.push($(this).val());
    });
    taste = arr1.toString();
    arr2 = new Array();
    $("input[name='weight']:checked").each(function () {
        arr2.push($(this).val());
    });
    weight = arr2.toString();
    category_id = $('#category_id').val();
    material_id = $('#material_id').val();
    content = $('#content').val();
    picurl = $('input[name=picurl]').val();
    price = $('input[name=price]').val();
    checkinfo = $('input[name=checkinfo]:checked').val();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: edit_menu_url,
            data: {
                'name': name,
                'keyword': keyword,
                'description': description,
                'property': property,
                'taste': taste,
                'weight': weight,
                'category_id': category_id,
                'material_id': material_id,
                'content': content,
                'picurl': picurl,
                'price': price,
                'checkinfo': checkinfo
            },
            dataType: "json",
            success: function (response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息修改成功！", "success");
                    self.location.href = manageMenu;
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("修改失败", str, "error");
                    setTimeout(function () {
                        location.reload()
                    }, 2000);
                }
            }
        });
    }
}

function select_all_menu() {
    $("input[name=mid]:checkbox").prop("checked", true);

}

function select_empty_menu() {
    $("input[name=mid]:checkbox").prop("checked", false);
}

function select_reverse_menu() {
    $("input[name=mid]:checkbox").each(function () {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}

function del_menu(mid, liid) {
    swal({
        title: "您确定要删除这条信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "get",
                url: del_menu_url,
                data: {
                    'mid': mid
                },
                dataType: "json",
                success: function (response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了这条信息！", "success");
                        $('table#menumanage').find('tr.menu').eq(liid).remove();
                        setTimeout(function () {
                            location.reload()
                        }, 2000);
                    } else {
                        swal("删除失败", "由于某种原因您的操作无效！", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error")
        }
    });
}

function multi_del_menu() {
    var midList = new Array();
    $("input[name='mid']:checked").each(function () {
        midList.push($(this).val());
    });
    swal({
        title: "您确定要删除这几条信息吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "post",
                url: del_menu_url,
                data: {
                    'midlist': midList
                },
                dataType: "json",
                success: function (response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", response['success'] + " 成功 " + response['fail'] + " 失败", "success");
                        setTimeout(function () {
                            location.reload()
                        }, 2000);
                    } else {
                        swal("删除失败", "由于某种原因您的操作无效！", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error")
        }
    });
}