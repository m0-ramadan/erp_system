<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the SETUP department
        $department = Department::where('code', 'SETUP')->first();

        // Create or update the admin user
        $user = User::updateOrCreate(
            ['email' => 'demo@admin.com'],
            [
                'employee_code' => 'ADM-001',
                'name' => 'System Administrator',
                'phone' => '1234567890',
                'password' => Hash::make('Almlm85478547..85478547..'),
                'department_id' => $department?->id,
                'is_active' => true,
            ]
        );

        // Find the ADMIN role
        $adminRole = Role::where('code', 'ADMIN')->first();

        if ($adminRole) {
            // Attach the ADMIN role to the user if not already attached
            $user->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
}
