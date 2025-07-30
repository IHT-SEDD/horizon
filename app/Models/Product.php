<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    protected $guarded = ['id'];

    protected $with = ['unit', 'category'];

    public static function validate($request)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5',
                'brand' => 'required|min:5',
                'type' => 'required|min:3',
                'sales_price' => 'required|numeric',
                'product_unit_id' => 'required',
                'product_category_id' => 'required',
            ],
            [
                'name.required' => 'Name is required',
                'name.min' => 'Name minimum 5 characters',

                'brand.required' => 'Brand is required',
                'brand.min' => 'Brand minimum 5 characters',

                'type.required' => 'Type is required',
                'type.min' => 'Type minimum 3 characters',

                'sales_price.required' => 'Product sales price is required',
                'sales_price.numeric' => 'Product sales price must be numeric',

                'product_unit_id.required' => 'Product unit is required',
                'product_category_id.required' => 'Product Category is required',
            ]
        );
    }

    public function unit()
    {
        return $this->belongsTo(ProductUnit::class, 'product_unit_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
