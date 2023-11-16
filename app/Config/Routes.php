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
        $routes->get('list', 'CustomerSubscriptionsController::index', ['as' => 'customer.subscription.list']);

        $routes->get('create', 'CustomerSubscriptionsController::create', ['as' => 'customer.subscription.create']);
        $routes->post('create', 'CustomerSubscriptionsController::submit', ['as' => 'customer.subscription.submit']);

        $routes->get('edit/(:num)', 'CustomerSubscriptionsController::edit/$1', ['as' => 'customer.subscription.edit']);
        $routes->put('edit/(:num)', 'CustomerSubscriptionsController::update/$1', ['as' => 'customer.subscription.update']);

        $routes->get('cancel/(:num)', 'CustomerSubscriptionsController::cancel/$1', ['as' => 'customer.subscription.cancel']);
        $routes->post('cancel/(:num)', 'CustomerSubscriptionsController::submitCancelRequest/$1', ['as' => 'customer.subscription.submit_cancel_request']);

        $routes->get('suspend/(:num)', 'CustomerSubscriptionsController::suspend/$1', ['as' => 'customer.subscription.suspend']);
        $routes->post('suspend/(:num)', 'CustomerSubscriptionsController::submitSuspendRequest/$1', ['as' => 'customer.subscription.submit_suspend_request']);

    });

});
