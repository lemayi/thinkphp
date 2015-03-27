<?php

namespace Admin\Controller;
use Think\Controller;

class MemberController extends AdminController {
    
    public function index(){
        $username =   I('username', '', 'trim');
        
        if(!empty($username)){
            $map['username'] = array('like', '%'.$username.'%');
        }
        if(isset($_GET['status'])){
            $map['status'] = I('status', 0, 'intval');
        }

        $list   = $this->lists('Member', $map);
        $this->assign('_list', $list);

        $this->meta_title = '用户管理';
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $Member = D('Member');
            $rs = $Member->register();
            if(false === $rs){
                $this->error($Member->getError());
            }else{
                $this->success('用户添加成功！',U('index'));
            }
        }
        $this->meta_title = '新增用户';
        $this->display();
    }

    public function edit(){
        if(IS_POST){
            $Member = D('Member');
            if($Member->create()){
                $Member->save();
                $this->success('更新用户信息成功！',U('index'));
            }else{
                $this->error($Member->getError());
            }
        }

        $id     = I('get.id', 0, 'intval');
        $member = D('Member')->find($id);

        $this->assign('member', $member);
        $this->meta_title = '编辑用户';
        $this->display();
    }

    // 用户状态修改
    public function changeStatus($method=null){
        $id = array_unique((array)I('id',0));
        $id = is_array($id) ? implode(',',$id) : $id;
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map['id'] = array('in',$id);
        switch ( strtolower($method) ){
            case 'forbid':
                $this->forbid('Member', $map);
                break;
            case 'resume':
                $this->resume('Member', $map);
                break;
            case 'delete':
                $this->delete('Member', $map);
                break;
            default:
                $this->error('参数非法');
        }
    }
}