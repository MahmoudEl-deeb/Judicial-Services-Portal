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
        Schema::create('cassation_departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_code')->unique();
            $table->string('department_name_ar');
            $table->string('department_name_en');
            $table->enum('department_type', [
                'civil', 'commercial', 'criminal', 'administrative', 'constitutional', 'disciplinary'
            ]);
            $table->foreignId('head_judge_id')->nullable()->constrained('users')->nullOnDelete();
            // $table->text('department_description')->nullable();
            // $table->json('department_services')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cassation_departments');
    }
};
