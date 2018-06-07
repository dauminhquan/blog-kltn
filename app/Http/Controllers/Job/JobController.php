<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function list_job()
    {
        return view('job.list_job');
    }
    public function job_detail($id)
    {
        return view('job.job_detail');
    }

}
