<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_ticket_id')->constrained('job_tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('planned_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('feasibility_status', ['pending', 'feasible', 'not_feasible', 'feasible_with_notes'])->default('pending');
            $table->text('feasibility_notes')->nullable();
            $table->enum('plan_status', ['draft', 'approved', 'released', 'in_progress', 'completed', 'cancelled'])->default('draft');
            $table->date('planned_start_date')->nullable();
            $table->date('planned_end_date')->nullable();
            $table->dateTime('actual_start_at')->nullable();
            $table->dateTime('actual_end_at')->nullable();
            $table->text('plan_notes')->nullable();
            $table->timestamps();

            $table->index('job_ticket_id');
            $table->index('planned_by');
            $table->index('feasibility_status');
            $table->index('plan_status');
            $table->index(['planned_start_date', 'planned_end_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_plans');
    }
};
