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
       Route::get('/add-student',['name' => "add.student","uses" => 'StudentManageController@addStudent']);
       Route::get('/info-student',['name' => "info.student","uses" => 'StudentManageController@infoStudent']);
       Route::get('/get-excel-student',['name' => "get.excel.student","uses" => 'StudentManageController@get_excel_info_student']);
   });


    Route::group(['prefix' => 'enterprise-manage','as' => 'enterprise.manage.'],function (){
        Route::get('/',['name' => "index","uses" => 'EnterpriseManageController@enterpriseManage']);
        Route::get('/add-enterprise',['name' => "add.enterprise","uses" => 'EnterpriseManageController@addEnterprise']);
        Route::get('/info-enterprise',['name' => "info.enterprise","uses" => 'EnterpriseManageController@infoEnterprise']);
        Route::get('/get-excel-enterprise',['name' => "get.excel.student","uses" => 'EnterpriseManageController@get_excel_info_enterprise']);
    });
    Route::group(['prefix' => 'job-manage','as' => 'job.manage.'],function (){
        Route::get('/position',['name' => "position","uses" => 'JobManageController@positionsManage']);
        Route::get('/skill',['name' => "skill","uses" => 'JobManageController@skillsManage']);
    });

});


Route::group(['prefix' => 'job','as' => 'job.','namespace' => 'Job'],function (){
    Route::get('list-job',['name' => 'list.job','uses' =>'JobController@list_job']);
});