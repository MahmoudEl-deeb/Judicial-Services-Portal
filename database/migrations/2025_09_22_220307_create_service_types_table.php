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
    Schema::create('service_types', function (Blueprint $table) {
        $table->id();
        $table->string('service_type_key')->unique();
        $table->string('service_name_ar');
        $table->string('service_name_en');
        $table->text('description_ar')->nullable();
        $table->text('description_en')->nullable();
        $table->foreignId('responsible_department_id')->constrained('cassation_departments');
        $table->enum('cassation_service_type', [
            'cassation_appeal_filing','cassation_case_status','cassation_judgment_copy',
            'cassation_hearing_certificate','cassation_case_extract','cassation_execution_order',
            'cassation_legal_memo','cassation_precedent_search','cassation_case_transfer',
            'cassation_appeal_withdrawal','cassation_urgent_appeal','cassation_document_authentication'
        ]);
        $table->json('required_documents')->nullable();
        $table->decimal('base_fee', 12, 2)->default(0);
        $table->decimal('urgent_fee_multiplier', 8, 2)->default(1);
        $table->integer('processing_days')->default(0);
        $table->integer('urgent_processing_days')->default(0);
        $table->boolean('allows_urgent')->default(false);
        $table->boolean('is_prepaid_service')->default(false);
        $table->boolean('requires_case_reference')->default(false);
        $table->boolean('requires_lawyer_signature')->default(false);
        $table->boolean('requires_department_approval')->default(false);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_types');
    }
};
