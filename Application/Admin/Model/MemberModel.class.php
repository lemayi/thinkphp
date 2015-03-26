<?php

namespace Admin\Model;
use Think\Model;

class MemberModel extends Model{

    /* 用户模型自动验证 */
    protected $_validate = array(
        /* 验证用户名 */
        array('username', '2,20', "用户名长度不小于2个字符或不大于20个字符", self::EXISTS_VALIDATE, 'length'), //用户名长度不合法
        array('username', 'checkDenyMember', "该用户名不允许被注册", self::EXISTS_VALIDATE, 'callback'), //用户名禁止注册
        array('username', '', "用户名已经被注册", self::EXISTS_VALIDATE, 'unique'), //用户名被占用

        /* 验证密码 */
        array('password', '6,30', "密码长度不小于2个字符或不大于20个字符", self::EXISTS_VALIDATE, 'length'), //密码长度不合法
        
        /* 验证确认密码 */
        array('repassword','password', "两次输入密码不一致", self::EXISTS_VALIDATE, 'confirm'), // 验证确认密码是否和密码一致

        /* 验证邮箱 */
        array('email', 'email', "邮箱格式不正确", self::EXISTS_VALIDATE), //邮箱格式不正确
        array('email', 'checkDenyEmail', "该邮箱不允许被注册", self::EXISTS_VALIDATE, 'callback'), //邮箱禁止注册
        array('email', '', "邮箱已经被注册", self::EXISTS_VALIDATE, 'unique'), //邮箱被占用

        /* 验证手机号码 */
        array('mobile', 'number', "手机号格式不正确", self::EXISTS_VALIDATE), //手机号格式不正确
        array('mobile', 'checkDenyMobile', "该手机号不允许被注册", self::EXISTS_VALIDATE, 'callback'), //手机禁止注册
        array('mobile', '', "手机号已经被注册", self::EXISTS_VALIDATE, 'unique'), //手机号被占用
    );

    /* 用户模型自动完成 */
    protected $_auto = array(
        array('reg_time', NOW_TIME, self::MODEL_INSERT),
        array('reg_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
        array('status', 1, self::MODEL_INSERT),
        array('created_at', NOW_TIME, self::MODEL_INSERT),
        array('updated_at', NOW_TIME),
    );

    // 检测用户名是不是被禁止注册
    protected function checkDenyMember($username){
        return true; //TODO: 暂不限制，下一个版本完善
    }

    // 检测邮箱是不是被禁止注册
    protected function checkDenyEmail($email){
        return true; //TODO: 暂不限制，下一个版本完善
    }

    // 检测手机是不是被禁止注册
    protected function checkDenyMobile($mobile){
        return true; //TODO: 暂不限制，下一个版本完善
    }

    // 注册用户
    public function register(){
        $data = I('post.');
        unset($data['repassword']);
        $data['salt']       = generate_salt();
        $data['password']   = generate_password($data['password'], $data['salt']);
dump($data);
        $data = $this->create($data);
dump($data);die;
        if($data){
            $id = $this->add($data);
            return $id ? $id : "未知错误";
        }else{
            return $this->getError();
        }
    }

}
