<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cart;
use App\Models\Order;

class CustomerOrder extends BaseController
{
    private $orderModel, $cartModel;

    public function __construct()
    {
        $this->orderModel = new Order();
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

        return view("pages/customer/order/index", $data);
    }
}
