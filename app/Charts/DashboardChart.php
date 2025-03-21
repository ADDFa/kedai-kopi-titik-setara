<?php

namespace App\Charts;

class DashboardChart extends BaseChart
{
    public function __construct()
    {
        parent::__construct();

        $db = db_connect();

        $query = "SELECT DATE_FORMAT(order_date, '%M') AS month, DATE_FORMAT(order_date, '%m') AS month_num, COUNT(id) AS total_visitors, product_sold
                FROM orders o
                JOIN (
                    SELECT SUM(qty) AS product_sold, order_id
                    FROM order_items o_i
                    INNER JOIN orders o ON o.id = o_i.order_id
                    WHERE o.status = 'completed'
                    GROUP BY o_i.order_id
                ) AS p_s ON p_s.order_id = o.id
                WHERE status = 'completed'
                GROUP BY month
                ORDER BY month_num";

        $result = $db->query($query)->getResultArray();

        $this->type = "line";

        $this->data = [
            "labels"    => array_column($result, "month"),
            "datasets"  => [
                [
                    "label" => "Produk Terjual",
                    "data"  => array_column($result, "product_sold"),
                    "borderColor"   => "oklch(0.714 0.203 305.504)",
                    "cubicInterpolationMode"    => "monotone",
                    "tension" => .4
                ],
                [
                    "label" => "Jumlah Pengunjung",
                    "data"  => array_column($result, "total_visitors"),
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
