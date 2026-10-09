<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table         = 'customers';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['full_name', 'email', 'phone', 'created_at'];

    /**
     * Delete a customer without losing sales history: their past sales become
     * walk-in sales (customer_id is nullable), then the customer row is removed.
     */
    public function deleteKeepingSales(int $id): void
    {
        $this->db->transBegin();

        try {
            $this->db->table('sales')->where('customer_id', $id)->update(['customer_id' => null]);
            $this->delete($id);
            $this->db->transCommit();
        } catch (\Throwable $e) {
            $this->db->transRollback();
            throw $e;
        }
    }
}
