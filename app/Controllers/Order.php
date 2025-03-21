<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Cart as ControllersCart;
use App\Models\Cart;
use App\Models\Order as ModelsOrder;
use Symfony\Component\Uid\Uuid;

class Order extends BaseController
{
    private $orderModel, $cartModel;

    public function __construct()
    {
        $this->orderModel = new ModelsOrder();
        $this->cartModel = new Cart();
    }

    private function validateUserId(int $orderId)
    {
        $userId = session("user.id");
        $order = $this->orderModel->find($orderId);

        if ($order->user_id != $userId) return [
            false,
            ["text" => "Akses ditolak!", "icon" => "error"],
            $order
        ];

        return [true, null, $order];
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
        $rules = [
            "payment_method"    =>  "required|in_list[qris,cash]"
        ];

        if (!$this->validate($rules)) return redirect()->back()->withInput()
            ->with("errors", $this->validator->getErrors());

        $userId = session("user.id");
        $orderItemModel = new \App\Models\OrderItem();
        $paymentModel = new \App\Models\Payment();

        try {
            $this->orderModel->db->transStart();

            // simpan data order
            $orderId = $this->orderModel->insert([
                "user_id"       => $userId,
                "total_price"   => ControllersCart::total(false),
                "order_date"    => date("Y-m-d H:i:s")
            ]);

            // simpan data products yang di order
            $carts = $this->cartModel
                ->setTable("carts c")
                ->select([
                    "product_id",
                    "c.qty",
                    "(p.price * c.qty) AS subtotal"
                ])
                ->join("products p", "p.id = product_id", "inner")
                ->where("user_id", $userId)->findAll();

            foreach ($carts as $cart) {
                $orderItemModel->insert([
                    "order_id"      => $orderId,
                    "product_id"    => $cart->product_id,
                    "qty"           => $cart->qty,
                    "subtotal"      => $cart->subtotal
                ]);
            }

            // simpan data pembayaran
            $paymentModel->insert([
                "order_id"          => $orderId,
                "payment_method"    => $this->request->getPost("payment_method"),
                "transaction_id"    => Uuid::v7(),
                "date"              => date("Y-m-d H:i:s")
            ]);

            // kosongkan keranjang
            $this->cartModel->where("user_id", $userId)->delete();

            $this->orderModel->db->transCommit();

            return redirect()->back()->with("message", [
                "text"  => "Order telah dibuat, silakan lakukan pembayaran!"
            ]);
        } catch (\Exception $e) {
            $this->orderModel->db->transRollback();
            return redirect()->back()->with("server_error", $e->getMessage());
        }
    }

    public function cancel(int $id)
    {
        list($valid, $message) = $this->validateUserId($id);
        if (!$valid) return redirect()->back()->with("message", $message);

        $this->orderModel->update($id, ["status" => "canceled"]);

        return redirect()->back()->with("message", [
            "icon"  => "info",
            "text"  => "Pesanan dibatalkan."
        ]);
    }
}
