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

    public function get_list_type_job()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getListTypeJob();
    }

    public function get_list_position()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getListPosition();
    }
    public function get_list_enterprise()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getListEnterprise();
    }

    public function get_list_skill()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getListSkill();
    }
}
