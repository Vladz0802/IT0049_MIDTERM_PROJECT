<?php

namespace App\Controllers;

use App\Libraries\ImageUploader;
use App\Models\ProductModel;
use App\Models\SaleModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Products extends BaseController
{
    private array $rules = [
        'name'           => 'required|min_length[2]|max_length[100]',
        'price'          => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[99999999.99]',
        'stock_quantity' => 'required|is_natural|less_than_equal_to[1000000]',
    ];

    public function index(): string
    {
        return view('products/index', [
            'title'    => 'Products',
            'active'   => 'products',
            'products' => (new ProductModel())->orderBy('name')->findAll(),
        ]);
    }

    public function new(): string
    {
        return view('products/new', ['title' => 'Add Product', 'active' => 'products']);
    }

    public function create()
    {
        $rules = $this->rules;
        $file  = $this->request->getFile('image');
        $sent  = ImageUploader::wasSent($file);

        if ($sent) {
            $rules['image'] = ImageUploader::rules('image');
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        (new ProductModel())->insert([
            'name'           => $this->request->getPost('name'),
            'price'          => number_format((float) $this->request->getPost('price'), 2, '.', ''),
            'stock_quantity' => (int) $this->request->getPost('stock_quantity'),
            'image'          => $sent ? (new ImageUploader('products'))->store($file) : null,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/products')->with('success', 'Product added.');
    }

    public function edit($id): string
    {
        $product = (new ProductModel())->find($id);
        if (! $product) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('products/edit', [
            'title'   => 'Edit Product',
            'active'  => 'products',
            'product' => $product,
        ]);
    }

    public function update($id)
    {
        $model   = new ProductModel();
        $product = $model->find($id);
        if (! $product) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = $this->rules;
        $file  = $this->request->getFile('image');
        $sent  = ImageUploader::wasSent($file);

        if ($sent) {
            $rules['image'] = ImageUploader::rules('image');
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name'           => $this->request->getPost('name'),
            'price'          => number_format((float) $this->request->getPost('price'), 2, '.', ''),
            'stock_quantity' => (int) $this->request->getPost('stock_quantity'),
        ];

        if ($sent) {
            // store() also deletes the old file
            $data['image'] = (new ImageUploader('products'))->store($file, $product['image']);
        }

        $model->update($id, $data);

        return redirect()->to('/products')->with('success', 'Product updated.');
    }

    public function delete($id)
    {
        $model   = new ProductModel();
        $product = $model->find($id);
        if (! $product) {
            throw PageNotFoundException::forPageNotFound();
        }

        // Sales point at products by foreign key; deleting one with history would break the records.
        if ((new SaleModel())->existsWhere(['product_id' => (int) $id])) {
            return redirect()->to('/products')->with(
                'error',
                '"' . $product['name'] . '" has sales history and can\'t be deleted. Set its stock to 0 instead to stop selling it.'
            );
        }

        $model->delete($id);
        (new ImageUploader('products'))->delete($product['image']);

        return redirect()->to('/products')->with('success', 'Product deleted.');
    }
}
