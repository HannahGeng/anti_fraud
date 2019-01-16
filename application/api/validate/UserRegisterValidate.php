<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2018/12/14
 * Time: 17:25
 */

namespace app\api\validate;

class UserRegisterValidate extends BaseValidate
{
    protected $rule = [
        'user_phone'=>'require|mobile',
        'login_pwd'=>'require',
        're_pwd'=>'require'
    ];

    protected $message = [
        'mobile' => '手机号不得为空|手机号格式错误',
        'login_pwd' => 'login_pwd不得为空',
        're_pwd' => 're_pwd不得为空',
    ];
}