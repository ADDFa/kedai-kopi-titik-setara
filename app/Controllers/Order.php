<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order as ModelsOrder;

class Order extends BaseController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new ModelsOrder();
    }

    public function index()
    {
        $cartModel = new \App\Models\Cart();

        $userId = session("user.id");
        $orders = $this->orderModel->with("items", ["user_id" => session("user.id")]);

        $data = [
            "title"             => "Data Pesanan",
            "orders"            => $orders,
            "userTotalProduct"  => $cartModel->userTotalProduct($userId),
            "active"            => "order"
        ];

        return view("pages/order/index", $data);
    }
}
