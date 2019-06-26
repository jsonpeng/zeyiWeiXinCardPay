<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//验证码
Route::group(['middleware' => ['api']], function () {
	//发送短信验证码
	//Route::get('/sendCode', 'Front\UserController@sendCode');
});

//微信支付购买会员
Route::get('/memberbuy/{action}', 'Front\PayController@buyActionMember');
Route::any('/notify', 'Front\PayController@payNotify');

/**
 * 认证
 */
Route::group([ 'prefix' => 'auth', 'namespace' => 'Front'], function () {

	//Route::get('login', 'AuthController@showLoginForm');
	//Route::post('login', 'AuthController@postLogin');
	//Route::get('logout', 'AuthController@logout');
	//Route::get('register', 'AuthController@register');
	//Route::post('register', 'AuthController@postRegister');
	//Route::get('reset_password', 'AuthController@resetPassword');
	//Route::post('reset_password', 'AuthController@postResetPassword');
	//更改绑定手机号
	Route::get('reset_mobile', 'AuthController@resetMobile');
	//绑定手机号
	Route::get('mobile', 'AuthController@mobile');
});


//短信
Route::get('/sendCode', 'Front\FrontController@sendCode');
//手机号注册
Route::post('/post_mobile', 'Front\FrontController@postMobile');


/**
 * ajax操作
 */
Route::group([ 'prefix' => 'ajax', 'namespace' => 'Front'], function () {

	/**
	 * 项目操作
	 */
	Route::group(['prefix' => 'project'], function () {
		//更新
		Route::get('/{id}/update', 'AjaxController@updateProject');
		//查看 及时更新
		Route::get('/{id}/show','AjaxController@showProject');
		//添加
		Route::get('/store', 'AjaxController@storeProject');
		//删除
		Route::get('/{id}/delete', 'AjaxController@deleteProject');
		//收藏
		Route::get('/{id}/attach/{status}', 'AjaxController@attachProject');
	});

	/**
	 * 公司操作
	 */
	Route::group(['prefix' => 'company'], function () {
		//添加
		Route::get('/store', 'AjaxController@storeCompany');
		//收藏
		Route::get('/{id}/attach/{status}', 'AjaxController@attachCompany');
		//提交企业纠错信息
		Route::get('/submitErrorInfo','AjaxController@submitCompanyErrorInfo');
		//更新纠错信息
		Route::get('{id}/updateErrorInfo','AjaxController@updateCompanyErrorInfo');
	});

	/**
	 * 分页获取数据
	 */
	Route::get('/paginage/{type}','AjaxController@paginageToGetData');

	//图片上传
	Route::post('/uploads','AjaxController@uploadImage');

});

//微信中间件
$mid = ['web', 'wechat.oauth:snsapi_userinfo', 'auth.user'];
if (Config::get('web.app_env') == 'local'){
	$mid = ['web', 'auth.user'];
}

Route::group(['middleware' => $mid, 'namespace' => 'Front'], function () {
	//首页
	Route::get('/', 'FrontController@index');
	Route::get('/protocal', 'FrontController@protocal');
	Route::get('/intro', 'FrontController@intro');
	//公司详情
	Route::get('{id}/company_detail', 'FrontController@companyDetail');
	//优秀企业
	Route::get('/company/list', 'FrontController@companyList');
	//项目列表
	Route::get('/projects/{type?}/{project_type?}', 'FrontController@projects');
    
   

	//项目
	Route::group(['prefix' => 'project'], function () {
		//
		Route::get('/', 'ProjectController@index');
		//创建
		Route::get('/create', 'ProjectController@create');
		//编辑
		Route::get('/{id}/edit', 'ProjectController@edit');
		//展示
		Route::get('{id}/show', 'ProjectController@show');
		//删除
		//Route::get('/delete', 'ProjectController@delete');
		//测试
		Route::get('test', 'ProjectController@test');
	});

	//个人中心
	Route::group(['prefix' => 'usercenter'], function () {
		//个人中心主页
		Route::get('/', 'UserController@index');
		//会员购买
		Route::get('/member', 'UserController@member');
		//会员升级
		Route::get('/memberLevelup', 'UserController@memberLevelup');
		//我的公司
		Route::get('/company', 'UserController@company');
		//创建公司
		Route::get('/company/create', 'UserController@companyCreate');
		//二维码
		Route::get('/erweima', 'UserController@erweima');
		//我的收藏
		Route::get('/collections/{type?}', 'UserController@collections');
		//联系管理员
		Route::get('/manager', 'UserController@manager');
		//分享记录
		Route::get('/share/{type?}','UserController@share');
		 //我要推广
    	Route::get('/promote/{id}','UserController@promote');
	});

	//文章系统
	Route::get('cat/{id}', 'FrontController@cat')->name('category');
	Route::get('post/{id}', 'FrontController@post')->name('post');
	Route::get('page/{id}', 'FrontController@page')->name('page');

});