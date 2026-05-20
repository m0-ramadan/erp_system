<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained('quote_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('quotation_no', 80)->unique();
            $table->unsignedInteger('current_version_no')->default(1);
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('sales_rep_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('payment_terms_id')->nullable()->constrained('payment_terms')->nullOnDelete()->cascadeOnUpdate();
            $table->date('quotation_date');
            $table->date('valid_until')->nullable();
            $table->decimal('subtotal', 18, 2)->default(0);
            $table->decimal('discount_amount', 18, 2)->default(0);
            $table->decimal('tax_amount', 18, 2)->default(0);
            $table->decimal('total_amount', 18, 2)->default(0);
            $table->enum('status', [
                'draft',
                'pending_design',
                'pending_accounts',
                'pending_management',
                'approved',
                'sent',
                'revision_requested',
                'accepted',
                'rejected',
                'expired',
                'cancelled',
                'closed'
            ])->default('draft');
            $table->string('pdf_path', 500)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->timestamps();

            $table->index('quote_request_id');
            $table->index('customer_id');
            $table->index('sales_rep_id');
            $table->index('currency_id');
            $table->index('payment_terms_id');
            $table->index('quotation_date');
            $table->index('valid_until');
            $table->index('status');
            $table->index('created_by');
            $table->index('sent_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
