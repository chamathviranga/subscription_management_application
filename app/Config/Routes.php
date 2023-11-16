<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->get('/', function(){
    return redirect('login');
});

service('auth')->routes($routes);

$routes->group('',['filter' => 'session'], static function ($routes) {
    $routes->get('test', function(){
        return "Success";
    });

    $routes->get('subscription/list', 'SubscriptionsConttoller::index');
    $routes->group('subscription', static function ($routes) {
    });


});
