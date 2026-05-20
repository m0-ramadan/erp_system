<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workflow_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_instance_id')->constrained('workflow_instances')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('step_code', 100);
            $table->string('assigned_role_code', 80)->nullable();
            $table->foreignId('assigned_user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('task_status', ['open', 'in_progress', 'completed', 'skipped', 'cancelled', 'rejected'])->default('open');
            $table->dateTime('due_at')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('result_code', 100)->nullable();
            $table->text('result_notes')->nullable();
            $table->timestamps();

            $table->foreign('step_code')->references('code')->on('workflow_steps')->restrictOnDelete()->cascadeOnUpdate();

            $table->index('workflow_instance_id');
            $table->index('step_code');
            $table->index('assigned_role_code');
            $table->index('assigned_user_id');
            $table->index('task_status');
            $table->index('due_at');
            $table->index(['task_status', 'due_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_tasks');
    }
};
