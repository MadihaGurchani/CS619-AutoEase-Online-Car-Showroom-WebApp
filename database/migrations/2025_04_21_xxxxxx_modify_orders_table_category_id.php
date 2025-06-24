<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['category_id']);
            
            // Make category_id nullable
            $table->unsignedBigInteger('category_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('category_id')->nullable(false)->change();
        });
    }
};