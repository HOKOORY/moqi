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

use think\Route;

Route::post("api/:version/saveuser", "api/:version.User/SaveUser");  //创建用户 传入code , name , avatar
Route::post("api/:version/gettoken", "api/:version.Token/getToken");  //获取该用户的token 传入code
Route::post("api/:version/saveformid", "api/:version.FormID/SaveFormID");  //保存formid
Route::post("api/:version/validateimage", "api/:version.ValidateImage/ValidateImage");  //识别图片
Route::post("api/:version/blurry", "api/:version.Blurry/Blurry");  //加密图片
Route::post("api/:version/uploadimage", "api/:version.Image/UploadImage");  //上传图片
Route::post("api/:version/getimage", "api/:version.Image/GetImage");  //拿图片
Route::rule("api/:version/getproblemlist", "api/:version.Problem/GetProblemList");  //获取题库的题目
Route::rule("api/:version/getproblem", "api/:version.Problem/GetProblem");  //获取题目
Route::rule("api/:version/saveproblem", "api/:version.Problem/SaveProblem");  //保存答题
Route::rule("api/:version/subjectrecord", "api/:version.Problem/SubjectRecord");  //出题记录
Route::rule("api/:version/answerquestion", "api/:version.Problem/AnswerQuestion");  //回答问题
Route::rule("api/:version/isright", "api/:version.Problem/isAnswer");  //回答问题
Route::rule("api/:version/answererrecord", "api/:version.Problem/AnswererRecord");  //回答问题的记录
Route::rule("api/:version/answerdetail", "api/:version.Problem/AnswerDetail");  //回答问题详情
Route::rule("api/:version/saveshow", "api/:version.Show/SaveShow");  //保存展示的数据
Route::rule("api/:version/getshow", "api/:version.Show/GetShow");  //拿展示的数据
Route::rule("api/:version/pay", "api/:version.Order/CreatePreOrder");  //付钱


Route::rule("api/:version/getqrcode", "api/:version.QRcode/GetQRcode");  //获取二维码


Route::rule('api/:version/test', 'api/:version.Test/test');
Route::rule('api/:version/test1', 'api/:version.Test1/test1');
Route::rule('api/:version/test2', 'api/:version.Test2/test2');
Route::rule('api/:version/test3', 'api/:version.Test3/test3');
Route::rule('api/:version/test4', 'api/:version.Test4/entry');
//Route::rule('api/:version/test5', 'api/:version.Test4/check');
Route::rule('api/:version/test5', 'api/:version.Test5/test5');
Route::rule('api/:version/GetBuild', 'api/:version.Test2/GetBuild');