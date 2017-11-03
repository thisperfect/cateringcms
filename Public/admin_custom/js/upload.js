function select_all_file() {
    $("input[name=fid]:checkbox").prop("checked", true);

}

function select_empty_file() {
    $("input[name=fid]:checkbox").prop("checked", false);
}

function select_reverse_file() {
    $("input[name=fid]:checkbox").each(function() {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}

function del_file(fid, liid) {
    swal({
        title: "您确定要删除此文件吗",
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
                url: del_file_url,
                data: {
                    'fid': fid
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了此文件！", "success");
                        $('table#fileManage').find('tr.file').eq(liid).remove();
                    } else if (response['deleteCode'] == 0) {
                        swal("删除失败", "文件删除失败或者文件不存在！", "error");
                    } else if (response['deleteCode'] == 2) {
                        swal("删除失败", "文件不存在或者已经被删除！", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error")
        }
    });
}

function multi_del_file() {
    var fidList = new Array();
    $("input[name='fid']:checked").each(function() {
        fidList.push($(this).val());
    });
    swal({
        title: "您确定要删除这几条文件吗",
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
                url: del_file_url,
                data: {
                    'fidlist': fidList
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除已完成！", response['success'] + " 成功 " + response['fail'] + " 失败", "success");
                        setTimeout(function() { location.reload() }, 2000);
                    } else if (response['deleteCode'] == 0) {
                        swal("删除失败", "文件删除失败或者文件不存在！", "error");
                    } else if (response['deleteCode'] == 2) {
                        swal("删除失败", "文件不存在或者已经被删除！", "error");
                    }
                }
            });
        } else {
            swal("已取消", "您取消了删除操作！", "error")
        }
    });
}