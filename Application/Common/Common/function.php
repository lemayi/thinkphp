<?php 

// 生成密码盐
function generate_salt(){
    return md5(uniqid() . str_shuffle(C('PASSWORD_SALT')));
}

// 生成密码
function generate_password($password, $salt){
    return md5(sha1($salt). $password);
}