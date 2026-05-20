<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_version_id')->constrained('quotation_versions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('quote_request_item_id')->nullable()->constrained('quote_request_items')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('line_no')->default(1);
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete()->cascadeOnUpdate();
            $table->string('description', 255);
            $table->decimal('quantity', 18, 3)->default(1);
            $table->string('unit', 50)->default('EA');
            $table->decimal('unit_price', 18, 4)->default(0);
            $table->decimal('discount_percent', 8, 3)->default(0);
            $table->decimal('tax_percent', 8, 3)->default(0);
            $table->decimal('line_total', 18, 2)->default(0);
            $table->json('specs')->nullable();
            $table->text('notes')->nullable();

            $table->unique(['quotation_version_id', 'line_no']);
            $table->index('quotation_version_id');
            $table->index('quote_request_item_id');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};
