<?php

namespace App\Schemas;

class LoginSchema
{
    public static function getRules()
    {
        return [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Field {field} is required.',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field {field} is required.',
                ],
            ]
        ];
    }
}
