<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2018/12/15
 * Time: 9:25
 */

namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http传入的参数
        $request = Request();
        $params = $request->param();

        //对参数进行校验
        $result = $this->batch()->check($params);

        if (!$result){
            $e = new ParameterException([
                'msg'=>$this->error,
            ]);

            throw $e;
        }
        else{
            return true;
        }
    }

    protected function isPositiveInteger($value,$rule='',$data='',$field='')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        }
        else{
            return false;
        }
    }

}