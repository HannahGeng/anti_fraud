<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2019/1/15
 * Time: 17:30
 */

namespace app\api\model;

use think\Db;

class UserSearchLog
{
    public static function saveHistory($result){
        $data = [];
        $data['user_id'] = (int)session('ANTI_USER.id');
        $data['mobile'] = $result['result']['Mobile'];
        $data['area_code'] = $result['result']['Area'];
        $data['result'] = $result['result']['CheckResult'];
        $data['create_date'] = date('Ymd');
        $data['create_time'] = time();

        Db::name('UserSearchLog')->insert($data);
        Db::name('user')->where("id",(int)session('ANTI_USER.id'))->setDec('search_point',1);
    }

    public static function getHistory(){
        $user_id = (int)session('ANTI_USER.id');

        $field = "id,mobile,area_code,result";

        $result = Db::name('UserSearchLog')
            ->field($field)
            ->where(['user_id'=>$user_id,'create_date'=>date('Ymd')])
            ->order('id desc')
            ->select();

        return $result;
    }
}