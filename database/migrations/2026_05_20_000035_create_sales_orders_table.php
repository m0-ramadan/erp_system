<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('quotation_version_id')->nullable()->constrained('quotation_versions')->nullOnDelete()->cascadeOnUpdate();
            $table->string('order_no', 80)->unique();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('sales_rep_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('status', [
                'created',
                'on_hold',
                'released_to_production',
                'in_production',
                'quality_check',
                'ready_for_dispatch',
                'dispatched',
                'delivered',
                'invoiced',
                'closed',
                'cancelled',
                'reopened'
            ])->default('created');
            $table->date('order_date');
            $table->date('planned_delivery_date')->nullable();
            $table->decimal('total_amount', 18, 2)->default(0);
            $table->text('hold_reason')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->text('reopened_reason')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('held_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->dateTime('reopened_at')->nullable();
            $table->timestamps();

            $table->index('quotation_id');
            $table->index('quotation_version_id');
            $table->index('customer_id');
            $table->index('sales_rep_id');
            $table->index('status');
            $table->index('order_date');
            $table->index('planned_delivery_date');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
