<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product as ModelsProduct;

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

        $data = [
            "active"    => "product",
            "products"  => $products
        ];

        return $this->pageViews("product/index", $data);
    }

    public function new(): string
    {
        $data = [
            "active"    => "product"
        ];

        return $this->pageViews("product/create", $data);
    }

    public function create()
    {
        // 
    }

    public function show(int $id): string
    {
        $product = $this->productModel->find($id);
        $data = [
            "active"    => "product",
            "product"   => $product
        ];

        return $this->pageViews("product/show", $data);
    }

    public function edit(int $id): string
    {
        $product = $this->productModel->find($id);
        $data = [
            "active"    => "product",
            "product"   => $product
        ];

        return $this->pageViews("product/edit", $data);
    }

    public function update(int $id)
    {
        // 
    }

    public function delete(int $id)
    {
        // 
    }
}
