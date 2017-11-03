function in_array(stringToSearch, arrayToSearch) {
    for (s = 0; s < arrayToSearch.length; s++) {
        thisEntry = arrayToSearch[s].toString();
        if (thisEntry == stringToSearch) {
            return true;
        }
    }
    return false;
}

function message_check(id, isCheck) {
    if (in_array(isCheck, [0, 1])) {
        $.ajax({
            type: "post",
            url: check_message_url,
            data: {
                'mid': id,
                'checkinfo': isCheck
            },
            dataType: "json",
            success: function(response) {
                if (response['chkCode'] == 1) {
                    swal("成功", "审核成功", "success");
                    setTimeout(function() { location.reload() }, 2000);
                } else {
                    var str = "";
                    for (var i in response) {
                        str += response[i] + "\n";
                    }
                    swal("审核失败", str, "error");
                    setTimeout(function() { location.reload() }, 2000);
                }
            }
        });
    } else { swal("失败", "由于某些原因，无法进行审核", "error"); }
}

function select_all_message() {
    $("input[name=mid]:checkbox").prop("checked", true);

}

function select_empty_message() {
    $("input[name=mid]:checkbox").prop("checked", false);
}

function select_reverse_message() {
    $("input[name=mid]:checkbox").each(function() {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}

function del_message(mid, liid) {
    swal({
        title: "您确定要删除此条留言吗",
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
                url: del_message_url,
                data: {
                    'mid': mid
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了这条信息！", "success");
                        $('table#messagemanage').find('tr.messagetr').eq(liid).remove();
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

function multi_del_message() {
    var midList = new Array();
    $("input[name='mid']:checked").each(function() {
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
    }, function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "post",
                url: del_message_url,
                data: {
                    'midlist': midList
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