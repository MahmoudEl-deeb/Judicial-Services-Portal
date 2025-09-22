<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lawyers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('bar_registration_number')->unique();
            $table->string('bar_registration_image');
            $table->string('specialization');
            $table->date('registration_date')->nullable();
            $table->enum('license_status', ['active', 'suspended', 'expired'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lawyers');
    }
};
