<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add role first with default value
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('customer');
            }
        });

        // Add other fields in a separate operation
        Schema::table('users', function (Blueprint $table) {
            // Set default values for all fields to avoid MySQL strict mode issues
            $table->string('number')->default('')->change();
            $table->string('city')->default('')->change();
            $table->string('address')->default('')->change();
            $table->string('guarantor_name')->default('')->change();
            $table->string('guarantor_phone')->default('')->change();
            $table->string('guarantor_address')->default('')->change();
            $table->string('guarantor_cnic')->default('')->change();
            $table->string('bank_name')->default('')->change();
            $table->string('account_name')->default('')->change();
            $table->string('account_number')->default('')->change();
            $table->string('branch_code')->default('')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'number', 'city', 'address', 'guarantor_name',
                'guarantor_phone', 'guarantor_address', 'guarantor_cnic',
                'bank_name', 'account_name', 'account_number', 'branch_code'
            ]);
        });
    }
}