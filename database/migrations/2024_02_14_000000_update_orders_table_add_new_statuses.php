<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateOrdersTableAddNewStatuses extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processing', 'shipped', 'delivered', 'completed', 'cancelled')");
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processing', 'completed', 'cancelled')");
        });
    }
}