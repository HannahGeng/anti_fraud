<?php
/**
 * Created by PhpStorm.
 * User: cjt
 * Date: 2018/12/17
 * Time: 9:38
 */

namespace app\lib\exception;

use think\Config;
use think\Db;
use think\Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    //需要返回客户端当前请求的URL路径
    public function render(\Exception $ex)
    {
        if ($ex instanceof BaseException){
            //如果是自定义的异常
            $this->code = $ex->code;
            $this->msg = $ex->msg;
            $this->errorCode = $ex->errorCode;
        }
        else{
            if (config('app.app_debug'))
            {
                return parent::render($ex);
            }
            else
            {
                $this->code = 500;
                $this->msg = '服务器内部错误，不想告诉你';
                $this->errorCode = 999;
//                $this->recordErrorLog($ex);
            }

        }

        $request = Request();

        $result = [
            'msg'=>$this->msg,
            'error_code'=>$this->errorCode,
            'request_url'=>$request->url()
        ];

        return json($result,$this->code);
    }

    public function recordErrorLog(Exception $e)
    {
        Log::init([
            'type'  => 'File',
            // 日志保存目录
            'path'  => LOG_PATH,
            // 日志记录级别
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(),'error');
    }

}