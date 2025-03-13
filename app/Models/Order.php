<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["user_id", "status", "total_price", "order_date"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    public function with(string $with, $options = []): array
    {
        switch ($with) {
            case "items":
                return $this->withItems($options["user_id"]);

            default:
                return [];
        }
    }

    private function withItems($userId = null): array
    {
        $data = $this->setTable("orders o")
            ->select("o.id, o.status, o.order_date, o.total_price, o_i.id AS item_id, o_i.subtotal, o_i.qty, p.name, c.name AS category, p.price, p.picture")
            ->join("order_items o_i", "o_i.order_id = o.id", "INNER")
            ->join("products p", "p.id = o_i.product_id", "INNER")
            ->join("categories c", "c.id = p.category_id", "INNER")
            ->where("o.user_id", $userId)
            ->orderBy("UNIX_TIMESTAMP(o.order_date)", "DESC")
            ->asObject()->findAll();

        $result = [];
        foreach ($data as $d) {
            if (!isset($result[$d->id])) {
                $result[$d->id] = (object) [
                    "id"            => $d->id,
                    "status"        => $d->status,
                    "total_price"   => $d->total_price,
                    "order_date"    => date("d-m-Y", strtotime($d->order_date)),
                    "items"         => []
                ];
            }

            array_push($result[$d->id]->items, (object) [
                "id"            => $d->item_id,
                "name"          => $d->name,
                "category"      => $d->category,
                "picture"       => $d->picture,
                "price"         => $d->price,
                "subtotal"      => $d->subtotal,
                "qty"           => $d->qty
            ]);
        }

        return $result;
    }
}
