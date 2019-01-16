<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Db;

/**
 * 生成随机数账号
 */
function RandomLoginName($loginName){
    $chars = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    //简单的派字母
    foreach ($chars as $key =>$c){
        $crs = CheckLoginKey($loginName."_".$c);
        if($crs['code']==1)return $loginName."_".$c;
    }
    //随机派三位数值
    for($i=0;$i<1000;$i++){
        $crs = $this->CheckLoginKey($loginName."_".$i);
        if($crs['code']==1)return $loginName."_".$i;
    }
    return '';
}

/**
 * 生成数据返回值
 */
function ANTIReturn($msg,$status = -1,$data = []){
    $rs = ['code'=>$status,'msg'=>$msg];
    if(!empty($data))$rs['data'] = $data;

    return $rs;
}

/**
 * 检测登录账号是否可用
 * @param $key 要检测的内容
 */
function CheckLoginKey($val,$userId = 0){
    if($val=='')return ANTIReturn("登录账号不能为空");

    $dbo = Db::name('user')->where(["login_name|user_phone"=>['=',$val]]);

    if($userId>0){
        $dbo->where("id", "<>", $userId);
    }
//    $rs = $dbo->count();
    $rs = 0;

    if($rs==0){
        return ANTIReturn("该登录账号可用",1);
    }
    return ANTIReturn("对不起，登录账号已存在");
}