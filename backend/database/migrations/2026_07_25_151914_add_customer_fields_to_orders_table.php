<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('customer_name')
                  ->nullable();

            $table->string('queue_number')
                  ->nullable();

            $table->decimal(
                'cash_received',
                12,
                2
            )->nullable();

            $table->decimal(
                'change_amount',
                12,
                2
            )->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'customer_name',
                'queue_number',
                'cash_received',
                'change_amount'
            ]);

        });
    }
};