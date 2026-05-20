<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->enum('related_entity_type', ['quote_request', 'quotation', 'sales_order', 'job_ticket', 'invoice']);
            $table->unsignedBigInteger('related_entity_id');
            $table->enum('reminder_type', ['customer_follow_up', 'internal_task', 'quotation_expiry', 'approval_pending', 'production_delay', 'payment_due']);
            $table->text('message');
            $table->dateTime('remind_at');
            $table->dateTime('sent_at')->nullable();
            $table->enum('status', ['scheduled', 'sent', 'cancelled', 'failed'])->default('scheduled');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->index(['related_entity_type', 'related_entity_id']);
            $table->index('reminder_type');
            $table->index(['remind_at', 'status']);
            $table->index('created_by');
            $table->index('assigned_to');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
