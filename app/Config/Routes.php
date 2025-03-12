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

    $routes->get("cart", "Cart::index");
    $routes->post("cart", "Cart::create");
    $routes->delete("cart/(:num)", "Cart::delete/$1");
    $routes->post("cart/add-product/(:num)", "Cart::addProduct/$1");
    $routes->post("cart/reduce-product/(:num)", "Cart::reduceProduct/$1");
});

$routes->group("/", ["filter" => ["auth", "authenticate:admin"]], static function ($routes) {
    $routes->get("dashboard", "Home::dashboard");
    $routes->resource("product");
});
