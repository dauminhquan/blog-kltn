<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnterpriseManageController extends Controller
{
    public function enterpriseManage()
    {
        return view('admin.enterprisemanage.enterprisemanage');
    }
    public function addEnterprise()
    {
        return view('admin.enterprisemanage.add_enterprise');
    }
    public function infoEnterprise(Request $request)
    {
        if($request->has('user_enterprise') && User::where('user_name',$request->user_enterprise)->count()>0)
        {

            $email_address_enterprise = $request->user_enterprise;
            return view('admin.enterprisemanage.info_enterprise',['email_address_enterprise' => $email_address_enterprise]);
        }

    }
    public function get_excel_info_enterprise(){
        $info_student = Student::join('users',"users.id","students.id_user")->select('students.*',DB::raw('users.user_name as code_student'))->get();
        return response()->download(Excel::create('student-excel', function($excel) use($info_student) {
            $excel->sheet('Sheetname', function($sheet) use($info_student) {
                $sheet->fromArray($info_student);
            });
        })->export('xls'));
    }
}
