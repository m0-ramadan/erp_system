<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workflow_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_instance_id')->constrained('workflow_instances')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('from_step_code', 100)->nullable();
            $table->string('to_step_code', 100)->nullable();
            $table->foreignId('transition_id')->nullable()->constrained('workflow_transitions')->nullOnDelete()->cascadeOnUpdate();
            $table->string('action_code', 100);
            $table->string('action_label', 180)->nullable();
            $table->text('comments')->nullable();
            $table->foreignId('acted_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->dateTime('acted_at')->useCurrent();

            $table->foreign('from_step_code')->references('code')->on('workflow_steps')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('to_step_code')->references('code')->on('workflow_steps')->nullOnDelete()->cascadeOnUpdate();

            $table->index('workflow_instance_id');
            $table->index('from_step_code');
            $table->index('to_step_code');
            $table->index('transition_id');
            $table->index('action_code');
            $table->index('acted_by');
            $table->index('acted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_history');
    }
};
