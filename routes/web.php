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

Route::get('/', function () {
    return view('layout');
});
Route::get('/datatable',function (){
    return view('datatable');
});
Route::get('/list-job',function (){
   return view('list_job');
});

//admin

Route::group(['prefix' => 'admin','as' => 'admin.','namespace' => 'Admin'],function (){
   Route::group(['prefix' => 'student-manage','as' => 'student.manage.'],function (){
      Route::get('/',['name' => "index","uses" => 'StudentManageController@studentManage']);
   });
});