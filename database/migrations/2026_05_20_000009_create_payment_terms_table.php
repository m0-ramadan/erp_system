<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_terms', function (Blueprint $table) {
            $table->id();
            $table->string('code', 80)->unique();
            $table->string('name', 180);
            $table->text('description')->nullable();
            $table->unsignedInteger('days_count')->nullable();
            $table->boolean('is_active')->default(true);

            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_terms');
    }
};
