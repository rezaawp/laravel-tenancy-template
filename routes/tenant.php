<?php

declare(strict_types=1);

use App\Http\Routes\SharedRoutes;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // Public routes
    Route::view('/', 'welcome')->name('home');

    Route::get('test-model-in-tenant', function () {
        $user = new Product();
        $tableName = $user->getConnection();
        dd($tableName);
    });

    // Shared routes
    SharedRoutes::register();
});
