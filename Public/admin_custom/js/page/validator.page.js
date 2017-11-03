$.validator.setDefaults({ highlight: function(e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function(e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function(e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function() {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            title: { required: !0 },
            author: { required: !0 },
            content: { required: !0 },
            checkinfo: { required: !0 }

        },
        messages: {
            title: { required: e + "请输入标题" },
            author: { required: e + "请输入作者" },
            content: { required: e + "请输入详细内容" },
            checkinfo: { required: e + "请选择审核状态" }
        }
    });
});