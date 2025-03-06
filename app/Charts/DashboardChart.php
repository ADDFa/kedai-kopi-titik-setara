<?php

namespace App\Charts;

class DashboardChart extends BaseChart
{
    public function __construct()
    {
        parent::__construct();

        $this->type = "line";

        $this->data = [
            "labels"    => ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            "datasets"  => [
                [
                    "label" => "Produk Terjual",
                    "data"  => [
                        "10",
                        "5",
                        "7",
                        "3",
                        "12",
                        "8",
                        "15",
                        "6",
                        "9",
                        "14",
                        "11",
                        "4"
                    ],
                    "borderColor"   => "oklch(0.714 0.203 305.504)",
                    "cubicInterpolationMode"    => "monotone",
                    "tension" => .4
                ],
                [
                    "label" => "Jumlah Pengunjung",
                    "data"  => [
                        "8",
                        "14",
                        "6",
                        "12",
                        "9",
                        "4",
                        "11",
                        "7",
                        "15",
                        "3",
                        "10",
                        "5"
                    ],
                    "borderColor"   => "oklch(0.712 0.194 13.428)",
                    "cubicInterpolationMode"    => "monotone",
                    "tension" => .4
                ]
            ]
        ];

        $this->options = [
            "responsive"            => true,
            "maintainAspectRatio"   => false,
            "scales"    => [
                "y"     => [
                    "beginAtZero" => true
                ]
            ],
            "plugins" => [
                "title" => [
                    "display"   => true,
                    "text"      => "Grafik pengunjung - produk terjual"
                ]
            ]
        ];
    }
}
