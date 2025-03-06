<?php

namespace App\Controllers;

use App\Charts\DashboardChart;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            "title" => "Home"
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
