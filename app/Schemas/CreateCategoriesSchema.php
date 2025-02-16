<?php

namespace App\Schemas;

class CreateCategoriesSchema
{
    public static function getRules()
    {
        return [
            'name' => [
                'label' => 'Nama Kategori',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'min_length' => 'Kolom {field} harus memiliki minimal {param} karakter.',
                ],
            ],

            'description' => [
                'label' => 'Deskripsi Kategori',
                'rules' => 'required|min_length[15]',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'min_length' => 'Kolom {field} harus memiliki minimal {param} karakter.',
                ],
            ],
        ];
    }
}
