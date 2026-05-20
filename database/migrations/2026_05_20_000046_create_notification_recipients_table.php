<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained('notifications')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_contact_id')->nullable()->constrained('customer_contacts')->nullOnDelete()->cascadeOnUpdate();
            $table->string('recipient_email', 180)->nullable();
            $table->string('recipient_phone', 80)->nullable();
            $table->enum('delivery_status', ['pending', 'sent', 'failed', 'read'])->default('pending');
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('read_at')->nullable();

            $table->index('notification_id');
            $table->index('user_id');
            $table->index('customer_contact_id');
            $table->index('recipient_email');
            $table->index('delivery_status');
            $table->index('delivered_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_recipients');
    }
};
