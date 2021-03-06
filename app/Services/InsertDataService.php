<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:35
 */

namespace App\Services;


use App\Models\Enterprise;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InsertDataService
{
    public function insertStudent(Request $request)
    {
         $validate = Validator::make($request->all(),[
                    'code_course' => 'required|exists:courses,code_course',
                    'code_branch'=> 'required|exists:branches,code_branch',
                    'first_name_student' =>'required',
                    'last_name_student' => 'required',
                    'address_student' =>'required',
                    'phone_number_student' => 'required',
                    'email_address_student' => 'required|email|unique:students,email_address_student',
                    'code_student' => 'required|unique:users,user_name',
                    'password' => 'required',
                    'rep_password' => 'required|same:password'
         ],[
             'code_course.required' => 'Khóa học không có',
             'code_course.exists' => 'Khóa học không tồn tại',
             'code_branch.required' => 'Ngành học không có',
             'code_branch.exists' => 'Ngành học không tồn tại',
             'first_name_student.required' => 'Không có họ',
             'last_name_student.required' =>' Không có tên',
             'address_student.required' => 'Không có địa chỉ',
             'phone_number_student.required' => 'Không có số điện thoại',
             'email_address_student.required' => 'Không có Email',
             'email_address_student.unique' => 'Email đã tồn tại',
             'email_address_student.email' => 'Không đúng định dạng Email',
             'code_student.required' => 'Mã sinh viên không có',
             'code_student.unique' => 'Mã sinh viên đã tồn tại',
             'password.required' => 'Không có password',
             'rep_password.required' => 'Không có nhập lại password',
             'rep_password.same' => 'Nhập lại mật khẩu không đúng'
         ]);
         if($validate->fails())
         {
             return response()->json($validate->errors(),406);
         }
        return DB::transaction(function () use ($request) {
            $user = new User();
            $user->user_name = $request->code_student;
            $user->password = $request->password;
            $user->authentication = true;
            $user->type = 3;
            $user->save();
            $student = new Student();
            $student->code_course = $request->code_course;
            $student->code_branch = $request->code_branch;
            $student->first_name_student = $request->first_name_student;
            $student->last_name_student = $request->last_name_student;
            $student->address_student = $request->address_student;
            $student->phone_number_student = $request->phone_number_student;
            $student->id_user = $user->id;
            $student->email_address_student = $request->email_address_student;
            $student->save();
            return response()->json([
                'message' => 'Thêm mới sinh viên thành công'

            ],200);
        });

    }

    public function insertEnterprise(Request $request)
    {
        $validate = Validator::make($request->all(),[


            'name_enterprise' =>'required',
            'address_enterprise' => 'required',
            'name_president_enterprise' =>'required',
            'phone_number_enterprise' => 'required',
            'email_address_enterprise' => 'required|email|unique:users,user_name',
            'password' => 'required',
            'rep_password' => 'required|same:password'
        ],[
            'name_enterprise.required' => 'Không có tên doanh nghiệp',
            'address_enterprise.required' => 'Không có địa chỉ doanh nghiệp',
            'name_president_enterprise.required' => 'Không có tên tổng giám đốc',

            'phone_number_enterprise.required' => 'Không có số điện thoại',
            'email_address_enterprise.required' => 'Không có Email',
            'email_address_enterprise.unique' => 'Email đã tồn tại',
            'email_address_enterprise.email' => 'Không đúng định dạng Email',
            'password.required' => 'Không có password',
            'rep_password.required' => 'Không có nhập lại password',
            'rep_password.same' => 'Nhập lại mật khẩu không đúng'
        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors(),406);
        }
        return DB::transaction(function () use ($request) {
            $user = new User();
            $user->user_name = $request->email_address_enterprise;
            $user->password = $request->password;
            $user->authentication = true;
            $user->type = 2;
            $user->save();
            $enterprise = new Enterprise();
            $enterprise->id_user = $user->id;
            $enterprise->name_enterprise = $request->name_enterprise;
            $enterprise->address_enterprise = $request->address_enterprise;
            $enterprise->name_president_enterprise = $request->name_president_enterprise;
            $enterprise->phone_number_enterprise = $request->phone_number_enterprise;
            if($request->has('introduce_enterprise'))
            {
                $enterprise->introduce_enterprise = $request->introduce_enterprise;
            }
            $enterprise->save();
            return response()->json([
                'message' => 'Thêm mới doanh nghiệp thành công'

            ],200);
        });
    }
}