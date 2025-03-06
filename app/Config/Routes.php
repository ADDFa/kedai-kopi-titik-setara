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

$routes->get("/menu", "Home::index");

$routes->group("/", ["filter" => "auth"], static function ($routes) {
    $routes->post("sign-out", "Auth::signOut");
});

$routes->group("/", ["filter" => ["auth", "authenticate:admin"]], static function ($routes) {
    $routes->get("dashboard", "Home::dashboard");
    $routes->resource("product");
});
