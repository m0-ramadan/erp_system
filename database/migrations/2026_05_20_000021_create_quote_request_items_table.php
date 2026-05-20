<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained('quote_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('line_no')->default(1);
            $table->string('product_name', 255);
            $table->text('description')->nullable();
            $table->decimal('quantity', 18, 3)->default(1);
            $table->string('unit', 50)->default('EA');
            $table->json('product_specs')->nullable();
            $table->text('customer_notes')->nullable();
            $table->timestamps();

            $table->unique(['quote_request_id', 'line_no']);
            $table->index('quote_request_id');
            $table->index('product_id');
            $table->index('product_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_request_items');
    }
};
