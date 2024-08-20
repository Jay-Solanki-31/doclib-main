<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOtherUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_user', function (Blueprint $table) {
            //
            $table->integer('title');
            $table->string('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_user', function (Blueprint $table) {
            //
            $table->dropColumn('title');
            $table->dropColumn('gender')->nullable();
        });
    }
}
