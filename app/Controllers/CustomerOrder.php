<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Enum\OrderStatus;
use App\Enum\PaymentStatus;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;

class CustomerOrder extends BaseController
{
    private $orderModel, $cartModel, $paymentModel;

    public function __construct()
    {
        $this->orderModel = new Order();
        $this->cartModel = new Cart();
        $this->paymentModel = new Payment();
    }

    private function statusColor()
    {
        return function ($status) {
            switch ($status) {
                case OrderStatus::PENDING:
                    return "bg-amber-300";

                case OrderStatus::PROCESS:
                    return "bg-blue-300";

                case OrderStatus::COMPLETE:
                    return "bg-green-300";

                case OrderStatus::CANCEL:
                    return "bg-red-300";
            }
        };
    }

    public function index()
    {
        $userId = session("user.id");
        $status = $this->request->getGet("status") ?? "pending";

        $orders = $this->orderModel
            ->setTable("orders o")
            ->select([
                "o.id",
                "u.id AS user_id",
                "name",
                "total_price",
                "status",
                "order_date"
            ])
            ->join("users u", "u.id = user_id", "inner")
            ->where("status", $status)
            ->orderBy("order_date", "DESC")
            ->findAll();

        $data = [
            "title"             => "Data Pesanan",
            "orders"            => $orders,
            "userTotalProduct"  => $this->cartModel->userTotalProduct($userId),
            "active"            => "customer/order",
            "statusColor"       => $this->statusColor(),
            "status"            => $status,
            "order_status"      => OrderStatus::values()
        ];

        return view("pages/customer-order/index", $data);
    }

    public function show(int $id)
    {
        $orderItem = new OrderItem();

        $order = $this->orderModel->setTable("orders o")
            ->select([
                "o.*",
                "u.name",
                "p_m.status AS payment_status",
                "p_m.payment_method"
            ])
            ->join("users u", "u.id = user_id", "inner")
            ->join("payments p_m", "p_m.order_id = o.id", "inner")
            ->where("o.id", $id)
            ->first();

        $order->order_items = $orderItem->setTable("order_items o_i")
            ->select([
                "o_i.id",
                "product_id",
                "p.name",
                "p.picture",
                "o_i.qty",
                "o_i.subtotal"
            ])
            ->join("products p", "p.id = product_id", "inner")
            ->where("order_id", $order->id)->findAll();

        $data = [
            "title"         => "Pesanan Pelanggan",
            "active"        => "customer/order",
            "order"         => $order,
            "statusColor"   => $this->statusColor()
        ];

        return view("pages/customer-order/show", $data);
    }

    public function print(int $id)
    {
        $orderItem = new OrderItem();

        $order = $this->orderModel->setTable("orders o")
            ->select([
                "o.*",
                "u.name",
                "p_m.status AS payment_status",
                "p_m.payment_method",
                "p_m.transaction_id"
            ])
            ->join("users u", "u.id = user_id", "inner")
            ->join("payments p_m", "p_m.order_id = o.id", "inner")
            ->where("o.id", $id)
            ->first();

        $order->order_items = $orderItem->setTable("order_items o_i")
            ->select([
                "o_i.id",
                "product_id",
                "p.name",
                "p.picture",
                "o_i.qty",
                "o_i.subtotal"
            ])
            ->join("products p", "p.id = product_id", "inner")
            ->where("order_id", $order->id)->findAll();

        $data = [
            "title"         => "Print Out Struk",
            "order"         => $order
        ];

        return view("pages/customer-order/print", $data);
    }

    public function process(int $id)
    {
        try {
            $this->orderModel->db->transStart();

            // ambil id pembayaran
            $paymentId = (int) $this->paymentModel->where("order_id", $id)
                ->first()->id;

            // update status pesanan
            $this->orderModel->update($id, [
                "status" => OrderStatus::PROCESS
            ]);

            // update status pembayaran
            $this->paymentModel->update($paymentId, [
                "status" => PaymentStatus::PAID
            ]);

            $this->orderModel->db->transComplete();

            return redirect()->to("/customer/order?status=process");
        } catch (\Exception $e) {
            $this->orderModel->db->transRollback();
            return redirect()->back();
        }
    }

    public function completed($id)
    {
        $this->orderModel->update($id, [
            "status" => OrderStatus::COMPLETE
        ]);

        return redirect()->to("/customer/order?status=completed")->with("message", [
            "text" => "Pesanan telah diselesaikan."
        ]);
    }

    public function delete(int $id)
    {
        $this->orderModel->delete($id);

        return redirect()->to("/customer/order?status=canceled")->with("message", [
            "text"  => "Data pesanan berhasil dihapus."
        ]);
    }
}
