<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cost_estimation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cost_estimation_id')->constrained('cost_estimations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('quote_request_item_id')->nullable()->constrained('quote_request_items')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('line_no')->default(1);
            $table->string('description', 255);
            $table->enum('cost_type', ['material', 'labor', 'overhead', 'subcontract', 'other'])->default('material');
            $table->decimal('quantity', 18, 3)->default(1);
            $table->string('unit', 50)->default('EA');
            $table->decimal('unit_cost', 18, 4)->default(0);
            $table->decimal('total_cost', 18, 2)->default(0);
            $table->string('supplier_name', 255)->nullable();
            $table->text('notes')->nullable();

            $table->unique(['cost_estimation_id', 'line_no']);
            $table->index('cost_estimation_id');
            $table->index('quote_request_item_id');
            $table->index('cost_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cost_estimation_items');
    }
};
