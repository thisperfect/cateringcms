<?php
/**
 * passwdSet 安全加密
 *
 * @param string $pass  密码明文
 * @return string       密码密文
 */
function passwdSet($pass){
    vendor('Password.password');
    $passwd = new \Vendor\Password\Password;
    $bcryptPass=$passwd->setPassword($pass);
    return $bcryptPass;
}
/**
 * passCrypt 混合参数加密
 *
 * @param string $psw
 * @return string
 */
function passCrypt($psw){
    $apass=MD5($psw);
    $salt=mb_substr($apass,9,13,'utf-8');
    $bpass=crypt($apass,$salt);
    return $bpass;
}
/**
 * sendMail 验证码发送
 *
 * @param [string] $sendTo  收件人邮箱
 * @param [string] $time    请求时间
 * @param [string] $url     请求链接
 * @return boolean          返回信息
 */
function sendMail($sendTo,$time,$url,$body=0){
    vendor('PHPMailer.PHPMailerAutoload');
    date_default_timezone_set('Asia/Shanghai');             // 设定时区东八区
    $mail = new PHPMailer;                                  // 建立邮件发送类
    $mail->CharSet =C('MAIL_CHARSET');                      // 设置编码。否则发送中文乱码
    if(C('MAIL_SMTP')){                                     // 使用SMTP方式发送
        $mail->isSMTP();
    }                                     
    $mail->Host = C('MAIL_HOST');                           // SMTP邮箱服务器域名
    $mail->SMTPAuth = C('MAIL_SMTPAUTH');                   // 启用SMTP验证功能
    $mail->Username = C('MAIL_USERNAME');                   // SMTP 用户名
    $mail->Password = C('MAIL_PASSWORD');                   // SMTP 密码
    $mail->SMTPSecure = C('MAIL_SECURE');                   // 加密方式 ssl/tls
    $mail->Port = C('MAIL_PORT');                           // 端口
    $mail->setFrom(C('MAIL_USERNAME'), C('MAIL_FROMNAME'));       // 发件人
    $mail->addAddress($sendTo);                                   // 收件人
    $mail->isHTML(C('MAIL_ISHTML'));                              // 是否使用HTML格式

    $mail->Subject = '验证邮件';                                                           // 主题
    if($body==0){
        $mail->Body    = "亲爱的".$sendTo."：<br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码（链接30分钟内有效）。<br/><a href='".$url."' target='_blank'>".$url."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。<br/>如果您没有提交找回密码请求，请忽略此邮件。<br/>在你点击上面链接修改密码之前，你的密码将会保持不变。"; 
    }else{
        $mail->Body    = "亲爱的".$sendTo."：<br/>您在".$time."注册了网站账号。请点击下面的链接认证账号。<br/><a href='".$url."' target='_blank'>".$url."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。<br/>如果您没有注册，请忽略此邮件。<br/>如无法认证，请联系管理员。"; 
    }                      

    if(!$mail->send()) {
        return false;
    } else {
        return true;
    }
}
/**
 * 设置验证码
 *
 * @param string $config 验证配置
 * @return string
 */
function show_verify($config=''){
    if($config==''){
        $config=array(
            'fontSize'    =>    35,    // 验证码字体大小
            'length'      =>    5,     // 验证码位数
            'useNoise'    =>    true,  // 杂点
            'useCurve'    =>    true   //混淆线
            );
    }
    $verify=new \Think\Verify($config);
    return $verify->entry();
}
// 检测验证码
function check_verify($code){
    $verify=new \Think\Verify();
    return $verify->check($code);
}
/**
 * 发送HTTP请求
 *
 * @param string $url 请求地址
 * @param array $data 发送数据
 * @param string $refererUrl 请求来源地址
 * @param string $method 请求方式 GET/POST
 * @param string $contentType 
 * @param string $timeout
 * @param string $proxy
 * @return boolean
 */
function send_request($url, $data, $refererUrl = '', $method = 'GET', $contentType = 'application/json', $timeout = 30, $proxy = false) {
    $ch = null;
    if('POST' === strtoupper($method)) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER,0 );
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        if ($refererUrl) {
            curl_setopt($ch, CURLOPT_REFERER, $refererUrl);
        }
        if($contentType) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:'.$contentType));
        }
        if(is_string($data)){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
    } else if('GET' === strtoupper($method)) {
        if(is_string($data)) {
            $real_url = $url. (strpos($url, '?') === false ? '?' : ''). $data;
        } else {
            $real_url = $url. (strpos($url, '?') === false ? '?' : ''). http_build_query($data);
        }
 
        $ch = curl_init($real_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:'.$contentType));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        if ($refererUrl) {
            curl_setopt($ch, CURLOPT_REFERER, $refererUrl);
        }
    } else {
        $args = func_get_args();
        return false;
    }
 
    if($proxy) {
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    $ret = curl_exec($ch);
    $info = curl_getinfo($ch);
    $contents = array(
            'httpInfo' => array(
                    'send' => $data,
                    'url' => $url,
                    'ret' => $ret,
                    'http' => $info,
            )
    );
 
    curl_close($ch);
    return $ret;
}