<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\ExcelFile;

use App\Services\DeleteDataService;
use App\Services\GetDataService;
use App\Services\InsertDataFromExcelService;
use App\Services\InsertDataService;
use App\Services\UpdateDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class StudentManageController extends Controller
{
    //
    public function add_student_excel(ExcelFile $request)
    {
            $insert_excel_service = new InsertDataFromExcelService();
           return $insert_excel_service->insertExcelStudents($request);

    }

    public function add_student(Request $request)
    {
        $insert_data_service = new InsertDataService();
        return $insert_data_service->insertStudent($request);
    }

    public function get_list_student()
    {
            $get_data_service = new GetDataService();
            return $get_data_service->getStudents();
    }

    public function delete_list_student(Request $request){
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->deleteListStudent($request);
    }

    public function delete_student(Request $request)
    {
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->deleteStudent($request);
    }

    public function update_student(Request $request)
    {

        $update_data_service = new UpdateDataService();
        return $update_data_service->UpdateStudent($request);
    }
    public function update_avatar_student(Request $request)
    {
        $update_data_service = new UpdateDataService();
        return $update_data_service->UpdateAvatarStudent($request);
    }
    public function get_work_student(Request $request)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getWorkStudent($request);
    }

}
