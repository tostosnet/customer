<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// landing page route
Route::get('/', function () {
    return view('welcome');
});


// all authentication routes
Auth::routes();


// dashboard route
Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');




  // :::::::::::::::::::::::::::::::::: //
 // :::::::: USERS ROUTES :::::::::::: //
// :::::::::::::::::::::::::::::::::: //

// user's profile route
Route::get('/profile', [Controllers\UserController::class, 'index'])->name('profile');


// profile update route 
Route::post('/profile/update', [Controllers\UserController::class, 'update'])->name('update_profile');


// profile email update
Route::post('/profile/update/email', [Controllers\UserController::class, 'update_email'])->name('update_profile_email');


// profile username update
Route::post('/profile/update/username', [Controllers\UserController::class, 'update_username'])->name('update_profile_username');


// profile password update
Route::post('/profile/update/password', [Controllers\UserController::class, 'update_password'])->name('update_profile_password');


// profile picture update
Route::post('/profile/update/photo', [Controllers\UserController::class, 'update_photo'])->name('update_profile_photo');


// profile connection
Route::get('/profile/connect', [Controllers\UserController::class, 'connect'])->name('connect');




  // :::::::::::::::::::::::::::::::::: //
 // :::::::: CLIENTS ROUTES :::::::: //
// :::::::::::::::::::::::::::::::::: //

// new client form
Route::get('/c/create', [Controllers\ClientController::class, 'index'])->name('client.form');


// Create client
Route::post('/c/create', [Controllers\ClientController::class, 'create'])->name('client.create');


// get all client
Route::get('/c', [Controllers\ClientController::class, 'clients'])->name('clients');


// get client profile
Route::get('/c/profile/{client}', [Controllers\ClientController::class, 'profile'])->where('client', '[0-9]+')->name('client.profile');


// update client
Route::post('/c/update/{client}', [Controllers\ClientController::class, 'update'])->where('client', '[0-9]+')->name('client.update');


// update client photos
Route::post('/c/photo/update/{client}', [Controllers\ClientController::class, 'update_photo'])->where('client', '[0-9]+')->name('client.photo.update');


// update client email
Route::post('/c/email/update/{client}', [Controllers\ClientController::class, 'update_email'])->where('client', '[0-9]+')->name('client.email.update');


// add one product to client
Route::post('/c/{client}/add/p', [Controllers\ClientController::class, 'add_product'])->where('client', '[0-9]+')->name('client.add.product');


// add one guarantor to client
Route::post('/c/{client}/add/g', [Controllers\ClientController::class, 'add_guarantor'])->where('client', '[0-9]+')->name('client.add.grt');


// delete all client guarantor
Route::post('/c/{client}/del/g', [Controllers\ClientController::class, 'del_all_guarantor'])->where('client', '[0-9]+')->name('client.del.grt.all');


// delete one client guarantor
Route::post('/c/{client}/del/g/{gid}', [Controllers\ClientController::class, 'del_guarantor'])->where(['client' => '[0-9]+', 'grt' => '[0-9]+'])->name('client.del.grt');




  // :::::::::::::::::::::::::::::::::: //
 // :::::::: GUARANTOR ROUTES :::::::: //
// :::::::::::::::::::::::::::::::::: //

// grt form
Route::get('/g/create', [Controllers\GuarantorController::class, 'form'])->name('grt.form');


// create grt
Route::post('/g/create', [Controllers\GuarantorController::class, 'create'])->name('grt.create');


// all grt
Route::get('/g', [Controllers\GuarantorController::class, 'index'])->name('guarantors');


// grt profile
Route::get('/g/profile/{grt}', [Controllers\GuarantorController::class, 'profile'])->name('grt.profile')->where('grt', '[0-9]+');


// update grt
Route::post('/g/update/{grt}', [Controllers\GuarantorController::class, 'update'])->name('grt.update')->where('grt', '[0-9]+');


// update grt photos
Route::post('/g/photo/update/{grt}', [Controllers\GuarantorController::class, 'update_photo'])->name('grt.photo.update')->where('grt', '[0-9]+');




// ::::::::::::::::::::::::::::::::: //
// :::::::: PRODUCT ROUTES ::::::::: //
// ::::::::::::::::::::::::::::::::: //

// get product form
Route::get('/p/create', [Controllers\ProductController::class, 'form'])->name('product.form');


// create new product
Route::post('/p/create', [Controllers\ProductController::class, 'create'])->name('product.create');


// get all product
Route::get('/p', [Controllers\ProductController::class, 'index'])->name('products');


// product profile
Route::get('/p/{product}/profile', [Controllers\ProductController::class, 'profile'])->name('product.profile');


// get one product
Route::get('/p/{product}/preview', [Controllers\ProductController::class, 'preview_product'])->where('product', '[0-9]+');



  // :::::::::::::::::::::::::::::::::::::::::::::::::::::: //
 // :::::::: CATEGORIES / BRANDS / MODELS ROUTES ::::::::: //
// :::::::::::::::::::::::::::::::::::::::::::::::::::::: //

// get categories
Route::get('cat', [Controllers\ProductController::class, 'categories'])->name('product.categories');


// get category brands
Route::get('/cat/{cat}/brands', [Controllers\ProductController::class, 'category_brands'])->where('cat', '[0-9]+')->name('category_brands');


// get brand models
Route::get('/brand/{brand}/models', [Controllers\ProductController::class, 'brand_models'])->where('brand', '[0-9]+')->name('brand_models');


// get category products
Route::get('/cat/{cat}/p', [Controllers\ProductController::class, 'category_products'])->where('cat', '[0-9]+')->name('category_products');


// get brand products
Route::get('/brand/{brand}/products', [Controllers\ProductController::class, 'brand_products'])->where('brand', '[0-9]+')->name('brand_products');


// get model products
Route::get('/model/{model}/products', [Controllers\ProductController::class, 'model_products'])->where('cat', '[0-9]+')->name('model_products');




// ::::::::::::::::::::::::::::::::: //
// :::::::: ORDERS ROUTES ::::::::: //
// ::::::::::::::::::::::::::::::::: //

// process new client order
Route::post('/order/create/{client}', [Controllers\OrderController::class, 'create'])->where('client', '[0-9]+')->name('order.create');


// get all requests
Route::get('/requests', [Controllers\OrderController::class, 'requests'])->name('requests');


// get active orders
Route::get('/orders/index', [Controllers\OrderController::class, 'index'])->name('orders.index');


// get completed orders
Route::get('/orders/complete', [Controllers\OrderController::class, 'complete'])->name('orders.complete');


// get uncompleted orders
Route::get('/orders/uncomplete', [Controllers\OrderController::class, 'uncomplete'])->name('orders.uncomplete');




// ::::::::::::::::::::::::::::::::: //
// :::::::: PAYMENTS ROUTES ::::::::: //
// ::::::::::::::::::::::::::::::::: //

// make payment
Route::post('/payments/create/{client}', [Controllers\PaymentController::class, 'make_payment']);


// get all payments
Route::get('/payments', [Controllers\PaymentController::class, 'index'])->name('payments');



// ::::::::::::::::::::::::::::::::: //
// :::::::: USERS ROUTES ::::::::: //
// ::::::::::::::::::::::::::::::::: //

// user profile
Route::get('/customers/{customer}/profile', [Controllers\CustomerController::class, 'profile'])->name('customer.profile');





// ::::::::::::::::::::::::::::::::: //
// :::::::: Message ROUTES ::::::::: //
// ::::::::::::::::::::::::::::::::: //

// get chat list
Route::get('/chats', [Controllers\ChatController::class, 'index'])->name('chats');


// get chat data
Route::get('/chats/{client}', [Controllers\ChatController::class, 'chat'])->name('chat');

