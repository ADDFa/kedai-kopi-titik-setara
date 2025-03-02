<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group("/", ["filter" => "guest"], static function ($routes) {
    $routes->get("", "Auth::signIn");
    $routes->post("", "Auth::handleSignIn");

    $routes->get("sign-up", "Auth::signUp");
    $routes->post("sign-up", "Auth::handleSignUp");
});

$routes->group("/", ["filter" => "auth"], static function ($routes) {
    $routes->get("dashboard", "Home::dashboard");

    $routes->get("product", "Product::index");
    $routes->get("product/(:id)", "Product::show");
    $routes->get("product/add", "Product::create");
    $routes->post("product", "Product::store");
    $routes->get("product/(:id)/edit", "Product::edit");
    $routes->put("product/(:id)", "Product::update");
    $routes->delete("product/(:id)", "Product::destroy");
});
