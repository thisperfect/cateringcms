$.validator.setDefaults({ highlight: function(e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function(e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function(e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function() {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            name: { required: !0 },
            picurl: { required: !0 },
            keyword: { required: !0 },
            description: { required: !0 },
            content: { required: !0 },
            checkinfo: { required: !0 }

        },
        messages: {
            name: { required: e + "请输入姓名" },
            picurl: { required: e + "请选择厨师图片" },
            keyword: { required: e + "请输入厨师关键词" },
            description: { required: e + "请输入厨师描述" },
            content: { required: e + "请输入厨师详细介绍" },
            checkinfo: { required: e + "请选择显示状态" }
        }
    });
});