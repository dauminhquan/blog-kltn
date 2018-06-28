<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Services\DeleteDataService;
use App\Services\GetDataService;
use App\Services\InsertDataService;
use App\Services\UpdateDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function index()
    {
        $data = Auth::user()->enterprise->courses()->select('id','title_course','created_at','accept')->get();

        foreach ($data as $item)
        {
            $item->positions= $item->positions()->select('name_position')->get();
        }
        foreach ($data as $item)
        {
            $item->types= $item->types()->select('name_job_type')->get();
        }
        return $data;
    }


    public function store(Request $request)
    {
        $insert_data_service = new InsertDataService();
        return $insert_data_service->insertCourse($request);
    }


    public function show($id)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->enterpriseGetDetailJob($id);
    }


    public function update(Request $request, $id)
    {


        $update_data_service = new UpdateDataService();
        return $update_data_service->updateCourse($request,$id);
    }

    public function destroy($id)
    {
            $delete_data_service = new DeleteDataService();
            return $delete_data_service->deleteCourse($id);
    }
    public function delete_list_course(Request $request)
    {
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->deleteListCourse($request);
    }
}
