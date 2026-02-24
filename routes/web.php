<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\SignUpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Livewire\Appointments;
use App\Livewire\Customers;
use App\Livewire\Dashboard;
use App\Livewire\Employees;
use App\Livewire\Products;
use App\Livewire\Services;

Route::get('/', function () {
    return redirect()->route('admin.index');
});

Route::prefix("admin") // Prefix é usado para criar um grupo de rotas
    ->name('admin.') // Nome do grupo
    ->group(function (): void { // Função que define esse grupo

        Route::prefix('auth') // Criando subgrupo
            ->name('auth.') // Nome do subgrupo
            ->group(function(): void {  // Função que define esse grupo
                Route::get('login', LoginController::class)->name('login');
                Route::get('signup', SignUpController::class)->name('signup');
                Route::get('logout', LogoutController::class)->name('logout'); // Rota
            });

        Route::middleware('auth')->group(function(): void {

                Route::middleware('isAdmin')->group(function(): void {
                    Route::get('appointments', Appointments::class)->name('appointments.index');
                    Route::get('customers', Customers::class)->name('customers.index');
                    Route::get('services', Services::class)->name('services.index');
                    Route::get('products', Products::class)->name('products.index');
                    Route::get('employees', Employees::class)->name('employees.index');
                    Route::get('', Dashboard::class)->name('index');
                });
        });
    });
