<?php

namespace App\Controllers;

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
        $data = [
            "title" => "Dashboard"
        ];

        return $this->pageViews("home/dashboard", $data);
    }
}
