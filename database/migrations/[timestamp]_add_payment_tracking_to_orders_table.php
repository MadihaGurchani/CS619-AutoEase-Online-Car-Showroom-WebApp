<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'payment_status')) {
                $table->string('payment_status')->default('pending')->after('status');
            }
            if (!Schema::hasColumn('orders', 'last_payment_date')) {
                $table->timestamp('last_payment_date')->nullable()->after('payment_status');
            }
            if (!Schema::hasColumn('orders', 'next_payment_date')) {
                $table->timestamp('next_payment_date')->nullable()->after('last_payment_date');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'last_payment_date', 'next_payment_date']);
        });
    }
};