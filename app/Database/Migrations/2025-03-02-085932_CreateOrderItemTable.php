<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderItemTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                "type"              => "BIGINT",
                "auto_increment"    => true
            ],
            "order_id"    => [
                "type"              => "BIGINT"
            ],
            "product_id"    => [
                "type"              => "BIGINT"
            ],
            "qty"  => [
                "type"              => "INTEGER",
                "unsigned"          => true
            ],
            "subtotal"  => [
                "type"              => "DECIMAL",
                "constraint"        => [10, 2]
            ],
            "created_at" => [
                "type"              => "TIMESTAMP",
                "null"              => true
            ],
            "updated_at" => [
                "type"              => "TIMESTAMP",
                "null"              => true
            ]
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("order_id", "orders", "id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("product_id", "products", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("order_items", true);
    }

    public function down()
    {
        $this->forge->dropTable("order_items", true);
    }
}
