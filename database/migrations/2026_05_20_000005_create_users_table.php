<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code', 80)->nullable()->unique();
            $table->string('name', 180);
            $table->string('email', 180)->unique();
            $table->string('phone', 50)->nullable();
            $table->string('password');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('manager_user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->boolean('is_active')->default(true);
            $table->dateTime('last_login_at')->nullable();
            $table->timestamps();

            $table->index('department_id');
            $table->index('manager_user_id');
            $table->index('is_active');
            $table->index('last_login_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
