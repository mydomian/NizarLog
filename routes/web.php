<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AreaTypeController;
use App\Http\Controllers\Admin\CODChargeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryChargeController;
use App\Http\Controllers\Admin\ParcelTypeController;
use App\Http\Controllers\Admin\WeightTypeController;
use App\Http\Controllers\Admin\ServiceAreaController;
use App\Http\Controllers\Admin\DeliveryTypeController;
use App\Http\Controllers\Admin\HubController;
use App\Http\Controllers\Agency\DashboardController as AgencyDashboardController;
use App\Http\Controllers\Driver\DashboardController as DriverDashboardController;
use App\Models\DeliveryType;

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

Route::match(['get','post'],'/admin/login',[AuthController::class,'adminLogin'])->name('admin.login');
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
    Route::match(['get','post'],'settings',[SettingController::class,'settings'])->name('admin.settings');



    //drivers
    Route::resource('admin-drivers',DriverController::class);
    Route::post('/admin-drivers-status/{user}',[DriverController::class,'driverStatus'])->name('admin.drivers.status');
    //service area
    Route::resource('service-areas',ServiceAreaController::class);
    Route::post('/service-areas-status/{serviceArea}',[ServiceAreaController::class,'serviceAreaStatus'])->name('admin.serviceArea.status');
    //agency
    Route::resource('admin-agencies',AgencyController::class);
    Route::post('/admin-agency-status/{user}',[AgencyController::class,'agencyStatus'])->name('admin.agencies.status');
    //air bills
    Route::resource('admin-air-bills',BookingController::class);
    Route::post('admin-air-bills-status/{user}',[BookingController::class,'airBillsStatus'])->name('admin.airBills.status');

    //area-types
    Route::resource('admin-area-types',AreaTypeController::class);
    Route::post('/admin-area-types-status/{areaType}',[AreaTypeController::class,'areaTypeStatus'])->name('admin.areaTypes.status');

    //parcel-types
    Route::resource('admin-parcel-types',ParcelTypeController::class);
    Route::post('/admin-parcel-types-status/{parcelType}',[ParcelTypeController::class,'parcelTypeStatus'])->name('admin.parcelTypes.status');

    //deliveries-types
    Route::resource('admin-delivery-types',DeliveryTypeController::class);
    Route::post('/admin-delivery-types-status/{deliveryType}',[DeliveryTypeController::class,'deliveryTypeStatus'])->name('admin.deliveryTypes.status');

    //delivery-charges
    Route::resource('admin-delivery-charges',DeliveryChargeController::class);
    Route::post('/admin-delivery-charges-status/{deliveryCharge}',[DeliveryChargeController::class,'deliveryChargeStatus'])->name('admin.deliveryCharge.status');

    //hub
    Route::resource('admin-hubs',HubController::class);
    Route::post('/admin-hub-status/{hub}',[HubController::class,'hubStatus'])->name('admin.hubs.status');



    //ajax
    Route::get('admin-delivery-type-wise-delivery-charge',[DeliveryTypeController::class,'delTypeWiseWeighType'])->name('admin.delivery-type-wise-delivery-charge');
    Route::get('admin-delivery-charge-wise-cod-charge',[DeliveryTypeController::class,'delTypeWiseCodCharge'])->name('admin.delivery-charge-wise-cod-charge');

    Route::get('admin-logout',[DashboardController::class,'logout'])->name('admin.logout');

});

Route::match(['get','post'],'/agency/login',[AuthController::class,'agencyLogin'])->name('agency.login');
Route::prefix('agency')->middleware(['auth', 'agency'])->group(function () {
    Route::get('/dashboard',[AgencyDashboardController::class,'dashboard'])->name('agency.dashboard');
    Route::get('agency-logout',[AgencyDashboardController::class,'logout'])->name('agency.logout');

});

Route::match(['get','post'],'/driver/login',[AuthController::class,'driverLogin'])->name('driver.login');
Route::prefix('driver')->middleware(['auth', 'driver'])->group(function () {
    Route::get('/dashboard',[DriverDashboardController::class,'dashboard'])->name('driver.dashboard');
    Route::get('driver-logout',[DriverDashboardController::class,'logout'])->name('driver.logout');
});

//cache delete
Route::get('/clear', function () {
    Artisan::call('cache:clear'); Artisan::call('config:clear'); Artisan::call('config:cache'); Artisan::call('view:clear'); Artisan::call('route:clear'); Artisan::call('optimize:clear'); Artisan::call('storage:link');
    return "Cleared!";
});
