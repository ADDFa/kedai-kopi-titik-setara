<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"    => [
                "type"              => "BIGINT",
                "auto_increment"    => true
            ],
            "name"  => [
                "type"              => "VARCHAR",
                "constraint"       => 255,
                "unique"            => true
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
        $this->forge->createTable("categories", true);
    }

    public function down()
    {
        $this->forge->dropTable("categories", true);
    }
}
