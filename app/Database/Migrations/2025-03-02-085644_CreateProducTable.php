<?php

namespace App\Database\Migrations;

use App\Enum\ProductType;
use CodeIgniter\Database\Migration;

class CreateProducTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                "type"              => "BIGINT",
                "auto_increment"    => true
            ],
            "category_id"    => [
                "type"              => "BIGINT"
            ],
            "type"  => [
                "type"              => "ENUM",
                "constraint"        => ProductType::values()
            ],
            "name"  => [
                "type"              => "VARCHAR",
                "constraint"       => 255
            ],
            "price"  => [
                "type"              => "DECIMAL",
                "constraint"       => [10, 2]
            ],
            "picture"  => [
                "type"              => "VARCHAR",
                "constraint"       => 255
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
        $this->forge->addForeignKey("category_id", "categories", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("products", true);
    }

    public function down()
    {
        $this->forge->dropTable("products", true);
    }
}
