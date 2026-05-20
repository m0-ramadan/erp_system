<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->constrained('sales_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('ticket_no', 80)->unique();
            $table->enum('status', [
                'created',
                'production_feasibility_review',
                'production_planning',
                'released_to_production',
                'in_production',
                'quality_check',
                'passed',
                'failed',
                'ready_for_dispatch',
                'dispatched',
                'delivered',
                'closed',
                'cancelled',
                'on_hold'
            ])->default('created');
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->text('production_notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();

            $table->index('sales_order_id');
            $table->index('status');
            $table->index('priority');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_tickets');
    }
};
