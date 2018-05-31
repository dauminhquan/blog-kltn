<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentManageController extends Controller
{
    //
    public function add_student_excel(Request $request)
    {
//        $student = new Student();
//        return ['a' => $student->enterprises()];
        return Student::find(1)->enterprises;
        if($request->hasFile('ExcelFileUpload'))
        {
            return ['ok' => '123'];
        }
    }
}
