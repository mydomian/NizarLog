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
use App\Http\Controllers\Agency\AirBillController as AgencyAirBillController;
use App\Http\Controllers\Agency\SettingController as AgencySettingController;
use App\Http\Controllers\Driver\DashboardController as DriverDashboardController;
use App\Http\Controllers\Driver\PickupController as DriverPickupController;
use App\Http\Controllers\Driver\SettingController as DriverSettingController;
use App\Models\AirBooking;

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



Route::get('/', function () { return redirect()->route('admin.login');});
Route::get('/admin', function () { return redirect()->route('admin.login');});
Route::get('/login', function () { return redirect()->route('admin.login');});

Route::match(['get','post'],'/admin/login',[AuthController::class,'adminLogin'])->name('admin.login');
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
    Route::match(['get','post'],'settings',[SettingController::class,'settings'])->name('admin.settings');



    //drivers
    Route::resource('admin-drivers',DriverController::class);
    Route::post('/admin-drivers-status/{user}',[DriverController::class,'driverStatus'])->name('admin.drivers.status');

    //agency
    Route::resource('admin-agencies',AgencyController::class);
    Route::post('/admin-agency-status/{user}',[AgencyController::class,'agencyStatus'])->name('admin.agencies.status');

    //air bills
    Route::resource('admin-air-bills',BookingController::class);
    Route::match(['get','post'],'admin-lists-assign-deliveryman',[BookingController::class,'adminListsAssignDeliveryman'])->name('adminListsAssignDeliveryman');
    Route::match(['get','post'],'admin-lists-pickup-received',[BookingController::class,'adminListsPickupReceived'])->name('adminListsPickupReceived');
    Route::match(['get','post'],'admin-lists-hub-store',[BookingController::class,'adminListsHubStore'])->name('adminListsHubStore');
    Route::match(['get','post'],'admin-lists-transit',[BookingController::class,'adminListsTransit'])->name('adminListsTransit');
    Route::get('admin-lists-delivered',[BookingController::class,'adminListsDelivered'])->name('adminListsDelivered');
    Route::get('admin-lists-return',[BookingController::class,'adminListsReturn'])->name('adminListsReturn');
    Route::match(['get','post'],'admin-tracking',[BookingController::class,'adminTracking'])->name('adminTracking');

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

    //admin-cod-charge
    Route::resource('admin-cod-charge',CODChargeController::class);
    Route::post('/admin-cod-charge-status/{cod}',[CODChargeController::class,'CODStatus'])->name('admin.COD.status');

    //print pages
    Route::get('air-booking-print/{airBillPrint}',[BookingController::class,'airBillPrint'])->name('admin.airBillPrint');

    //ajax
    Route::get('admin-delivery-type-wise-delivery-charge',[DeliveryTypeController::class,'delTypeWiseWeighType'])->name('admin.delivery-type-wise-delivery-charge');
    Route::get('admin-delivery-charge-wise-cod-charge',[DeliveryTypeController::class,'delTypeWiseCodCharge'])->name('admin.delivery-charge-wise-cod-charge');
    Route::get('cod-charge',[DeliveryTypeController::class,'CodCharge'])->name('admin.cod-charge');

    Route::get('admin-logout',[DashboardController::class,'logout'])->name('admin.logout');

});

Route::match(['get','post'],'/agency/login',[AuthController::class,'agencyLogin'])->name('agency.login');
Route::prefix('agency')->middleware(['auth', 'agency'])->group(function () {
    Route::get('/dashboard',[AgencyDashboardController::class,'dashboard'])->name('agency.dashboard');
    Route::get('agency-logout',[AgencyDashboardController::class,'logout'])->name('agency.logout');

    Route::match(['get','post'],'agency/profile',[AgencySettingController::class,'setting'])->name('agency.settings');
    Route::post('/agency-password-confirm',[AgencySettingController::class,'checkPassword'])->name('agency.password.confirm');
    Route::post('/agency-password-update',[AgencySettingController::class,'updatePassword'])->name('agency.password.update');
    Route::get('/agency-cancel-change-password',[AgencySettingController::class,'cancel'])->name('agency.cancel.change.password');
    Route::resource('agency-air-bill', AgencyAirBillController::class);


    Route::get('agency-delivery-type-wise-delivery-charge',[AgencyAirBillController::class,'delTypeWiseWeighType'])->name('agency.delivery-type-wise-delivery-charge');
    Route::get('agency-delivery-charge-wise-cod-charge',[AgencyAirBillController::class,'delTypeWiseCodCharge'])->name('agency.delivery-charge-wise-cod-charge');
    Route::get('agency-transit-receive',[AgencyAirBillController::class,'transitReceive'])->name('agency-air-bill.transit.receive');
    Route::get('agency-confirm-transit-received/{air_booking}',[AgencyAirBillController::class,'confirmReceivedTransit'])->name('agency-air-bill.received.transit');
    Route::get('cod-charge-agency',[AgencyAirBillController::class,'CodCharge'])->name('agency.cod-charge');
    Route::match(['get','post'],'agency-tracking',[AgencyAirBillController::class,'tracking'])->name('agency.tracking');


    Route::get('agency-air-booking-print/{airBillPrint}',[AgencyAirBillController::class,'airBillPrint'])->name('agency.airBillPrint');

});

Route::match(['get','post'],'/driver/login',[AuthController::class,'driverLogin'])->name('driver.login');
Route::prefix('driver')->middleware(['auth', 'driver'])->group(function () {
    Route::get('/dashboard',[DriverDashboardController::class,'dashboard'])->name('driver.dashboard');
    Route::get('driver-logout',[DriverDashboardController::class,'logout'])->name('driver.logout');

    Route::get('pickups',[DriverPickupController::class,'pickupRequests'])->name('driver.pickup.requests');
    Route::get('hub-delivery',[DriverPickupController::class,'deliveryRequests'])->name('driver.delivery.requests');
    Route::get('pickedup-list',[DriverPickupController::class,'pickupList'])->name('driver.pickup.list');
    Route::get('delivered-to-hub-list',[DriverPickupController::class,'deliveredToHubList'])->name('driver.delivered.to.hub.list');
    Route::get('parcel-picked-up/{air_booking}',[DriverPickupController::class,'pickedUp'])->name('parcel.picked.up');
    Route::get('parcel-delivered-to-hub/{air_booking}',[DriverPickupController::class,'deliveredToHub'])->name('parcel.delivered.to.hub');
    Route::get('parcel-transit-delivered/{air_booking}',[DriverPickupController::class,'transitDelivery'])->name('parcel.transit.delivery');
    Route::get('bulk-parcel-picked-up',[DriverPickupController::class,'bulkPickedUp'])->name('bulk.parcel.picked.up');
    Route::get('bulk-parcel-delivered-to-hub',[DriverPickupController::class,'bulkDeliveredToHub'])->name('bulk.parcel.delivered.to.hub');
    Route::get('bulk-parcel-transit-delivered',[DriverPickupController::class,'bulkTransitDelivery'])->name('bulk.parcel.transit.delivery');
    Route::match(['get','post'],'driver-tracking',[DriverPickupController::class,'tracking'])->name('driver.tracking');

    Route::match(['get','post'],'profile-settings',[DriverSettingController::class,'settings'])->name('driver.settings');
    Route::post('/password-confirm',[DriverSettingController::class,'checkPassword'])->name('driver.password.confirm');
    Route::post('/password-update',[DriverSettingController::class,'updatePassword'])->name('driver.password.update');
    Route::get('/cancel-change-password',[DriverSettingController::class,'cancel'])->name('driver.cancel.change.password');
});

//cache delete
Route::get('/clear', function () {
    Artisan::call('cache:clear'); Artisan::call('config:clear'); Artisan::call('config:cache'); Artisan::call('view:clear'); Artisan::call('route:clear'); Artisan::call('optimize:clear'); Artisan::call('storage:link');
    return "Cleared!";
});
