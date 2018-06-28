<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Position;
use App\Models\Post;
use App\Models\PostCourse;
use App\Models\Skill;
use App\Services\GetDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostCourseManageController extends Controller
{

    public function get_list_post_course(Request $request)
    {

        $post_courses = PostCourse::all();
        foreach ($post_courses as $item)
        {
//

            $item->enterprise = $item->enterprise()->select('id','name_enterprise','avatar_enterprise','id_user')->first();

            $user_name = $item->enterprise->user()->select('user_name')->first();
            $item->enterprise->user_name = $user_name->user_name;
        }
        return $post_courses;
    }
    public function accept_post_course($id)
    {
        $post_courses = PostCourse::findOrFail($id);

        $post_courses->accept = 1;
        $post_courses->update();
        return ['status' => 1,'message' =>'Chấp nhận bài viết thành công'];
    }
    public function get_detail_post_course($id)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->adminGetDetailPostCourse($id);

    }
}
