<?php

use App\Customer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Log viewer route
Route::get('logs', ['middleware' => ['auth', 'role:Gymie'], 'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);

//Data Migration
Route::get('data/migration', ['middleware' => ['auth', 'role:Gymie'], 'uses' => 'DataMigrationController@migrate']);
Route::get('data/media/migration', ['middleware' => ['auth', 'role:Gymie'], 'uses' => 'DataMigrationController@migrateMedia']);
Route::get('excel/migration', ['middleware' => ['auth', 'role:Gymie'], 'uses' => 'DataMigrationController@migrateExcel']);

//Report DATA
Route::get('reportData/members', 'MembersController@details');

//API routes
// Route::post('api/token', 'Api\AuthenticateController@authenticate');

// Route::group(['prefix' => 'api', 'middleware' => ['jwt.auth']], function () {
//     Route::get('dashboard', 'Api\DashboardController@index');
//     Route::get('dashboard', 'Api\DashboardController@index1');
//     Route::get('members', 'Api\MembersController@index');
//     Route::get('subscriptions', 'Api\SubscriptionsController@index');
//     Route::get('payments', 'Api\PaymentsController@index');
//     Route::get('invoices', 'Api\InvoicesController@index');
//     Route::get('invoices/paid', 'Api\InvoicesController@paid');
//     Route::get('invoices/unpaid', 'Api\InvoicesController@unpaid');
//     Route::get('invoices/partial', 'Api\InvoicesController@partial');
//     Route::get('invoices/overpaid', 'Api\InvoicesController@overpaid');
//     Route::get('enquiries', 'Api\EnquiriesController@index');
//     Route::get('settings', 'Api\SettingsController@index');
//     Route::get('plans', 'Api\PlansController@index');
//     Route::get('expenseCategories', 'Api\ExpenseCategoriesController@index');
//     Route::get('expenses', 'Api\ExpensesController@index');
//     Route::get('subscriptions/expiring', 'Api\SubscriptionsController@expiring');
//     Route::get('subscriptions/expired', 'Api\SubscriptionsController@expired');
//     Route::get('members/{id}', 'Api\MembersController@show');
//     Route::get('subscriptions/{id}', 'Api\SubscriptionsController@show');
//     Route::get('payments/{id}', 'Api\PaymentsController@show');
//     Route::get('invoices/{id}', 'Api\InvoicesController@show');
//     Route::get('enquiries/{id}', 'Api\EnquiriesController@show');
//     Route::get('plans/{id}', 'Api\PlansController@show');
//     Route::get('expenseCategories/{id}', 'Api\ExpenseCategoriesController@show');
//     Route::get('expenses/{id}', 'Api\ExpensesController@show');
// });

//Auth routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});

//dashboard
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/dashboard/charts', 'DashboardController@indexCharts');
    Route::post('/dashboard/smsRequest', 'DashboardController@smsRequest');
});

//MembersController
Route::group(['prefix' => 'members', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-gymie|manage-members|view-member'], 'uses' => 'MembersController@index']);
    Route::get('all', ['middleware' => ['permission:manage-gymie|manage-members|view-member'], 'uses' => 'MembersController@index']);
    Route::get('active', ['middleware' => ['permission:manage-gymie|manage-members|view-member'], 'uses' => 'MembersController@active']);
    Route::get('inactive', ['middleware' => ['permission:manage-gymie|manage-members|view-member'], 'uses' => 'MembersController@inactive']);
    Route::get('create', ['middleware' => ['permission:manage-gymie|manage-members|add-member'], 'uses' => 'MembersController@create']);
    Route::post('/', ['middleware' => ['permission:manage-gymie|manage-members|add-member'], 'uses' => 'MembersController@store']);
    Route::get('{id}/show', ['middleware' => ['permission:manage-gymie|manage-members|view-member'], 'uses' => 'MembersController@show']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-gymie|manage-members|edit-member'], 'uses' => 'MembersController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-gymie|manage-members|edit-member'], 'uses' => 'MembersController@update']);
    Route::post('{id}/archive', ['middleware' => ['permission:manage-gymie|manage-members|delete-member'], 'uses' => 'MembersController@archive']);
    Route::get('{id}/transfer', ['middleware' => ['permission:manage-gymie|manage-enquiries|transfer-enquiry'], 'uses' => 'MembersController@transfer']);
});

//SmsController
Route::group(['prefix' => 'sms', 'middleware' => ['auth']], function () {
    Route::get('triggers', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@triggersIndex']);
    Route::post('triggers/update', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@triggerUpdate']);
    Route::get('events', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@eventsIndex']);
    Route::get('events/create', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@createEvent']);
    Route::post('events', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@storeEvent']);
    Route::get('events/{id}/edit', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@editEvent']);
    Route::post('events/{id}/update', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@updateEvent']);
    Route::post('events/{id}/destroy', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@destroyEvent']);
    Route::get('send', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@send']);
    Route::post('shoot', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@shoot']);
    Route::get('log', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@logIndex']);
    Route::get('log/refresh', ['middleware' => ['permission:manage-gymie|manage-sms'], 'uses' => 'SmsController@logRefresh']);
});

//enquiries
Route::group(['prefix' => 'enquiries', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-gymie|manage-enquiries|view-enquiry'], 'uses' => 'EnquiriesController@index']);
    Route::get('all', ['middleware' => ['permission:manage-gymie|manage-enquiries|view-enquiry'], 'uses' => 'EnquiriesController@index']);
    Route::get('create', ['middleware' => ['permission:manage-gymie|manage-enquiries|add-enquiry'], 'uses' => 'EnquiriesController@create']);
    Route::post('/', ['middleware' => ['permission:manage-gymie|manage-enquiries|add-enquiry'], 'uses' => 'EnquiriesController@store']);
    Route::get('{id}/show', ['middleware' => ['permission:manage-gymie|manage-enquiries|view-enquiry'], 'uses' => 'EnquiriesController@show']);
    Route::post('{id}/lost', ['middleware' => ['permission:manage-gymie|manage-enquiries|view-enquiry'], 'uses' => 'EnquiriesController@lost']);
    Route::post('{id}/markMember', ['middleware' => ['permission:manage-gymie|manage-enquiries|view-enquiry'], 'uses' => 'EnquiriesController@markMember']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-gymie|manage-enquiries|edit-enquiry'], 'uses' => 'EnquiriesController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-gymie|manage-enquiries|edit-enquiry'], 'uses' => 'EnquiriesController@update']);
});

//followups
Route::group(['prefix' => 'enquiry', 'middleware' => ['auth']], function () {
    Route::post('followups', ['middleware' => ['permission:manage-gymie|manage-enquiries|add-enquiry-followup'], 'uses' => 'FollowupsController@store']);
    Route::post('followups/{id}/update', ['middleware' => ['permission:manage-gymie|manage-enquiries|edit-enquiry-followup'], 'uses' => 'FollowupsController@update']);
});

//plans
Route::group(['prefix' => 'plans', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-gymie|manage-plans|view-plan'], 'uses' => 'PlansController@index']);
    Route::get('all', ['middleware' => ['permission:manage-gymie|manage-plans|view-plan'], 'uses' => 'PlansController@index']);
    Route::get('show', ['middleware' => ['permission:manage-gymie|manage-plans|view-plan'], 'uses' => 'PlansController@show']);
    Route::get('create', ['middleware' => ['permission:manage-gymie|manage-plans|add-plan'], 'uses' => 'PlansController@create']);
    Route::post('/', ['middleware' => ['permission:manage-gymie|manage-plans|add-plan'], 'uses' => 'PlansController@store']);
    Route::post('/onsales', ['middleware' => ['permission:manage-gymie|manage-plans|add-plan'], 'uses' => 'PlansController@PlanOnSales'])->name('plans.onsales');
    Route::post('/onsales/delete', ['middleware' => ['permission:manage-gymie|manage-plans|add-plan'], 'uses' => 'PlansController@PlanOnSalesDelete'])->name('plans.onsalesdelete');
    Route::get('{id}/edit', ['middleware' => ['permission:manage-gymie|manage-plans|edit-plan'], 'uses' => 'PlansController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-gymie|manage-plans|edit-plan'], 'uses' => 'PlansController@update']);
    // Route::post('{id}/delete', ['middleware' => ['permission:manage-gymie|manage-plans|delete-plan'], 'uses' => 'PlansController@delete']);
    Route::get('/services', ['middleware' => ['permission:manage-gymie|manage-services|view-service'], 'uses' => 'ServicesController@index']);
    Route::get('services/all', ['middleware' => ['permission:manage-gymie|manage-services|view-service'], 'uses' => 'ServicesController@index']);
    Route::get('services/create', ['middleware' => ['permission:manage-gymie|manage-services|add-service'], 'uses' => 'ServicesController@create']);
    Route::post('/services', ['middleware' => ['permission:manage-gymie|manage-services|add-service'], 'uses' => 'ServicesController@store']);
    Route::get('services/{id}/edit', ['middleware' => ['permission:manage-gymie|manage-services|edit-service'], 'uses' => 'ServicesController@edit']);
    Route::post('services/{id}/update', ['middleware' => ['permission:manage-gymie|manage-services|edit-service'], 'uses' => 'ServicesController@update']);
    Route::post('services/delete/{id}', ['middleware' => ['permission:manage-gymie|manage-services|delete-service'], 'uses' => 'ServicesController@delete'])->name('services.delete');
});


//subsciptions
Route::group(['prefix' => 'subscriptions', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-gymie|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@index']);
    Route::get('all', ['middleware' => ['permission:manage-gymie|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@index']);
    Route::get('expiring', ['middleware' => ['permission:manage-gymie|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@expiring']);
    Route::get('expired', ['middleware' => ['permission:manage-gymie|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@expired']);
    Route::get('create', ['middleware' => ['permission:manage-gymie|manage-subscriptions|add-subscription'], 'uses' => 'SubscriptionsController@create']);
    Route::post('/', ['middleware' => ['permission:manage-gymie|manage-subscriptions|add-subscription'], 'uses' => 'SubscriptionsController@store']);
    Route::get('{id}/show', ['middleware' => ['permission:manage-gymie|manage-subscriptions|view-subscription'], 'uses' => 'SubscriptionsController@show']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-gymie|manage-subscriptions|edit-subscription'], 'uses' => 'SubscriptionsController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-gymie|manage-subscriptions|edit-subscription'], 'uses' => 'SubscriptionsController@update']);
    Route::get('{id}/change', ['middleware' => ['permission:manage-gymie|manage-subscriptions|change-subscription'], 'uses' => 'SubscriptionsController@change']);
    Route::post('{id}/modify', ['middleware' => ['permission:manage-gymie|manage-subscriptions|change-subscription'], 'uses' => 'SubscriptionsController@modify']);
    Route::get('{id}/renew', ['middleware' => ['permission:manage-gymie|manage-subscriptions|renew-subscription'], 'uses' => 'SubscriptionsController@renew']);
    Route::post('{id}/cancelSubscription', ['middleware' => ['permission:manage-gymie|manage-subscriptions|cancel-subscription'], 'uses' => 'SubscriptionsController@cancelSubscription']);
    Route::post('{id}/delete', ['middleware' => ['permission:manage-gymie|manage-subscriptions|delete-subscription'], 'uses' => 'SubscriptionsController@delete']);
});

//invoices
Route::group(['prefix' => 'invoices', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-gymie|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@index']);
    Route::get('all', ['middleware' => ['permission:manage-gymie|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@index']);
    Route::get('paid', ['middleware' => ['permission:manage-gymie|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@paid']);
    Route::get('unpaid', ['middleware' => ['permission:manage-gymie|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@unpaid']);
    Route::get('partial', ['middleware' => ['permission:manage-gymie|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@partial']);
    Route::get('overpaid', ['middleware' => ['permission:manage-gymie|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@overpaid']);
    Route::get('{id}/show', ['middleware' => ['permission:manage-gymie|manage-invoices|view-invoice'], 'uses' => 'InvoicesController@show']);
    Route::get('{id}/payment', ['middleware' => ['permission:manage-gymie|manage-invoices|add-payment'], 'uses' => 'InvoicesController@createPayment']);
    Route::post('{id}/delete', ['middleware' => ['permission:manage-gymie|manage-invoices|delete-invoice'], 'uses' => 'InvoicesController@delete']);
    Route::get('{id}/discount', ['middleware' => ['permission:manage-gymie|manage-invoices|add-discount'], 'uses' => 'InvoicesController@discount']);
    Route::post('{id}/applyDiscount', ['middleware' => ['permission:manage-gymie|manage-invoices|add-discount'], 'uses' => 'InvoicesController@applyDiscount']);
});

//payments
Route::group(['prefix' => 'payments', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-gymie|manage-payments|view-payment'], 'uses' => 'PaymentsController@index']);
    Route::get('all', ['middleware' => ['permission:manage-gymie|manage-payments|view-payment'], 'uses' => 'PaymentsController@index']);
    Route::get('show', ['middleware' => ['permission:manage-gymie|manage-payments|view-payment'], 'uses' => 'PaymentsController@show']);
    Route::get('create', ['middleware' => ['permission:manage-gymie|manage-payments|add-payment'], 'uses' => 'PaymentsController@create']);
    Route::post('/', ['middleware' => ['permission:manage-gymie|manage-payments|add-payment'], 'uses' => 'PaymentsController@store']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-gymie|manage-payments|edit-payment'], 'uses' => 'PaymentsController@edit']);
    Route::get('{id}/clearCheque', ['middleware' => ['permission:manage-gymie|manage-payments|edit-payment'], 'uses' => 'PaymentsController@clearCheque']);
    Route::get('{id}/depositCheque', ['middleware' => ['permission:manage-gymie|manage-payments|edit-payment'], 'uses' => 'PaymentsController@depositCheque']);
    Route::get('{id}/chequeBounce', ['middleware' => ['permission:manage-gymie|manage-payments|edit-payment'], 'uses' => 'PaymentsController@chequeBounce']);
    Route::get('{id}/chequeReissue', ['middleware' => ['permission:manage-gymie|manage-payments|edit-payment'], 'uses' => 'PaymentsController@chequeReissue']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-gymie|manage-payments|edit-payment'], 'uses' => 'PaymentsController@update']);
    Route::post('{id}/delete', ['middleware' => ['permission:manage-gymie|manage-payments|delete-payment'], 'uses' => 'PaymentsController@delete']);
});

//expenses
Route::group(['prefix' => 'expenses', 'middleware' => ['auth']], function () {
    Route::get('/', ['middleware' => ['permission:manage-gymie|manage-expenses|view-expense'], 'uses' => 'ExpensesController@index']);
    Route::get('all', ['middleware' => ['permission:manage-gymie|manage-expenses|view-expense'], 'uses' => 'ExpensesController@index']);
    Route::get('show', ['middleware' => ['permission:manage-gymie|manage-expenses|view-expense'], 'uses' => 'ExpensesController@show']);
    Route::get('create', ['middleware' => ['permission:manage-gymie|manage-expenses|add-expense'], 'uses' => 'ExpensesController@create']);
    Route::post('/', ['middleware' => ['permission:manage-gymie|manage-expenses|add-expense'], 'uses' => 'ExpensesController@store']);
    Route::get('{id}/edit', ['middleware' => ['permission:manage-gymie|manage-expenses|edit-expense'], 'uses' => 'ExpensesController@edit']);
    Route::post('{id}/update', ['middleware' => ['permission:manage-gymie|manage-expenses|edit-expense'], 'uses' => 'ExpensesController@update']);
    Route::get('{id}/paid', ['middleware' => ['permission:manage-gymie|manage-expenses|edit-expense'], 'uses' => 'ExpensesController@paid']);
    Route::post('{id}/delete', ['middleware' => ['permission:manage-gymie|manage-expenses|delete-expense'], 'uses' => 'ExpensesController@delete']);
    Route::get('/categories', ['middleware' => ['permission:manage-gymie|manage-expenseCategories|view-expenseCategory'], 'uses' => 'ExpenseCategoriesController@index']);
    Route::get('categories/all', ['middleware' => ['permission:manage-gymie|manage-expenseCategories|view-expenseCategory'], 'uses' => 'ExpenseCategoriesController@index']);
    Route::get('categories/create', ['middleware' => ['permission:manage-gymie|manage-expenseCategories|add-expenseCategory'], 'uses' => 'ExpenseCategoriesController@create']);
    Route::post('/categories', ['middleware' => ['permission:manage-gymie|manage-expenseCategories|add-expenseCategory'], 'uses' => 'ExpenseCategoriesController@store']);
    Route::get('categories/{id}/edit', ['middleware' => ['permission:manage-gymie|manage-expenseCategories|edit-expenseCategory'], 'uses' => 'ExpenseCategoriesController@edit']);
    Route::post('categories/{id}/update', ['middleware' => ['permission:manage-gymie|manage-expenseCategories|edit-expenseCategory'], 'uses' => 'ExpenseCategoriesController@update']);
    Route::post('categories/{id}/archive', ['middleware' => ['permission:manage-gymie|manage-expenseCategories|delete-expenseCategory'], 'uses' => 'ExpenseCategoriesController@archive']);
});


/**
 * admin working schedule routes
 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('member/working-schedule','WorkingScheduleController@index')->name('working-schedule.index');
    Route::get('member/working-schedule/create','WorkingScheduleController@create')->name('working-schedule.create');
    Route::post('member/working-schedule/add','WorkingScheduleController@store')->name('working-schedule.store');
    Route::get('member/{id}/working-schedules','WorkingScheduleController@show')->name('working-schedule.show');
    Route::get('member/working-schedule/edit/{id}','WorkingScheduleController@edit')->name('working-schedule.edit');
    Route::match(['put','patch'],'member/working-schedule/update/{id}','WorkingScheduleController@update')->name('working-schedule.update');
    Route::get('member/working-schedule/destroy/{id}','WorkingScheduleController@destroy')->name('working-schedule.destroy');
});

/**
 * Ends
 */
//settings
Route::group(['prefix' => 'settings', 'middleware' => ['permission:manage-gymie|manage-settings', 'auth']], function () {
    Route::get('/', 'SettingsController@show');
    Route::get('edit', 'SettingsController@edit');
    Route::post('save', 'SettingsController@save');
});

//User Module with roles & permissions
//User
Route::group(['prefix' => 'user', 'middleware' => ['permission:manage-gymie|manage-users', 'auth']], function () {
    Route::get('/', 'AclController@userIndex');
    Route::get('create', 'AclController@createUser');
    Route::post('/', 'AclController@storeUser');
    Route::get('{id}/edit', 'AclController@editUser');
    Route::post('{id}/update', 'AclController@updateUser');
    Route::post('{id}/delete', 'AclController@deleteUser');
});

//Roles
Route::group(['prefix' => 'user/role', 'middleware' => ['permission:manage-gymie|manage-users', 'auth']], function () {
    Route::get('/', 'AclController@roleIndex');
    Route::get('create', 'AclController@createRole');
    Route::post('/', 'AclController@storeRole');
    Route::get('{id}/edit', 'AclController@editRole');
    Route::post('{id}/update', 'AclController@updateRole');
    Route::post('{id}/delete', 'AclController@deleteRole');
});

//Permissions
Route::group(['prefix' => 'user/permission', 'middleware' => ['auth', 'role:Gymie']], function () {
    Route::get('/', 'AclController@permissionIndex');
    Route::get('create', 'AclController@createPermission');
    Route::post('/', 'AclController@storePermission');
    Route::get('{id}/edit', 'AclController@editPermission');
    Route::post('{id}/update', 'AclController@updatePermission');
    Route::post('{id}/delete', 'AclController@deletePermission');
});

//Website
Route::resource('/', 'WebsiteController');
Route::get('classes', 'WebsiteController@getClasses')->name('website.classes');
Route::get('about-us', 'WebsiteController@getAboutUs')->name('website.about-us');
Route::get('news', 'WebsiteController@getNews')->name('website.news');
Route::get('contact-us', 'WebsiteController@getContact')->name('website.contact');
Route::post('newsletter', 'WebsiteController@subscribeNewsletter')->name('website.newsletter');
Route::get('plan/selected/{id}', 'WebsiteController@planSelected')->name('website.planseleted');
Route::post('website/send/enquries','WebsiteController@send_enquiry')->name('website.send_enquiry');
Route::get('website/enquiries','WebsiteController@website_enquiries_index')->name('website-enquiries.index');
Route::get('customer-new-orders','WebsiteController@customer_new_orders')->name('new.orders');
Route::get('customer-order/products/{orderID}','WebsiteController@customer_order_products')->name('order.products');
Route::get('customer-order/confirm/{orderId}','WebsiteController@customer_order_confirm')->name('order.confirm');
Route::get('customer-order/cancel/{orderId}','WebsiteController@customer_order_cancel')->name('order.cancel');
Route::get('customer-order/invoice-print/{orderId}','WebsiteController@customer_order_invoice_print')->name('order.invoice.print');

/**
 * Shop Routes
 */
Route::get('shop','ShopController@index')->name('shop.index');
Route::get('shop/product/{id}','ShopController@single_product')->name('shop.single_product');
Route::get('shop/products/by-category/{id}','ShopController@product_by_category')->name('shop.product_by_category');



// cart controllers
Route::group(['prefix' => 'cart','middleware' => 'customer'], function(){
    Route::get('add/product/{id}','CartController@add')->name('cart.add');
    Route::get('items','CartController@all_items')->name('cart.show');
    Route::get('items/remove/{id}','CartController@remove_item')->name('cart.remove');
    Route::get('items/add/{id}','CartController@increase_item')->name('cart.increase');
    Route::get('checkout','CartController@checkout')->name('cart.checkout');
});




/** Customer Routes */
Route::group(['prefix'=>'customer'], function(){
    // signup routes
    Route::get('register','CustomerController@showRegistrationForm')->name('customer.register');
    Route::post('register-attempt','CustomerController@register_attempt')->name('customer.register-attempt');

    // login routes
    Route::get('login','CustomerController@showLoginForm')->name('customer.login');
    Route::post('login-attempt','CustomerController@login_attempt')->name('customer.login-attempt');
    Route::get('logout','CustomerController@customer_logout')->name('customer.logout');
    Route::get('dashboard', 'CustomerController@index')->name('customer.dashboard')->middleware('customer');

    // shopping history
    Route::get('shopping-history','CustomerController@shopping_history')->name('customer.shopping_history')->middleware('customer');;
    Route::get('shopped-products/{id}','CustomerController@shopped_products')->name('customer.shopped_products')->middleware('customer');

    // working schedule routes
    Route::get('my-working-schedules','CustomerController@working_schedule')->name('working.schedule');

    // member payment history
    Route::get('member-invoice/show/{id}','CustomerController@member_invoice')->name('member.invoice.show');
    

});
/** Customer Routes End */

/** Category Routes */
Route::resource('category','CategoryController',['except' => 'update','destroy']);
Route::get('category/delete/{id}','CategoryController@destroy')->name('category.destroy');
Route::put('category/update/{id}','CategoryController@update')->name('category.update');
/** Ends */

/**
 * *******************************************
 * Product Routes
 * *******************************************
*/
Route::resource('product','ProductController',['except' => 'update','destroy']);
Route::get('product/delete/{id}','ProductController@destroy')->name('product.destroy');
Route::match(['put','patch'],'product/update/{id}','ProductController@update')->name('product.update');
Route::get('product-by-category/{id}','ProductController@product_by_category')->name('product.by_category');

/**
 * **********
 * Website Routes
 * **********
 */
Route::group(['prefix' => 'website1', 'middleware' => ['auth', 'role:Gymie']], function () {
    Route::get('/', 'AclController@permissionIndex');
    Route::get('create', 'AclController@createPermission');
    Route::post('/', 'AclController@storePermission');
    Route::get('{id}/edit', 'AclController@editPermission');
    Route::post('{id}/update', 'AclController@updatePermission');
    Route::post('{id}/delete', 'AclController@deletePermission');
});

Route::group(['prefix' => 'pos', 'middleware' => 'auth'], function(){
    Route::get('pos-invoices','PosController@index')->name('pos.index');
    Route::get('create','PosController@create')->name('pos.create');
    Route::post('store','PosController@store')->name('pos.store');
    Route::get('pos-print/{id}','PosController@pos_print')->name('pos.print');
});