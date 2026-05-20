<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('allowed')->default(true);

            $table->primary(['user_id', 'permission_id']);
            $table->index('permission_id');
            $table->index('allowed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};
