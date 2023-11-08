<?php

use App\Http\Controllers\ApplianceController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HouseInfoController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ProductController;
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

// This route is for the custom name error method.
Route::get('schedule/nameError', 'App\Http\Controllers\ScheduleController@nameError')->name('schedule.nameError');

// this route is for viewing the products type /product in the browser
/*Route::resource('products', ItemController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);*/

// // this route is for viewing the customer type /customer in the browser
// Route::resource('customer', CustomerController::class)
//     ->only(['index'])
//     ->middleware(['auth', 'verified']);

Route::resource('schedule', ScheduleController::class)
    ->middleware(['auth', 'verified']);

Route::resource('building', BuildingController::class)
    ->middleware(['auth', 'verified']);

Route::resource('room', RoomController::class)
    ->middleware(['auth', 'verified']);

    Route::get('room/dedit', 'RoomController@edit')->name('room.dedit');

    Route::get('room/delete', 'RoomController@destroy')->name('room.delete');
Route::resource('appliance', ApplianceController::class)
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
Route::resource('product', ProductController::class)
    ->middleware(['auth', 'verified']);

Route::resource('configuration', ConfigurationController::class)
    ->middleware(['auth', 'verified']);   

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
