<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2019/1/15
 * Time: 17:30
 */

namespace app\api\model;


class User
{
    /**
     * 会员注册
     */
    public function regist(){

        $data = array();
        $data['userPhone'] = input("post.userPhone");

        $rs = $this->where("userPhone",$data['userPhone'])
            ->where(["dataFlag"=>1])
            ->find();
        if($rs){
            if($rs->userStatus==0){
                session('ZHL_USERuserPhone',$data['userPhone']);
                return ZHLReturn("保存失败，用户已登记过，请直接验证手机号码",2);
            }
        }

        $data['loginPwd'] = input("post.loginPwd");
        $data['reUserPwd'] = input("post.reUserPwd");

        if($data['loginPwd']!=$data['reUserPwd']){
            return ZHLReturn("两次输入密码不一致!");
        }

        foreach ($data as $v){
            if($v ==''){
                return ZHLReturn("注册信息不完整!");
            }
        }


        $loginName = ZHLRandomLoginName($data['userPhone']);

        if($loginName=='')return ZHLReturn("注册失败!分派不了登录名");//分派不了登录名

        $data['loginName'] = $loginName;
        unset($data['reUserPwd']);
        unset($data['protocol']);
        //检测账号，邮箱，手机是否存在
        $data["loginSecret"] = rand(1000,9999);
        $data['loginPwd'] = md5($data['loginPwd'].$data['loginSecret']);
        $data['searchPoint'] = 1000;
        $data['createTime'] = date('Y-m-d H:i:s');
        $data['dataFlag'] = 1;

        $userId = $this->data($data)->save();
        if(false !== $userId){
            session('ZHL_USERuserPhone',$data['userPhone']);
            return ZHLReturn("注册成功！",1);
        }

        return ZHLReturn("注册失败!");
    }
}