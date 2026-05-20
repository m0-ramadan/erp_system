<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clarifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained('quote_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('requested_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->text('question');
            $table->text('response')->nullable();
            $table->enum('status', ['open', 'answered', 'closed', 'cancelled'])->default('open');
            $table->dateTime('requested_at')->useCurrent();
            $table->dateTime('responded_at')->nullable();
            $table->dateTime('closed_at')->nullable();

            $table->index('quote_request_id');
            $table->index('requested_by');
            $table->index('assigned_to');
            $table->index('status');
            $table->index('requested_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clarifications');
    }
};
