<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('contact_name', 180);
            $table->string('job_title', 150)->nullable();
            $table->string('email', 180)->nullable();
            $table->string('phone', 80)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('customer_id');
            $table->index('email');
            $table->index('is_primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_contacts');
    }
};
