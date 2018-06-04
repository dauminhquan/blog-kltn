<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentManageController extends Controller
{
    //
    public function studentManage()
    {
        return view('admin.studentmanage.studentmanage');
    }
    public function addStudent()
    {
        return view('admin.studentmanage.add_student');
    }
    public function infoStudent(Request $request)
    {


        if($request->has('code_student') && User::where('user_name',$request->code_student)->count()>0)
        {

            $code_student = $request->code_student;
            return view('admin.studentmanage.info_student',['code_student' => $code_student]);
        }

    }
}
