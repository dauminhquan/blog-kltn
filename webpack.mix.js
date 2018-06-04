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
mix.js('resources/assets/js/admin/job/positionsmanage/positionsmanage.js', 'public/assets/js/build/pages/admin/job/position.js');



// !-- admin

//dung chung

//job

mix.js('resources/assets/js/job/list_job/list_job.js', 'public/assets/js/build/pages/job/list-job/list-job.js');

