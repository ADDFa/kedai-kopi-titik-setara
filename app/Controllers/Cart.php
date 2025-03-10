<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cart as ModelsCart;
use CodeIgniter\HTTP\ResponseInterface;

class Cart extends BaseController
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new ModelsCart();
    }

    public function create()
    {
        $rules = [
            "user_id"       => "required|is_not_unique[users.id]",
            "product_id"    => "required|is_not_unique[products.id]"
        ];
        if (!$this->validate($rules)) return redirect()->back()->withInput()->with("errors", $this->validator->getErrors());

        $data = $this->validator->getValidated();
        $data["qty"] = 1;

        $userId = $this->request->getPost("user_id");
        $productId = $this->request->getPost("product_id");
        $cart = $this->cartModel->where("user_id", $userId)->where("product_id", $productId)->asObject()->first();

        if ($cart) $this->cartModel->update($cart->id, ["qty" => $cart->qty + 1]);
        if (!$cart) $this->cartModel->insert($data);

        return response()->setJSON(["total_product" => $this->cartModel->userTotalProduct($userId)]);
    }
}
