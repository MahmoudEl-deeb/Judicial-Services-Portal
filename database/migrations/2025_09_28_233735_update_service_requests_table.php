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
        Schema::table('service_requests', function (Blueprint $table) {
            $table->string('client_national_id')->nullable()->after('requester_id');
            $table->boolean('is_paid')->default(false)->after('total_fees_amount');
            $table->dropColumn('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn('client_national_id');
            $table->dropColumn('is_paid');
            $table->enum('payment_status', ['pending','partial_paid','paid','refunded','prepaid_balance_used'])->default('pending');
        });
    }
};
