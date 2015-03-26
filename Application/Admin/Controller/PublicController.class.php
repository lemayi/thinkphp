<?php

namespace Admin\Controller;
use Think\Controller;

class PublicController extends Controller {
    
    public function login($username = null, $password = null, $verify = null){
        if(IS_POST){
            /* 检测验证码 */
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }
            // 检测用户名/密码
            $Member = D('Member');
            $uid = $Member->login($username, $password);
            if(false === $uid){
                $this->error($Member->getError());
            }else{
                $this->success('登录成功！', '/index');
            }
        }
        $this->display();
    }

    public function logout(){
        $this->show('logout');
    }

    public function verify(){
        $verify = new \Think\Verify();
        $verify->entry(1);
    }

}