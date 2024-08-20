<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentDirExternalToLibSubDirectories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lib_sub_directories', function (Blueprint $table) {
            $table->bigInteger('parent_dir_external')->unsigned()->after('parent_dir_internal')->nullable();
            $table->foreign('parent_dir_external')->references('id')->on('lib_directories');
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
            $table->dropColumn('parent_dir_external');
        });
    }
}
