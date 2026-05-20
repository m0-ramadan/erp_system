<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_no', 80)->unique();
            $table->enum('request_source', ['sales_rep', 'sales_coordinator', 'customer_portal', 'phone', 'email', 'walk_in', 'other'])->default('sales_rep');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('contact_id')->nullable()->constrained('customer_contacts')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('sales_rep_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('sales_coordinator_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('assigned_estimation_user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->string('title', 255)->nullable();
            $table->string('project_name', 255)->nullable();
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->date('requested_delivery_date')->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('status', [
                'draft',
                'submitted',
                'in_review',
                'clarification_requested',
                'estimation_in_progress',
                'design_review',
                'accounts_review',
                'management_review',
                'quotation_generated',
                'sent_to_customer',
                'revision_requested',
                'accepted',
                'rejected',
                'cancelled',
                'closed'
            ])->default('draft');
            $table->enum('completeness_status', ['unchecked', 'complete', 'incomplete'])->default('unchecked');
            $table->text('customer_requirements')->nullable();
            $table->text('internal_notes')->nullable();
            $table->dateTime('submitted_at')->nullable();
            $table->dateTime('closed_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->timestamps();

            $table->index('request_source');
            $table->index('customer_id');
            $table->index('contact_id');
            $table->index('created_by');
            $table->index('sales_rep_id');
            $table->index('sales_coordinator_id');
            $table->index('assigned_estimation_user_id');
            $table->index('priority');
            $table->index('requested_delivery_date');
            $table->index('currency_id');
            $table->index('status');
            $table->index('completeness_status');
            $table->index('submitted_at');
            $table->index(['status', 'priority']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
