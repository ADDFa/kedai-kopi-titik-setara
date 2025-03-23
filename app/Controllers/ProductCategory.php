<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductCategory as ModelsProductCategory;

class ProductCategory extends BaseController
{
    private $productCategoryModel;

    public function __construct()
    {
        $this->productCategoryModel = new ModelsProductCategory();
    }

    public function new()
    {
        $data = [
            "title"     => "Tambah Kategori Produk",
            "active"    => "product"
        ];

        return view("pages/product-category/create", $data);
    }

    public function create()
    {
        $rules = [
            "name"  => "required|max_length[255]|is_unique[categories.name]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
        }

        $this->productCategoryModel->insert($this->validator->getValidated());
        return redirect()->back()->withInput()->with("message", [
            "text"  => "Kategori produk ditambahkan."
        ]);
    }
}
