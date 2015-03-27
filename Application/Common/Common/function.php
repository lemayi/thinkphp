<?php 

// 生成密码盐
function generate_salt(){
    return md5(uniqid() . str_shuffle(C('PASSWORD_SALT')));
}

// 生成密码
function generate_password($password, $salt){
    return md5(sha1($salt). $password);
}

// 验证密码
function verify_password($passwordInput, $salt, $password){
    dump(generate_password($passwordInput, $salt));
    dump($password);
    return generate_password($passwordInput, $salt) === $password;
}

// 时间戳格式化
function time_format($time = NULL,$format='Y-m-d H:i'){
    $time = $time === NULL ? NOW_TIME : intval($time);
    return date($format, $time);
}

// 状态格式化
function status_text($status){
    $status = intval($status);
    switch ($status) {
        case 0:
            return '禁用';
        case 1:
            return '启用';
        default:
            return '-';
    }
}

// 检测验证码
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}