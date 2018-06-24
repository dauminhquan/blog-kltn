<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:20
 */

namespace App\Services;


use App\Models\Employee;
use App\Models\Enterprise;
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
            'id' => 'required|exists:students,id'
        ],[
            'id.required' => 'Id sinh viên không có',
            'id.exists' => 'Sinh viên không tồn tại'
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

    public function DeleteWorkStudent($id)
    {
        $employee = Employee::find($id);
        if($employee != null)
        {
            $employee->delete();
        }
        return ['message' => 'Xóa thành công'];
    }
    public function deleteEnterprise(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'id' => 'required|exists:enterprises,id'
        ],[
            'id.required' => 'Id doanh nghiệp không có',
            'id.exists' => 'Doanh nghiệp không tồn tại'
        ]);
        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->errors()
            ]);
        }else{
            $enterprise = Enterprise::find((int)$request->id);
            $id_user = $enterprise->id_user;
            $enterprise->delete();
            User::find($id_user)->delete();
        }
    }
    public function deleteListEnterprises(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'list_id_enterprise' => 'required'
        ],[
            'list_id_enterprise.required' => 'Danh sách doanh nghiệp không tồn tại'
        ]);
        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->errors()
            ]);
        }
        else{
            $list_id_enterprise = $request->list_id_enterprise;
            foreach ($list_id_enterprise as $item)
            {
                $enterprise = Enterprise::find((int)$item);
                $id_user = $enterprise->id_user;
                $enterprise->delete();
                User::find($id_user)->delete();

            }
        }
    }
}