<?php

namespace App\Schemas;

class CreateSupplierSchema
{
    public static function getRules()
    {
        return [
            'name' => [
                'label' => 'Nama Supplier',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama Supplier wajib diisi.',
                    'min_length' => 'Nama Supplier harus memiliki minimal 3 karakter.',
                    'max_length' => 'Nama Supplier tidak boleh lebih dari 100 karakter.'
                ]
            ],
            'contact_person' => [
                'label' => 'Nama Kontak',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama Kontak wajib diisi.',
                    'min_length' => 'Nama Kontak harus memiliki minimal 3 karakter.',
                    'max_length' => 'Nama Kontak tidak boleh lebih dari 100 karakter.'
                ]
            ],
            'phone' => [
                'label' => 'Nomor Telepon',
                'rules' => 'required|regex_match[/^[0-9]{10,15}$/]',
                'errors' => [
                    'required' => 'Nomor Telepon wajib diisi.',
                    'regex_match' => 'Nomor Telepon harus terdiri dari 10 hingga 15 digit.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi.',
                    'valid_email' => 'Mohon masukkan email yang valid.'
                ]
            ],
            'address' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[10]|max_length[255]',
                'errors' => [
                    'required' => 'Alamat wajib diisi.',
                    'min_length' => 'Alamat harus memiliki minimal 10 karakter.',
                    'max_length' => 'Alamat tidak boleh lebih dari 255 karakter.'
                ]
            ],
        ];
    }
}
