<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_types', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 120);
            $table->string('allowed_extensions', 255)->nullable();
            $table->unsignedInteger('max_size_mb')->nullable();
            $table->boolean('is_active')->default(true);

            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_types');
    }
};
