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

mix.js('resources/assets/js/admin/studentmanage/studentmanage/studentmanage.js', 'public/assets/js/build/pages/admin/student-manage/student-manage.js');

