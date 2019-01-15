<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2019/1/15
 * Time: 17:29
 */

namespace app\api\controller;
use app\api\model\User as MUser;

class User
{
    public function register(){
        $m = new MUser();
        $rs = $m->regist();
    }
}