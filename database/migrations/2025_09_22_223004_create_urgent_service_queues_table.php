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
Schema::create('urgent_service_queue', function (Blueprint $table) {
    $table->id();
    $table->foreignId('service_request_id')->constrained('service_requests')->onDelete('cascade');
    $table->integer('queue_position');
    $table->dateTime('estimated_completion')->nullable();
    $table->dateTime('actual_start_time')->nullable();
    $table->dateTime('actual_completion_time')->nullable();
    $table->enum('status', ['queued','in_progress','completed','cancelled'])->default('queued');
    $table->foreignId('assigned_processor')->nullable()->constrained('users');
    $table->text('processing_notes')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urgent_service_queues');
    }
};
