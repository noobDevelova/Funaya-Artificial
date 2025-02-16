<?php

namespace App\Schemas;

class CreatePurchaseSchema
{
    public static function getRules()
    {
        return [
            'price' => [
                'label' => 'Harga Produk',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'numeric' => 'Kolom {field} harus berupa angka.',
                ],
            ],
            'quantity' => [
                'label' => 'Kuantitas',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'numeric' => 'Kolom {field} harus berupa angka.',
                ],
            ],
            'supplier_id' => [
                'label' => 'Supplier',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'numeric' => 'Kolom {field} harus berupa angka.',
                ],
            ],
        ];
    }
}
