<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'product_id'  => ['type' => 'INT', 'constraint' => 11],
            'customer_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true], // null = walk-in customer
            'sold_by'     => ['type' => 'INT', 'constraint' => 11],
            'quantity'    => ['type' => 'INT', 'constraint' => 11],
            'total_price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at'  => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id');
        $this->forge->addForeignKey('customer_id', 'customers', 'id');
        $this->forge->addForeignKey('sold_by', 'users', 'id');
        $this->forge->createTable('sales', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('sales', true);
    }
}
