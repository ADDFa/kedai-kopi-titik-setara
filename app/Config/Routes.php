<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "Home::index");

$routes->group("/", ["filter" => "guest"], static function ($routes) {
    $routes->get("sign-in", "Auth::signIn");
    $routes->post("sign-in", "Auth::handleSignIn");

    $routes->get("sign-up", "Auth::signUp");
    $routes->post("sign-up", "Auth::handleSignUp");
});

$routes->group("/", ["filter" => "auth"], static function ($routes) {
    $routes->post("sign-out", "Auth::signOut");
});

$routes->group("/", ["filter" => ["auth", "authenticate:admin"]], static function ($routes) {
    $routes->get("dashboard", "Home::dashboard");

    $routes->get("product-category/new", "ProductCategory::new");
    $routes->post("product-category", "ProductCategory::create");
    $routes->resource("product");

    $routes->get("customer/order", "CustomerOrder::index");
    $routes->get("customer/order/(:num)", "CustomerOrder::show/$1");
    $routes->get("customer/order/(:num)/print", "CustomerOrder::print/$1");
    $routes->post("customer/order/(:num)/process", "CustomerOrder::process/$1");
    $routes->post("customer/order/(:num)/completed", "CustomerOrder::completed/$1");
    $routes->delete("customer/order/(:num)", "CustomerOrder::delete/$1");
});

$routes->group("/", ["filter" => ["auth", "authenticate:customer"]], static function ($routes) {
    $routes->get("cart", "Cart::index");
    $routes->post("cart", "Cart::create");
    $routes->delete("cart/(:num)", "Cart::delete/$1");
    $routes->post("cart/add-product/(:num)", "Cart::addProduct/$1");
    $routes->post("cart/reduce-product/(:num)", "Cart::reduceProduct/$1");

    $routes->get("order", "Order::index");
    $routes->post("order", "Order::create");
    $routes->post("order/(:num)/cancel", "Order::cancel/$1");
});
