function edit_info() {
    formData = $('#infoForm').serialize();
    if ($('#infoForm').valid()) {
        $.ajax({
            type: "post",
            url: edit_info_url,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息已修改成功！", "success");
                    self.location.href = home;
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

function edit_passwd() {
    formData = $('#passwdForm').serialize();
    if ($('#passwdForm').valid()) {
        $.ajax({
            type: "post",
            url: edit_passwd_url,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功", "信息已修改成功！", "success");
                    self.location.href = logout;
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