<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCategoryRequest extends Request
{
    public function rules()
    {
        return [
            'title'       => 'max:100|required',
            'description' => 'max:255|required'
        ];
    }
}
