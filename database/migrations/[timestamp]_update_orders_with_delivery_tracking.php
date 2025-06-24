<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('delivery_status', [
                'processing',
                'ready_for_delivery',
                'out_for_delivery',
                'delivered'
            ])->default('processing');
            $table->timestamp('estimated_delivery_date')->nullable();
            $table->text('delivery_notes')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_status', 'estimated_delivery_date', 'delivery_notes']);
        });
    }
};