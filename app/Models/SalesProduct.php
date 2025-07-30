<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SalesProduct extends Model
{
    protected $guarded = ['id'];

    protected $with = ['products', 'taxes'];

    public static function validate($data)
    {
        return Validator::make(
            $data,
            [
                '*.id' => 'required|exists:products,id',
                '*.tax_id' => 'required|exists:taxes,id',
                '*.discount' => 'required',
                '*.quantity' => 'required',
                '*.subtotal' => 'required',
            ],
            [
                '*.id.required' => 'Product is required',
                '*.tax_id.required' => 'Tax is required',
                '*.discount.required' => 'Discount is required',
                '*.quantity.required' => 'Quantity is required',
                '*.subtotal.required' => 'Subtotal is required',
            ]
        );
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function taxes()
    {
        return $this->belongsTo(Tax::class, 'tax_id');
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }
}
