<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code', 80)->unique();
            $table->string('company_name', 255);
            $table->enum('customer_type', ['new', 'existing', 'prospect'])->default('prospect');
            $table->string('tax_number', 100)->nullable();
            $table->string('commercial_register', 100)->nullable();
            $table->string('email', 180)->nullable();
            $table->string('phone', 80)->nullable();
            $table->string('address_line1', 255)->nullable();
            $table->string('address_line2', 255)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('country', 120)->nullable();
            $table->foreignId('assigned_sales_rep_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['active', 'inactive', 'blacklisted'])->default('active');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();

            $table->index('company_name');
            $table->index('customer_type');
            $table->index('assigned_sales_rep_id');
            $table->index('status');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
