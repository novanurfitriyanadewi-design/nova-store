<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Onitsuka Tiger Mexico 66',
                'description' => 'Sepatu klasik Onitsuka dengan desain vintage dan nyaman dipakai harian.',
                'price' => 1200000,
                'image' => 'products/onitsuka1.jpeg',
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adidas Samba OG',
                'description' => 'Sepatu streetwear legendaris dengan gaya retro modern.',
                'price' => 1500000,
                'image' => 'products/samba.jpeg',
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nike Air Force 1',
                'description' => 'Sneakers putih ikonik cocok untuk semua outfit.',
                'price' => 1300000,
                'image' => 'products/nike.jpeg',
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puma Classic',
                'description' => 'Sepatu Puma dengan desain sporty dan nyaman dipakai sehari-hari.',
                'price' => 1100000,
                'image' => 'products/puma.jpeg',
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nike Air Max',
                'description' => 'Sneakers Nike Air Max dengan teknologi bantalan udara ikonik.',
                'price' => 1600000,
                'image' => 'products/airmax.jpeg',
                'stock' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adidas Handball Spezial',
                'description' => 'Sepatu Adidas Handball dengan gaya retro dan sol karet klasik.',
                'price' => 1400000,
                'image' => 'products/handball.jpeg',
                'stock' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
