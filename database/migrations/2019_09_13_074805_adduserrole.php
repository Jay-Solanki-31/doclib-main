<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adduserrole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table){
            $table->dropColumn('name');
            $table->string('FirstName');
            $table->string('SecondName');
            $table->integer('UserRole');
            $table->string('Obfuscator')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function($table){
            $table->string('name');
            $table->dropColumn('FirstName');
            $table->dropColumn('SecondName');
            $table->dropColumn('UserRole');
            $table->dropColumn('Obfuscator');
        });
    }
}
