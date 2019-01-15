<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2019/1/10
 * Time: 10:36
 */

namespace app\api\controller;

use app\api\validate\SearchValidate;

class Search
{
    //特定查询
    public function special(){

        (new SearchValidate())->goCheck();
        //手机号码
        $mobile = input("get.mobile");
        //区号
        $areacode = input("get.areacode");

        $result = $this->search($mobile,$areacode);

        return json($result);
    }

    //泛查询
    public function widely(){

        (new SearchValidate())->goCheck();

        //手机号码
        $mobile = input("mobile");

        $result = $this->search($mobile,'');

        return json($result);
    }

    //条件查询
    public function condition(){

    }

    //查询历史
    public function history(){
        //手机号、状态(true\false)
    }

    //载入策略
    public function get(){

    }

    //保存策略
    public function save(){

    }

    /**
     * 主查询
     * @param $mobile 手机号码
     * @param $areacode 城市行政编码
     * @return array|mixed
     */
    public function search($mobile,$areacode){
        //首先检测是否支持curl
        if (!extension_loaded("curl")) {
            trigger_error("对不起，请开启curl功能模块！", E_USER_ERROR);
        }

        $url = sprintf(config('haoservice.url'),$mobile,$areacode,config('haoservice.key'));

        //初始一个curl会话
        $ch = curl_init($url);

        //设置url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER,false);
        $resp=curl_exec($ch);
        curl_close($ch);

        $result = json_decode($resp,true);

        //测试环境下app_debug=true，$result为模拟数据，CheckResult随机生成
        if (config('app.app_debug')){
            $result = [];
            $result['error_code'] = 0;
            $result['reason'] = 0;
            $result['result']['Mobile'] = $mobile;
            $result['result']['Area'] = $areacode;
            $result['result']['CheckResult'] = rand(0,1)?true:false;
        }

        return $result;
    }

}