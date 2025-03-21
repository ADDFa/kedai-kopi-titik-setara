<?php

namespace App\Controllers;

use App\Charts\DashboardChart;
use App\Enum\OrderStatus;
use App\Enum\UserRole;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class Home extends BaseController
{
    private $productModel;
    private $orderModel;
    private $userModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->orderModel = new Order();
        $this->userModel = new User();
    }

    public function index(): string
    {
        $cartModel = new Cart();

        $data = [
            "title"                 => "Home",
            "products"              => $this->productModel->get(),
            "bestSellers"           => $this->productModel->get("best_seller", ["limit" => 5]),
            "userTotalProduct"      => $cartModel->userTotalProduct(session("user.id"))
        ];

        return $this->pageViews("home/menu", $data);
    }

    public function dashboard(): string
    {
        $order = $this->orderModel->select([
            "SUM(total_price) AS total",
            "COUNT(id) AS total_order"
        ])
            ->where("status", OrderStatus::COMPLETE)
            ->groupBy("status")
            ->first();

        $total = number_format($order->total, 0, ",", ".");
        $totalOrder = $order->total_order;
        $visitors = $this->userModel
            ->select([
                "COUNT(id) AS total"
            ])
            ->where("role", UserRole::CUSTOMER)
            ->groupBy("role")
            ->first();

        $cards = [
            [
                "label"     => "Total Pendapatan",
                "value"     => "Rp. $total.,",
                "icon"      => "currency-dollar",
                "bg-color"  => "bg-cyan-200"
            ],
            [
                "label"     => "Jumlah Pesanan",
                "value"     => $totalOrder,
                "icon"      => "boxes",
                "bg-color"  => "bg-purple-200"
            ],
            [
                "label"     => "Jumlah Pengunjung",
                "value"     => $visitors->total,
                "icon"      => "person-hearts",
                "bg-color"  => "bg-rose-200"
            ]
        ];

        $data = [
            "title"     => "Dashboard",
            "active"    => "dashboard",
            "chart"     => new DashboardChart(),
            "cards"     => $cards
        ];

        return $this->pageViews("home/dashboard", $data);
    }
}
