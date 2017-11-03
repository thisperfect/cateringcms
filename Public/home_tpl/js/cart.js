// JavaScript Document



/*改变所购商品的数量*/
function changeNum(id, numId, flag) { /*numId表示对应商品数量的文本框ID，flag表示是增加还是减少商品数量*/
    var numId = document.getElementById(numId);
    if (flag == "minus") { /*减少商品数量*/
        if (numId.value <= 1) {
            swal("宝贝数量必须是大于0", "或者请直接移除购物车", "error");
            return false;
        } else {
            numId.value = parseInt(numId.value) - 1;
            $.ajax({
                type: "post",
                url: dec_num_url,
                data: {
                    'id': id
                },
                dataType: "json",
                success: function (response) {
                    if (response['code'] == '1') {
                        console.log('ok');
                    } else {
                        console.log('error');
                    }
                }
            });
            productCount();
        }
    } else { /*flag为add，增加商品数量*/
        numId.value = parseInt(numId.value) + 1;
        $.ajax({
            type: "post",
            url: inc_num_url,
            data: {
                'id': id
            },
            dataType: "json",
            success: function (response) {
                if (response['code'] == '1') {
                    console.log('ok');
                } else {
                    console.log('error');
                }
            }
        });
        productCount();
    }
}

/*自动计算商品的总金额、总共节省的金额和积分*/
function productCount() {
    var total = 0; //商品金额总计
    var integral = 0; //可获商品积分
    var point; //每一行商品的单品积分
    var price; //每一行商品的单价
    var number; //每一行商品的数量
    var subtotal; //每一行商品的小计

    /*访问ID为shopping表格中所有的行数*/
    var myTableTr = document.getElementById("shopping").getElementsByTagName("tr");
    if (myTableTr.length > 0) {
        for (var i = 1; i < myTableTr.length; i++) { /*从1开始，第一行的标题不计算*/
            if (myTableTr[i].getElementsByTagName("td").length > 2) { //最后一行不计算

                price = myTableTr[i].getElementsByTagName("td")[4].innerHTML;
                point = parseInt(price / 10);
                number = myTableTr[i].getElementsByTagName("td")[5].getElementsByTagName("input")[0].value;
                total += price * number;
                integral += point * number;
                myTableTr[i].getElementsByTagName("td")[6].innerHTML = price * number;
            }
        }
        document.getElementById("total").innerHTML = total;
        document.getElementById("integral").innerHTML = integral;

    }
}
window.onload = productCount;

/*复选框全选或全不选效果*/
function selectAll() {
    var oInput = document.getElementsByName("cartCheckBox");
    for (var i = 0; i < oInput.length; i++) {
        oInput[i].checked = document.getElementById("allCheckBox").checked;
    }
}

/*根据单个复选框的选择情况确定全选复选框是否被选中*/
function selectSingle() {
    var k = 0;
    var oInput = document.getElementsByName("cartCheckBox");
    for (var i = 0; i < oInput.length; i++) {
        if (oInput[i].checked == false) {
            k = 1;
            break;
        }
    }
    if (k == 0) {
        document.getElementById("allCheckBox").checked = true;
    } else {
        document.getElementById("allCheckBox").checked = false;
    }
}

/*删除单行商品*/
function deleteRow(id, rowId) {
    swal({
        title: "您确定要删除此商品吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            var Index = document.getElementById(rowId).rowIndex; //获取当前行的索引号
            document.getElementById("shopping").deleteRow(Index);
            document.getElementById("shopping").deleteRow(Index - 1);
            $.ajax({
                type: "post",
                url: del_item_url,
                data: {
                    'id': id
                },
                dataType: "json",
                success: function (response) {
                    if (response['code'] == '1') {
                        swal("删除成功", "您已成功删除", "success")
                    } else {
                        swal("删除失败", "出现了问题", "error")
                    }

                }
            });
            productCount();
        } else {
            swal("已取消", "您取消了删除操作！", "error")
        }
    })
}

/*删除选中行的商品*/
function deleteSelectRow() {
    swal({
        title: "您确定要删除此商品吗",
        text: "删除后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要删除！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            var oInput = document.getElementsByName("cartCheckBox");
            var Index;
            for (var i = oInput.length - 1; i >= 0; i--) {
                if (oInput[i].checked == true) {
                    Index = document.getElementById(oInput[i].value).rowIndex;
                    id = $("#" + oInput[i].value).find('td.cart_td_1').find('input[name=cart_id]').val();
                    document.getElementById("shopping").deleteRow(Index);
                    document.getElementById("shopping").deleteRow(Index - 1);
                    $.ajax({
                        type: "post",
                        url: del_item_url,
                        data: {
                            'id': id
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response['code'] == '1') {
                                swal("删除成功", "您已成功删除", "success");
                            } else {
                                swal("删除失败", "出现了问题", "error");
                            }

                        }
                    });
                }
            }
            productCount();
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    })
}
// 清空购物车
function clearCart() {
    swal({
        title: "您确定要清空购物车吗",
        text: "清空后将无法恢复，请谨慎操作！",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是的，我要清空！",
        cancelButtonText: "让我再考虑一下…",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "post",
                url: clear_cart_url,
                data: {
                    'action': 'clear'
                },
                dataType: "json",
                success: function (response) {
                    if (response['code'] == '1') {
                        $(".cartDiv").remove();
                        swal("成功", "您已成功清空购物车", "success");
                    } else {
                        swal("失败", "出现了问题", "error");
                    }
                }
            });
            productCount();
        } else {
            swal("已取消", "您取消了删除操作！", "error");
        }
    });

}