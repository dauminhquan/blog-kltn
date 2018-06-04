<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'],function(){


    Route::group(["prefix" => '/admin','name' => 'api.admin.','namespace' =>'Admin'],function (){

        // quan ly sinh vien
        Route::group(['prefix' => '/student-manage','name' => 'student.manage.'],function (){
            //them sinh vien bang file excel
            Route::post('/add-student-excel',['name' => 'add.student.excel','uses' => 'StudentManageController@add_student_excel']);
            Route::get('/get-list-student',['name' => 'get.list.student','uses' => 'StudentManageController@get_list_student']);
            Route::delete('/delete-list-student',['name' => 'delete.list.student','uses' => 'StudentManageController@delete_list_student']);
            Route::delete('/delete-student',['name' => 'delete.student','uses' => 'StudentManageController@delete_student']);
            Route::post('/add-student',['name' => 'add.student','uses' => 'StudentManageController@add_student']);
            Route::put('/update-student',['name' => 'add.student','uses' => 'StudentManageController@update_student']);

        });

    });


    Route::group(['prefix' => '/request-info','name' => 'get.info.'],function (){
        Route::get('get-courses','RequestInfoController@get_courses');
        Route::get('get-departments','RequestInfoController@get_departments');
        Route::get('get-branches/{department}','RequestInfoController@get_branches_with_code_departments');
        Route::post('check-exist-info-student','RequestInfoController@check_exist_info_student');
        Route::get('get-option-student','RequestInfoController@get_option_student');
        Route::get('get-info-student','RequestInfoController@get_student_with_code_student');
    });
});

