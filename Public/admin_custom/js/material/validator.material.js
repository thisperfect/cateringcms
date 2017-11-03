$.validator.setDefaults({ highlight: function (e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function (e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function (e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function () {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            title: { required: !0 },
            keyword: { required: !0 },
            description: { required: !0 }
        },
        messages: {
            title: { required: e + "请输入食材名" },
            keyword: { required: e + "请输入关键词" },
            description: { required: e + "请输入描述" }
        }
    });
});