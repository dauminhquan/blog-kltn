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


class EnterpriseManageController extends Controller
{
    //
    public function add_enterprise_excel(ExcelFile $request)
    {
            $insert_excel_service = new InsertDataFromExcelService();
           return $insert_excel_service->insertExcelEnterprises($request);

    }

    public function add_enterprise(Request $request)
    {
        $insert_data_service = new InsertDataService();
        return $insert_data_service->insertEnterprise($request);
    }

    public function get_list_enterprise()
    {
            $get_data_service = new GetDataService();
            return $get_data_service->getEnterprise();
    }

    public function delete_list_enterprise(Request $request){
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->deleteListEnterprises($request);
    }

    public function delete_enterprise(Request $request)
    {
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->deleteEnterprise($request);
    }

    public function update_enterprise(Request $request)
    {

        $update_data_service = new UpdateDataService();
        return $update_data_service->UpdateEnterprise($request);
    }
    public function update_avatar_enterprise(Request $request)
    {
        $update_data_service = new UpdateDataService();
        return $update_data_service->UpdateAvatarEnterprise($request);
    }
    public function get_employee_enterprise(Request $request)
    {

        $get_data_service = new GetDataService();
        return $get_data_service->getEmployeesEnterprise($request);
    }

}
