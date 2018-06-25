<?php

namespace App\Http\Controllers\Enterprise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsManageController extends Controller
{
    public function posts_manage()
    {

    }
    public function new_post()
    {
        return view('enterprise.new_post');
    }
    public function post_manage()
    {
        return view('enterprise.post_manage');
    }
}
