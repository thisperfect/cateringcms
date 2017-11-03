function add_admin() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: addAdmin,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['addCode'] == 1) {
                    swal("添加成功", "信息已添加成功！", "success");
                    self.location.href = manageAdmin;
                } else if (response['addCode'] == 2) {
                    swal("添加失败", "权限信息添加失败！", "error");
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

function edit_admin() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: editAdmin,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息修改成功！", "success");
                    self.location.href = manageAdmin;
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("修改失败", str, "error");
                    setTimeout(function() { location.reload() }, 2000);
                }
            }
        });
    }
}

function select_all_admin() {
    $("input[name=aid]:checkbox").prop("checked", true);

}

function select_empty_admin() {
    $("input[name=aid]:checkbox").prop("checked", false);
}

function select_reverse_admin() {
    $("input[name=aid]:checkbox").each(function() {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}

function del_admin(aid, liid) {
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
                url: del_admin_url,
                data: {
                    'aid': aid
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了这条信息！", "success");
                        $('table#adminmanage').find('tr.admin').eq(liid).remove();
                    } else {
                        swal("删除失败", "由于某种原因您的操作无效！", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

function multi_del_admin() {
    var aidList = new Array();
    $("input[name='aid']:checked").each(function() {
        aidList.push($(this).val());
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
                url: del_admin_url,
                data: {
                    'aidlist': aidList
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
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

function add_group() {
    groupTitle = $('input[name=title]').val();
    groupStatus = $('input[name=status]:checked').val();
    groupPrivacy = new Array();
    $("input[name='rules']:checked").each(function() {
        groupPrivacy.push($(this).val());
    });
    groupRules = groupPrivacy.toString();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: addGroup,
            data: {
                'title': groupTitle,
                'status': groupStatus,
                'rules': groupRules
            },
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
                    swal("添加失败", str, "error");
                }
            }
        });
    }
}

function edit_group() {
    groupTitle = $('input[name=title]').val();
    groupStatus = $('input[name=status]:checked').val();
    groupPrivacy = new Array();
    $("input[name='rules']:checked").each(function() {
        groupPrivacy.push($(this).val());
    });
    groupRules = groupPrivacy.toString();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: editGroup,
            data: {
                'title': groupTitle,
                'status': groupStatus,
                'rules': groupRules
            },
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
                    setTimeout(function() { location.reload() }, 2000);
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
            swal("已取消", "您取消了删除操作！", "error");
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
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

function add_rule() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: add_rule_url,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['addCode'] == 1) {
                    swal("添加成功", "信息已添加成功！", "success");
                    setTimeout(function() { location.reload() }, 20000);
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

function edit_rule() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: edit_rule_url,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息修改成功！", "success");
                    self.location.href = manageRule;
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

function select_all_rule() {
    $("input[name=rid]:checkbox").prop("checked", true);

}

function select_empty_rule() {
    $("input[name=rid]:checkbox").prop("checked", false);
}

function select_reverse_rule() {
    $("input[name=rid]:checkbox").each(function() {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}

function del_rule(rid, liid) {
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
                url: del_rule_url,
                data: {
                    'rid': rid
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了这条信息！", "success");
                        $('table#rulemanage').find('tr.rule').eq(liid).remove();
                    } else {
                        swal("删除失败", "由于某种原因您的操作无效！", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}

function multi_del_rule() {
    var ridList = new Array();
    $("input[name='rid']:checked").each(function() {
        ridList.push($(this).val());
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
                url: del_rule_url,
                data: {
                    'ridlist': ridList
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
            swal("已取消", "您取消了删除操作！", "error");
        }
    });
}
