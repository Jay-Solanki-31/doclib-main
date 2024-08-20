<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObfuscatorToLibSubDirectories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lib_sub_directories', function (Blueprint $table) {
            $table->string('obfuscator')->after('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lib_sub_directories', function (Blueprint $table) {
            $table->dropColumn('obfuscator');
        });
    }
}
