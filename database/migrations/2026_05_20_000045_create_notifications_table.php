<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('related_entity_type', ['quote_request', 'quotation', 'sales_order', 'job_ticket', 'invoice', 'workflow_task'])->nullable();
            $table->unsignedBigInteger('related_entity_id')->nullable();
            $table->enum('notification_type', ['system', 'email', 'sms', 'whatsapp', 'in_app'])->default('in_app');
            $table->string('title', 255);
            $table->text('body')->nullable();
            $table->enum('status', ['draft', 'queued', 'sent', 'failed', 'read'])->default('queued');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('sent_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->index(['related_entity_type', 'related_entity_id']);
            $table->index('notification_type');
            $table->index('status');
            $table->index('created_by');
            $table->index('sent_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
