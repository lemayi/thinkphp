<?php

namespace Admin\Controller;
use Think\Controller;

class PublicController extends Controller {
    
    public function login(){
        if(IS_POST){
            $username = I('post.username', '', 'trim');
            $password = I('post.password', '', 'trim');
            $verify   = I('post.verify', '', 'trim');
            /* 检测验证码 */
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }
            // 检测用户名/密码
            $id = D('Member')->login($username, $password);
            if(false === $id){
                $this->error($id);
            }else{
                $this->success('登录成功！', U('index/index'));
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