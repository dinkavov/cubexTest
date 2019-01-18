<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMess extends FormRequest
{
    public function authorize()
    {
        return true;
    }

 	public function rules()
    {
        return [
            'messageTheme' => 'required',
            'message' => 'required',
            'file' => 'file|nullable'
        ];
    }
}
