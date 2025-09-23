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
    Schema::create('case_documents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
        $table->string('document_name');
        $table->string('file_path');
        $table->foreignId('uploaded_by')->constrained('users');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_documents');
    }
};
