<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupermarketController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');

});


Route::get('/supermarkets', [SupermarketController::class, 'index'])->name('supermarkets.index');

Route::get('/supermarkets/create', [SupermarketController::class, 'create'])->name('supermarkets.create');
//Route::put('supermarkets/{supermarket}', [SupermarketController::class, 'update'])->name('supermarkets.update');
Route::match(['put', 'patch'], 'supermarkets/{supermarket}', [SupermarketController::class, 'update'])->name('supermarkets.update');

//Route::patch('/supermarkets/update', [SupermarketController::class, 'update'])->name('supermarkets.update');
Route::get('/supermarkets/{supermarket}/edit', [SupermarketController::class, 'edit'])->name('supermarkets.edit');
Route::delete('/supermarkets/{supermarket}', [SupermarketController::class, 'destroy'])->name('supermarkets.destroy');

Route::post('/supermarkets', [SupermarketController::class, 'store'])->name('supermarkets.store');


Route::get('supermarkets/{supermarket}/import-employees', [ImportController::class, 'importEmployees'])->name('supermarkets.import-employees');
//Route::get('supermarkets/{supermarket}/import-suppliers', [ImportController::class, 'importSuppliers'])->name('supermarkets.import-suppliers');
Route::get('supermarkets/{supermarket}/import-employees', [SupermarketController::class, 'importEmployeesView'])
    ->name('supermarkets.import-employees-view');
Route::post('supermarkets/{supermarket}/import-employees', [SupermarketController::class, 'importEmployees'])
    ->name('supermarkets.import-employees');

Route::get('supermarkets/{supermarket}/import-suppliers', [SupermarketController::class, 'importSuppliersView'])
    ->name('supermarkets.import-suppliers-view');
Route::post('supermarkets/{supermarket}/import-suppliers', [SupermarketController::class, 'importSuppliers'])
    ->name('supermarkets.import-suppliers');
//Route::post('supermarkets/{supermarket}/import-suppliers', [SupermarketController::class, 'importSuppliers'])->name('supermarkets.import-suppliers');
//Route::post('supermarkets/{id}/import-suppliers', [SupermarketController::class, 'importSuppliers'])->name('supermarkets.import-suppliers');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
