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
                "picture"       => "coffe-images/caffe-latte.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Cappuccino",
                "price"         => 32000,
                "picture"       => "coffe-images/cappucino.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "V60",
                "price"         => 35000,
                "picture"       => "coffe-images/v60.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "French Press",
                "price"         => 35000,
                "picture"       => "coffe-images/french-press.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Espresso",
                "price"         => 25000,
                "picture"       => "coffe-images/caffe-latte.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Americano",
                "price"         => 30000,
                "picture"       => "coffe-images/cappucino.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Cappuccino",
                "price"         => 40000,
                "picture"       => "coffe-images/v60.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Latte",
                "price"         => 42000,
                "picture"       => "coffe-images/french-press.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Mocha",
                "price"         => 45000,
                "picture"       => "coffe-images/caffe-latte.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Macchiato",
                "price"         => 43000,
                "picture"       => "coffe-images/cappucino.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Affogato",
                "price"         => 38000,
                "picture"       => "coffe-images/v60.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Cold Brew",
                "price"         => 35000,
                "picture"       => "coffe-images/french-press.jpg"
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
