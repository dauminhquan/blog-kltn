<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelFile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ExcelFileUpload' => 'required|mimes:xlsx,xlsm,xls,xls'
        ];
    }
    public function messages()
    {
        return [
            'ExcelFileUpload.required' => "Chua chon file Excel",
            'ExcelFileUpload.mimes' => "Loai file khong phai file Excel"
        ];
    }
}
