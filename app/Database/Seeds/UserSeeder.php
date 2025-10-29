<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin123',
                'password' => password_hash('123456789', PASSWORD_BCRYPT),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
