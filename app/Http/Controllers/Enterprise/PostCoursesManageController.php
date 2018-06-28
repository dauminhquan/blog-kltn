<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 6/28/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers\Enterprise;


use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CoursesManageController extends Controller
{
    public function new_course()
    {
        return view('enterprise.new_course');
    }
    public function course_manage()
    {
        return view('enterprise.course_manage');
    }
    public function update_course($id){
        $course = Course::findOrFail($id);
        if($course && $course->id_enterprise == Auth::guard('web')->user()->enterprise->id)
        {
            return view('enterprise.update_course',['id'=>$id]);
        }
        return response()->redirectToRoute('home');

    }
}