<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product as ModelsProduct;
use CodeIgniter\Files\File;

class Product extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ModelsProduct();
    }

    public function index(): string
    {
        $query = $this->productModel->withCategory();

        $keyword = $this->request->getGet("keyword");
        if ($keyword) $query->like("p.name", $keyword);

        $products = $query->asObject()->findAll();
        $data = [
            "title"     => "Data Produk",
            "active"    => "product",
            "products"  => $products,
            "keyword"   => $keyword
        ];

        return $this->pageViews("product/index", $data);
    }

    public function new(): string
    {
        $data = [
            "title"     => "Tambah Produk",
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
        $product = $this->productModel->withCategory()->where("p.id", $id)->asObject()->first();
        $data = [
            "title"     => "Detail Produk",
            "active"    => "product",
            "product"   => $product
        ];

        return $this->pageViews("product/show", $data);
    }

    public function edit(int $id): string
    {
        $product = $this->productModel->withCategory()->asObject()->find($id);
        $data = [
            "title"     => "Edit Produk",
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
        $message = [
            "text"  => "Data produk berhasil dihapus"
        ];

        $this->productModel->delete($id);
        return redirect()->to("/product")->with("message", $message);
    }
}
