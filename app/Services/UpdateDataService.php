<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 02/06/2018
 * Time: 16:09
 */

namespace App\Services;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdateDataService
{
    public function UpdateStudent(Request $request)
    {
        $validate = Validator::make($request->all(),[

            'code_student' => 'required|exists:users,user_name',

        ],[
            'code_student.required' => 'Mã sinh viên không có',
            'code_student.exists' => 'Mã sinh viên không tồn tại',
        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors());
        }
        $user = User::where('user_name',$request->code_student)->first();
        $student = $user->student;

        $validate = Validator::make($request->all(),[
            'code_course' => 'required|exists:courses,code_course',
            'code_branch'=> 'required|exists:branches,code_branch',
            'first_name_student' =>'required',
            'last_name_student' => 'required',
            'address_student' =>'required',
            'phone_number_student' => 'required',
            'email_address_student' => 'required|email|unique:students,email_address_student,'.$student->id,
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
        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors());
        }
        // update

        if($request->has('password') && $request->password !='' && $request->rep_password != '')
        {
            $validate = Validator::make($request->all(),[

                'password' => 'required',
                'rep_password' => 'required|same:password'
            ],[
                'password.required' => 'Không có password',
                'rep_password.required' => 'Không có nhập lại password',
                'rep_password.same' => 'Nhập lại mật khẩu không đúng'
            ]);
            if($validate->fails())
            {
                return response()->json($validate->errors());
            }
           return DB::transaction(function () use ($student,$request,$user){
                $student->code_course = $request->code_course;
                $student->code_branch = $request->code_branch;
                $student->first_name_student = $request->first_name_student;
                $student->last_name_student = $request->last_name_student;
                $student->address_student = $request->address_student;
                $student->phone_number_student = $request->phone_number_student;
                $student->email_address_student = $request->email_address_student;
                $student->save();
                $user->password = Hash::make($request->password);
                return [
                    'message' => 'Thành công'
                ];
            });
        }
        else{
            $student->code_course = $request->code_course;
            $student->code_branch = $request->code_branch;
            $student->first_name_student = $request->first_name_student;
            $student->last_name_student = $request->last_name_student;
            $student->address_student = $request->address_student;
            $student->phone_number_student = $request->phone_number_student;
            $student->email_address_student = $request->email_address_student;
            $student->save();
            return [
                'message' => 'Thành công'
            ];
        }

    }
}