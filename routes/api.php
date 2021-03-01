<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\QueryItem;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, origin");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['checkIP']], function () {

    Route::post('verify-phone', "PhoneController@verify_phone");
    Route::post('get-code', "PhoneController@get_code");
    // Route::get('/ip', function() {
    //     logger(request()->ip());
    //     logger(gettype(request()->ip()));
    // });

});

Route::post('/argc', function() {
    logger(request()->all());
});



Route::post('/query/cx', "OrderController@cx");
Route::post('/query/wx', "OrderController@wx");
Route::post('/query/vin', "OrderController@vin");
Route::post('/query/jqx', "OrderController@jqx");
Route::post('/query/njzt', "OrderController@njzt");
Route::post('/query/cph', "OrderController@cph");
Route::post('/query/jszzt', "OrderController@jszzt");
Route::post('/query/wz', "OrderController@wz");


Route::post('/order/request_refund', "OrderController@request_refund");


Route::get('/pay/get_pay_url', "PayController@get_pay_url");


Route::get('/result/process_result', "ResultProcessController@process_result");
Route::get('/pay/query', "OrderStatusController@query_status_update");

Route::get('/wechat_pay_status_update', "OrderStatusController@wechat_pay_status_update");

Route::get('/price/{query_item}', function($query_item) {
    return ['origin_price' => sprintf("%.2f", QueryItem::find($query_item)->origin_price),
             'price' =>sprintf("%.2f", QueryItem::find($query_item)->price)];
});

Route::get('/wx_pre/{vin}', 'QueryController@wx_pre');

Route::group(['middleware' => ['token']], function () {

    Route::get('/orders', "UserOrderController@orders");
    

});


Route::post('/car', 'PayController@notify');
Route::post('/ali_pay_notify', 'AlipayController@notify');
Route::post('/wechat_pay_notify', 'WechatpayController@notify');

Route::post('/record', 'RecordController@index');