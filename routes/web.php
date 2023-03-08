<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//


// this route show admin panel dashboard
route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');
// next 3 route show view catagory option and add catagory and delete catagory
route::get('/view_catagory', [AdminController::class, 'view_catagory']);
route::post('/add_catagory', [AdminController::class, 'add_catagory']);
route::get('/delete_catagory/{id}', [AdminController::class, 'delete_catagory']);

// next 6 route show products update delete add in admin dashboard
route::get('/view_product', [AdminController::class, 'view_product']);
route::post('/add_product', [AdminController::class, 'add_product']);
route::get('/show_product', [AdminController::class, 'show_product']);
route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
route::get('/update_product/{id}', [AdminController::class, 'update_product']);
route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);
route::get('/showAllOrders', [AdminController::class, 'showAllOrders']);
route::get('/delivered/{id}', [AdminController::class, 'delivered']);
route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);
route::get('/send_email/{id}', [AdminController::class, 'send_email']);
route::post('/send_user_email/{id}', [AdminController::class, 'send_user_email']);
route::get('/search', [AdminController::class, 'searchdata']);





// product details route
route::get('/product_details/{id}', [HomeController::class, 'product_details']);
// product add to cart route in db
route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
// show add to cart product and remove to cart route
route::get('/show_cart', [HomeController::class, 'show_cart']);
route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
//under this 2 route show cash on delivery and online payment system stripe
route::get('/cash_order', [HomeController::class, 'cash_order']);
route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);
route::post('/stripe/{totalprice}', [HomeController::class, 'stripePost'])->name('stripe.post');


