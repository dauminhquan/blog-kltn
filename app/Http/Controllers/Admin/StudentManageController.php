<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
    public function get_excel_info_student(){
        $info_student = Student::join('users',"users.id","students.id_user")->select('students.*',DB::raw('users.user_name as code_student'))->get();
        return response()->download(Excel::create('student-excel', function($excel) use($info_student) {
            $excel->sheet('Sheetname', function($sheet) use($info_student) {
                $sheet->fromArray($info_student);
            });
        })->export('xls'));
    }
}
