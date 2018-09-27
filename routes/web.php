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



Auth::routes();


Route::get('list-{cate_id}-{page}.html','ArticleController@article_category');
Route::get('show-{cate_id}-{id}-{page}.html','ArticleController@article_info');

// foreach (\App\Models\ArticleCategory::get() as $val) {
// 	//文章链接
//     if (!empty($val['url'])){
//         Route::get($val['url'], ['as'=>$val['url'],'uses'=>'ArticleController@article_category']);
//         Route::get($val['url']."/{id}",'ArticleController@article_info');
//     }
// }
Route::get("category/{id}",'ArticleController@article_category');
Route::get("article/{id}",'ArticleController@article_info');

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('search', 'HomeController@search');
Route::post('apply-save','ApplyController@apply_save');//申请提交
// Route::post('recruitment-apply-save','RecruitmentApplyController@recruitment_apply_save');//申请提交

Route::post('register-sms-send','SmsController@register_sms_send');//发送注册短信验证码
Route::post('password-reset-sms-send','SmsController@password_reset_sms_send');//发送密码密码短信验证码

Route::get('password-reset','UserController@password_reset');//密码页面
Route::post('password-reset','UserController@password_reset_save');//密码密码
Route::any('unique-user','UserController@unique_user');//ajax验证用户唯一

// Route::get('video-list','VideoController@video_list');//视频课程
// Route::get('video-info/{id}','VideoController@video_info');//视频课程详情
// Route::get('contact-us','ArticleController@contact_us');//联系我们
Route::post('praise/{id}','ArticleController@praise');//联系我们

// Route::any('wechat_notify_url','PayController@wechat_notify_url');//微信支付回调
Route::get('activity','ActivityController@activity_list');//活动
Route::get('activity/{id}','ActivityController@activity_info');//活动

Route::post('collection-save','UserController@collection_save');//收藏


Route::group(['middleware'=>'auth'], function(){
	//需要登陆的路由
	Route::get('download-list','UserController@download_list');//下载列表
	Route::get('download-del/{id}','UserController@download_del');//下载删除
	Route::get('download-save/{id}/{type?}','UserController@download_save');//下载

	
	Route::get('collection-list','UserController@collection_list');//收藏列表
	
	Route::get('collection-del/{id}','UserController@collection_del');//收藏删除


	// Route::get('video-play/{id}','VideoController@video_play');//视频课程观看
	// Route::get('video-pay/{id}','VideoController@video_pay');//视频课程购买
	// Route::post('video-pay-save','VideoController@video_pay_save');//视频课程购买
	// Route::get('member-video-list','VideoController@member_video_list');//视频课程购买

	// Route::get('vip-pay','UserController@vip_pay');//会员vip购买
	// Route::post('vip-pay-save','UserController@vip_pay_save');//会员vip购买提交
	
	// Route::get('member','UserController@member');//个人中心
	// Route::get('member-edit','UserController@member_edit');//个人资料修改
	// Route::get('user-name-edit','UserController@user_name_edit');//个人名称修改
	// Route::get('user-phone-edit','UserController@user_phone_edit');//个人手机修改
	Route::get('user-password-edit','UserController@user_password_edit');//个人密码修改
	// Route::get('member-pic','UserController@member_pic');//会员头像
	// Route::post('member-pic-save','UserController@member_pic_save');//会员上传头像
	// Route::post('user-name-save','UserController@user_name_save');//会员名称修改
	// Route::post('user-bangding-save','UserController@user_bangding_save');//会员名称修改
	Route::post('user-password-save','UserController@user_password_save');//会员密码修改

	// Route::post('bangding-sms-send','SmsController@bangding_sms_send');//发送修改手机验证码
	// Route::post('password-sms-send','SmsController@password_sms_send');//发送修改密码验证码

	// Route::get('pay','PayController@pay');//支付发起
	// Route::post('pay_is','PayController@pay_is');//判断支付是否成功
});

