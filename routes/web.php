<?php

use App\Http\Controllers\Driver\driverController;
use App\Http\Controllers\Driver\DriverLoginController;
use App\Http\Controllers\Admin\LoginController;
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

Route::get('/test',function(){
return view("hhh");
});


Route::group(['namespace' => 'Driver', 'prefix' => '/{locale?}/driver', 'middleware' => ['SetLocale','auth:driver']], function () {
    Route::get('login', [DriverLoginController::class, 'show_login_view'])->name('driver.showlogin');
    Route::post('login', [DriverLoginController::class, 'login'])->name('driver.login');
    Route::get('/Driver/edit', [driverController::class, 'edit'])->name('driver.edit');

});



//Route::group(['prefix' => '{locale?}/driver','where'=>['locale'=>'[a-zA-Z]{2}'], 'middleware' => ['auth:driver','SetLocale']], function () {


     /*  بداية  قائمة السائق     */
     // Route::get('/DriverEmployees', [driverController::class, 'employees'])->name('financial.employees');
     // Route::get('/DriverGeneralLoans_index', [driverController::class, 'generalLoans_index'])->name('financial.generalLoans_index');
     Route::get('/driver/DriverGeneralLoans_edit/{id}', [driverController::class, 'generalLoans_edit'])->name('driver.generalLoans_edit');
     // Route::post('/DriverGeneralLoans_update/{id}', [driverController::class, 'generalLoans_update'])->name('financial.generalLoans_update');
   // });

