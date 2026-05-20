<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DepartmentsAndRolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_without_role_cannot_access_admin_dashboard(): void
    {
        $this->seed(DepartmentsAndRolesSeeder::class);

        $user = User::query()->create([
            'name' => 'Demo Admin',
            'email' => 'demo@admin.com',
            'password' => bcrypt('secret123'),
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertForbidden();
    }

    public function test_assigning_admin_role_restores_dashboard_access(): void
    {
        $this->seed(DepartmentsAndRolesSeeder::class);

        $user = User::query()->create([
            'name' => 'Demo Admin',
            'email' => 'demo@admin.com',
            'password' => bcrypt('secret123'),
            'is_active' => true,
        ]);

        $this->artisan('users:assign-role', [
            'email' => $user->email,
            'role_code' => 'ADMIN',
        ])->assertExitCode(0);

        $this->assertTrue($user->fresh()->hasRole('ADMIN'));

        $response = $this->actingAs($user->fresh())->get('/admin/dashboard');

        $response->assertOk();
    }
}
