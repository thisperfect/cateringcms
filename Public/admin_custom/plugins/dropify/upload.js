function pic_upload(id, pic) {
    a = '#' + id;
    b = 'input#' + pic;
    //获取上传文件的名称、类型、大小
    var file = $(a).get(0).files[0];
    if (file) {
        var uri = uploadUrl;
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open("POST", uri, true);
        xhr.onreadystatechange = function(response) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var responseText = xhr.responseText;
                response = JSON.parse(responseText);
                console.log('上传图片成功！');
                $(b).val(response['url']);
                $(a).remove();
            }
        };
        fd.append('file', file);
        xhr.send(fd);
    }
}