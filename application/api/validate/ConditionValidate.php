<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2018/12/14
 * Time: 17:25
 */

namespace app\api\validate;

class ConditionValidate extends BaseValidate
{
    protected $rule = [
        'mobile'=>'mobile',
        'areacodes'=>'checkCodes'
    ];

    protected $message = [
        'mobile' => '手机号格式错误',
        'areacodes' => 'areacodes必须是以逗号分隔的多个地区编号',
    ];

    protected function checkCodes($value)
    {
        $values = explode(',',$value);
        if (empty($values)){
            return false;
        }
        foreach ($values as $id){
            if (!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }
}