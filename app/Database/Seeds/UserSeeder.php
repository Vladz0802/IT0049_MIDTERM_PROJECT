<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $now  = date('Y-m-d H:i:s');
        $hash = password_hash('password123', PASSWORD_DEFAULT); // starter password for every seeded account

        $this->db->table('users')->insertBatch([
            ['username' => 'jcruz',     'full_name' => 'Juan Dela Cruz', 'password' => $hash, 'created_at' => $now],
            ['username' => 'msantos',   'full_name' => 'Maria Santos',   'password' => $hash, 'created_at' => $now],
            ['username' => 'preyes',    'full_name' => 'Pedro Reyes',    'password' => $hash, 'created_at' => $now],
            ['username' => 'alim',      'full_name' => 'Ana Lim',        'password' => $hash, 'created_at' => $now],
            ['username' => 'cbautista', 'full_name' => 'Carlo Bautista', 'password' => $hash, 'created_at' => $now],
        ]);
    }
}
