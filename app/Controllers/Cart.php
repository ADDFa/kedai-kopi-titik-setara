<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cart as ModelsCart;

class Cart extends BaseController
{
    private $cartModel;

    private function validateUserId(int $cartId): array
    {
        $cart = $this->cartModel->asObject()->find($cartId);
        if (!$cart || $cart->user_id != session("user.id")) return [false, ["text" => "Akses ditolak!", $cart]];

        return [true, null, $cart];
    }

    public function __construct()
    {
        $this->cartModel = new ModelsCart();
    }

    public function index()
    {
        $userId = session("user.id");
        $carts = $this->cartModel->setTable("carts c")->where("user_id", $userId)
            ->join("products p", "p.id = c.id", "inner")
            ->join("categories cat", "cat.id = p.category_id", "inner")
            ->select("p.id, cat.name AS category, p.name, p.price, p.picture, c.qty")
            ->asObject()->findAll();

        $data = [
            "title"             => "Keranjang Saya",
            "carts"             => $carts,
            "userTotalProduct"  => $this->cartModel->userTotalProduct($userId),
            "active"            => "cart"
        ];

        return view("pages/cart/index", $data);
    }

    public function create()
    {
        $rules = [
            "user_id"       => "required|is_not_unique[users.id]",
            "product_id"    => "required|is_not_unique[products.id]"
        ];
        if (!$this->validate($rules)) return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());

        $data = $this->validator->getValidated();
        $data["qty"] = 1;

        $userId = $this->request->getPost("user_id");
        $productId = $this->request->getPost("product_id");
        $cart = $this->cartModel->where("user_id", $userId)->where("product_id", $productId)->asObject()->first();

        if ($cart) $this->cartModel->update($cart->id, ["qty" => $cart->qty + 1]);
        if (!$cart) $this->cartModel->insert($data);

        return response()->setJSON(["total_product" => $this->cartModel->userTotalProduct($userId)]);
    }

    public function delete(int $id)
    {
        list($validId, $message) = $this->validateUserId($id);
        if ($validId) redirect()->back()->with("message", $message);

        $this->cartModel->delete($id);
        return redirect()->back()->with("message", [
            "icon"  => "success",
            "text"  => "Produk berhasil dihapus."
        ]);
    }

    public function addProduct(int $id)
    {
        list($validId, $message, $cart) = $this->validateUserId($id);
        if ($validId) redirect()->back()->with("message", $message);

        $data = ["qty" => ++$cart->qty];
        $this->cartModel->update($id, $data);

        return response()->setJSON($data);
    }

    public function reduceProduct(int $id)
    {
        list($validId, $message, $cart) = $this->validateUserId($id);
        if ($validId) redirect()->back()->with("message", $message);

        if ($cart->qty == 1) $this->cartModel->delete($id);

        $data = ["qty" => --$cart->qty];
        $this->cartModel->update($id, $data);

        return response()->setJSON($data);
    }
}
