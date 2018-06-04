<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JobManageController extends Controller
{
    public function get_list_position()
    {
        return Position::all();
    }
    public function add_position(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'name_position' => 'required|unique:positions,name_position'
        ],[
                'name_position.required' => 'Không có tên chức vụ',
                'name_position.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $position = new Position();
        $position->name_position = $request->name_position;
        $position->save();
        return response()->json([
            'message' => 'Thêm chức vụ thành công'
        ],200);
    }
    public function delete_list_position(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'list_id_position' => 'required'
        ],[
            'name_position.required' => 'Không có danh sách',

        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        if(gettype($request->list_id_position) != 'array')
        {
            return response()->json([
                'message' => "Không phải list ID"
            ],406);
        }
        if(count($request->list_id_position) < 1)
        {
            return response()->json([
                'message' => "List trống"
            ],406);
        }
        foreach ($request->list_id_position as $item)
        {
            $position = Position::find((int) $item);
            if($position!= null)
            {
                $position->delete();
            }
        }

        return response()->json([
            'message' => 'Xóa danh sách thành công'
        ],200);
    }
}
