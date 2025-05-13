<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Product([
            'name'        => $row['name'],
            'category_id' => $row['category_id'],    // Nhập trực tiếp ID
            'price'       => $row['price'],
            'quantity'    => $row['quantity'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name'        => 'required|string',
            '*.category_id' => 'required|exists:categories,id',
            '*.price'       => 'required|numeric|min:0',
            '*.quantity'    => 'required|integer|min:0',
        ];
    }
}
