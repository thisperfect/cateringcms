function add_user() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: add_user_url,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['addCode'] == 1) {
                    swal("添加成功", "信息已添加成功！", "success");
                    self.location.href = manageUser;
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

function edit_user() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: edit_user_url,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息修改成功！", "success");
                    self.location.href = manageUser;
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("修改失败", str, "error");
                }
            }
        });
    }
}

function select_all_user() {
    $("input[name=uid]:checkbox").prop("checked", true);

}

function select_empty_user() {
    $("input[name=uid]:checkbox").prop("checked", false);

}

function select_reverse_user() {
    $("input[name=uid]:checkbox").each(function() {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}

function del_user(uid, liid) {
    swal({
        title: "您确定要删除此用户吗",
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
                url: del_user_url,
                data: {
                    'uid': uid
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了这条信息！", "success");
                        $('table#usermanage').find('tr.user').eq(liid).remove();
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

function multi_del_user() {
    var uidList = new Array();
    $("input[name='uid']:checked").each(function() {
        uidList.push($(this).val());
    });
    swal({
        title: "您确定要删除这几用户吗",
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
                url: del_user_url,
                data: {
                    'uidlist': uidList
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

function add_group() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: addGroup,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['addCode'] == 1) {
                    swal("添加成功", "信息已添加成功！", "success");
                    self.location.href = manageGroup;
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("修改失败", str, "error");
                }
            }
        });
    }
}

function edit_group() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: editGroup,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息已修改成功！", "success");
                    self.location.href = manageGroup;
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("修改失败", str, "error");
                }
            }
        });
    }
}

function select_all_group() {
    $("input[name=gid]:checkbox").prop("checked", true);

}

function select_empty_group() {
    $("input[name=gid]:checkbox").prop("checked", false);
}

function select_reverse_group() {
    $("input[name=gid]:checkbox").each(function() {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}

function del_group(gid, liid) {
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
                url: del_group_url,
                data: {
                    'gid': gid
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了这条信息！", "success");
                        $('table#groupmanage').find('tr.group').eq(liid).remove();
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

function multi_del_group() {
    var gidList = new Array();
    $("input[name='gid']:checked").each(function() {
        gidList.push($(this).val());
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
                url: del_group_url,
                data: {
                    'gidlist': gidList
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