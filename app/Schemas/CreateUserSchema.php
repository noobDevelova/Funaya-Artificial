<?php

namespace App\Schemas;

class CreateUserSchema
{
    public static function getRules()
    {
        return [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username wajib diisi.',
                    'min_length' => 'Username harus memiliki minimal 3 karakter.',
                    'max_length' => 'Username tidak boleh lebih dari 50 karakter.',
                ]
            ],
            'role_id' => [
                'label' => 'Role',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Role wajib dipilih.',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Mohon masukkan email yang valid.',
                ]
            ],
            'phone_number' => [
                'label' => 'Nomor Telepon',
                'rules' => 'required|regex_match[/^[0-9]{10,15}$/]',
                'errors' => [
                    'required' => 'Nomor Telepon wajib diisi.',
                    'regex_match' => 'Nomor Telepon harus terdiri dari 10 hingga 15 digit.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[50]',
                'errors' => [
                    'required' => 'Password wajib diisi.',
                    'min_length' => 'Password minimal harus 8 karakter.',
                    'max_length' => 'Password maksimal 50 karakter.'
                ]
            ],
            'confirm_password' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi.',
                    'matches' => 'Konfirmasi password harus sama dengan password.'
                ]
            ]
        ];
    }
}
