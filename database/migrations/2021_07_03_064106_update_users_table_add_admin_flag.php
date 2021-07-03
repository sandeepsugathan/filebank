<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableAddAdminFlag extends Migration
{
    /**
     * Run the migrations - add admin flag to users table.
     *
     * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('admin', ['yes', 'no'])->after('remember_token')->default('no');
        });
    }

    /**
     * Reverse the migrations - remove admin flag from users table.
     *
     * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin');
        });
    }
}
