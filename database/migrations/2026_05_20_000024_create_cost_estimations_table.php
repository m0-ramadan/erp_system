<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cost_estimations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained('quote_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('estimation_no', 80)->unique();
            $table->unsignedInteger('version_no')->default(1);
            $table->foreignId('estimated_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['draft', 'submitted', 'revised', 'approved', 'rejected'])->default('draft');
            $table->decimal('material_cost', 18, 2)->default(0);
            $table->decimal('labor_cost', 18, 2)->default(0);
            $table->decimal('overhead_cost', 18, 2)->default(0);
            $table->decimal('subcontract_cost', 18, 2)->default(0);
            $table->decimal('margin_percent', 8, 3)->default(0);
            $table->decimal('discount_percent', 8, 3)->default(0);
            $table->decimal('tax_percent', 8, 3)->default(0);
            $table->decimal('total_cost', 18, 2)->default(0);
            $table->decimal('selling_price', 18, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['quote_request_id', 'version_no']);
            $table->index('quote_request_id');
            $table->index('estimated_by');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cost_estimations');
    }
};
