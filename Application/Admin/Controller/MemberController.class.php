<?php

namespace Admin\Controller;
use Think\Controller;

class MemberController extends Controller {
    
    public function index(){
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $rs = D('Member')->register();
            if($rs){
                $this->success('用户添加成功！',U('index'));
            }else{
                $this->error($rs);
            }
        }
        $this->meta_title = '新增用户';
        $this->display();
    }

    public function edit(){
        $this->display();
    }

}