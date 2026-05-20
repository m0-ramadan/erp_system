<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispatch_id')->constrained('dispatches')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('sales_order_id')->constrained('sales_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('delivery_no', 80)->unique();
            $table->enum('status', ['pending', 'confirmed', 'failed', 'returned'])->default('pending');
            $table->string('received_by_name', 180)->nullable();
            $table->string('received_by_phone', 80)->nullable();
            $table->string('proof_file_path', 500)->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->index('dispatch_id');
            $table->index('sales_order_id');
            $table->index('status');
            $table->index('delivered_at');
            $table->index('confirmed_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
