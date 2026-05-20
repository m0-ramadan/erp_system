<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('management_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained('quote_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('decision', ['pending', 'approved', 'rejected', 'returned_to_accounts', 'returned_to_estimation'])->default('pending');
            $table->decimal('approval_limit_amount', 18, 2)->nullable();
            $table->text('comments')->nullable();
            $table->dateTime('decided_at')->nullable();
            $table->timestamps();

            $table->index('quote_request_id');
            $table->index('quotation_id');
            $table->index('approved_by');
            $table->index('decision');
            $table->index('decided_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('management_approvals');
    }
};
