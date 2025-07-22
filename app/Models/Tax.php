<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Tax extends Model
{
    protected $guarded = ['id'];

    public static function validate($request)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'description' => 'nullable|min:5',
                'value' => 'required|numeric|min:1',
                'is_active' => 'required',
            ],
            [
                'name.required' => 'Name is required',
                'name.min' => 'Name minimum 3 characters',

                'description.min' => 'Description minimum 5 characters',

                'value.required' => 'Value is required',
                'value.min' => 'Value minimum 1 characters',
                'value.numeric' => 'Value must be numeric',

                'is_active.required' => 'Active status is required',
            ]
        );
    }
}
