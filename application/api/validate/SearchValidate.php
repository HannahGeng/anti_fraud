<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2018/12/14
 * Time: 17:25
 */

namespace app\api\validate;

class SearchValidate extends BaseValidate
{
    protected $rule = [
        'mobile'=>'mobile',
        'areacode'=>'number'
    ];

    protected $message = [
        'mobile' => '手机号格式错误',
        'areacode' => 'areacode格式错误',
    ];
}