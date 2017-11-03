function edit_site() {
    if ($('#signupForm').valid()) {
        formData = $('#signupForm').serialize();
        $.ajax({
            type: "post",
            url: edit_site_url,
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response['editCode'] == 1) {
                    swal("修改成功！", "站点信息修改成功！", "success");
                    setTimeout(function() { location.reload() }, 2000);
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