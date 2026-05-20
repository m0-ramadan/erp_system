<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workflow_transitions', function (Blueprint $table) {
            $table->id();
            $table->string('from_step_code', 100);
            $table->string('to_step_code', 100);
            $table->string('condition_code', 100)->nullable();
            $table->string('condition_label', 180)->nullable();
            $table->boolean('is_default')->default(false);
            $table->text('description')->nullable();

            $table->foreign('from_step_code')->references('code')->on('workflow_steps')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('to_step_code')->references('code')->on('workflow_steps')->cascadeOnDelete()->cascadeOnUpdate();

            $table->index('from_step_code');
            $table->index('to_step_code');
            $table->index('condition_code');
            $table->index('is_default');
            $table->index(['from_step_code', 'condition_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_transitions');
    }
};
