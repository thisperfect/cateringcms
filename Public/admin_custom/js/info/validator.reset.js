$.validator.setDefaults({ highlight: function(e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function(e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function(e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function() {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#passwdForm").validate({
        rules: {
            password: { required: !0, minlength: 5 },
            confirm_password: { required: !0, minlength: 5, equalTo: "#password" },
        },
        messages: {
            password: { required: e + "请输入新密码", minlength: e + "密码必须5个字符以上" },
            confirm_password: { required: e + "请再次输入新密码", minlength: e + "密码必须5个字符以上", equalTo: e + "两次输入的密码不一致" }
        }
    });
});