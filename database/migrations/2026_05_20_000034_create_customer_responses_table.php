<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('quotation_version_id')->nullable()->constrained('quotation_versions')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('contact_id')->nullable()->constrained('customer_contacts')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('response', ['pending', 'accepted', 'rejected', 'revision_requested', 'no_response'])->default('pending');
            $table->text('response_notes')->nullable();
            $table->text('revision_details')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->dateTime('responded_at')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->index('quotation_id');
            $table->index('quotation_version_id');
            $table->index('customer_id');
            $table->index('contact_id');
            $table->index('response');
            $table->index('responded_at');
            $table->index('recorded_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_responses');
    }
};
