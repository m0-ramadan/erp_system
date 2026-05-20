<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_ticket_id')->constrained('job_tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('production_plan_id')->nullable()->constrained('production_plans')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('logged_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('log_type', ['progress', 'delay', 'issue', 'material', 'labor', 'machine', 'note'])->default('progress');
            $table->decimal('progress_percent', 5, 2)->nullable();
            $table->text('description');
            $table->dateTime('logged_at')->useCurrent();

            $table->index('job_ticket_id');
            $table->index('production_plan_id');
            $table->index('logged_by');
            $table->index('log_type');
            $table->index('logged_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_logs');
    }
};
