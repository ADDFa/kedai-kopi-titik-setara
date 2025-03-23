<?php

namespace App\Database\Migrations;

use App\Enum\PaymentStatus;
use CodeIgniter\Database\Migration;

class CreatePaymentTable extends Migration
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
            "payment_method"  => [
                "type"              => "ENUM",
                "constraint"        => ["cash", "qris"]
            ],
            "status"  => [
                "type"              => "ENUM",
                "constraint"        => PaymentStatus::values()
            ],
            "transaction_id"  => [
                "type"              => "VARCHAR",
                "constraint"        => 255,
                "unique"            => true
            ],
            "date"  => [
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
        $this->forge->addForeignKey("order_id", "orders", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("payments", true);
    }

    public function down()
    {
        $this->forge->dropTable("payments", true);
    }
}
