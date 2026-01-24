<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\SignUpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Customers\CustomersController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\Admin\Services\ListServicesController;

Route::get('/', function () {
    return redirect()->route('admin.index');
});

Route::prefix("admin") // Prefix é usado para criar um grupo de rotas
    ->name('admin.') // Nome do grupo
    ->group(function (): void { // Função que define esse grupo {

        Route::prefix('auth') // Criando subgrupo
            ->name('auth.') // Nome do subgrupo
            ->group(function(): void {  // Função que define esse grupo
                Route::get('login', LoginController::class)->name('login');
                Route::get('signup', SignUpController::class)->name('signup');
                Route::get('logout', LogoutController::class)->name('logout'); // Rota
            });

        Route::middleware('auth')->group(function(): void {
            Route::get('', DashboardController::class)->name('index'); // Rota Padrão

            Route::prefix('customers') // Criando subgrupo
                ->name('customers.') // Nome do subgrupo
                ->group(function () {  // Função que define esse grupo
                    Route::get('', CustomersController::class)->name('index');
                });

            Route::prefix('employees')
            ->name('employees.')
            ->group(function () {
                Route::get('', EmployeeController::class)->name('index');
            });

            Route::prefix('services') // Criando subgrupo
                ->name('services.') // Nome do subgrupo
                ->group(function () { // Função que define esse grupo
                    Route::get('', ListServicesController::class)->name('index');
                });

            Route::prefix('products') // Criando subgrupo
                ->name('products.') // Nome do subgrupo
                ->group(function () { // Função que define esse grupo
                    Route::get('', ProductsController::class)->name('index');
                });
        });
    });
