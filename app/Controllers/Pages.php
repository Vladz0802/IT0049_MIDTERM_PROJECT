<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Pages extends BaseController
{
    public function index(): string
    {
        $counts = null;

        // Store figures are only shown to logged-in staff
        if (session()->get('isLoggedIn')) {
            $counts = [
                'products'  => (new ProductModel())->countAllResults(),
                'customers' => (new CustomerModel())->countAllResults(),
                'staff'     => (new UserModel())->countAllResults(),
                'sales'     => (new SaleModel())->countAllResults(),
            ];
        }

        return view('pages/landing', [
            'title'  => 'Corner Shop POS',
            'active' => 'home',
            'counts' => $counts,
        ]);
    }

    public function about(): string
    {
        return view('pages/about', [
            'title'  => 'About · Corner Shop POS',
            'active' => 'about',
        ]);
    }
}
