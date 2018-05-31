<?php

namespace App\Http\Controllers\Admin;

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
    public function infoStudent()
    {
        return view('admin.studentmanage.info_student');
    }
}
