<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cart as ModelsCart;

class Cart extends BaseController
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new ModelsCart();
    }

    private function validateUserId(int $cartId): array
    {
        $cart = $this->cartModel->find($cartId);
        if (!$cart || $cart->user_id != session("user.id")) return [false, ["text" => "Akses ditolak!", $cart]];

        return [true, null, $cart];
    }

    public static function total(bool $format = true)
    {
        $cartModel = new ModelsCart();
        $userId = session("user.id");
        $total = $cartModel
            ->select("SUM(qty * products.price) as total")
            ->join("products", "products.id = product_id", "inner")
            ->groupBy("user_id")
            ->where("user_id", $userId)
            ->find()[0]->total ?? 0;

        return $format ? number_format($total, 2, ",", ".") : $total;
    }

    public function index()
    {
        $userId = session("user.id");
        $carts = $this->cartModel->setTable("carts c")
            ->select("c.id, p.id AS product_id, p.name, p.price, (p.price * c.qty) AS subtotal, p.picture, c.qty")
            ->join("products p", "p.id = c.product_id", "inner")
            ->where("user_id", $userId)
            ->orderBy("name", "ASC")
            ->findAll();

        $data = [
            "title"             => "Keranjang Saya",
            "carts"             => $carts,
            "userTotalProduct"  => $this->cartModel->userTotalProduct($userId),
            "active"            => "cart",
            "total"             => self::total()
        ];

        return view("pages/cart/index", $data);
    }

    public function create()
    {
        $rules = [
            "product_id"    => "required"
        ];
        if (!$this->validate($rules)) {
            return response()->setJSON($this->validator->getErrors());
        }

        $userId = session("user.id");
        $productId = $this->request->getPost("product_id");

        $data = [
            "user_id"       => $userId,
            "product_id"    => $productId,
            "qty"           => 1
        ];

        // cek apakah produk sudah ada di keranjang
        $cart = $this->cartModel->where("user_id", $userId)->where("product_id", $productId)->first();

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

        $data["total"] = self::total();
        return response()->setJSON($data);
    }

    public function reduceProduct(int $id)
    {
        list($validId, $message, $cart) = $this->validateUserId($id);
        if ($validId) redirect()->back()->with("message", $message);

        if ($cart->qty == 1) $this->cartModel->delete($id);

        $data = ["qty" => --$cart->qty];
        $this->cartModel->update($id, $data);

        $data["total"] = self::total();
        return response()->setJSON($data);
    }
}
