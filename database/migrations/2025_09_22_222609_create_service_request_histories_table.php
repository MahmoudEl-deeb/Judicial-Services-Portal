<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('service_request_history', function (Blueprint $table) {
        $table->id();
        $table->foreignId('service_request_id')->constrained('service_requests')->onDelete('cascade');
        $table->enum('status', ['pending','under_review','approved','rejected','completed','cancelled']);
        $table->text('notes')->nullable();
        $table->foreignId('updated_by')->constrained('users');
        $table->timestamp('created_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_request_histories');
    }
};
