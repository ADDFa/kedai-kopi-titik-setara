<?php

namespace App\Controllers;

use App\Charts\DashboardChart;
use App\Models\Cart;
use App\Models\Product;

class Home extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
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
        $cards = [
            [
                "label"     => "Total Pendapatan",
                "value"     => "Rp. 1.200.000.,",
                "icon"      => "currency-dollar",
                "bg-color"  => "bg-cyan-200"
            ],
            [
                "label"     => "Jumlah Pesanan",
                "value"     => 50,
                "icon"      => "boxes",
                "bg-color"  => "bg-purple-200"
            ],
            [
                "label"     => "Jumlah Pengunjung",
                "value"     => 24,
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
