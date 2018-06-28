<?php

namespace App\Http\Controllers\Job;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function list_job(Request $request)
    {
        return view('job.list_job');
    }
    public function job_detail($id)
    {
        $post = Post::findOrFail($id);
        return view('job.job_detail',['id' => $id]);
    }
    public function file($id)
    {
        try{
            $post = Post::find($id);
            if($post != null)
            {
                return Storage::download($post->file_attach_post);
            }
        }catch (\Exception $e)
        {
            return ['status' => 0, 'message' => 'File not found'];
        }
        return ['status' => 0, 'message' => 'File not found'];
    }

}
