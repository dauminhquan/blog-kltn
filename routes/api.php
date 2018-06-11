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
            Route::post('/update-avatar-student',['name' => 'update.avatar.student','uses' => 'StudentManageController@update_avatar_student']);
            Route::get('/get-work-student',['name' => 'get.work.student','uses' => 'StudentManageController@get_work_student']);
        });
        // quan ly doanh nghiẹp

        Route::group(['prefix' => '/enterprise-manage','name' => 'enterprise.manage.'],function (){
            //them sinh vien bang file excel
            Route::post('/add-enterprise-excel',['name' => 'add.enterprise.excel','uses' => 'EnterpriseManageController@add_enterprise_excel']);
            Route::get('/get-list-enterprise',['name' => 'get.list.enterprise','uses' => 'EnterpriseManageController@get_list_enterprise']);
            Route::delete('/delete-list-enterprise',['name' => 'delete.list.enterprise','uses' => 'EnterpriseManageController@delete_list_enterprise']);
            Route::delete('/delete-enterprise',['name' => 'delete.enterprise','uses' => 'EnterpriseManageController@delete_enterprise']);
            Route::post('/add-enterprise',['name' => 'add.enterprise','uses' => 'EnterpriseManageController@add_enterprise']);
            Route::put('/update-enterprise',['name' => 'add.enterprise','uses' => 'EnterpriseManageController@update_enterprise']);
            Route::post('/update-avatar-enterprise',['name' => 'update.avatar.enterprise','uses' => 'EnterpriseManageController@update_avatar_enterprise']);
            Route::get('/get-employees-enterprise',['name' => 'get.employee.enterprise','uses' => 'EnterpriseManageController@get_employee_enterprise']);
        });

        //job
        Route::group(['prefix' => '/job-manage','name' => 'job.manage.'],function (){
            //them sinh vien bang file excel
            Route::get('/get-list-position',['name' => 'get.list.position','uses' => 'JobManageController@get_list_position']);
            Route::post('/add-position',['name' => 'add.position','uses' => 'JobManageController@add_position']);
            Route::delete('/delete-list-position',['name' => 'delete.list.position','uses' => 'JobManageController@delete_list_position']);
            Route::delete('/delete-position',['name' => 'delete.position','uses' => 'JobManageController@delete_position']);
            Route::put('/edit-position',['name' => 'edit.position','uses' => 'JobManageController@edit_position']);
            
            
            //skill

            Route::get('/get-list-skill',['name' => 'get.list.skill','uses' => 'JobManageController@get_list_skill']);
            Route::post('/add-skill',['name' => 'add.skill','uses' => 'JobManageController@add_skill']);
            Route::delete('/delete-list-skill',['name' => 'delete.list.skill','uses' => 'JobManageController@delete_list_skill']);
            Route::delete('/delete-skill',['name' => 'delete.skill','uses' => 'JobManageController@delete_skill']);
            Route::put('/edit-skill',['name' => 'edit.skill','uses' => 'JobManageController@edit_skill']);

        });


        //post
        Route::group(['prefix' => '/post-manage','name' => 'post.manage.'],function (){
            //them sinh vien bang file excel

            Route::get('/get-list-post',['name' => 'get.list.post','uses' => 'PostsManageController@get_list_post']);

        });

    });


    Route::group(['prefix' => '/request-info','name' => 'get.info.'],function (){
        Route::get('get-courses','RequestInfoController@get_courses');
        Route::get('get-departments','RequestInfoController@get_departments');
        Route::get('get-branches/{department}','RequestInfoController@get_branches_with_code_departments');
        Route::post('check-exist-info-student','RequestInfoController@check_exist_info_student');
        Route::get('get-option-student','RequestInfoController@get_option_student');
        Route::get('get-info-student','RequestInfoController@get_student_with_code_student');



        //enterprise

        Route::get('get-option-enterprise','RequestInfoController@get_option_enterprise');
        Route::post('check-exist-info-enterprise','RequestInfoController@check_exist_info_enterprise');
        Route::get('get-info-enterprise','RequestInfoController@get_enterprise_with_email_address_enterprise');


    }); //dùng cho admin

    Route::group(['prefix' => '/enterprise','name'=>'api.enterprise'],function (){
       Route::group(['prefix' => 'post-manage', 'name' => 'postmanage','namespace' => 'Enterprise'],function(){
           Route::get('/get-list-post',['name' => 'get.lit.post','uses' => 'PostManageController@get_list_post']);
       });
    });

    Route::group(['prefix' => '/job','name' => 'get.job.','namespace' => 'Job'],function (){
        Route::get('get-list-job','JobController@get_list_job')->name('list_job');
        Route::get('get-list-type-job','JobController@get_list_type_job')->name('list_type_job');
        Route::get('get-list-position','JobController@get_list_position')->name('get_list_position ');
        Route::get('get-list-enterprise','JobController@get_list_enterprise')->name('get_list_enterprise');
        Route::get('get-list-skill','JobController@get_list_skill')->name('get_list_skill');
        Route::get('detail/{id}','JobController@detail')->name('detail');
        Route::get('similar-job/{id}','JobController@get_similar_job')->name('similar.job');



        //enterprise



    });

    Route::post('login',['uses' => 'Auth\AuthController@login']);

});

