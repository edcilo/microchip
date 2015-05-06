<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('permission_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('permission_user');
    }
}
