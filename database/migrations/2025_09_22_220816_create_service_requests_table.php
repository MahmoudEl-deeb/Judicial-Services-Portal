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
    Schema::create('service_requests', function (Blueprint $table) {
        $table->id();
        $table->string('request_number')->unique();
        $table->foreignId('requester_id')->constrained('users');
        $table->foreignId('service_type_id')->constrained('service_types')->onDelete('cascade');
        $table->foreignId('department_id')->constrained('cassation_departments');
        $table->foreignId('assigned_secretary_id')->nullable()->constrained('judge_sercretories');
        $table->foreignId('approved_by_secretary_id')->nullable()->constrained('judge_sercretories');
        $table->string('request_title');
        $table->text('request_description')->nullable();
        $table->foreignId('related_case_id')->nullable()->constrained('cases');
        $table->enum('status', [
            'pending','under_department_review','assigned_to_secretary','in_progress',
            'pending_approval','approved','rejected','completed','cancelled','awaiting_payment'
        ])->default('pending');
        $table->enum('priority', ['normal','urgent'])->default('normal');
        // $table->enum('service_category', ['regular','urgent','prepaid'])->default('regular');
        $table->boolean('is_urgent_service')->default(false);
        $table->boolean('is_prepaid_service')->default(false);
        // $table->decimal('urgent_service_multiplier', 8, 2)->default(1);
        // $table->json('submitted_documents_meta')->nullable();
        $table->decimal('base_fees_amount', 12, 2)->default(0);
        $table->decimal('urgent_fees_amount', 12, 2)->default(0);
        $table->decimal('total_fees_amount', 12, 2)->default(0);
        $table->enum('payment_status', ['pending','partial_paid','paid','refunded','prepaid_balance_used'])->default('pending');
        $table->date('requested_date')->nullable();
        $table->date('assigned_to_secretary_date')->nullable();
        $table->date('department_review_date')->nullable();
        $table->date('expected_completion_date')->nullable();
        $table->date('urgent_completion_deadline')->nullable();
        $table->date('approved_date')->nullable();
        $table->date('completed_date')->nullable();
        $table->integer('processing_time_hours')->nullable();
        $table->integer('urgent_processing_time_hours')->nullable();
        $table->text('department_notes')->nullable();
        $table->text('secretary_notes')->nullable();
        $table->text('approval_notes')->nullable();
        $table->text('rejection_reason')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
