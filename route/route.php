<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//查询历史
//关注人员
//计划任务
//位置记录

//特定查询、范查询
Route::get('search/special', 'api/search/special');

//条件查询
Route::get('search/condition', 'api/search/condition');

//查询历史
Route::get('search/history', 'api/search/history');

//载入策略
Route::get('search/get', 'api/search/get');

//保存策略
Route::get('search/save', 'api/search/save');

//剩余查询积分
Route::get('user/points', 'api/user/points');

//用户登录
Route::post('user/login', 'api/user/login');

//用户注册
Route::post('user/register', 'api/user/register');

