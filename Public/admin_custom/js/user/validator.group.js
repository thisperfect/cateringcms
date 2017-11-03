$.validator.setDefaults({ highlight: function(e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function(e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function(e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function() {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            title: { required: !0 },
            points_a: { required: !0, number: true, min: 0 },
            points_b: { required: !0, number: true, min: 0 },
            status: { required: !0 }
        },
        messages: {
            title: { required: e + "请输入管理组名" },
            points_a: {
                required: e + "请输入积分区间最小值",
                number: e + "积分必须为数字类型",
                min: e + "输入积分区间最小值不能小于0"
            },
            points_b: {
                required: e + "请输入积分区间最大值",
                number: e + "积分必须为数字类型",
                min: e + "输入积分区间最小值不能小于0"
            },
            status: { required: e + "请选择启用状态" }
        }
    });
});