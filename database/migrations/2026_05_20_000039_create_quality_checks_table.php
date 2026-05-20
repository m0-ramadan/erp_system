<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quality_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_ticket_id')->constrained('job_tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('checked_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('result', ['pending', 'passed', 'failed', 'passed_with_notes'])->default('pending');
            $table->json('checklist')->nullable();
            $table->text('defects_found')->nullable();
            $table->text('corrective_action')->nullable();
            $table->dateTime('checked_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->index('job_ticket_id');
            $table->index('checked_by');
            $table->index('result');
            $table->index('checked_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quality_checks');
    }
};
