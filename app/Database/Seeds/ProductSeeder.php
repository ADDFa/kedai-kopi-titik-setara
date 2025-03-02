<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ["name"  => "Espresso-Based"],
            ["name"  => "Manual Brew"]
        ];

        $products = [
            [
                "category_id"   => 1,
                "name"          => "Caffè Latte",
                "price"         => 32000,
                "picture"       => "coofe-images/caffe-latte.jpg",
                "qty"           => 4
            ],
            [
                "category_id"   => 1,
                "name"          => "Cappuccino",
                "price"         => 32000,
                "picture"       => "coofe-images/cappucino.jpg",
                "qty"           => 3
            ],
            [
                "category_id"   => 2,
                "name"          => "V60",
                "price"         => 35000,
                "picture"       => "coofe-images/v60.jpg",
                "qty"           => 2
            ],
            [
                "category_id"   => 2,
                "name"          => "French Press",
                "price"         => 35000,
                "picture"       => "coofe-images/french-press.jpg",
                "qty"           => 5
            ]
        ];

        foreach ($categories as $category) {
            $this->db->table("categories")->insert($category);
        }

        foreach ($products as $product) {
            $this->db->table("products")->insert($product);
        }
    }
}
