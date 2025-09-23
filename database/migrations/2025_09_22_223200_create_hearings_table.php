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
        Schema::create('hearings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('cases')->onDelete('cascade');
            $table->foreignId('judge_id')->constrained('judges')->onDelete('cascade');
            $table->date('hearing_date');
            $table->time('hearing_time');
    $table->string('courtroom')->nullable();
    $table->enum('status', ['scheduled','postponed','completed','cancelled'])->default('scheduled');
    $table->text('hearing_notes')->nullable();
    $table->text('postponement_reason')->nullable();
    $table->date('next_hearing_date')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hearings');
    }
};
