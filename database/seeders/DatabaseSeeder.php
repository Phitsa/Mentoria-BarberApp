<?php

namespace Database\Seeders;

use App\Livewire\Employee\Availability;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Employee\Availability as EmployeeAvailability;
use App\Models\Service;
use App\Models\User;
use Database\Factories\Employee\AvailabilityFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */


    public function run(): void
    {
        $userId = User::factory()->create([
            'email' => 'admin@example.com',
        ])->id;

        $employeeId = User::factory()->create([
            'email' => 'employee@example.com',
        ])->id;

        $adminTest = Admin::create([
            'name' => 'Admin Test',
            'phone' => '1234567890',
            'last_login_at' => now(),
            'user_id' => $userId,
        ]);

        Employee::create([
            'name' => 'Employee Test',
            'phone' => '0987654321',
            'joined_at' => now(),
            'birth_date' => '1990-01-01',
            'tax_id' => '00000000000',
            'active' => true,
            'user_id' => $employeeId,
            'admin_id' => $adminTest->id,
        ]);

        Admin::factory()->count(10)->create();

        Admin::all()->each(function ($admin) {
            Service::factory()
                ->count(20)
                ->create([
                    'admin_id' => $admin->id,
                ]);
            Customer::factory()
                ->count(5)
                ->create([
                    'admin_id' => $admin->id,
                ]);
            Employee::factory()
                ->count(10)
                ->create([
                    'admin_id' => $admin->id,
                ]);

            // Associar serviços aleatórios a cada employee do admin
            $services = Service::where('admin_id', $admin->id)->pluck('id');
            Employee::where('admin_id', $admin->id)->each(function ($employee) use ($services) {
                $employee->services()->attach(
                    $services->random(rand(5, 15))
                );
            });
        });

        Employee::all()->each(function ($employee) {
            EmployeeAvailability::factory()
            ->count(100)
            ->create([
                'employee_id' => $employee->id,
            ]);
        });

    }
}
