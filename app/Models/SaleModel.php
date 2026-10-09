<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table         = 'sales';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['product_id', 'customer_id', 'sold_by', 'quantity', 'total_price', 'created_at'];

    /** Every sale with the product, customer (if any), and staff names, newest first. */
    public function history(): array
    {
        return $this->select('sales.*, products.name AS product_name, customers.full_name AS customer_name, users.full_name AS staff_name')
            ->join('products', 'products.id = sales.product_id')
            ->join('customers', 'customers.id = sales.customer_id', 'left') // customer is optional
            ->join('users', 'users.id = sales.sold_by')
            ->orderBy('sales.created_at', 'DESC')
            ->orderBy('sales.id', 'DESC')
            ->findAll();
    }

    /** Do any sales match these conditions? Used to protect rows that sales point to. */
    public function existsWhere(array $conditions): bool
    {
        return $this->where($conditions)->countAllResults() > 0;
    }

    /**
     * Record a sale and take the units out of stock, all-or-nothing.
     *
     * The product row is locked (FOR UPDATE) while we check stock, so two
     * cashiers selling the last units at the same moment can't both succeed.
     *
     * @return array{ok: bool, message: string}
     */
    public function record(int $productId, ?int $customerId, int $staffId, int $quantity): array
    {
        $this->db->transBegin();

        try {
            $product = $this->db
                ->query('SELECT id, name, price, stock_quantity FROM products WHERE id = ? FOR UPDATE', [$productId])
                ->getRowArray();

            if (! $product) {
                $this->db->transRollback();

                return ['ok' => false, 'message' => 'That product no longer exists.'];
            }

            if ($quantity > (int) $product['stock_quantity']) {
                $this->db->transRollback();

                return [
                    'ok'      => false,
                    'message' => sprintf(
                        'Not enough stock: only %d unit(s) of "%s" available, but you asked for %d.',
                        $product['stock_quantity'],
                        $product['name'],
                        $quantity
                    ),
                ];
            }

            // Price comes from the database, never from the form, so it can't be tampered with.
            $total = number_format((float) $product['price'] * $quantity, 2, '.', '');

            $this->db->table('products')
                ->where('id', $productId)
                ->set('stock_quantity', 'stock_quantity - ' . $quantity, false)
                ->update();

            $this->insert([
                'product_id'  => $productId,
                'customer_id' => $customerId,
                'sold_by'     => $staffId,
                'quantity'    => $quantity,
                'total_price' => $total,
                'created_at'  => date('Y-m-d H:i:s'),
            ]);

            $this->db->transCommit();

            return [
                'ok'      => true,
                'message' => sprintf('Sale recorded: %d × %s for ₱%s.', $quantity, $product['name'], number_format((float) $total, 2)),
            ];
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', 'Sale failed: ' . $e->getMessage());

            return ['ok' => false, 'message' => 'Something went wrong and the sale was not recorded. Please try again.'];
        }
    }
}
