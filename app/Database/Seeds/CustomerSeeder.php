<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $this->db->table('customers')->insertBatch([
            ['full_name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@example.com',  'phone' => '0917-111-2222', 'created_at' => $now],
            ['full_name' => 'Maria Santos',   'email' => 'maria.santos@example.com',   'phone' => '0917-222-3333', 'created_at' => $now],
            ['full_name' => 'Pedro Reyes',    'email' => 'pedro.reyes@example.com',    'phone' => '0917-333-4444', 'created_at' => $now],
            ['full_name' => 'Ana Lim',        'email' => 'ana.lim@example.com',        'phone' => '0917-444-5555', 'created_at' => $now],
            ['full_name' => 'Carlo Bautista', 'email' => 'carlo.bautista@example.com', 'phone' => '0917-555-6666', 'created_at' => $now],
        ]);
    }
}
