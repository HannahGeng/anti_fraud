<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2018/12/18
 * Time: 13:43
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}