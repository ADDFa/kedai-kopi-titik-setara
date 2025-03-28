<?php

namespace App\Database\Seeds;

use App\Enum\ProductType;
use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ["name" => "Espresso-Based"],
            ["name" => "Manual Brew"],
            ["name" => "Mie"],
            ["name" => "Rice"],
            ["name" => "Pizza"]
        ];

        $products = [
            [
                "category_id"   => 1,
                "name"          => "Caffè Latte",
                "type"          => ProductType::DRINKS,
                "price"         => 32000,
                "picture"       => "img/coffe-images/caffe-latte.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Cappuccino",
                "type"          => ProductType::DRINKS,
                "price"         => 32000,
                "picture"       => "img/coffe-images/cappucino.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "V60",
                "type"          => ProductType::DRINKS,
                "price"         => 35000,
                "picture"       => "img/coffe-images/v60.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "French Press",
                "type"          => ProductType::DRINKS,
                "price"         => 35000,
                "picture"       => "img/coffe-images/french-press.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Espresso",
                "type"          => ProductType::DRINKS,
                "price"         => 25000,
                "picture"       => "img/coffe-images/caffe-latte.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Americano",
                "type"          => ProductType::DRINKS,
                "price"         => 30000,
                "picture"       => "img/coffe-images/cappucino.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Cappuccino",
                "type"          => ProductType::DRINKS,
                "price"         => 40000,
                "picture"       => "img/coffe-images/v60.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Latte",
                "type"          => ProductType::DRINKS,
                "price"         => 42000,
                "picture"       => "img/coffe-images/french-press.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Mocha",
                "type"          => ProductType::DRINKS,
                "price"         => 45000,
                "picture"       => "img/coffe-images/caffe-latte.jpg"
            ],
            [
                "category_id"   => 1,
                "name"          => "Macchiato",
                "type"          => ProductType::DRINKS,
                "price"         => 43000,
                "picture"       => "img/coffe-images/cappucino.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Affogato",
                "type"          => ProductType::DRINKS,
                "price"         => 38000,
                "picture"       => "img/coffe-images/v60.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Cold Brew",
                "type"          => ProductType::DRINKS,
                "price"         => 35000,
                "picture"       => "img/coffe-images/french-press.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Mie Goreng",
                "type"          => ProductType::FOODS,
                "price"         => 25000,
                "picture"       => "img/food-images/mie.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Mie Rebus",
                "type"          => ProductType::FOODS,
                "price"         => 23000,
                "picture"       => "img/food-images/mie.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Mie Ayam",
                "type"          => ProductType::FOODS,
                "price"         => 27000,
                "picture"       => "img/food-images/mie.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Mie Aceh",
                "type"          => ProductType::FOODS,
                "price"         => 30000,
                "picture"       => "img/food-images/mie.jpg"
            ],
            [
                "category_id"   => 3,
                "name"          => "Nasi Goreng",
                "type"          => ProductType::FOODS,
                "price"         => 28000,
                "picture"       => "img/food-images/hamburger.jpg"
            ],
            [
                "category_id"   => 3,
                "name"          => "Nasi Uduk",
                "type"          => ProductType::FOODS,
                "price"         => 20000,
                "picture"       => "img/food-images/hamburger.jpg"
            ],
            [
                "category_id"   => 3,
                "name"          => "Nasi Kuning",
                "type"          => ProductType::FOODS,
                "price"         => 22000,
                "picture"       => "img/food-images/hamburger.jpg"
            ],
            [
                "category_id"   => 3,
                "name"          => "Nasi Liwet",
                "type"          => ProductType::FOODS,
                "price"         => 32000,
                "picture"       => "img/food-images/hamburger.jpg"
            ],
            [
                "category_id"   => 4,
                "name"          => "Pizza Pepperoni",
                "type"          => ProductType::FOODS,
                "price"         => 85000,
                "picture"       => "img/food-images/pizza.jpg"
            ],
            [
                "category_id"   => 4,
                "name"          => "Pizza Margherita",
                "type"          => ProductType::FOODS,
                "price"         => 80000,
                "picture"       => "img/food-images/pizza.jpg"
            ],
            [
                "category_id"   => 4,
                "name"          => "Pizza BBQ Chicken",
                "type"          => ProductType::FOODS,
                "price"         => 90000,
                "picture"       => "img/food-images/pizza.jpg"
            ],
            [
                "category_id"   => 4,
                "name"          => "Pizza Hawaiian",
                "type"          => ProductType::FOODS,
                "price"         => 87000,
                "picture"       => "img/food-images/pizza.jpg"
            ],
            [
                "category_id"   => 3,
                "name"          => "Nasi Campur",
                "type"          => ProductType::FOODS,
                "price"         => 29000,
                "picture"       => "img/food-images/hamburger.jpg"
            ],
            [
                "category_id"   => 2,
                "name"          => "Mie Tek-Tek",
                "type"          => ProductType::FOODS,
                "price"         => 26000,
                "picture"       => "img/food-images/mie.jpg"
            ],
            [
                "category_id"   => 4,
                "name"          => "Pizza Meat Lovers",
                "type"          => ProductType::FOODS,
                "price"         => 95000,
                "picture"       => "img/food-images/pizza.jpg"
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
