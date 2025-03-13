<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'name', 'price', 'picture', 'qty'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function withCategory()
    {
        return $this->setTable("products as p")->select("p.id, category_id, p.name, p.price, p.picture, p.qty, c.name AS category_name")
            ->join("categories AS c", "c.id = p.category_id", "LEFT");
    }

    public function get(string $category = "", array $options = [])
    {
        $binds = [];

        $query =
            "SELECT
                p.*,
                COALESCE(s_i.sold, 0) AS sold
            FROM products p
            LEFT JOIN (
                SELECT
                    o_i.product_id,
                    COUNT(o_i.product_id) AS sold
                FROM order_items o_i
                INNER JOIN orders o ON o.id = o_i.order_id
                WHERE o.status = 'completed'
                GROUP BY o_i.product_id
            ) AS s_i ON p.id = s_i.product_id";

        if ($category) {
            switch ($category) {
                case "best_seller":
                    $query .= " ORDER BY sold DESC";
                    break;
            }
        }

        if (key_exists("limit", $options)) {
            $query .= " LIMIT ?";
            $binds[] = $options["limit"];
        }

        return $this->db->query($query, $binds)->getResult();
    }
}
