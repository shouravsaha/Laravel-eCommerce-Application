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

// this route show admin panel dashboard
route::get('/redirect', [HomeController::class, 'redirect']);
// next 3 route show view catagory option and add catagory and delete catagory
route::get('/view_catagory', [AdminController::class, 'view_catagory']);
route::post('/add_catagory', [AdminController::class, 'add_catagory']);
route::get('/delete_catagory/{id}', [AdminController::class, 'delete_catagory']);
//
route::get('/view_product', [AdminController::class, 'view_product']);
route::post('/add_product', [AdminController::class, 'add_product']);
route::get('/show_product', [AdminController::class, 'show_product']);
