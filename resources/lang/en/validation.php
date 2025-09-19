<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default validation messages
    |--------------------------------------------------------------------------
    */

    'required'  => 'The :attribute field is required.',
    'email'     => 'The :attribute must be a valid email address.',
    'exists'    => 'The selected :attribute is invalid.',
    'unique'    => 'The :attribute has already been taken.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom attribute names
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'name'                  => 'name',
        'email'                 => 'email address',
        'password'              => 'password',
        'password_confirmation' => 'password confirmation',
        'token'                 => 'verification token',
    ],

];
