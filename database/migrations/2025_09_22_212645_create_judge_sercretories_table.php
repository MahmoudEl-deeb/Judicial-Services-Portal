<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('judge_sercretories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('employee_id')->unique();
            $table->foreignId('judge_id')->nullable()->constrained('judges')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('cassation_departments')->nullOnDelete();
            $table->timestamps();
        });
        

        
    }

    public function down(): void {
        Schema::dropIfExists('judge_sercretories');
    }
};
