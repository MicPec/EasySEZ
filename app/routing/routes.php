<?php

$routes->group(['namespace' => 'app\controllers'], function ($routes) {
    $routes->get('/login', 'Auth::showLogin');
    $routes->post('/login', 'Auth::login');
    $routes->get('/logout', 'Auth::logout');
    $routes->get('/user/activate/{token}', 'Users::activate')->patterns(['token' => '[0-9a-fA-F]+']);

});

$routes->group(['namespace' => 'app\controllers', 'middleware' => ['setLinkBack', 'checkLogin']], function ($routes) {
    $routes->get('/', 'Dashboard::show', 'dashboard');

    $routes->get('/orders', 'Orders::show', 'orders');
    $routes->get('/order/create', 'Orders::new');
    $routes->put('/order/create', 'Orders::create');
    $routes->get('/order/{id}', 'Orders::get')->patterns(['id' => '[0-9]+']);
    $routes->put('/order/{id}', 'Orders::update')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->post('/order/{id}/changestatus', 'Orders::changeStatus')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->post('/order/{id}/addflag', 'Orders::addFlag')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->post('/order/{id}/removeflag', 'Orders::removeFlag')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->get('/order/{id}/summary', 'Orders::summary')->patterns(['id' => '[0-9]+']);

    $routes->get('/clients', 'Clients::show', 'clients');
    $routes->get('/client/create', 'Clients::new');
    $routes->put('/client/create', 'Clients::create');
    $routes->get('/client/{id}', 'Clients::get')->patterns(['id' => '[0-9]+']);
    $routes->put('/client/{id}', 'Clients::update')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->post('/client/delete', 'Clients::delete')->middleware('csrf')->middleware('adminAccess');

    $routes->get('/products', 'Products::show', 'products');
    $routes->get('/product/create', 'Products::new');
    $routes->put('/product/create', 'Products::create');
    $routes->get('/product/{id}', 'Products::get')->patterns(['id' => '[0-9]+']);
    $routes->put('/product/{id}', 'Products::update')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->post('/product/delete', 'Products::delete')->middleware('csrf')->middleware('adminAccess');

    $routes->get('/statuses', 'Statuses::show', 'statuses');
    $routes->get('/status/create', 'Statuses::new')->middleware('adminAccess');
    $routes->put('/status/create', 'Statuses::create')->middleware('adminAccess');
    $routes->get('/status/{id}', 'Statuses::get')->patterns(['id' => '[0-9]+'])->middleware('adminAccess');
    $routes->put('/status/{id}', 'Statuses::update')->patterns(['id' => '[0-9]+'])->middleware('csrf')->middleware('adminAccess');
    $routes->post('/status/delete', 'Statuses::delete')->middleware('csrf')->middleware('adminAccess');

    $routes->get('/units', 'Units::show', 'units');
    $routes->get('/unit/create', 'Units::new');
    $routes->put('/unit/create', 'Units::create');
    $routes->get('/unit/{id}', 'Units::get');
    $routes->put('/unit/{id}', 'Units::update')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->post('/unit/delete', 'Units::delete')->middleware('csrf')->middleware('adminAccess');

    $routes->get('/flags', 'Flags::show', 'flags');
    $routes->get('/flag/create', 'Flags::new');
    $routes->put('/flag/create', 'Flags::create');
    $routes->get('/flag/{id}', 'Flags::get')->patterns(['id' => '[0-9]+']);
    $routes->put('/flag/{id}', 'Flags::update')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->post('/flag/delete', 'Flags::delete')->middleware('csrf')->middleware('adminAccess');

    $routes->get('/users', 'Users::show', 'users')->middleware('adminAccess');
    $routes->get('/user/create', 'Users::new')->middleware('adminAccess');
    $routes->put('/user/create', 'Users::create')->middleware('adminAccess');
    $routes->get('/user/{id}', 'Users::get')->patterns(['id' => '[0-9]+'])->middleware('adminAccess');
    $routes->get('/user/profile', 'Users::profile');
    $routes->put('/user/{id}', 'Users::update')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->get('/user/{id}/changepassword', 'Users::changePassword')->patterns(['id' => '[0-9]+']);
    $routes->put('/user/{id}/changepassword', 'Users::updatePassword')->patterns(['id' => '[0-9]+'])->middleware('csrf');
    $routes->post('/user/ban', 'Users::ban')->middleware('csrf')->middleware('adminAccess');
    $routes->post('/user/unban', 'Users::unban')->middleware('csrf')->middleware('adminAccess');

    $routes->get('/calendar', 'Calendar::show');
});

$routes->group(['prefix' => '/api', 'namespace' => 'app\controllers', 'middleware' => 'checkLogin'], function ($routes) {
    $routes->get('/getClients', 'Clients::select');
    $routes->get('/getProducts', 'Products::select');
    $routes->get('/getStatuses', 'Statuses::select');
    $routes->get('/getFlags', 'Flags::select');
    $routes->get('/getUsers', 'Users::select');
    $routes->get('/getUserGroups', 'Users::selectGroup');
    $routes->get('/getUnits', 'Units::select');
    $routes->get('/getStates', 'States::select');
    $routes->get('/getStatusModal/{id}', 'Orders::getStatusModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/getAddFlagModal/{id}', 'Orders::getAddFlagModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/removeFlagModal/{id}/{flag}', 'Orders::removeFlagModal')->patterns(['id' => '[0-9]+', 'flag' => '[0-9]+']);
    $routes->get('/banUserModal/{id}', 'Users::banUserModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/unbanUserModal/{id}', 'Users::unbanUserModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/flagDeleteModal/{id}', 'Flags::flagDeleteModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/statusDeleteModal/{id}', 'Statuses::statusDeleteModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/unitDeleteModal/{id}', 'Units::unitDeleteModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/productDeleteModal/{id}', 'Products::productDeleteModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/clientDeleteModal/{id}', 'Clients::clientDeleteModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/getNoteModal/{id}', 'Orders::getNoteModal')->patterns(['id' => '[0-9]+']);
    $routes->get('/getStatuslogModal/{id}', 'Orders::getStatuslogModal')->patterns(['id' => '[0-9]+']);
});
