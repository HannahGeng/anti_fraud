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

//特定查询
Route::get('search/special/:member_id', 'api/search/special');

//范查询
Route::get('search/widely/:member_id', 'api/search/widely');

//条件查询
Route::get('search/condition/:member_id', 'api/search/condition');

//剩余查询积分
Route::get('search/points/:member_id', 'api/home/points');

//查询历史
Route::get('search/history/:member_id', 'api/search/history');

//载入策略
Route::get('search/get/:member_id', 'api/search/get');

//保存策略
Route::get('search/save/:member_id', 'api/search/save');