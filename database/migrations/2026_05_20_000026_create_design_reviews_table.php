<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('design_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained('quote_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('feasibility_status', ['pending', 'feasible', 'feasible_with_notes', 'not_feasible'])->default('pending');
            $table->enum('decision', ['pending', 'approved', 'approved_with_notes', 'rejected'])->default('pending');
            $table->text('design_notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->timestamps();

            $table->index('quote_request_id');
            $table->index('reviewed_by');
            $table->index('feasibility_status');
            $table->index('decision');
            $table->index('reviewed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_reviews');
    }
};
