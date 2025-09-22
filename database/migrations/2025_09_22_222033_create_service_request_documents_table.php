<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('service_request_documents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('service_request_id')->constrained('service_requests')->onDelete('cascade');
        // $table->string('document_type');
        $table->string('document_name');
        $table->string('file_path');
        // $table->boolean('is_required')->default(false);
        // $table->boolean('is_verified')->default(false);
        // $table->foreignId('verified_by')->nullable()->constrained('users');
        // $table->timestamp('verified_at')->nullable();
        // $table->text('verification_notes')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_request_documents');
    }
};
