<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/','Backend\AuthController::index');



$routes->group('{locale}', function ($routes) {

    $routes->group('admin', ['namespace' => 'App\Controllers\Backend'], function ($routes) {
        $routes->get('/', 'Dashboard::index', ['filter' => 'restrict']);
  
        $routes->get('auth', 'AuthController::index');
        
        // Explicitly define the login route to match the form post URL exactly
        $routes->post('login', 'AuthController::check_login');
        // Alias to ensure the route works with other URL patterns
        // $routes->addRedirect('{locale}/admin/login', '{locale}/admin/login');
        
        $routes->get('logout', 'AuthController::signout');
  
        $routes->post('sales_by_waiters', 'Dashboard::sales_by_waiters');
     });

});
