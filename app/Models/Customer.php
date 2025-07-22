<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Customer extends Model
{
    protected $guarded = ['id'];

    public static function validate($request)
    {
        return Validator::make(
            $request->all(),
            [
                'name' => 'required|min:5',
                'contact' => 'nullable|numeric|min:8',
                'phone_mobile' => 'nullable|numeric|min:8',
                'email' => 'required|email',
                'address' => 'required|min:5',
                'referred_to_role' => 'required|min:5',
                'referred_to_name' => 'required|min:5',
            ],
            [
                'name.required' => 'Name is required',

                'contact.numeric' => 'Contact must be numeric',
                'contact.min' => 'Contact minimum 8 characters',

                'phone_mobile.numeric' => 'Phone mobile must be numeric',
                'phone_mobile.min' => 'Phone mobile minimum 8 characters',

                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email address',

                'address.required' => 'Address is required',
                'address.min' => 'Address minimum 5 characters',

                'referred_to_role.required' => 'Role referrer is required',
                'referred_to_role.min' => 'Role referrer minimum 5 characters',

                'referred_to_name.required' => 'Name referrer is required',
                'referred_to_name.min' => 'Name referrer minimum 5 characters',
            ]
        );
    }
}
