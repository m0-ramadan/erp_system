<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->constrained('sales_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('job_ticket_id')->nullable()->constrained('job_tickets')->nullOnDelete()->cascadeOnUpdate();
            $table->string('dispatch_no', 80)->unique();
            $table->enum('status', ['pending', 'dispatched', 'returned', 'cancelled'])->default('pending');
            $table->string('carrier_name', 180)->nullable();
            $table->string('tracking_no', 180)->nullable();
            $table->text('dispatch_address')->nullable();
            $table->foreignId('dispatched_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('dispatched_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('sales_order_id');
            $table->index('job_ticket_id');
            $table->index('status');
            $table->index('tracking_no');
            $table->index('dispatched_by');
            $table->index('dispatched_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
