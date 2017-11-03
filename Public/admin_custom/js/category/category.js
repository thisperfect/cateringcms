function add_category() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: addCategory,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['addCode'] == 1) {
                    swal("添加成功", "信息已添加成功！", "success");
                    self.location.href = manageCategory;
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("添加失败", str, "error");
                    self.location.href;
                }
            }
        });
    }
}

function edit_category() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: editCategory,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息修改成功！", "success");
                    self.location.href = manageCategory;
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("添加失败", str, "error");
                    self.location.href;
                }
            }
        });
    }
}



function select_all_category() {
    $("input[name=cid]:checkbox").prop("checked", true);

}

function select_empty_category() {
    $("input[name=cid]:checkbox").prop("checked", false);
}

function select_reverse_category() {
    $("input[name=cid]:checkbox").each(function() {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}


function del_category(cid, liid) {
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
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "get",
                url: del_category_url,
                data: {
                    'cid': cid
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了这条信息！", "success");
                        $('table#categorymanage').find('tr.category').eq(liid).remove();
                    } else {
                        swal("删除失败", "由于某种原因您的操作无效！", "error");
                        self.location.href;
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
            self.location.href;
        }
    });
}


function multi_del_category() {
    var cidList = new Array();
    $("input[name='cid']:checked").each(function() {
        cidList.push($(this).val());
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
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "post",
                url: del_category_url,
                data: {
                    'cidlist': cidList
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", response['success'] + " 成功 " + response['fail'] + " 失败", "success");
                        setTimeout(function() { location.reload() }, 2000);
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