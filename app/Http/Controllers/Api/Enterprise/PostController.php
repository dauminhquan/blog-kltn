<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Services\InsertDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function index()
    {

    }


    public function store(Request $request)
    {
        $insert_data_service = new InsertDataService();
        return $insert_data_service->insertPost($request);
    }


    public function show($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {

    }
}
