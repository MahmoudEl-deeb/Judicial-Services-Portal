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
    Schema::create('court_cases', function (Blueprint $table) {
        $table->id();
        $table->string('case_number')->unique();
        $table->string('cassation_appeal_number')->unique();
        $table->string('case_title');
        $table->text('case_description')->nullable();
        $table->enum('cassation_case_type', [
            'civil_cassation','commercial_cassation','criminal_cassation',
            'administrative_cassation','constitutional_cassation','disciplinary_cassation'
        ]);
        $table->enum('status', [
            'filed','under_department_review','accepted','rejected',
            'scheduled_hearing','under_deliberation','judgment_issued','closed'
        ])->default('filed');
        $table->foreignId('lawyer_id')->nullable()->constrained('lawyers');
        $table->foreignId('department_id')->constrained('cassation_departments');
        $table->foreignId('assigned_judge_id')->nullable()->constrained('judges');
        $table->string('lower_court_name')->nullable();
        $table->string('lower_court_judgment_number')->nullable();
        $table->date('lower_court_judgment_date')->nullable();
        $table->date('cassation_filing_date')->nullable();
        $table->date('hearing_date')->nullable();
        // $table->decimal('appeal_value', 12, 2)->nullable();
        $table->text('case_summary')->nullable();
        $table->text('legal_grounds')->nullable();
        $table->enum('judgment_result', [
            'appeal_accepted','appeal_rejected','case_remanded','judgment_amended'
        ])->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_cases');
    }
};
