<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enterprise;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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
        $info_enterprise = Enterprise::join('users',"users.id","enterprises.id_user")->select('enterprises.*',DB::raw('users.user_name as email_address_enterprise'))->get();
        return response()->download(Excel::create('enterprise-excel', function($excel) use($info_enterprise) {
            $excel->sheet('enterprise', function($sheet) use($info_enterprise) {
                $sheet->fromArray($info_enterprise);
            });
        })->export('xls'));
    }
    public function get_excel_example_info_enterprise(){
        return response()->download(Excel::create('example-enterprise-excel', function($excel) {
            $excel->sheet('enterprise', function($sheet) {
                $sheet->fromArray([
                    'email_address_enterprise',
                    'password',
                    'name_enterprise',
                    'address_enterprise',
                    'name_president_enterprise',
                    'phone_number_enterprise',
                    'avatar_enterprise',
                    'introduce_enterprise'
                ]);
            });
        })->export('xls'));
    }
}
