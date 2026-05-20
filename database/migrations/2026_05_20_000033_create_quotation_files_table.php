<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('quotation_version_id')->nullable()->constrained('quotation_versions')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('file_type_id')->nullable()->constrained('file_types')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->string('original_name', 255);
            $table->string('stored_name', 255);
            $table->string('file_path', 500);
            $table->string('mime_type', 120)->nullable();
            $table->unsignedBigInteger('size_bytes')->nullable();
            $table->dateTime('uploaded_at')->useCurrent();

            $table->index('quotation_id');
            $table->index('quotation_version_id');
            $table->index('file_type_id');
            $table->index('uploaded_by');
            $table->index('uploaded_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_files');
    }
};
