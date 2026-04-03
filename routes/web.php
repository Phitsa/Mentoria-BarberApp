<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Livewire\Admin\Appointments as AdminAppointments;
use App\Livewire\Admin\Customers as AdminCustomers;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Employees as AdminEmployees;
use App\Livewire\Admin\Products as AdminProducts;
use App\Livewire\Admin\Services as AdminServices;
use App\Livewire\Admin\Login as AdminLogin;
use App\Livewire\Admin\Signup as AdminSignup;
use App\Livewire\Employee\Appointments as EmployeeAppointments;
use App\Livewire\Employee\Availability;
use App\Livewire\Employee\Dashboard as EmployeeDashboard;
use App\Livewire\Employee\Login as EmployeeLogin;


Route::get('/', function () {
    return redirect()->route('admin.index');
});

Route::prefix("admin") // Prefix é usado para criar um grupo de rotas
    ->name('admin.') // Nome do grupo
    ->group(function (): void { // Função que define esse grupo

        Route::prefix('auth') // Criando subgrupo
            ->name('auth.') // Nome do subgrupo
            ->group(function(): void {  // Função que define esse grupo
                Route::get('login', AdminLogin::class)->name('login');
                Route::get('signup', AdminSignup::class)->name('signup');
                Route::get('logout', LogoutController::class)->name('logout'); // Rota
            });

        Route::middleware('auth')->group(function(): void {

            Route::middleware('isAdmin')->group(function(): void {
                Route::get('appointments', AdminAppointments::class)->name('appointments.index');
                Route::get('customers', AdminCustomers::class)->name('customers.index');
                Route::get('services', AdminServices::class)->name('services.index');
                Route::get('products', AdminProducts::class)->name('products.index');
                Route::get('employees', AdminEmployees::class)->name('employees.index');
                Route::get('', AdminDashboard::class)->name('index');
            });
        });
});

Route::prefix('employee')
    ->name('employee.')
    ->group(function (): void {

        Route::prefix('auth') // Criando subgrupo
            ->name('auth.') // Nome do subgrupo
            ->group(function(): void {  // Função que define esse grupo
                Route::get('login', EmployeeLogin::class)->name('login');
                Route::get('logout', LogoutController::class)->name('logout'); // Rota
            });

        Route::middleware('auth')->group(function(): void {

            Route::middleware('isEmployee')->group(function(): void {
                Route::get('appointments', EmployeeAppointments::class)->name('appointments.index');
                Route::get('availability', Availability::class)->name('availability.index'); // Rota para disponibilidade
                // Route::get('customers', Customers::class)->name('customers.index');
                // Route::get('services', Services::class)->name('services.index');
                // Route::get('products', Products::class)->name('products.index');
                // Route::get('employees', Employees::class)->name('employees.index');
                Route::get('', EmployeeDashboard::class)->name('index');
            });
        });
});
