<?php

namespace App\Database\Migrations;

use App\Enum\UserRole;
use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type"              => "BIGINT",
                "auto_increment"    => true
            ],
            "username"  => [
                "type"              => "VARCHAR",
                "constraint"        => 255,
                "unique"            => true
            ],
            "password"  => [
                "type"              => "VARCHAR",
                "constraint"        => 255
            ],
            "name"  => [
                "type"              => "VARCHAR",
                "constraint"        => 255
            ],
            "role"  => [
                "type"              => "ENUM",
                "constraint"        => UserRole::values(),
                "default"           => "customer"
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
        $this->forge->createTable("users", true);
    }

    public function down()
    {
        $this->forge->dropTable("users", true);
    }
}
