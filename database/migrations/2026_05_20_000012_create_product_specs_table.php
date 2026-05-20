<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('spec_name', 150);
            $table->text('spec_value')->nullable();
            $table->string('unit', 50)->nullable();
            $table->boolean('is_required')->default(false);
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->index('product_id');
            $table->index('spec_name');
            $table->index('is_required');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_specs');
    }
};
