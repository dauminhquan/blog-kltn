<?php

namespace App\Http\Controllers\Api\Job;

use App\Services\GetDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function get_list_job()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getListJob();
    }

}
