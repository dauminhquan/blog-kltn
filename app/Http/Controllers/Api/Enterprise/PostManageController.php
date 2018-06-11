<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Services\GetDataService;

use App\Http\Controllers\Controller;

class PostManageController extends Controller
{
    public function get_list_post(){

        $get_data_service = new GetDataService();
        return $get_data_service->getListPost();
    }
}
