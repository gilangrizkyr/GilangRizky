<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Truncate table before seeding
        $this->db->table('users')->truncate();

        $data = [
            'username' => 'GilangRizky',
            'password' => password_hash('Gilang091102!@#', PASSWORD_BCRYPT),
            'email' => 'admin@example.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
    }
}
