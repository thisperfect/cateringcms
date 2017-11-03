$.validator.setDefaults({
    highlight: function (e) {
        $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
    },
    success: function (e) {
        e.closest(".form-group").removeClass("has-error").addClass("has-success")
    },
    errorElement: "span",
    errorPlacement: function (e, r) {
        e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
    },
    errorClass: "help-block m-b-none",
    validClass: "help-block m-b-none"
}), $().ready(function () {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            name: {
                required: !0
            },
            keyword: {
                required: !0
            },
            description: {
                required: !0
            },
            property: {
                required: !0
            },
            taste: {
                required: !0
            },
            weight: {
                required: !0
            },
            category_id: {
                required: !0
            },
            material_id: {
                required: !0
            },
            content: {
                required: !0
            },
            picurl: {
                required: !0
            },
            price: {
                required: !0,
                number: true,
                min: 0
            },
            checkinfo: {
                required: !0
            }

        },
        messages: {
            name: {
                required: e + "请选择菜名"
            },
            keyword: {
                required: e + "请输入关键词"
            },
            description: {
                required: e + "请输入描述"
            },
            property: {
                required: e + "请选择菜品属性"
            },
            taste: {
                required: e + "请选择口味属性"
            },
            weight: {
                required: e + "请选择份量属性"
            },
            category_id: {
                required: e + "请选择菜品类别"
            },
            material_id: {
                required: e + "请选择食材类别"
            },
            content: {
                required: e + "请输入详细介绍"
            },
            picurl: {
                required: e + "请选择特色图片"
            },
            price: {
                required: e + "请输入单价",
                number: e + "价格必须为数字类型",
                min: e + "价格最小值不能小于0"
            },
            checkinfo: {
                required: e + "请选择是否上架"
            }
        }
    });
});