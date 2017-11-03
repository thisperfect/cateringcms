$.validator.setDefaults({ highlight: function(e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function(e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function(e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function() {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            uname: {
                required: !0,
                minlength: 2
            },
            password: { required: !0, minlength: 5 },
            confirm_password: { required: !0, minlength: 5, equalTo: "#password" },
            email: { required: !0, email: true },
            points: { required: !0, number: true },
            checkinfo: { required: !0 }
        },
        messages: {
            uname: { required: e + "请输入用户名", minlength: e + "用户名必须两个字符以上" },
            password: { required: e + "请输入密码", minlength: e + "密码必须5个字符以上" },
            confirm_password: { required: e + "请再次输入密码", minlength: e + "密码必须5个字符以上", equalTo: e + "两次输入的密码不一致" },
            email: { required: e + "邮箱不能为空", email: e + "请输入正确格式的电子邮件" },
            points: { required: e + "请输入积分", number: e + "积分必须为数字类型" },
            checkinfo: { required: e + "请选择审核状态" }
        }
    });
});