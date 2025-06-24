<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First check if the table exists
        if (Schema::hasTable('installment_transactions')) {
            // Drop the existing table
            Schema::dropIfExists('installment_transactions');
        }

        // Create the table with the new schema
        Schema::create('installment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->integer('installment_number');
            $table->date('due_date');
            $table->date('payment_date')->nullable();
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('installment_transactions');
    }
};