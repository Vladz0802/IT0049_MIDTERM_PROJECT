<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $this->db->table('products')->insertBatch([
            ['name' => 'Instant Noodles (Cup)', 'price' => 18.00, 'stock_quantity' => 60,  'created_at' => $now],
            ['name' => 'Canned Sardines 155g',  'price' => 24.50, 'stock_quantity' => 40,  'created_at' => $now],
            ['name' => '3-in-1 Coffee Sachet',  'price' => 7.00,  'stock_quantity' => 120, 'created_at' => $now],
            ['name' => 'Bottled Water 500ml',   'price' => 15.00, 'stock_quantity' => 48,  'created_at' => $now],
            ['name' => 'Cola 1.5L',             'price' => 68.00, 'stock_quantity' => 24,  'created_at' => $now],
            ['name' => 'White Sugar 1kg',       'price' => 82.00, 'stock_quantity' => 15,  'created_at' => $now],
            ['name' => 'Laundry Soap Bar',      'price' => 22.00, 'stock_quantity' => 30,  'created_at' => $now],
            ['name' => 'Egg (per piece)',       'price' => 9.50,  'stock_quantity' => 5,   'created_at' => $now],
        ]);
    }
}
