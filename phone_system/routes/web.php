<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
//use App\Http\Controllers\UserCrudController;


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

Route::get('/', [TemplateController::class, 'index']);

/*Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => config('backpack.base.web_middleware', 'web'),
    'namespace' => 'Admin',
], function () {
    // ... other routes

    // Update the dashboard route
    Route::get('/dashboard', [UserCrudController::class, 'dashboard']);
    
});*/