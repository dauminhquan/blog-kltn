<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobManageController extends Controller
{
    public function list_job(Request $request)
    {

        return view('job.list_job');
    }
    public function positionsManage()
    {
        return view('admin.job.position');
    }
    public function skillsManage()
    {
        return view('admin.job.skill');
    }
    public function jobsManage()
    {
        return view('admin.job.jobs');
    }
    public function updateJob($id)
    {
        $post = Post::findOrFail($id);
        if($post)
        {
            return view('admin.job.update_post',['id'=>$id]);
        }
        return response()->redirectToRoute('home');
    }

}
