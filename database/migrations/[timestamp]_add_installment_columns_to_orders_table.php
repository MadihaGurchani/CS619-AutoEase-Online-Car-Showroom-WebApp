<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'installment_details')) {
                $table->json('installment_details')->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_status')) {
                $table->string('delivery_status')->default('pending');
            }
            if (!Schema::hasColumn('orders', 'estimated_delivery_date')) {
                $table->timestamp('estimated_delivery_date')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['installment_details', 'delivery_status', 'estimated_delivery_date']);
        });
    }
};