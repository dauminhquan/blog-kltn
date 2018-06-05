<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobManageController extends Controller
{
    public function list_job()
    {
//        return view('job.list_job');
    }
    public function positionsManage()
    {
        return view('admin.job.position');
    }
    public function skillsManage()
    {
        return view('admin.job.skill');
    }

}
