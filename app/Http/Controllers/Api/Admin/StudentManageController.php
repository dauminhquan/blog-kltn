<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\ExcelFile;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class StudentManageController extends Controller
{
    //
    public function add_student_excel(ExcelFile $request)
    {

        $list_err = [];

        $data = Excel::load($request->ExcelFileUpload,function($reader){
                $reader->all();

        })->get();

        if(count($data) > 0)
        {
            foreach ($data as $item)
            {
                $student  = new Student();
                // check xem ma nganh
                // ma khoa co ton tai khong

                $code_course = $item->code_course;
                $code_branch = $item->code_branch;
                $code_student = $item->code_student;
                if($code_course == null || $code_branch == null || $code_student == null || $item->password == null ||
                    $item->first_name_student == null ||
                    $item->last_name_student == null ||
                    $item->address_student == null ||
                    $item->phone_number_student == null ||
                    $item->email_address_student == null ||
                    !$this->existBranch($code_branch) ||
                    !$this->existCourse($code_course) ||
                    $this->existCodeStudent($code_student) ||
                    $this->existEmailStudent($item->email_address_student))
                {

                    $list_err[] = [
                        'item' => $item->code_student,
                        'message' => 'Thiếu thông tin | Thông tin bị trùng | Không đúng form'
                    ];
                }
                else{
                    $user = new User();
                    $user->user_name = $item->code_student;
                    $user->password = Hash::make($item->password);
                    $user->authentication = true;
                    $user->type = 3;
                    $user->save();
                    $student = new Student();
                    $student->first_name_student = $item->first_name_student;
                    $student->last_name_student = $item->last_name_student;
                    $student->address_student = $item->address_student;
                    $student->phone_number_student = $item->phone_number_student;
                    $student->email_address_student = $item->email_address_student;
                    $student->introduce_student = $item->introduce_student;
                    $student->avatar_student = $item->avatar_student;
                    $student->code_course = $item->code_course;
                    $student->code_branch = $item->code_branch;
                    $student->salary = $item->salary;
                    $student->id_user = $user->id;
                    $student->graduated = $item->graduated;
                    $student->save();
                }


            }
        }
        if(count($list_err) == count($data))
        {
            return response()->json([
                'message' => "File rỗng | Sai định dạng | Trùng dữ liệu toàn bộ"
            ],406);
        }
        return [
            'message' => 'Thêm sinh viên thành công',
            'error' => $list_err
        ];
    }


    public function get_list_student()
    {
            $student = new Student();
            $students = [];
            $data = $student->get();

            if(count($data) > 0)
            {
                foreach ($data as $item)
                {
                    if($item->branch != null)
                    {
                        $name_department = $item->branch->department->name_department;
                        $name_branch = $item->branch->name_branch;

                    }
                    else{
                        $name_department = null;
                        $name_branch = null;
                    }
                    if($item->course != null)
                    {
                        $name_course = $item->course->name_course;
                    }
                    else{
                        $name_course = null;
                    }

                    $students [] = [
                      'id' => $item->id,
                        'first_name_student' => $item->first_name_student,
                        'last_name_student' => $item->last_name_student,
                        'code_student' => $item->user->user_name,
                        'name_department' => $name_department,
                        'name_branch' => $name_branch,
                        'name_course' => $name_course,
                        'graduated' => $item->graduated
                    ];

                }
            }
            return $students;

    }

    public function delete_list_student(Request $request){


            $validate =  Validator::make($request->all(),[
                'list_id_student' => 'required'
            ],[
                'list_id_student.required' => 'Danh sách sinh viên không tồn tại'
            ]);
            if($validate->fails())
            {
                return response()->json([
                    'message' => $validate->errors()
                ]);
            }
            else{
                $list_id_student = $request->list_id_student;
                foreach ($list_id_student as $item)
                {
                    $student = Student::find((int)$item);
                    $id_user = $student->id_user;
                    $student->delete();
                    User::find($id_user)->delete();

                }
            }
    }

    public function delete_student(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'id' => 'required'
        ],[
            'id.required' => 'Danh sách sinh viên không tồn tại'
        ]);
        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->errors()
            ]);
        }else{
            $student = Student::find((int)$request->id);
            $id_user = $student->id_user;
            $student->delete();
            User::find($id_user)->delete();
        }
    }

    private function existCourse($code_course)
    {
        if(Course::where('code_course',$code_course)->count() > 0)
        {
            return true;
        }
        return false;
    }
    private function existBranch($code_branch)
    {
        if(Branch::where('code_branch',$code_branch)->count() > 0)
        {
            return true;
        }
        return false;
    }
    private function existCodeStudent($code_student)
    {
        if(User::where('user_name',$code_student)->count()>0)
        {
            return true;
        }
        return false;
    }
    private function existEmailStudent($email_address_student)
    {
        if(Student::where('email_address_student',$email_address_student)->count() > 0)
        {
            return true;
        }
        return false;
    }
}
