<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('line_no')->default(1);
            $table->string('description', 255);
            $table->decimal('quantity', 18, 3)->default(1);
            $table->string('unit', 50)->default('EA');
            $table->decimal('unit_price', 18, 4)->default(0);
            $table->decimal('discount_percent', 8, 3)->default(0);
            $table->decimal('tax_percent', 8, 3)->default(0);
            $table->decimal('line_total', 18, 2)->default(0);

            $table->unique(['invoice_id', 'line_no']);
            $table->index('invoice_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
