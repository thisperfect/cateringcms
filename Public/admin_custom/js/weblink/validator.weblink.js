$.validator.setDefaults({ highlight: function(e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function(e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function(e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function() {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            webname: { required: !0 },
            picurl: { required: !0 },
            linkurl: { required: !0 },
            webnote: { required: !0 },
            checkinfo: { required: !0 }

        },
        messages: {
            webname: { required: e + "请输入友情链接名称" },
            picurl: { required: e + "请选择友情链接图片" },
            linkurl: { required: e + "请选择友情链接地址" },
            webnote: { required: e + "请输入友情链接描述" },
            checkinfo: { required: e + "请选择启用状态" }
        }
    });
});