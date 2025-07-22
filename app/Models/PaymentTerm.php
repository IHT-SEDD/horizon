<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class PaymentTerm extends Model
{
    protected $guarded = ['id'];

    public static function validate($request)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'is_active' => 'required',
            ],
            [
                'name.required' => 'Name is required',
                'name.min' => 'Name minimum 3 characters',

                'is_active.required' => 'Active status is required',
            ]
        );
    }
}
