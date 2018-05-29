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
}
