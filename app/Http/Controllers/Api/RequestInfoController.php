<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:59
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\GetDataService;

class RequestInfoController extends Controller
{
    public function get_courses()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getCourses();
    }
    public function get_departments()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getDepartments();
    }
}