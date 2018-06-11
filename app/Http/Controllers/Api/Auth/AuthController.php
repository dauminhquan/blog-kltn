<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\OauthAccessTokens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'user_name' => 'required|exists:users,user_name',
           'password' => 'required'
        ],[
            'user_name.required' => "Không có tài khoản",
            'user_name.exists' => "Tài khoản không tồn tại",
            'password.required' => "Không có mật khẩu"
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }

        if(Auth::attempt(['user_name' => $request->user_name,'password' => $request->password]))
        {
            $user = Auth::user();

            $token = $user->token_api;

// chi duoc phep toi da 10 token
            //qua 10 thi xoa thang be nhat
            if(count($token) ==10)
            {
                $user->token_api;
            }


            if($token == null)
            {
                $token = $user->createToken('DauQuan')->accessToken;
            }
            else{

                $token->delete();

            }
            $token = $user->createToken('DauQuan')->accessToken;
            return response()->json([
                'message' => 'Login Thành công',
                'token' => $token
            ],200);
        }

        return response()->json([
            'message' => 'Mật khẩu không đúng',
        ],406);
    }
}
