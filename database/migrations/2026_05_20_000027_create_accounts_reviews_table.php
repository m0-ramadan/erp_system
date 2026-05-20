<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained('quote_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('cost_estimation_id')->nullable()->constrained('cost_estimations')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('decision', ['pending', 'approved', 'returned_for_correction', 'rejected'])->default('pending');
            $table->boolean('credit_limit_checked')->default(false);
            $table->foreignId('payment_terms_id')->nullable()->constrained('payment_terms')->nullOnDelete()->cascadeOnUpdate();
            $table->text('financial_notes')->nullable();
            $table->text('correction_required')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->timestamps();

            $table->index('quote_request_id');
            $table->index('cost_estimation_id');
            $table->index('reviewed_by');
            $table->index('decision');
            $table->index('payment_terms_id');
            $table->index('reviewed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts_reviews');
    }
};
