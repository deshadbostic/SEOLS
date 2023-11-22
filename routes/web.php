<?php

use App\Http\Controllers\ApplianceController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PVSystemController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HouseInfoController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Models\Product;
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
// Route::get('schedule/nameError', 'App\Http\Controllers\ScheduleController@nameError')->name('schedule.nameError');

Route::resource('schedule', ScheduleController::class)
    ->middleware(['auth', 'verified']);

Route::get('search', [SearchController::class, 'search'])
    ->middleware(['auth', 'verified']);

Route::get('/reset', function () {
    // Reset session variables here
    session(['num_items' => 5]);
    session(['category' => []]);
    return redirect(route("product.index"));
})->middleware(['auth', 'verified']);

 Route::resource('building', BuildingController::class)
    ->middleware(['auth', 'verified']);

Route::resource('room', RoomController::class)
    ->middleware(['auth', 'verified']);

Route::get('room/dedit', 'RoomController@edit')->name('room.dedit');

 Route::get('room/delete', 'RoomController@destroy')->name('room.delete');

 Route::get('appliance/dedit', 'ApplianceController@edit')->name('applince.dedit');

Route::get('appliance/delete', 'ApplianceController@destroy')->name('appliance.delete');

Route::get('building/dedit', 'BuildingController@edit')->name('building.dedit');

Route::get('building/delete', 'BuildingController@destroy')->name('building.delete');

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

Route::resource('pv_system', PVSystemController::class)
    ->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// This route is for accessing the investment return page. Type /investment in the browser
Route::resource('investment', InvestmentController::class)
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
