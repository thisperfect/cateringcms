$.validator.setDefaults({ highlight: function(e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function(e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function(e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function() {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            shopping_name: { required: !0 },
            shopping_tel: { required: !0 },
            shopping_address: { required: !0 },
            total: { required: !0 },
            pay_code: { required: !0 },
            order_status_id: { required: !0 }
        },
        messages: {
            shopping_name: { required: e + "请输入收货人姓名" },
            shopping_tel: { required: e + "请输入收货人电话" },
            shopping_address: { required: e + "请输入收货人地址" },
            total: { required: e + "请输入总金额" },
            pay_code: { required: e + "请选择支付方式" },
            order_status_id: { required: e + "请选择订单状态" }
        }
    });
});