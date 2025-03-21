<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                "type"              => "BIGINT",
                "auto_increment"    => true
            ],
            "user_id" => [
                "type"              => "BIGINT"
            ],
            "product_id" => [
                "type" => "BIGINT"
            ],
            "qty" => [
                "type"  => "INTEGER"
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
        $this->forge->addForeignKey("user_id", "users", "id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("product_id", "products", "id", "CASCADE", "CASCADE");

        $this->forge->createTable("carts", true);
    }

    public function down()
    {
        $this->forge->dropTable("carts", true);
    }
}
