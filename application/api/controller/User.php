<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2019/1/15
 * Time: 17:29
 */

namespace app\api\controller;
use app\api\model\User as MUser;
use app\api\validate\UserLoginValidate;
use app\api\validate\UserRegisterValidate;

class User
{
    public function register(){

        (new  UserRegisterValidate())->goCheck();
        $m = new MUser();
        $rs = $m->regist();

        return json($rs);
    }

    public function login(){

        (new  UserLoginValidate())->goCheck();
        $m = new MUser();
        $rs = $m->checkLogin();

        return json($rs);
    }

    //剩余查询积分
    public function points(){

        $m = new MUser();
        $rs = $m->getPoint();

        return json(ANTIReturn($rs,1));
    }
}