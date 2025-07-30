<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Sales extends Model
{
    // Only id column cannot be updated or inserted
    protected $guarded = ['id'];

    // Statuses
    public const STATUS_QUOTATION = 'quotation';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_LOCKED = 'locked';
    public const STATUS_CANCELED = 'canceled';

    // Valdiated the request data from form
    public static function validate($data)
    {
        return Validator::make(
            $data,
            [
                'customer_id' => 'required|exists:customers,id',
                'payment_term_id' => 'required|exists:payment_terms,id',
                'expiration_date' => 'required',
            ],
            [
                'customer_id.required' => 'Customer is required',
                'payment_term_id.required' => 'Payment term is required',
                'expiration_date.required' => 'Expiration date is required',
            ]
        );
    }

    // Relation to customers table
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    // Relation to payment_terms table
    public function paymentTerms()
    {
        return $this->belongsTo(PaymentTerm::class, 'payment_term_id');
    }
    // Relation to users table
    public function users()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    // Relation to sales_products table
    public function salesProducts()
    {
        return $this->hasMany(SalesProduct::class);
    }
}
