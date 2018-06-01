<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:20
 */

namespace App\Services;


use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeleteDataService
{
    public  function deleteListStudent(Request $request)
    {
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
    public  function deleteStudent(Request $request)
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
}