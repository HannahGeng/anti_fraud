<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2018/12/14
 * Time: 17:25
 */

namespace app\api\validate;

class UserLoginValidate extends BaseValidate
{
    protected $rule = [
        'login_name'=>'require',
        'login_pwd'=>'require'
    ];

    protected $message = [
        'login_name' => '登录名不得为空',
        'login_pwd' => '密码不得为空'
    ];
}