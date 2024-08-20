<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDirectoryIdToLibFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lib_files', function (Blueprint $table) {
            $table->bigInteger('directory_id')->unsigned()->after('file_extension');
            $table->foreign('directory_id')->references('id')->on('lib_directories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lib_files', function (Blueprint $table) {
            $table->dropColumn('directory_id');
        });
    }
}
