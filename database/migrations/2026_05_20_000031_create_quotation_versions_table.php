<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('version_no');
            $table->foreignId('cost_estimation_id')->nullable()->constrained('cost_estimations')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('version_reason', ['initial', 'revision_requested', 'internal_revision', 'price_change', 'scope_change', 'correction'])->default('initial');
            $table->decimal('subtotal', 18, 2)->default(0);
            $table->decimal('discount_amount', 18, 2)->default(0);
            $table->decimal('tax_amount', 18, 2)->default(0);
            $table->decimal('total_amount', 18, 2)->default(0);
            $table->string('pdf_path', 500)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->unique(['quotation_id', 'version_no']);
            $table->index('quotation_id');
            $table->index('cost_estimation_id');
            $table->index('created_by');
            $table->index('version_reason');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_versions');
    }
};
