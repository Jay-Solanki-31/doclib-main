<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDirectoryPathToLibDirectories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lib_directories', function (Blueprint $table) {
            $table->string('directory_path')->after('directory_name');
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
            $table->dropColumn('directory_path');
        });
    }
}
