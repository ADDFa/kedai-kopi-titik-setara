<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
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
        $categoryModel = new Category();
        $categories = $categoryModel->select("id, name")->asObject()->findAll();

        $data = [
            "title"         => "Tambah Produk",
            "active"        => "product",
            "categories"    => $categories
        ];

        return $this->pageViews("product/create", $data);
    }

    public function create()
    {
        $rules = [
            "name"          => "required|max_length[255]",
            "category_id"   => "required|is_not_unique[categories.id]",
            "picture"       => "uploaded[picture]",
            "price"         => "required|numeric",
            "qty"           => "required|integer"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
        }

        $picture = $this->request->getFile("picture");
        $pictureName = date("d-m-Y-his_") . $picture->getName();
        $picture->move("coffe-images", $pictureName);

        $data = $this->request->getPost();
        $data["picture"] = "coffe-images/" . $pictureName;
        $this->productModel->insert($data);

        $message = [
            "text" => "Berhasil menambahkan produk."
        ];

        return redirect()->back()->with("message", $message);
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
        $product = $this->productModel->asObject()->find($id);
        $message = [
            "text"  => "Data produk berhasil dihapus"
        ];

        if (file_exists("./" . $product->picture)) unlink("./" . $product->picture);

        $this->productModel->delete($id);
        return redirect()->to("/product")->with("message", $message);
    }
}
