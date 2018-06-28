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

Route::group(['middleware' => 'web.check.login'],function (){
    Route::get('/', function () {
        return view('layout.manage_layout');
    })->name('home');
//    Route::get('/datatable',function (){
//        return view('datatable');
//    });
//    Route::get('/list-job',function (){
//        return view('list_job');
//    });

//admin

    Route::group(['prefix' => 'admin','as' => 'admin.','namespace' => 'Admin',/*'middleware' => 'web.check.admin'*/],function (){
        Route::group(['prefix' => 'student-manage','as' => 'student.manage.'],function (){
            Route::get('/',['as' => "index","uses" => 'StudentManageController@studentManage']);
            Route::get('/add-student',['as' => "add.student","uses" => 'StudentManageController@addStudent']);
            Route::get('/info-student',['as' => "info.student","uses" => 'StudentManageController@infoStudent']);
            Route::get('/get-excel-student',['as' => "get.excel.student","uses" => 'StudentManageController@get_excel_info_student']);
            Route::get('/get-excel-example-student',['as' => "get.excel.example.student","uses" => 'StudentManageController@get_excel_example_info_student']);
            Route::get('/get-excel-example-work-student',['as' => "get.excel.example.work.student","uses" => 'StudentManageController@get_excel_example_work_student']);
        });


        Route::group(['prefix' => 'enterprise-manage','as' => 'enterprise.manage.'],function (){
            Route::get('/',['as' => "index","uses" => 'EnterpriseManageController@enterpriseManage']);
            Route::get('/add-enterprise',['as' => "add.enterprise","uses" => 'EnterpriseManageController@addEnterprise']);
            Route::get('/info-enterprise',['as' => "info.enterprise","uses" => 'EnterpriseManageController@infoEnterprise']);
            Route::get('/get-excel-enterprise',['as' => "get.excel.enterprise","uses" => 'EnterpriseManageController@get_excel_info_enterprise']);
            Route::get('/get-excel-example-enterprise',['as' => "get.excel.example.enterprise","uses" => 'EnterpriseManageController@get_excel_example_info_enterprise']);
        });
        Route::group(['prefix' => 'job-manage','as' => 'job.manage.'],function (){
            Route::get('/position',['as' => "position","uses" => 'JobManageController@positionsManage']);
            Route::get('/skill',['as' => "skill","uses" => 'JobManageController@skillsManage']);
            Route::get('/jobs',['as' => "jobs","uses" => 'JobManageController@jobsManage']);
            Route::get('/jobs/{id}',['as' => "jobs.id","uses" => 'JobManageController@updateJob']);



        });
        Route::get('/post-courses',['as' => "post.courses","uses" => 'PostCourseManageController@postcoursesManage']);
        Route::get('/post-course/{id}',['as' => "post.course.id","uses" => 'PostCourseManageController@updatePostcourse']);

    });
    Route::group(['prefix' => 'enterprise','as' => 'enterprise.','namespace' => 'Enterprise',/*'middleware' => 'web.check.enterprise'*/],function (){
        Route::group(['as' => 'post.manage.'],function (){
            Route::get('new-post',['as' => 'new.post','uses' =>'PostsManageController@new_post']);
            Route::get('post-manage',['as' => 'index','uses' => 'PostsManageController@post_manage']);
            Route::get('post/{id}',['as' => 'post.update','uses' => 'PostsManageController@update_post']);
        });
        Route::group(['as' => 'post.course.manage.'],function (){
            Route::get('new-post-course',['as' => 'new.post.course','uses' =>'PostCoursesManageController@new_post_course']);
            Route::get('post-course-manage',['as' => 'index','uses' => 'PostCoursesManageController@post_course_manage']);
            Route::get('post-course/{id}',['as' => 'post.course.update','uses' => 'PostCoursesManageController@update_post_course']);
        });
    });

    Route::group(['prefix' => 'job','as' => 'job.','namespace' => 'Job'],function (){
        Route::get('list-job',['as' => 'list.job','uses' =>'JobController@list_job']);
        Route::get('job-detail/{id}',['as' => 'job.detail','uses' =>'JobController@job_detail']);
        Route::get('file/{id}',['as' => 'file.id','uses' =>'JobController@file']);
    });

});
Route::group(['as' => 'auth.'],function (){
    Route::get('login',['as' => 'login','uses' => 'Auth\LoginController@login']);
    Route::get('logout',['as' => 'logout','uses' => 'Auth\LoginController@logout']);
    Route::post('login',['as' => 'post.login','uses' => 'Auth\LoginController@post_login']);
});