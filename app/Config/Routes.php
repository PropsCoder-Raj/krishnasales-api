<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

//user
$routes->get('login/(:any)/(:any)','User::login/$1/$2');


// Items
$routes->get('get-all-items','Item::get_all_items');
$routes->get('get-all-items-bonus','Item::get_all_items_with_bonus_master');
$routes->get('get-all-items-bonus-count/(:any)','Item::get_all_items_with_bonus_master_count/$1');
$routes->get('delete-item-master/(:any)','Item::delete_item_master/$1');
$routes->get('get-user-item-master/(:any)','Item::get_user_item_master/$1');
$routes->get('search-item-with-item-id/(:any)','Item::search_item_with_item_id/$1');
$routes->post('update-item-master/(:any)','Item::update_item_master/$1');
$routes->post('create-item-master','Item::create_item_master');
$routes->post('post-excel-item-master-file','Item::post_excel_item_master_file');


// Bonus
$routes->get('get-all-bonus','Bonus::get_all_bonus');
$routes->get('get-bonus-using-item-id/(:any)','Bonus::get_bonus_using_item_id/$1');
$routes->post('delete-bonus-master/(:any)','Bonus::delete_bonus_master/$1');
$routes->post('update-bonus-master/(:any)','Bonus::update_bonus_master/$1');
$routes->post('create-bonus-master/(:any)','Bonus::create_bonus_master/$1');
$routes->post('post-excel-bonus-master-file','Bonus::post_excel_bonus_master_file');


//Emoloyees
$routes->get('get-all-employees','Employees::get_all_employees');
$routes->get('get-total-employees-count','Employees::get_total_employees_count');
$routes->get('get-total-customer-count/(:any)','Employees::get_total_customer_count/$1');
$routes->get('get-total-employees-active-count','Employees::get_total_employees_active_count');
$routes->get('delete-employee/(:any)','Employees::delete_employee/$1');
$routes->get('get-employee/(:any)','Employees::get_employee/$1');
$routes->post('create-employee','Employees::create_employee');
$routes->post('update-employee/(:any)','Employees::update_employee/$1');


//Customers
$routes->get('get-all-customers','Customers::get_all_customers');
$routes->get('get-total-customers-count','Customers::get_total_customers_count');
$routes->get('get-total-customers-active-count','Customers::get_total_customers_active_count');
$routes->get('delete-customer/(:any)','Customers::delete_customer/$1');
$routes->post('create-customer','Customers::create_customer');
$routes->post('update-customer/(:any)','Customers::update_customer/$1');


//Orders
$routes->get('get-all-orders','Order::get_all_orders');
$routes->get('get-orders-from-user-latest-seven-days/(:any)','Order::get_user_latest_seven_days_order/$1');
$routes->get('get-orders-from-user-latest-seven-days-employee/(:any)','Order::get_user_latest_seven_days_order_employee/$1');
$routes->get('get-orders-from-user/(:any)','Order::get_user_order/$1');

$routes->get('get-total-orders-count','Order::get_total_orders_count');
$routes->get('get-total-orders-pending-count','Order::get_total_orders_pending_count');
$routes->get('get-total-orders-confirm-count','Order::get_total_orders_confirm_count');
$routes->get('get-total-orders-cancel-count','Order::get_total_orders_cancel_count');

$routes->get('get-total-orders-count-from-user/(:any)','Order::get_total_orders_count_from_user/$1');
$routes->get('get-total-orders-pending-count-from-user/(:any)','Order::get_total_orders_pending_count_from_user/$1');
$routes->get('get-total-orders-confirm-count-from-user/(:any)','Order::get_total_orders_confirm_count_from_user/$1');
$routes->get('get-total-orders-cancel-count-from-user/(:any)','Order::get_total_orders_cancel_count_from_user/$1');

$routes->get('get-total-orders-count-from-employee/(:any)','Order::get_total_orders_count_from_employee/$1');
$routes->get('get-total-orders-pending-count-from-employee/(:any)','Order::get_total_orders_pending_count_from_employee/$1');
$routes->get('get-total-orders-confirm-count-from-employee/(:any)','Order::get_total_orders_confirm_count_from_employee/$1');
$routes->get('get-total-orders-cancel-count-from-employee/(:any)','Order::get_total_orders_cancel_count_from_employee/$1');

$routes->get('delete-order/(:any)','Order::delete_order/$1');
$routes->post('create-order','Order::create_order');
$routes->post('update-order/(:any)','Order::update_order/$1');
$routes->post('update-order-status/(:any)','Order::update_order_status/$1');


// Order Details
$routes->get('get-all-user-orders','Order_Details::get_all_user_orders');
$routes->get('delete-user-order/(:any)','Order_Details::delete_user_order/$1');
$routes->get('get-user-order/(:any)','Order_Details::get_user_order/$1');
$routes->post('create-user-order','Order_Details::create_user_order');
$routes->post('update-user-order/(:any)','Order_Details::update_user_order/$1');


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/users', 'User::index');
$routes->get('/change-password/(:any)/(:any)','User::chnagePassword/$1/$2');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
