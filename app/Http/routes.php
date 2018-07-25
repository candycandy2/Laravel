<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

//一、路由中的多參數
/*
Route::get('movie/{movie_id}/review/{review_id}',function($movie_id,$review_id)
{
return '電影'.$movie_id. '裡面的影評' . $review_id;
});
 */
//二、路由中的多參數可選，沒輸入有默認值
/*
Route::get('movie/{movie_id}/review/{review_id?}',function($movie_id,$review_id='123')
{
return '電影'.$movie_id. '裡面的影評' . $review_id;
});
 */
//三、路由中的多參數可選，沒輸入有默認值限制路由中的参数值的类型20180717
/*
Route::get('movie/{movie_id}/review/{review_id?}',function($movie_id,$review_id='123')
{
return '電影'.$movie_id. '裡面的影評' . $review_id;
})
->where('movie_id','[0-9]+' 'review_id','[0-9]+');
 */
//只能打數字
//如果打英文字NotFoundHttpException in RouteCollection.php
//->where('movie_id','[A-Za-z]+');//+表字數任意

//四、在全局限制路由参数值的类型
Route::get('movie/{movie_id}/review/{review_id?}', function ($movie_id, $review_id = '123') {
    return '電影' . $movie_id . '裡面的影評' . $review_id;
});
/*
在provider 資料夾內 RouteServiceProvider.php ,boot 函式內加上
$router->pattern('movie_id', '[0-9]+');
$router->pattern('review_id','[0-9]+');
 */
//================================================================
//三、路由
Route::get('/', function () {
    return view('welcome');
});



//五、Route命名---------------------
Route::get('user/login', ['as' => 'Routelogin', function () { //命名
    return '用戶登入';
}]);
//http://localhost:8080/candyproject1/public/user/login
Route::get('user/profile', function () {
    //
    return redirect()->route('Routelogin'); //路由名字
});
//http://localhost:8080/candyproject1/public/user/profile =>重導向
//--------------------------------------------------------------

//六、路由群组
Route::group(['prefix' => 'admin'], function () {
//路由群組，前綴是admin，利用prefix 參數指定
    Route::get('user', function () {
        return '管理用戶';
    });
    Route::get('content', function () {
        return '管理內容';
    });
});

///candyproject1/public/admin/user    =>管理用戶
// candyproject1/public/admin/content =>管理內容
// php artisan route:list
//--------------------------------------------------------------

// 控制器

//一、在路由里使用控制器
//Route 路由 add
Route::get('movie', function () {
    return '電影列表!1';
});
//--Add controller  App\Http\Controllers
///Route::get('movie/{id}', 'MovieController@showMovie');
//--控制器名: MovieController
//--控制器方法 : showMovie
//--不指名地址


Route::get('moviehi', 'MovieController@showMovie');
//Project ===================
Route::get('hellohi', function () {
    return view("helloworld");
//    return '電影列表!1';
});


Route::get('movie', function () {
    return '電影列表!1';
});


Route::get('movies', 'MovieController@import');

Route::any('/user/icon-upload','MovieController@upload');
//=============================================
Route::get('/uploadfile1',function () {//原本get顯示
    return view("helloworld");
});
//'MovieController@index');//顯示用get
//Route::post('/uploadfile','MovieController@showUploadFile');//
Route::post('/uploadfile1','MovieController@upload');//
//上傳是用post
//=============================================

Route::get('/uploadfile','UploadFileController@index');
Route::post('/uploadfile','UploadFileController@showUploadFile');
//Route::get('hellohi', 'MovieController@showTab');
//==================================================