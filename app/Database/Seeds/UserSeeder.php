<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                "username"  => "admin",
                "password"  => password_hash("password", PASSWORD_BCRYPT),
                "name"      => "Admin",
                "role"      => "admin"
            ],
            [
                "username"  => "customer-1",
                "password"  => password_hash("password", PASSWORD_BCRYPT),
                "name"      => "Customer 1",
                "role"      => "customer"
            ]
        ];

        foreach ($users as $user) {
            $this->db->table("users")->insert($user);
        }
    }
}
