let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/template/datatable/datatable.js', 'public/assets/js/build/datatable-theme.js');

mix.js('resources/assets/js/template/list_job/list_job.js', 'public/assets/js/build/list-job-theme.js');

// --admin

mix.js('resources/assets/js/admin/studentmanage/studentmanage/studentmanage.js', 'public/assets/js/build/pages/admin/student-manage/student-manage.js');

mix.js('resources/assets/js/admin/studentmanage/addstudent/addstudent.js', 'public/assets/js/build/pages/admin/student-manage/add-student.js');

mix.js('resources/assets/js/admin/studentmanage/infostudent/infostudent.js', 'public/assets/js/build/pages/admin/student-manage/info-student.js');


//enterprise
mix.js('resources/assets/js/admin/enterprisemanage/enterprisemanage/enterprisemanage.js', 'public/assets/js/build/pages/admin/enterprise-manage/enterprise-manage.js');

mix.js('resources/assets/js/admin/enterprisemanage/addenterprise/addenterprise.js', 'public/assets/js/build/pages/admin/enterprise-manage/add-enterprise.js');

mix.js('resources/assets/js/admin/enterprisemanage/infoenterprise/infoenterprise.js', 'public/assets/js/build/pages/admin/enterprise-manage/info-enterprise.js');

//job
mix.js('resources/assets/js/admin/post/positionsmanage/positionsmanage.js', 'public/assets/js/build/pages/admin/post/position.js');

mix.js('resources/assets/js/admin/post/skillsmanage/positionsmanage.js', 'public/assets/js/build/pages/admin/post/skill.js');

mix.js('resources/assets/js/admin/post/postsmanage/postmanage/postsmanage.js', 'public/assets/js/build/pages/admin/post/post.js');
mix.js('resources/assets/js/admin/post/postsmanage/updatepost/updatepost.js', 'public/assets/js/build/pages/admin/post/update-post.js');

//post course
mix.js('resources/assets/js/admin/postcourse/postcoursesmanage/postcoursemanage.js', 'public/assets/js/build/pages/admin/post-course/post-courses.js');
mix.js('resources/assets/js/admin/postcourse/updatepostcourse/updatepostcourse.js', 'public/assets/js/build/pages/admin/post-course/update-post-course.js');


// !-- admin
// -- enterprise
mix.js('resources/assets/js/enterprise/postsmanage/newpost/newpost.js', 'public/assets/js/build/pages/enterprise/post-manage/new-post.js');

mix.js('resources/assets/js/enterprise/postsmanage/postsmanage/postmanage.js', 'public/assets/js/build/pages/enterprise/post-manage/post-manage.js');

mix.js('resources/assets/js/enterprise/postsmanage/updatepost/updatepost.js', 'public/assets/js/build/pages/enterprise/post-manage/update-post.js');


mix.js('resources/assets/js/enterprise/postcoursesmanage/newpostcourse/newpostcourse.js', 'public/assets/js/build/pages/enterprise/post-course-manage/new-post-course.js');

mix.js('resources/assets/js/enterprise/postcoursesmanage/postcoursesmanage/postcoursemanage.js', 'public/assets/js/build/pages/enterprise/post-course-manage/post-course-manage.js');

mix.js('resources/assets/js/enterprise/postcoursesmanage/updatepostcourse/updatepostcourse.js', 'public/assets/js/build/pages/enterprise/post-course-manage/update-post-course.js');

mix.js('resources/assets/js/enterprise/profile/infoenterprise.js', 'public/assets/js/build/pages/enterprise/profile.js');

//!-- enterprise
//dung chung

// -- student

mix.js('resources/assets/js/student/profile/profilestudent.js', 'public/assets/js/build/pages/student/profile.js');

//!-- student

//job

mix.js('resources/assets/js/job/list_job/list_job.js', 'public/assets/js/build/pages/job/list-job/list-job.js');


mix.js('resources/assets/js/job/list_job/job_detail.js', 'public/assets/js/build/pages/job/list-job/job-detail.js');


//auth
mix.js('resources/assets/js/auth/login.js', 'public/assets/js/build/pages/auth/login.js');



mix.js('resources/assets/js/core.js', 'public/assets/js/core/index.js');

