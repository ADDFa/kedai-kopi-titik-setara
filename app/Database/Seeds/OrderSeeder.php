<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                "user_id"       => 2,
                "status"        => "completed",
                "table_number"  => 1,
                "total_price"   => 64000
            ],
            [
                "user_id"       => 2,
                "status"        => "completed",
                "table_number"  => 3,
                "total_price"   => 67000
            ]
        ];

        $orderItems = [
            [
                "order_id"      => 1,
                "product_id"    => 1,
                "qty"           => 1,
                "subtotal"     => 32000
            ],
            [
                "order_id"      => 1,
                "product_id"    => 2,
                "qty"           => 1,
                "subtotal"     => 32000
            ],
            [
                "order_id"      => 2,
                "product_id"    => 2,
                "qty"           => 1,
                "subtotal"     => 32000
            ],
            [
                "order_id"      => 2,
                "product_id"    => 3,
                "qty"           => 1,
                "subtotal"     => 35000
            ]
        ];

        foreach ($orders as $order) {
            $this->db->table("orders")->insert($order);
        }

        foreach ($orderItems as $orderItem) {
            $this->db->table("order_items")->insert($orderItem);
        }
    }
}
