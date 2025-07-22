<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Sales extends Model
{
    protected $guarded = ['id'];

    public static function validate($request)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'is_active' => 'required',
            ],
            [
                'name.required' => 'Name is required',
                'is_active.required' => 'Active status is required',
            ]
        );
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_unit_id');
    }
}
