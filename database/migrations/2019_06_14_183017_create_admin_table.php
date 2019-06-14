<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('v_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 20)->unique();
            $table->text('password');
            $table->string('call', 10)->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('avatar', 100)->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('create_time')->default(0);
            $table->unsignedInteger('update_time')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('v_admin', function (Blueprint $table) {
            //
        });
    }
}
