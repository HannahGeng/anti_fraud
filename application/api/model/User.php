<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2019/1/15
 * Time: 17:30
 */

namespace app\api\model;


use think\Db;

class User
{
    /**
     * 会员注册
     */
    public function regist(){

        $data = array();
        $data['user_phone'] = input("post.user_phone");

        $rs = Db::name('user')->where("user_phone",$data['user_phone'])->find();

        if($rs){
            session('ANTI_USERuserPhone',$data['user_phone']);
            return ANTIReturn("用户已存在",2);
        }

        $data['login_pwd'] = input("post.login_pwd");
        $data['re_pwd'] = input("post.re_pwd");

        if($data['login_pwd']!=$data['re_pwd']){

            return ANTIReturn("两次输入密码不一致!");
        }

        var_dump($data);
        foreach ($data as $v){
            if($v ==''){
                return ANTIReturn("注册信息不完整!");
            }
        }

        $loginName = RandomLoginName($data['user_phone']);

        if($loginName=='')return ANTIReturn("注册失败!分派不了登录名");//分派不了登录名

        $data['login_name'] = $loginName;
        unset($data['re_pwd']);
        //检测账号，邮箱，手机是否存在
        $data["login_secret"] = rand(1000,9999);
        $data['login_pwd'] = md5($data['login_pwd'].$data['login_secret']);
        $data['search_point'] = 1000;
        $data['create_time'] = time();

        $userId = Db::name('user')->insert($data);

        if(false !== $userId){
            session('ANTI_USERuserPhone',$data['user_phone']);
            return ANTIReturn("注册成功！",1);
        }

        return ANTIReturn("注册失败!");
    }

    /**
     * 用户普通登录验证
     */

    public function checkLogin(){
        $loginName = input("post.login_name");
        $loginPwd = input("post.login_pwd");

        $rememberPwd='';

        $rs = Db::name('user')->where("login_name|login_pwd|user_phone",$loginName)->find();

        if(!empty($rs)){
            $userId = $rs['id'];

            if($rs['login_pwd']!=md5($loginPwd.$rs['login_secret']))return ANTIReturn("密码错误");
            $ip = request()->ip();

            Db::name('user')->where(["id"=>$userId])->update(["last_time"=>time(),"last_ip"=>$ip]);

            if(empty($rs['login_name'])){
                cookie("loginName", $loginName,0,'/');
            }else{
                cookie("loginName", $rs['login_name'],0,'/');
            }

            if($rememberPwd == "on"){
                $datakey = md5($rs['login_name'])."_".md5($rs['login_pwd']);
                $key = $rs['login_secret'];
                //加密
                $loginKey = base64_encode($datakey, $key);
                cookie("loginPwd", $loginKey);
            }else{
                cookie("loginPwd", null);
            }
            session('ANTI_USER',$rs);
            return ANTIReturn("登录成功","1");
        }
        return ANTIReturn("用户不存在，请注册");
    }

    /**
     * 扣除查询分
     */
    public function subPoint(){

        Db::name('user')->where("id",(int)session('ANTI_USER.id'))->setDec('search_point',1);
    }

    /**
     * 获取当前查询分
     */
    public function getPoint(){
        $point = Db::name('user')
            ->where("id",(int)session('ANTI_USER.id'))
            ->find()['search_point'];

        return $point;
    }
}