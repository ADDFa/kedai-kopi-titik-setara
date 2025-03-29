<?php

namespace App\Database\Migrations;

use App\Enum\OrderStatus;
use CodeIgniter\Database\Migration;

class CreateOrderTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                "type"              => "BIGINT",
                "auto_increment"    => true
            ],
            "user_id"    => [
                "type"              => "BIGINT"
            ],
            "status"  => [
                "type"              => "ENUM",
                "constraint"        => OrderStatus::values(),
                "default"           => "pending"
            ],
            "table_number" => [
                "type"              => "INTEGER"
            ],
            "total_price"  => [
                "type"              => "DECIMAL",
                "constraint"       => [10, 2]
            ],
            "order_date"  => [
                "type"              => "TIMESTAMP"
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
        $this->forge->createTable("orders", true);
    }

    public function down()
    {
        $this->forge->dropTable("orders", true);
    }
}
