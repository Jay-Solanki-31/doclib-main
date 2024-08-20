<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //Deleted at for soft Delete and by who
            $table->string('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->string('gender');
            $table->integer('title');
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
            //Rollback the migration
            $table->dropColumn('deleted_at');
            $table->dropColumn('deleted_by');
            $table->dropColumn('gender');
            $table->dropColumn('title');
        });
    }
}
