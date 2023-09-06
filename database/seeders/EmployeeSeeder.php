<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // headquarter user
               \App\Models\User::factory()->create([
                'name' => 'Head Quarter',
                'phone' => '256700000000',
                'email' => 'headquarter@adepr.com',
                'role' => 'headquarter',
                'username' => 'headquarter',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);
            // region user
            \App\Models\User::factory()->create([
                'name' => 'Region',
                'phone' => '256700000001',
                'email' => 'region@adepr.com',
                'role' => 'region',
                'username' => 'region',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);
            // parish user
            \App\Models\User::factory()->create([
                'name' => 'Parish',
                'phone' => '256700000002',
                'email' => 'parish@adepr.com',
                'role' => 'parish',
                'username' => 'parish',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);
            // local church user
            \App\Models\User::factory()->create([
                'name' => 'Local Church',
                'phone' => '256700000003',
                'email' => 'localchurch@adepr.com',
                'role' => 'local church',
                'username' => 'localchurch',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);

    }
}
