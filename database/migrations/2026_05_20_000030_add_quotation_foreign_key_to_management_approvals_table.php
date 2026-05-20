<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('management_approvals', function (Blueprint $table) {
            $table->foreign('quotation_id')
                ->references('id')
                ->on('quotations')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('management_approvals', function (Blueprint $table) {
            $table->dropForeign(['quotation_id']);
        });
    }
};
