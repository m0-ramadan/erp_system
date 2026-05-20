<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workflow_instances', function (Blueprint $table) {
            $table->id();
            $table->enum('entity_type', ['quote_request', 'quotation', 'sales_order', 'job_ticket', 'invoice']);
            $table->unsignedBigInteger('entity_id');
            $table->string('current_step_code', 100)->nullable();
            $table->enum('status', ['active', 'on_hold', 'completed', 'cancelled', 'rejected'])->default('active');
            $table->foreignId('started_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('started_at')->useCurrent();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();

            $table->foreign('current_step_code')->references('code')->on('workflow_steps')->nullOnDelete()->cascadeOnUpdate();

            $table->index(['entity_type', 'entity_id']);
            $table->index('current_step_code');
            $table->index('status');
            $table->index('started_by');
            $table->index('started_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_instances');
    }
};
