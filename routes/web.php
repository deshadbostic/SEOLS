<?php

use App\Http\Controllers\BatteryController;
use App\Http\Controllers\InverterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HouseInfoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SolarController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductAttributeController;
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
    return view('welcome');
});

// this route is for viewing the products type /product in the browser
/*Route::resource('products', ItemController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);
*/
// this route is for viewing the customer type /customer in the browser
Route::resource('customer', CustomerController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

Route::resource('schedule', ScheduleController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

// this route is for viewing the FAQ in the browser
Route::resource('FAQs', FAQController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

// This route is for viewing customer's house information. Type /houseinfo in the browser
Route::resource('houseinfo', HouseInfoController::class)
    ->middleware(['auth', 'verified']);

// This route is for accessing the quotation page. Type /quote in the browser
Route::resource('quote', QuoteController::class)
    ->middleware(['auth', 'verified']);

// This route is for viewing products in the browser
Route::resource('products', ProductController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);

// This route is for viewing product attributes in the browser
Route::resource('product_attributes', ProductAttributeController::class)
    ->middleware(['auth', 'verified']);

Route::group(['prefix' => 'products'], function () {
    Route::resource('battery', BatteryController::class)
        ->middleware(['auth', 'verified']);
    Route::resource('inverter', InverterController::class)
        ->middleware(['auth', 'verified']);
    Route::resource('solarpanel', SolarController::class)
        ->middleware(['auth', 'verified']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
