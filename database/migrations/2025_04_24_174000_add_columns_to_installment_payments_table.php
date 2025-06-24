<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('installment_payments')) {
            Schema::table('installment_payments', function (Blueprint $table) {
                // Add order_id if it doesn't exist
                if (!Schema::hasColumn('installment_payments', 'order_id')) {
                    $table->unsignedBigInteger('order_id')->first();
                }

                // Add amount if it doesn't exist
                if (!Schema::hasColumn('installment_payments', 'amount')) {
                    $table->decimal('amount', 10, 2)->after('order_id');
                }

                // Add installment_number if it doesn't exist
                if (!Schema::hasColumn('installment_payments', 'installment_number')) {
                    $table->integer('installment_number')->after('amount');
                }

                // Add due_date if it doesn't exist
                if (!Schema::hasColumn('installment_payments', 'due_date')) {
                    $table->date('due_date')->after('installment_number');
                }

                // Add status if it doesn't exist
                if (!Schema::hasColumn('installment_payments', 'status')) {
                    $table->string('status')->default('pending')->after('due_date');
                }

                // Add payment_date if it doesn't exist
                if (!Schema::hasColumn('installment_payments', 'payment_date')) {
                    $table->date('payment_date')->nullable()->after('status');
                }

                // Add timestamps if they don't exist
                if (!Schema::hasColumn('installment_payments', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('installment_payments', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }

                // Add foreign key if order_id exists and foreign key doesn't
                try {
                    if (Schema::hasColumn('installment_payments', 'order_id')) {
                        $table->foreign('order_id')
                              ->references('id')
                              ->on('orders')
                              ->onDelete('cascade');
                    }
                } catch (\Exception $e) {
                    // Foreign key might already exist
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('installment_payments')) {
            Schema::table('installment_payments', function (Blueprint $table) {
                // Try to drop foreign key if it exists
                try {
                    $table->dropForeign('installment_payments_order_id_foreign');
                } catch (\Exception $e) {
                    // Foreign key might not exist
                }

                // Drop columns if they exist
                $columnsToDrop = [];
                foreach(['order_id', 'amount', 'installment_number', 'due_date', 'status', 'payment_date', 'created_at', 'updated_at'] as $column) {
                    if (Schema::hasColumn('installment_payments', $column)) {
                        $columnsToDrop[] = $column;
                    }
                }

                if (!empty($columnsToDrop)) {
                    $table->dropColumn($columnsToDrop);
                }
            });
        }
    }
};
