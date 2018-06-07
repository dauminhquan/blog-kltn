<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Services\GetDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostsManageController extends Controller
{
    public function get_list_post(Request $request)
    {
        if($request->has('email_address_enterprise'))
        {
            $validate = Validator::make($request->all(),[
                'email_address_enterprise' => 'exists:users,user_name'
            ],[
                'email_address_enterprise.exists' => 'Email không tồn tại'
            ]);
            if($validate->fails())
            {
                return response()->json($validate->errors(),406);
            }
        }
        $get_data_service = new GetDataService();
        return $get_data_service->getListJob($request);
    }
}
