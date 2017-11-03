function add_material() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: addMaterial,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['addCode'] == 1) {
                    swal("添加成功", "信息已添加成功！", "success");
                    self.location.href = manageMaterial;
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

function edit_material() {
    formData = $('#signupForm').serialize();
    if ($('#signupForm').valid()) {
        $.ajax({
            type: "post",
            url: editMaterial,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息修改成功！", "success");
                    self.location.href = manageMaterial;
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



function select_all_material() {
    $("input[name=mid]:checkbox").prop("checked", true);

}

function select_empty_material() {
    $("input[name=mid]:checkbox").prop("checked", false);
}

function select_reverse_material() {
    $("input[name=mid]:checkbox").each(function() {
        $(this).prop("checked", !$(this).prop("checked"));
    });
}


function del_material(mid, liid) {
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
                url: del_material_url,
                data: {
                    'mid': mid
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", "您已经永久删除了这条信息！", "success");
                        $('table#materialmanage').find('tr.material').eq(liid).remove();
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


function multi_del_material() {
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
                url: del_material_url,
                data: {
                    'midlist': midList
                },
                dataType: "json",
                success: function(response) {
                    if (response['deleteCode'] == 1) {
                        swal("删除成功", response['success'] + " 成功 " + response['fail'] + " 失败", "success");
                        location.reload();
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