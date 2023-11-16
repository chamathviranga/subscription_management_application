<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->get('/', function () {
    return redirect('login');
});

service('auth')->routes($routes);

$routes->group('', ['filter' => 'session'], static function ($routes) {
    $routes->get('test', function () {
        return "Success";
    });

    // Only for admin user
    $routes->group('admin/subscription', static function ($routes) {
        $routes->get('list', 'SubscriptionsController::index', ['as' => 'subscription.list']);

        $routes->get('create', 'SubscriptionsController::create', ['as' => 'subscription.create']);
        $routes->post('create', 'SubscriptionsController::submit', ['as' => 'subscription.submit']);
    });

    // Only for customers
    $routes->group('subscription', static function ($routes) {
        $routes->get('list', 'SubscriptionsController::index', ['as' => 'subscription.list']);

        $routes->get('create', 'SubscriptionsController::create', ['as' => 'subscription.create']);
        $routes->post('create', 'SubscriptionsController::submit', ['as' => 'subscription.submit']);
    });

});
