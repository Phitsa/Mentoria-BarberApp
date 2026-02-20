<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Service;
use App\Models\User;
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

        Admin::create([
            'name' => 'Admin Test',
            'phone' => '1234567890',
            'last_login_at' => now(),
            'user_id' => $userId,
        ]);

        Admin::factory()->count(10)->create();

        Admin::all()->each(function ($admin) {
            Service::factory()
                ->count(20)
                ->create([
                    'admin_id' => $admin->id,
                ]);
            Customer::factory()
                ->count(30)
                ->create([
                    'admin_id' => $admin->id,
                ]);
            Employee::factory()
                ->count(15)
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

    }
}
