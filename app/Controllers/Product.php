<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product as ModelsProduct;
use CodeIgniter\HTTP\ResponseInterface;

class Product extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ModelsProduct();
    }

    public function index(): string
    {
        $products = $this->productModel->findAll();
        return $this->pageViews("product.index", ["products" => $products]);
    }

    public function create(): string
    {
        return $this->pageViews("product.create");
    }

    public function store()
    {
        // 
    }

    public function show(int $id): string
    {
        $product = $this->productModel->find($id);
        return $this->pageViews("product.show", ["product" => $product]);
    }

    public function edit(int $id): string
    {
        $product = $this->productModel->find($id);
        return $this->pageViews("product.edit", $product);
    }

    public function update(int $id)
    {
        // 
    }

    public function destroy(int $id)
    {
        // 
    }
}
