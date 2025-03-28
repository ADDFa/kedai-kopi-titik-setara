<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Enum\ProductType;
use App\Models\Category;
use App\Models\Product as ModelsProduct;

class Product extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ModelsProduct();
    }

    private function categories(): array
    {
        $categoryModel = new Category();
        $categories = $categoryModel->select("id, name")->findAll();

        return $categories;
    }

    public function index(): string
    {
        $query = $this->productModel->withCategory();

        $keyword = $this->request->getGet("keyword");
        if ($keyword) $query->like("p.name", $keyword);

        $products = $query->findAll();
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
            "title"         => "Tambah Produk",
            "active"        => "product",
            "categories"    => $this->categories(),
            "product_types" => ProductType::values()
        ];

        return $this->pageViews("product/create", $data);
    }

    public function create()
    {
        $productTypeList = implode(",", ProductType::values());

        $rules = [
            "name"          => "required|max_length[255]",
            "type"          => "required|in_list[$productTypeList]",
            "category_id"   => "required|is_not_unique[categories.id]",
            "picture"       => "uploaded[picture]|max_size[picture,1024]|ext_in[picture,jpg,jpeg,png]",
            "price"         => "required|numeric"
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
        $product = $this->productModel->withCategory()->where("p.id", $id)->first();
        $data = [
            "title"     => "Detail Produk",
            "active"    => "product",
            "product"   => $product
        ];

        return $this->pageViews("product/show", $data);
    }

    public function edit(int $id): string
    {
        $product = $this->productModel->withCategory()->where("p.id", $id)->first();
        $product->price = intval($product->price);

        $data = [
            "id"            => $id,
            "title"         => "Edit Produk",
            "active"        => "product",
            "product"       => $product,
            "categories"    => $this->categories(),
            "product_types" => ProductType::values()
        ];

        return $this->pageViews("product/edit", $data);
    }

    public function update(int $id)
    {
        $productTypeList = implode(",", ProductType::values());

        $rules = [
            "name"          => "required|max_length[255]",
            "type"          => "required|in_list[$productTypeList]",
            "category_id"   => "required|is_not_unique[categories.id]",
            "price"         => "required|numeric"
        ];

        if (!$this->validate($rules)) return redirect()->back()->withInput()
            ->with("errors", $this->validator->getErrors());

        $data = $this->validator->getValidated();
        $product = $this->productModel->find($id);
        $picture = $this->request->getFile("picture");

        if ($picture->isValid()) {
            if (!$this->validateData(
                [
                    "picture" => "picture"
                ],
                [
                    "picture" => "uploaded[picture]|max_size[picture,1024]|ext_in[picture,jpg,jpeg,png]"
                ]
            )) {
                return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());
            }

            // simpan file
            $pictureName = date("d-m-Y-his_") . $picture->getName();
            $picture->move("coffe-images", $pictureName);

            // tambahkan nama file kedalam data
            $data["picture"] = "coffe-images/" . $pictureName;

            // hapus file lama
            if ($picture->hasMoved()) unlink($product->picture);
        }

        $this->productModel->update($id, $data);

        $message = [
            "text"  => "Data produk berhasil diupdate."
        ];
        return redirect()->back()->with("message", $message);
    }

    public function delete(int $id)
    {
        $product = $this->productModel->find($id);
        $message = [
            "text"  => "Data produk berhasil dihapus"
        ];

        $this->productModel->delete($id);
        unlink("./" . $product->picture);

        return redirect()->to("/product")->with("message", $message);
    }
}
