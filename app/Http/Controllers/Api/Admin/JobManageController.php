<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Position;
use App\Models\Skill;
use App\Services\GetDataService;
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
    public function delete_position(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:positions,id'
        ],[
            'id.required' => 'Không có id chức vụ',
            'id.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $position = Position::find($request->id);
        $position->delete();

        return response()->json([
            'message' => 'Xóa chức vụ thành công'
        ],200);
    }

    public function edit_position(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:positions,id',

        ],[
            'id.required' => 'Không có id chức vụ',
            'id.unique' => 'Chức vụ đã tồn tại'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $position = Position::find($request->id);
        $validator = Validator::make($request->all(),[
            'name_position' => 'required|unique:positions,name_position,'.$position->name_position

        ],[
            'name_position.required' => 'Không có tên chức vụ',
            'name_position.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $position->name_position = $request->name_position;
        $position->save();
        return response()->json([
            'message' => 'Sửa chức vụ thành công'
        ],200);
    }

    //skill

    public function get_list_skill()
    {
        return Skill::all();
    }
    public function add_skill(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name_skill' => 'required|unique:skills,name_skill'
        ],[
            'name_skill.required' => 'Không có tên kỹ năng',
            'name_skill.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $skill = new Skill();
        $skill->name_skill = $request->name_skill;
        $skill->save();
        return response()->json([
            'message' => 'Thêm kỹ năng thành công'
        ],200);
    }
    public function delete_list_skill(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'list_id_skill' => 'required'
        ],[
            'name_skill.required' => 'Không có danh sách',

        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        if(gettype($request->list_id_skill) != 'array')
        {
            return response()->json([
                'message' => "Không phải list ID"
            ],406);
        }
        if(count($request->list_id_skill) < 1)
        {
            return response()->json([
                'message' => "List trống"
            ],406);
        }
        foreach ($request->list_id_skill as $item)
        {
            $skill = Skill::find((int) $item);
            if($skill!= null)
            {
                $skill->delete();
            }
        }

        return response()->json([
            'message' => 'Xóa danh sách thành công'
        ],200);
    }
    public function delete_skill(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:skills,id'
        ],[
            'id.required' => 'Không có id kỹ năng',
            'id.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $skill = Skill::find($request->id);
        $skill->delete();

        return response()->json([
            'message' => 'Xóa kỹ năng thành công'
        ],200);
    }

    public function edit_skill(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:skills,id',

        ],[
            'id.required' => 'Không có id kỹ năng',
            'id.unique' => 'Chức vụ đã tồn tại'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $skill = Skill::find($request->id);
        $validator = Validator::make($request->all(),[
            'name_skill' => 'required|unique:skills,name_skill,'.$skill->name_skill

        ],[
            'name_skill.required' => 'Không có tên kỹ năng',
            'name_skill.unique' => 'Chức vụ đã tồn tại'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }
        $skill->name_skill = $request->name_skill;
        $skill->save();
        return response()->json([
            'message' => 'Sửa kỹ năng thành công'
        ],200);
    }
    public function get_list_job(Request $request)
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
