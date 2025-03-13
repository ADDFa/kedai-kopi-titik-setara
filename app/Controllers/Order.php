<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cart;
use App\Models\Order as ModelsOrder;

class Order extends BaseController
{
    private $orderModel, $cartModel;

    public function __construct()
    {
        $this->orderModel = new ModelsOrder();
        $this->cartModel = new Cart();
    }

    public function index()
    {
        $userId = session("user.id");
        $orders = $this->orderModel->with("items", ["user_id" => session("user.id")]);

        $data = [
            "title"             => "Data Pesanan",
            "orders"            => $orders,
            "userTotalProduct"  => $this->cartModel->userTotalProduct($userId),
            "active"            => "order"
        ];

        return view("pages/order/index", $data);
    }

    public function create()
    {
        $orderItemModel = new \App\Models\OrderItem();
        $userId = session("user.id");
        $this->orderModel->db->transStart();

        try {
            // ambil seluruh produk di keranjang
            $carts = $this->cartModel
                ->setTable("carts c")
                ->select("c.id, p.id AS product_id, p.name, p.price, (p.price * c.qty) AS subtotal, c.qty")
                ->join("products p", "p.id = c.product_id", "INNER")
                ->where("user_id", $userId)
                ->asObject()
                ->findAll();

            // hitung jumlah nominal harga
            $totalPrice = array_sum(array_column((array) $carts, "subtotal"));

            // buat order baru
            $orderId = $this->orderModel->insert([
                "user_id"       => $userId,
                "status"        => "pending",
                "total_price"   => $totalPrice,
                "order_date"    => date("Y-m-d H:i:s", time())
            ]);

            foreach ($carts as $cart) {
                // buat order items
                $orderItemModel->insert([
                    "order_id"      => $orderId,
                    "product_id"    => $cart->product_id,
                    "qty"           => $cart->qty,
                    "subtotal"      => $cart->subtotal
                ]);

                // hapus dari keranjang
                $this->cartModel->delete($cart->id);
            }

            $this->orderModel->db->transCommit();

            return redirect()->back()->with("message", [
                "text"  => "Produk berhasil di order."
            ]);
        } catch (\Exception $e) {
            $this->orderModel->db->transRollback();
            return redirect()->back()->with("errMsg", $e->getMessage());
        }
    }

    public function cancel(int $id)
    {
        $this->orderModel->update($id, ["status" => "canceled"]);

        return redirect()->back()->with("message", [
            "icon"  => "info",
            "text"  => "Pesanan dibatalkan."
        ]);
    }
}
