<?php

namespace App\Schemas;

class CreateProductSchema
{
    public static function getRules()
    {
        return  [
            'name' => [
                'label' => 'Nama Produk',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'min_length' => 'Kolom {field} harus memiliki minimal {param} karakter.',
                ],
            ],
            'minimum_stock' => [
                'label' => 'Stok Produk',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'numeric' => 'Kolom {field} harus berupa angka.',
                ],
            ],
            'unit' => [
                'label' => 'Satuan Unit',
                'rules' => 'required|in_list[pcs,set,bundle,box]',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'in_list' => 'Kolom {field} harus diisi dengan salah satu dari: pcs, set, bundle, box.',
                ],
            ],
            'price' => [
                'label' => 'Harga Produk',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'numeric' => 'Kolom {field} harus berupa angka.',
                ],
            ],
            'category_id' => [
                'label' => 'Kategori Produk',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'numeric' => 'Kolom {field} harus berupa angka.',
                ],
            ],
            'color' => [
                'label' => 'Warna Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                ],
            ],
            'size' => [
                'label' => 'Ukuran Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                ],
            ],
            'material' => [
                'label' => 'Bahan Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                ],
            ],
            'description' => [
                'label' => 'Deskripsi Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                ],
            ],
            'additional_info' => [
                'label' => 'Informasi Tambahan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                ],
            ],
        ];
    }
}
