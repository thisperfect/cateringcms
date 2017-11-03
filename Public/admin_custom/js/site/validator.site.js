$.validator.setDefaults({ highlight: function(e) { $(e).closest(".form-group").removeClass("has-success").addClass("has-error") }, success: function(e) { e.closest(".form-group").removeClass("has-error").addClass("has-success") }, errorElement: "span", errorPlacement: function(e, r) { e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent()) }, errorClass: "help-block m-b-none", validClass: "help-block m-b-none" }), $().ready(function() {
    var e = "<i class='fa fa-times-circle'></i> ";
    $("#signupForm").validate({
        rules: {
            title: { required: !0 },
            host: { required: !0 },
            author: { required: !0 },
            seotitle: { required: !0 },
            keyword: { required: !0 },
            description: { required: !0 },
            copy: { required: !0 },
            icp: { required: !0 },
            csite: { required: !0 }
            // cinfo: { required: !0 }
        },
        messages: {
            title: { required: e + "请输入网站名称" },
            host: { required: e + "请输入网站地址" },
            author: { required: e + "请输入作者名" },
            seotitle: { required: e + "请输入seo标题" },
            keyword: { required: e + "请输入关键词" },
            description: { required: e + "请输入网站描述" },
            copy: { required: e + "请输入网站版权信息" },
            icp: { required: e + "请输入站点备案信息" },
            csite: { required: e + "请选择站点状态" }
            // cinfo: { required: e + "请输入关站说明" }
        }
    });
});