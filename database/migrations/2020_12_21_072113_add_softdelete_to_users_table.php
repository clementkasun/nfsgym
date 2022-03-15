<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeleteToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('last_name',255)->nullable();
            $table->string('address',255)->nullable();
            $table->string('contact_no',12)->nullable();
            $table->string('nic',12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('deleted_at');
          $table->dropColumn('nic');
          $table->dropColumn('contact_no');
          $table->dropColumn('address');
          $table->dropColumn('last_name');
          
        });
    }
}
