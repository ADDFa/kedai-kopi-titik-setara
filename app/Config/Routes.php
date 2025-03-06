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

    $routes->resource("product");
    $routes->post("sign-out", "Auth::signOut");
});
