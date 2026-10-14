<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'GT3 RS',
                'description' => 'Sportcar track-ready dengan performa maksimal',
                'price'       => 250000,
                'segment'     => 'sportcar',
                'image'       => null,
            ],
            [
                'name'        => 'Panamera',
                'description' => 'Sedan mewah dengan kenyamanan kelas atas',
                'price'       => 120000,
                'segment'     => 'sedan',
                'image'       => null,
            ],
            [
                'name'        => 'Cayenne',
                'description' => 'SUV serbaguna untuk harian maupun petualangan',
                'price'       => 99999,
                'segment'     => 'suv',
                'image'       => null,
            ],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(
                ['name' => $item['name']], // kunci pencarian, mencegah data dobel
                $item
            );
        }
    }
}