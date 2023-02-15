<?php

use App\Http\Controllers\CakeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/cakes', [CakeController::class, 'index'])->name('cake');
    Route::match(['get', 'post'], '/cake/add', [CakeController::class, 'addCake'])->name('add-cake');
    Route::match(['get', 'put'], '/cake/edit/{id}', [CakeController::class, 'editCake'])->name('edit-cake');
    Route::delete('/cake/delete/{id}', [CakeController::class, 'deleteCake'])->name('delete-cake');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customer');
    Route::match(['get', 'post'], '/customer/add', [CustomerController::class, 'addCustomer'])->name('add-customer');
    Route::match(['get', 'put'], '/customer/edit/{id}', [CustomerController::class, 'editCustomer'])->name('edit-customer');
    Route::delete('customer/delete/{id}', [CustomerController::class, 'deleteCustomer'])->name('delete-customer');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice');
    Route::match(['get', 'post'], '/invoice/add', [InvoiceController::class, 'addInvoice'])->name('add-invoice');

});

