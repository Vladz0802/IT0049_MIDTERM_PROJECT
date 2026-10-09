<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;

class Sales extends BaseController
{
    /** Sales history */
    public function index(): string
    {
        $sales = (new SaleModel())->history();

        return view('sales/index', [
            'title'   => 'Sales History',
            'active'  => 'history',
            'sales'   => $sales,
            'revenue' => array_sum(array_column($sales, 'total_price')),
        ]);
    }

    /** Record Sale form */
    public function new(): string
    {
        return view('sales/new', [
            'title'     => 'Record Sale',
            'active'    => 'sale',
            'products'  => (new ProductModel())->orderBy('name')->findAll(),
            'customers' => (new CustomerModel())->orderBy('full_name')->findAll(),
        ]);
    }

    public function create()
    {
        $rules = [
            'product_id'  => 'required|is_natural_no_zero|is_not_unique[products.id]',
            'customer_id' => 'permit_empty|is_natural_no_zero|is_not_unique[customers.id]',
            'quantity'    => 'required|is_natural_no_zero|less_than_equal_to[100000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $customerId = $this->request->getPost('customer_id');

        $result = (new SaleModel())->record(
            (int) $this->request->getPost('product_id'),
            $customerId === '' || $customerId === null ? null : (int) $customerId,
            (int) session()->get('userId'),
            (int) $this->request->getPost('quantity')
        );

        if (! $result['ok']) {
            return redirect()->back()->withInput()->with('error', $result['message']);
        }

        return redirect()->to('/sales')->with('success', $result['message']);
    }
}
