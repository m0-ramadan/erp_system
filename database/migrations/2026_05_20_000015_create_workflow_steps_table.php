<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workflow_steps', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            $table->string('name', 180);
            $table->string('lane', 100);
            $table->string('role_code', 80)->nullable();
            $table->enum('step_type', ['start', 'task', 'gateway', 'system', 'end'])->default('task');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_terminal')->default(false);
            $table->text('description')->nullable();

            $table->index('lane');
            $table->index('role_code');
            $table->index('step_type');
            $table->index('sort_order');
            $table->index('is_terminal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_steps');
    }
};
