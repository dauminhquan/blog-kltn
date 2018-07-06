<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\User;
use App\Services\DeleteDataService;
use App\Services\GetDataService;
use App\Services\InsertDataFromExcelService;
use App\Services\InsertDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileManageController extends Controller
{
    public function option_profile_student(Request $request)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getOptionStudent(Auth::user()->user_name,$request->option);
    }
    public function info(){
        $get_data_service = new GetDataService();
        return $get_data_service->getStudentWithCodeStudent(Auth::user()->user_name);

    }

    public function works(){
        $work_student = Employee::where('code_student',Auth::user()->user_name)->get();
        $enter = [];
        foreach ($work_student as $item)
        {
            $id_employee = $item->id;
            $userEnterprise = $item->userEnterprise;
            $user_enterprise = $userEnterprise->user_name;
            $time_start_work = date('d/m/Y',strtotime($item->started_at));
            $time_end_work = date('d/m/Y',strtotime($item->dropped_at));
            if($item->id_salary != null)
            {
                $salary = $item->salary->about;
            }
            else{
                $salary = null;
            }
            $id_salary = $item->id_salary;
            $position = $item->position;
            $name_enterprise = $userEnterprise->enterprise->name_enterprise;
            $avatar_enterprise = $userEnterprise->enterprise->avatar_enterprise;
            $introduce_enterprise = $userEnterprise->enterprise->introduce_enterprise;
            $enter[] = [
                "user_enterprise" => $user_enterprise,
                "time_start" => $time_start_work,
                'time_end' => $time_end_work,
                'name_enterprise' => $name_enterprise,
                'avatar_enterprise' => $avatar_enterprise,
                'introduce_enterprise' => $introduce_enterprise,
                'position' => $position,
                'salary' => $salary,
                'id' => $id_employee,
                'id_salary' => $id_salary
            ];
        }
        return $enter;
    }
    public function get_list_enterprise()
    {
        return Enterprise::join('users',"users.id","enterprises.id_user")->select('enterprises.name_enterprise',DB::raw('users.user_name as user_enterprise'))->get();
    }
    public function add_work_excel(ExcelFile $request)
    {
        $insert_excel_service = new InsertDataFromExcelService();
        return ['ok' => 123];
        //        return $insert_excel_service->insertExcelWorkStudents($request);
    }
    public function add_work(Request $request)
    {
//        $insert_data_service = new InsertDataService();
//        return $insert_data_service->insertWorkStudent($request);

        $validate = Validator::make($request->all(),[
            'email_address_enterprise' => 'required|exists:users,user_name',
            'started_at' =>'required',
            'position' => 'required',

        ],[
            'email_address_enterprise.required' => 'Không có Email',
            'email_address_enterprise.exists' => 'Doanh nghiệp không tồn tại',
            'started_at.required' => 'Không có thời gian bắt đầu',
            'position.required' =>' Không có vị trí',

        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors(),406);
        }
        if(User::where('user_name',$request->email_address_enterprise)->first()->type != 2)
        {
            return response()->json(['message' => 'Doanh nghiệp không tồn tại'],404);
        }


        $employee = new Employee();
        $employee->user_enterprise = $request->email_address_enterprise;
        $employee->code_student = Auth::user()->user_name;
        $employee->started_at = $request->started_at;
        $employee->dropped_at = $request->dropped_at;
        $employee->id_salary = $request->id_salary;
        $employee->position = $request->position;
        $employee->save();
        return ['message' => 'Thanh cong'];
    }
    public function delete_work($id){
        $employee = Employee::findOrFail($id);

        if($employee->code_student != Auth::user()->user_name)
        {
            return response()->json(['message' => 'Bạn không đủ quyền'],406);
        }

        $delete_data_service = new DeleteDataService();
        return $delete_data_service->DeleteWorkStudent($id);
    }
}
