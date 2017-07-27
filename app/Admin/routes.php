<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UserController::class);
    $router->resource('country', CountryController::class);
    $router->resource('inquiry_website', InquiryWebsiteController::class);
    $router->resource('product_cat', ProductCatController::class);
    $router->resource('inquiry_from', InquiryFromController::class);
    $router->resource('group', GroupController::class);
    $router->resource('group_user', GroupUserController::class);
});
