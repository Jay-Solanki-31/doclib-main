<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObfuscatorToLibDirectories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lib_directories', function (Blueprint $table) {
            $table->string('obfuscator')->after('directory_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lib_directories', function (Blueprint $table) {
            $table->dropColumn('obfuscator');
        });
    }
}
